<?php

require_once(ROOT . '/models/Product.php');
require_once(ROOT . '/resources/Utils/userTokenTracker.php');

class ProductController
{
    public function actionView($id)
    {
        $user_id = userTokenTracker::isPreviousLogin();
        $selectedProduct = Product::productById($id);
        $seller = Product::getProductSeller($selectedProduct['id']);     
        require_once(ROOT . '/views/product/productView.php');
        return true;
    }
}

?>