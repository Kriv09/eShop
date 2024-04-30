<?php

class UserDataRules 
{
    //username
    public const MIN_USERNAME_LENGTH = 3;
    public const MAX_USERNAME_LENGTH = 20;

    //password
    public const MIN_PASSWORD_LENGTH = 6;
    public const MAX_PASSWORD_LENGTH = 20;
    
    //email
    public const MIN_EMAIL_LENGTH = 6;
    public const MAX_EMAIL_LENGTH = 50;

    const NOT_ALLOWABLE_USERNAME_SYMBOLS = "@#$%^&*()+=-[]';,./{}|:<>?~"; // For Username and Email (Except for the '@' symbol for email)

    public static function ValidateUsername($username)
    {
        return  strlen($username) >= self::MIN_USERNAME_LENGTH 
                && strlen($username) <= self::MAX_USERNAME_LENGTH
                && !strpbrk($username, self::NOT_ALLOWABLE_USERNAME_SYMBOLS);
    }

    public static function ValidatePassword($password)
    {
        return  strlen($password) >= self::MIN_PASSWORD_LENGTH 
                && strlen($password) <= self::MAX_PASSWORD_LENGTH;
    }

    public static function ValidateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) 
           && strlen($email) >= self::MIN_EMAIL_LENGTH 
           && strlen($email) <= self::MAX_EMAIL_LENGTH;
    }
}

?>