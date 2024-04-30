<?php

require_once(ROOT . '/resources/Utils/UserDataRules.php');
require_once(ROOT . '/resources/Utils/PasswordEncoder.php');
require_once(ROOT . '/resources/Utils/cartProductFormated.php');
require_once(ROOT . '/models/Product.php');

class User{

    private const ERROR_FAILED_LOGIN = "BadToken";
    // private const NO_PREVIOUS_LOGIN = "None";   

    public static function logOut($userToken)
    {
        $db = Db::getConnection();

        $query = "UPDATE userLoginTokens SET isTerminated = 1 WHERE token = '$userToken'";
        $db->exec($query);
        setcookie('userToken', '', -1, '/');
    }
    public static function register($name, $email, $password){
        $db = Db::getConnection();

        $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $password = PasswordEncoder::encode($password);

        
        $result = $db->prepare($query);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        return $result->execute();
    }

    private static function userCanLogIn($usernameOrEmail , $password)
    {
        $userExists = self::userCheckExistsByName($usernameOrEmail)
            || self::userCheckExistsByEmail($usernameOrEmail);
        if(!$userExists)
            return false;

        $db = Db::getConnection();

        $password = PasswordEncoder::encode($password);

        //Quote the string
        $usernameOrEmail = $db->quote($usernameOrEmail); 
        $password = $db->quote($password);

        $query = "SELECT * FROM users WHERE (name = $usernameOrEmail OR email = $usernameOrEmail) AND password = $password LIMIT 1";
        $result = $db->query($query);
        $data = $result->fetch();


        if($data === false)
            return false;

        return true;
    }

    public static function logIn($usernameOrEmail , $password)
    {
        if(!self::userCanLogIn($usernameOrEmail, $password))
            return self::ERROR_FAILED_LOGIN;

        $db = Db::getConnection();
        $user = self::userBy('name', $usernameOrEmail);
        if($user === false)
            $user = self::userBy('email', $usernameOrEmail);

        $userSessionToken = LogInToken::generateToken($user['name']);
        $query = "INSERT INTO userLoginTokens (user_id, token, isTerminated, createdOn) VALUES (:userId, :token, 0, NOW())";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':userId', $user['id']);
        $stmt->bindParam(':token', $userSessionToken);
        $stmt->execute();

