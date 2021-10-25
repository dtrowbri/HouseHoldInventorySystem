<?php

//require_once './database.php';

class AuthenticationDAO {
    
    function authenticate(?int $UserId, ?string $Password, $conn){
        $query = "select count(Id) as `count` from users where Id = ? and Password = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $UserId, PDO::PARAM_INT);
        $stmt->bindParam(2, $Password, PDO::PARAM_STR);

        $stmt->execute();
        
        $result = $stmt->fetch();
        
        if($result['count'] == 1){
            return true;
        } else {
            return false;
        }
    }
       
}
?>