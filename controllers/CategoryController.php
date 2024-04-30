<?php

require_once(ROOT . '/models/Product.php');
require_once(ROOT . '/models/Category.php');
require_once(ROOT . '/resources/Utils/userTokenTracker.php');

class CategoryController
{
    public function actionShowByName($categoryName)
    {
        $user_id = userTokenTracker::isPreviousLogin();
        
        $categoryProducts = Category::categoryProducts($categoryName);
        $allCategories = Category::allCategories();

        require_once(ROOT . '/views/category/categoryView.php');
        return true;
    }

}




?>