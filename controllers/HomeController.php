<?php

require_once(ROOT . '/models/Product.php');
require_once(ROOT . '/models/Category.php');
require_once(ROOT . '/resources/Utils/userTokenTracker.php');
require_once(ROOT . '/models/ServiceSupport.php');
require_once(ROOT . '/resources/Utils/Email.php');
class HomeController
{
    public function actionIndex()
    {   
        $user_id = userTokenTracker::isPreviousLogin();

        $allProducts = Product::allProducts();
        $allCategories = Category::allCategories();
        $sellers = Product::allSellers();
        
        require_once(ROOT . '/views/site/index.php');
        return true;
    }

    public function actionDonation()
    {
        print_r($_POST);
        $user_id = userTokenTracker::isPreviousLogin();
        $user = null;
        if($user_id)
        {
            $user = User::userBy('id', $user_id);
        }

        if(isset($_POST['submit']))
        {
            $name = $_POST['fullName'];
            $email = $_POST['email'];
            $amount = $_POST['donationAmount'];
            $message = $_POST['message'];
            $cardNumber = $_POST['cardNumber'];

            ServiceSupport::createDonation($name, $email, $amount, $cardNumber , $message);
            Email::sendThanksDonationEmail($email);
            require_once(ROOT . '/views/site/donationSuccess.php');
            return true;
        }

       
        require_once(ROOT . '/views/site/donation.php');
        return true;
    }


    public function actionAbout()
    {
        $user_id = userTokenTracker::isPreviousLogin();
        require_once(ROOT . '/views/site/about.php');
        return true;
    }

    public function actionContact()
    {
        $user_id = userTokenTracker::isPreviousLogin();
        $user = null;
        if($user_id)
        {
            $user = User::userBy('id', $user_id);
        }
        if(isset($_POST['submit']))
        {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];
            $problemType = $_POST['problemType'];

            ServiceSupport::createContact($name, $email, $message,$problemType);
            Email::sendThanksContactEmail($email);
            require_once(ROOT . '/views/site/contactSuccess.php');
            return true;
        }
        require_once(ROOT . '/views/site/contact.php');
        return true;
    }
}
?>