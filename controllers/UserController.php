<?php
require_once(ROOT . '/models/User.php');
require_once(ROOT . '/resources/Utils/PasswordEncoder.php');
require_once(ROOT . '/resources/Utils/LogInToken.php');
require_once (ROOT . '/resources/Utils/Email.php');

class UserController
{
    public function actionRegister()
    {
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            if (!User::checkName($name) ||
                !User::checkEmail($email) ||
                !User::checkPassword($password)) {

                require_once(ROOT . '/views/user/register/ErrorRegister.php');
                return true;
            }

            $userExists = User::userCheckExistsByEmail($email);
            if(!$userExists)
                User::register($name, $email, $password);
            else
            {
                require_once(ROOT . '/views/user/register/userAlreadyExists.php');
                return true;
            }
    
            $_POST = array();
            require_once(ROOT . '/views/user/register/successfulyRegistered.php');
            return true;
        }
    
        require_once(ROOT . '/views/user/register/userRegister.php');
        return true;
    }  

    public function actionVerifyEmail($user_id)
    {
        $user = User::userBy('id', $user_id);
        User::verifyUserEmail($user_id);
        require_once(ROOT . '/views/user/emailVerification/successVerifiedEmail.php');
        return true;
    }

    public function actionEmailVerification($user_id)
    {
        $user = User::userBy('id', $user_id);
        Email::sendVerificationEmail($user['email']);
        require_once(ROOT . '/views/user/emailVerification/emailVerification.php');
        return true;
    }

    public function actionLogin()
    {
        if (isset($_POST['submit'])) {
            $nameOrEmail = $_POST['name'];
            $password = $_POST['password'];


            $userToken = User::logIn($nameOrEmail, $password);
            if($userToken === "BadToken")
            {
                require_once(ROOT . '/views/user/login/userFailedLogin.php');
                return true;
            }


            // Save info in cookies...
            // if(isset($_POST['rememberMe']) && $_POST['rememberMe'] == 1)
            setcookie('userToken', $userToken, time() + (86400 * 30), "/"); 

            require_once(ROOT . '/views/user/login/userSuccessLogin.php');
            return true;
        }
        

        $_POST = array();
        require_once(ROOT . '/views/user/login/userLogin.php');
        return true;
    }



    public function actionPersonalProfile($id)
    {
        $user = User::userBy('id',$id);
        $user_id = $user['id'];
        $userOrders = User::getUserOrders($user_id);

        require_once(ROOT . '/views/user/personalProfile/personalProfile.php');
        return true;
    }

    public function actionBuyProduct($userId, $productId)
    {
        User::addToCart($userId, $productId,1);
        header("Location: /");
        return true;
    }

    public function actionProcessOrder($userId)
    {
        $user = User::userBy('id',$userId);
        $totalPrice = User::getCartProudctsTotalPrice($userId);

        if (isset($_POST['takerName']) && isset($_POST['takerPhoneNumber']) && isset($_POST['deliveryService']) && isset($_POST['paymentMethod'])) {

            // Process the payment (virtual)

            Email::sendReceipt($_POST['takerEmail'], User::getCartProductsFormated($userId), $totalPrice, $_POST['takerAddress'], $_POST['takerPhoneNumber'], $_POST['takerName'], $_POST['paymentMethod']);
            User::checkout($userId);
            require_once(ROOT . '/views/user/order/orderSuccessful.php');
            return true;
        } 

        require_once(ROOT . '/views/user/order/proccessingOrder.php');
        return true;
    }


    public function actionLogout()
    {
        $userToken = $_COOKIE['userToken'];
        User::logOut($userToken);
        header('Location: /');
        return true;
    } 

    public function actionCart($userId)
    {
        $user = User::userBy('id',$userId);
        $allUserProducts = User::getCartProductsFormated($userId);
        $totalPrice = User::getCartProudctsTotalPrice($userId);
        require_once(ROOT . '/views/user/cart/userCart.php');
        return true;
    }

    public function actionRemoveProduct($userId, $productId)
    {
        User::removeProductFromCart($userId, $productId);
        header("Location: /user/$userId/cart");
        return true;
    }
}

?>