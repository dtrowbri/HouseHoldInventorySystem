<?php

//require_once './database.php';

class AuthenticationDAO {
    
    function authenticate(?string $Email, ?string $Password, $conn){
        $query = "select count(Email) as `count` from users where Email = ? and Password = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $Email, PDO::PARAM_STR);
        $stmt->bindParam(2, $Password, PDO::PARAM_STR);

        $stmt->execute();
        
        $result = $stmt->fetch();
        //echo '<br>$result[count]:' . $result['count'];
        if($result['count'] == 1){
            return true;
        } else {
            return false;
        }
    }
       
}
?>