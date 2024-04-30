<?php

class Category
{

    public static function allCategories()
    {

        $db = Db::getConnection();

        $query = "SELECT id, name FROM categories";

        $result = $db->query($query);

        $data = $result->fetchAll();

        return $data;
    }

    public static function categoryProducts($categoryName)
    {
        $db = Db::getConnection();

        $query = "SELECT * FROM products WHERE category_id = (SELECT id FROM categories WHERE name = :categoryName)";

        $result = $db->prepare($query);
        $result->bindParam(':categoryName', $categoryName, PDO::PARAM_STR);
        $result->execute();

        $data = $result->fetchAll();

        return $data;
    }

    public static function filterProducts($products, $categoryName)
    {
        $resultData = [];
        foreach ($products as $product) {
            if($product['category_id'] == (Category::getCategory('name', $categoryName)['id'])) {
                array_push($resultData, $product);
            }
        }
        return $resultData;
    }


    public static function getCategory($param, $value)
    {
        $db = Db::getConnection();
        if (is_string($value)) {
            $value = "'$value'";
        }
        $query = "SELECT * FROM categories WHERE $param = $value";
        $result = $db->query($query);
        $data = $result->fetch();
        return $data;
    }
}
?>
