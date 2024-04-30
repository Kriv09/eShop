<?php



class LogInToken
{
    public static function generateToken($username)
    {
        $token = hash('sha256', $username . time());
        return $token;
    }

    public static function verifyToken($token, $username)
    {
        $generatedToken = hash('sha256', $username . time());
        return $token === $generatedToken;
    }

    public static function saveToken($token, $username)
    {
        $db = Db::getConnection();
        $userId = User::userBy('name', $username)['id'];
        $query = "INSERT INTO userLoginTokens (user_id, token, isTerminated, createdOn) VALUES ('$userId','$token', 0, NOW())";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':token', $token);
        $stmt->execute(); 
    }
}

?>