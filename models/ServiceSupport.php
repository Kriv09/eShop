<?php

class ServiceSupport
{
    public static function createDonation($name, $email, $amount, $cardNumber, $message)
    {
        $db = Db::getConnection();
        $query = "INSERT INTO donations (name, email, amount, cardNumber, message) VALUES (:name, :email, :amount, :cardNumber , :message)";
        $result = $db->prepare($query);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':amount', $amount, PDO::PARAM_INT);
        $result->bindParam(':cardNumber', $cardNumber, PDO::PARAM_INT);
        $result->bindParam(':message', $message, PDO::PARAM_STR);
        $result->execute();
    }

    public static function createContact($name, $email, $message, $problemType)
    {
        $db = Db::getConnection();
        $query = "INSERT INTO contacts (name, email, message, problemType) VALUES (:name, :email, :message, :problemType)";
        $result = $db->prepare($query);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':message', $message, PDO::PARAM_STR);
        $result->bindParam(':problemType', $problemType, PDO::PARAM_STR);
        $result->execute();
    }
}

?>