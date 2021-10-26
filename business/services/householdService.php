<?php

//require_once '../../database/database.php';
//require_once '../../database/householddao.php';
//require_once '../models/household.php';

class HouseHoldService {
    
    private $database;
    
    function __construct(){
        $this->database = new Database();
    }
    
    function addHouseHold(?HouseHold $HouseHold){
        $conn = $this->database->getConnection();
        $dao = new HouseHoldDAO();
        $results = $dao->addHouseHold($HouseHold, $conn);
        return $results;
    }
    
    function deleteHouseHold(?int $HouseHoldId){
        $conn = $this->database->getConnection();
        $dao = new HouseHoldDAO();
        $results = $dao->deleteHouseHold($HouseHoldId, $conn);
        return $results;
    }
    
    function updateHouseHold(?HouseHold $HouseHold){
        $conn = $this->database->getConnection();
        $dao = new HouseHoldDAO();
        $results = $dao->updateHouseHold($HouseHold, $conn);
        return $results;
    }
    
    function getHouseHolds(?int $UserId){
        $conn = $this->database->getConnection();
        $dao = new HouseHoldDAO();
        $results = $dao->getHouseHolds($UserId, $conn);
        return $results;
    }
}

?>