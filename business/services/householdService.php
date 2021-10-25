<?php

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
    
    function getHouseHolds(){
        //This code is test code for the front-end user. Real code will be added later
        $HouseHolds = array();
        $HouseHold1 = new HouseHold("HouseHold1", "1234 Elm St Phoenix Az", 1);
        $HouseHold1->setId(1);
        $HouseHold2 = new HouseHold("HouseHold2", "5678 Professor Oak St Pallet Town AZ", 1);
        $HouseHold2->setId(2);
        
        array_push($HouseHolds, $HouseHold1);
        array_push($HouseHolds, $HouseHold2);
        
        return $HouseHolds;
    }
}


?>