        return $userSessionToken;
    }

    public static function verifyUserEmail($user_id)
    {
        $db = Db::getConnection();
        $query = "UPDATE users SET isEmailVerified = 1 WHERE id = $user_id";
        $db->exec($query);
    }

   
    
    public static function addToCart($userId, $productId, $quantity) {
        $db = Db::getConnection();

        $stmt = $db->prepare("SELECT * FROM cart WHERE user_id = :userId AND product_id = :productId");
        $stmt->execute([':userId' => $userId, ':productId' => $productId]);
        $productInCart = $stmt->fetch();

        if ($productInCart) {
            $stmt = $db->prepare("UPDATE cart SET quantity = quantity + :quantity WHERE user_id = :userId AND product_id = :productId");
            $stmt->execute([':userId' => $userId, ':productId' => $productId, ':quantity' => $quantity]);
        } else {
            $stmt = $db->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (:userId, :productId, :quantity)");
            $stmt->execute([':userId' => $userId, ':productId' => $productId, ':quantity' => $quantity]);
        }
    }

    public static function getCartProducts($userId) {
        $db = Db::getConnection();

        $query = "SELECT * FROM cart WHERE user_id = $userId";
        $result = $db->query($query);

        $data = $result->fetchAll();
        return $data;
    }


    public static function getCartProductsFormated($userId)
    {
        $db = Db::getConnection();
        $query = "SELECT * FROM cart WHERE user_id = $userId";
        $result = $db->query($query);
        $allProducts = $result->fetchAll();


        $formatedProducts = array();
        $indexer = 1;
        foreach ($allProducts as $product) {
            $productDetails = Product::productDetails($product['product_id']);
            $product = new cartFormatedProduct($indexer,$productDetails['name'], $productDetails['price'], $product['quantity'], $productDetails['price'] * $product['quantity'], $product['product_id']);
            array_push($formatedProducts, $product);
            $indexer++;
        }
        return $formatedProducts;
    }

    public static function getCartProudctsTotalPrice($userId)
    {
        $db = Db::getConnection();
        $query = "SELECT SUM(products.price * cart.quantity) as total FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id = $userId";
        $result = $db->query($query);
        $data = $result->fetch();
        return $data['total'];
    }
    

    
    public static function updateCartQuantity($cartId, $newQuantity) {
        $db = Db::getConnection();
        $stmt = $db->prepare("UPDATE cart SET quantity = :quantity WHERE id = :id");
        $stmt->bindParam(':quantity', $newQuantity, PDO::PARAM_INT);
        $stmt->bindParam(':id', $cartId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function removeProductFromCart($userId, $productId) {
        $db = Db::getConnection();
        $stmt = $db->prepare("DELETE FROM cart WHERE user_id = :userId AND product_id = :productId");
        $stmt->execute([':userId' => $userId, ':productId' => $productId]);
    }

    
    public static function getUserOrders($userId){
        $db = Db::getConnection();
        $query = "SELECT * FROM orders WHERE user_id = $userId";
        $result = $db->query($query);
        $data = $result->fetchAll();
        return $data;
    }

   
    public static function checkout($userId) {
        $db = Db::getConnection();

        $db->beginTransaction();

        try {
            $stmt = $db->prepare("INSERT INTO orders (user_id,totalPrice) VALUES (:user_id,:totalPrice)");
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $totalPrice = self::getCartProudctsTotalPrice($userId);
            $stmt->bindParam(':totalPrice', $totalPrice, PDO::PARAM_INT);
            $stmt->execute();

            $orderId = $db->lastInsertId();

            $stmt = $db->prepare("INSERT INTO order_items (order_id, product_id, quantity)
                                SELECT :order_id, product_id, quantity FROM cart WHERE user_id = :user_id");
            $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();

            $stmt = $db->prepare("DELETE FROM cart WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();

            $db->commit();

            return true;
        } catch (Exception $e) {
            $db->rollBack();
            return false;
        }
    }


    public static function checkName($name){
        return UserDataRules::ValidateUsername($name);
    }

    public static function checkEmail($email){
        return UserDataRules::ValidateEmail($email);
    }

    public static function checkPassword($password){
        return UserDataRules::ValidatePassword($password);
    }


    public static function userBy($paramName, $param){
        $db = Db::getConnection();

        $query = "SELECT * FROM users WHERE $paramName = '$param' LIMIT 1";
        $result = $db->query($query);

        $data = $result->fetch();
        return $data;
    }

    public static function userCheckExistsByEmail($email){
        $db = Db::getConnection();

        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $result = $db->prepare($query);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
        $data = $result->fetch();

        return $data == true;
    }

    public static function userCheckExistsByName($name){
        $db = Db::getConnection();

        $query = "SELECT * FROM users WHERE name = :name LIMIT 1";
        $result = $db->prepare($query);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->execute();
        $data = $result->fetch();

        return $data == true;
    }


    public static function getUserByToken($userToken)
    {
        $db = Db::getConnection();

        $query = "SELECT * FROM users WHERE id = (SELECT user_id FROM userLoginTokens WHERE token = :token AND isTerminated = 0)";
        $result = $db->prepare($query);
        $result->bindParam(':token', $userToken, PDO::PARAM_STR);
        $result->execute();
        $data = $result->fetch();

        return $data;
    }

    public static function changeUserParam($userId,$param,$value, $isString = true)
    {

        $db = Db::getConnection();
        if($isString)
            $query = "UPDATE users
            SET $param = '$value' 
            WHERE id = $userId";
        else
            $query = "UPDATE users
            SET $param = $value'
            WHERE id = $userId";
        $db->query($query);
    }

}
?>