<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// require_once(ROOT . 'vendor/autoload.php');
require 'resources/Utils/phpMailer/src/Exception.php';
require 'resources/Utils/phpMailer/src/PHPMailer.php';
require 'resources/Utils/phpMailer/src/SMTP.php';

require_once(ROOT . '/models/User.php');

class Email
{

    const EMAIL_APP_PASSWORD = 'bymd exsp pdij yewh';
    const EMAIL_APP_USERNAME = 'EshopNazar@gmail.com';
    public static function sendVerificationEmail($email)
    {
        $user = User::userBy('email', $email);
        $user_id = $user['id'];

        //Basic settings
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = self::EMAIL_APP_USERNAME;
        $mail->Password = self::EMAIL_APP_PASSWORD;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom(self::EMAIL_APP_USERNAME);
        $mail->addAddress($email);
        $mail->isHTML(true);

        $mail->Subject = 'Email Verification';
        $mail->Body = "Please click the link below to verify your email address: <a href=" . "http://eshop/user/" . $user_id ."/verifyEmail>" . "Verify Email</a>" . "\n" . "Thank you!";
        $mail->send();
    }

    public static function sendReceipt($email, $allProducts, $totalPrice,$address,$phone,$name,$paymentMethod)
    {

        $user = User::userBy('email', $email);
        $user_id = $user['id'];

        //Basic settings
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = self::EMAIL_APP_USERNAME;
        $mail->Password = self::EMAIL_APP_PASSWORD;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom(self::EMAIL_APP_USERNAME);
        $mail->addAddress($email);
        $mail->isHTML(true);

        $mail->Subject = 'Your Receipt';
        $mail->Body = "<h1 style='text-align: center;'>Thank you for your purchase!</h1>"
            . "<h2 style='text-align: center;'>Here is your receipt:</h2>"
            . "<table style='width: 100%; border-collapse: collapse;'>"
            . "<thead>"
            . "<tr style='background-color: #f2f2f2;'>"
            . "<th style='padding: 15px; border: 1px solid #ddd;'>Product Name</th>"
            . "<th style='padding: 15px; border: 1px solid #ddd;'>Price</th>"
            . "<th style='padding: 15px; border: 1px solid #ddd;'>Quantity</th>"
            . "</tr>"
            . "</thead>"
            . "<tbody>";
        foreach ($allProducts as $product) {
            $mail->Body .= "<tr>"
                . "<td style='padding: 15px; border: 1px solid #ddd;'>" . $product->name . "</td>"
                . "<td style='padding: 15px; border: 1px solid #ddd;'>" . $product->price . "</td>"
                . "<td style='padding: 15px; border: 1px solid #ddd;'>" . $product->quantity . "</td>"
                . "</tr>";
        }
        $mail->Body .= "</tbody>"
            . "</table>"
            . "<h3 style='text-align: center;'>Total Price: $" . $totalPrice . "</h3>"
            . "<p style='text-align: center;'>Delivery Address: " . $address . "</p>"
            . "<p style='text-align: center;'>Phone Number: " . $phone . "</p>"
            . "<p style='text-align: center;'>Name: " . $name . "</p>"
            . "<p style='text-align: center;'>Payment Method: " . $paymentMethod . "</p>"
            . "<h2 style='text-align: center;'>Thank you!</h2>";
        $mail->send();
    }

    public static function sendConfirmEmail($email)
    {
        $user = User::userBy('email', $email);
        $user_id = $user['id'];

        //Basic settings
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = self::EMAIL_APP_USERNAME;
        $mail->Password = self::EMAIL_APP_PASSWORD;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom(self::EMAIL_APP_USERNAME);
        $mail->addAddress($email);
        $mail->isHTML(true);

        $mail->Subject = 'Confirm Changing Email';
        $mail->Body = "Please click the link below to verify that you change your email: <a href=" . "http://eshop/user/" . $user_id ."/personalProfile/changingPassword/verif/confirm>" . "Verify</a>" . "\n" . "Thank you!";
        $mail->send();
    }

    public static function sendThanksDonationEmail($email)
    {
        $user = User::userBy('email', $email);
        $user_id = $user['id'];

        //Basic settings
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = self::EMAIL_APP_USERNAME;
        $mail->Password = self::EMAIL_APP_PASSWORD;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom(self::EMAIL_APP_USERNAME);
        $mail->addAddress($email);
        $mail->isHTML(true);

        $mail->Subject = 'Thank you for your donation!';
        $mail->Body = "<h1 style='text-align: center;'>Thank you for your donation!</h1>"
            . "<h2 style='text-align: center;'>We appreciate your support!</h2>"
            . "<h2 style='text-align: center;'>Thank you!</h2>";
        $mail->send();
    }

    public static function sendThanksContactEmail($email)
    {
        $user = User::userBy('email', $email);
        $user_id = $user['id'];

        //Basic settings
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = self::EMAIL_APP_USERNAME;
        $mail->Password = self::EMAIL_APP_PASSWORD;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom(self::EMAIL_APP_USERNAME);
        $mail->addAddress($email);
        $mail->isHTML(true);

        $mail->Subject = 'Thank you for contacting us!';
        $mail->Body = "<h1 style='text-align: center;'>Thank you for contacting us!</h1>"
            . "<h2 style='text-align: center;'>We will get back to you as soon as possible!</h2>"
            . "<h2 style='text-align: center;'>Thank you!</h2>";
        $mail->send();
    }
}

?>