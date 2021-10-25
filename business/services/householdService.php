<?php
require_once 'business/models/household.php';
class HouseHoldService {
    
    
    function __construct(){
        
    }
    
    function addHouseHold(?HouseHold $HouseHold){
        //This code is test code for the front-end user. Real code will be added later
        if($HouseHold->getAddress() != null && $HouseHold->getName() != null && $HouseHold->getUserId() != null){
            return true;
        } else {
            return false;
        }
    }
    
    function deleteHouseHold(?int $HouseHoldId){
        //This code is test code for the front-end user. Real code will be added later
        return true;
    }
    
    function updateHouseHold(?HouseHold $HouseHold){
        //This code is test code for the front-end user. Real code will be added later
        return true;
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