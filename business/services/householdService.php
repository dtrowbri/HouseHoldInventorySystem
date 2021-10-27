<?php
require_once 'database/database.php';
require_once 'business/models/household.php';
require_once 'database/householddao.php';

class HouseHoldService {
    
    private $database;
    
    function __construct(){
        $this->database = new Database();
    }
    
    function addHouseHold(?HouseHold $HouseHold){
        $conn = $this->database->getConnection();
        $dao = new HouseHoldDAO();
        $conn->beginTransaction();
        $results = $dao->addHouseHold($HouseHold, $conn);
        
        if($results){
            $conn->commit();
        } else {
            $conn->rollBack();
        }
        
        return $results;
    }
    
    function deleteHouseHold(?int $HouseHoldId){
        $conn = $this->database->getConnection();
        $dao = new HouseHoldDAO();
        $conn->beginTransaction();
        $results = $dao->deleteHouseHold($HouseHoldId, $conn);
        
        if($results){
            $conn->commit();
        } else {
            $conn->rollBack();
        }
        
        return $results;
    }
    
    function updateHouseHold(?HouseHold $HouseHold){
        $conn = $this->database->getConnection();
        
        $dao = new HouseHoldDAO();
        $conn->beginTransaction();
        
        $results = $dao->updateHouseHold($HouseHold, $conn);
        
        if($results){
            $conn->commit();
        } else {
            $conn->rollBack();
        }
        
        return $results;
    }
    
    function getHouseHolds(?int $UserId){
        $conn = $this->database->getConnection();
        $dao = new HouseHoldDAO();
        $results = $dao->getHouseHolds($UserId, $conn);
        return $results;
    }
    
    function getHouseHold(?int $HHID){
        $conn = $this->database->getConnection();
        $dao = new HouseHoldDAO();
        $results = $dao->getHouseHold($HHID, $conn);
        return $results;
    }
}

?>
