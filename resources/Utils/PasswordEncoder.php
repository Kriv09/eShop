<?php

class PasswordEncoder
{
    public static function encode($password)
    {
        return hash('sha256', $password);
    }

    public static function verify($password, $hash)
    {
        return hash('sha256', $password) === $hash;
    }
}   
?>