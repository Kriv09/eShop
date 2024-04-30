<?php

class Product
{
    public static function allProducts()
    {
        $db = Db::getConnection();

        $query = "SELECT * FROM products";

        $result = $db->query($query);

        $data = $result->fetchAll();

        return $data;
    }


    public static function productById($id)
    {
        $db = Db::getConnection();

        $query = "SELECT * FROM products WHERE id = $id LIMIT 1";

        $result = $db->query($query);

        $data = $result->fetch();

        return $data;
    }

    public static function productDetails($productId)
    {
        $db = Db::getConnection();

        $query = "SELECT * FROM products WHERE id = $productId";

        $result = $db->query($query);

        $data = $result->fetch();

        return $data;
    }

    public static function searchProducts($search)
    {
        $db = Db::getConnection();
        $query = "SELECT * FROM products WHERE name LIKE '%$search%'";
        $result = $db->query($query);
        $data = $result->fetchAll();
        return $data;
    }

    public static function allSellers()
    {
        $db = Db::getConnection();

        $query = "SELECT * FROM sellers";

        $result = $db->query($query);

        $data = $result->fetchAll();

        return $data;
    }


    public static function getProductSeller($product_id) {

        $db = Db::getConnection();
        $stmt = $db->prepare("SELECT sellers.name, sellers.details, sellers.about, sellers.rate FROM sellers 
                                     INNER JOIN products ON sellers.id = products.seller_id 
                                     WHERE products.id = :product_id");
    
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result;
    }
}


?>