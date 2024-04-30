<?php

require_once(ROOT . '/models/User.php');

class userTokenTracker
{
    private static function checkIsLogin()
    {
        return isset($_COOKIE['userToken']) == true;
    }

    public static function isPreviousLogin()
    {
        if(self::checkIsLogin())
        {
            $user = User::getUserByToken($_COOKIE['userToken']);
            return $user_id = $user['id'];
        }
        return "None";
    }

}

?>