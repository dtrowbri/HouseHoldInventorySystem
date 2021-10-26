<?php
//require_once './database.php';
//require_once '../business/models/user.php';
class UserDAO {
    
    function addUser(?User $user, $conn){
        $query = "insert into users (Id, Email, Password, FirstName, LastName) values (null, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        $stmt->bindValue(1, $user->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(2, $user->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(3, $user->getFirstName(), PDO::PARAM_STR);
        $stmt->bindValue(4, $user->getLastName(), PDO::PARAM_STR);
  
        $stmt->execute();
        
        if($stmt->rowCount() == 1){
            return true;
        } else {
            return false;
        } 
    }
}

?>