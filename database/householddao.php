<?php

//require_once './database.php';
//require_once '../business/models/household.php';

class HouseHoldDAO {
    
    function addHouseHold(?HouseHold $HouseHold, $conn){
        $query = "insert into households (Id, Name, Address, UserId) values (null, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        
        $stmt->bindParam(1, $HouseHold->getName(), PDO::PARAM_STR);
        $stmt->bindParam(2, $HouseHold->getAddress(), PDO::PARAM_STR);
        $stmt->bindParam(3, $HouseHold->getUserId(), PDO::PARAM_INT);

        $stmt->execute();

        if($stmt->rowCount() == 1){
            return true;
        } else {
            return false;
        }
    }
    
    function deleteHouseHold(?int $Id, $conn){
        $query = "delete from households where Id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $Id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        if($stmt->rowCount() == 1){
            return true;
        } else {
            return false;
        }
    }
    
    function getHouseHolds(?int $UserId, $conn){
        $query = "select Id, Name, Address, UserId from households where UserId = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $UserId, PDO::PARAM_INT);

        $stmt->execute();

        if($stmt->rowCount() > 0){
            $households = array();
            $results = $stmt->fetchAll();
            
            foreach($results as $result){
                $household = new HouseHold($result["Name"], $result["Address"], $result["UserId"]);
                $household->setId($result["Id"]);
                array_push($households, $household);
            }
          
            return $households;            
        } else {
            return null;
        }
    }
    
    function updateHouseHold(?HouseHold $HouseHold, $conn){
        $query = "update households set Name = ?, Address = ? where Id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $HouseHold->getName(), PDO::PARAM_STR);
        $stmt->bindParam(2, $HouseHold->getAddress(), PDO::PARAM_STR);
        $stmt->bindParam(3, $HouseHold->getId(), PDO::PARAM_INT);

        $stmt->execute();
        
        if($stmt->rowCount() == 1){
            return true;
        } else {
            return false;
        }
    }
}
?>