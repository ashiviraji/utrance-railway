<?php
include_once "../models/UserModel.php";
include_once "../models/AdminModel.php";
include_once "../classes/core/Model.php";


class TrainFormValidation{

public $errorArray=[];
   public function runValidators($array)
    {
        
        $this->validateTrainName(trim($array['train_name']), trim($array['route_id'])); 
        $this->validateRouteId(trim($array['route_id'])); 
        $this->validateTravelDays(implode($array['train_travel_days'])); 
        $this->validateTrainFc(trim($array['train_fc_seats'])); 
        $this->validateTrainSc(trim($array['train_sc_seats'])); 
        $this->validateTrainSleepingB(trim($array['train_sleeping_berths'])); 
        $this->validateTrainweight(trim($array['train_total_weight'])); 
        return $this->errorArray;
       


    }

    public function validateTravelDays($tn) 

    {
        if (empty($tn)) {
            $this->errorArray['TravalDaysError'] = 'enter travel days';
            
           
        }
    }





    public function runValidators1($array)
    {
        $this->validateTrainName1(trim($array['train_name'])); 
        
        $this->validateTravelDays($array['train_travel_days']); 
        $this->validateRouteId(trim($array['route_id']));
        $this->validateTrainFc(trim($array['train_fc_seats'])); 
        $this->validateTrainSc(trim($array['train_sc_seats'])); 
        $this->validateTrainSleepingB(trim($array['train_sleeping_berths'])); 
        $this->validateTrainweight(trim($array['train_total_weight'])); 
        return $this->errorArray;
        return $this->errorArray;
       
    }

    private function validateTrainFc($tn)
    {
         if($tn<0) {
            $this->errorArray['TrainFcError'] = 'Number of seats greater than 0';
        } 
        // if (ctype_digit($tn)) {
        //     $this->errorArray['TrainFcError'] = 'Num Wrong length';
        //  }
        

    }
    private function validateTrainSc($tn)
    {
        if($tn<0) {
            $this->errorArray['TrainscError'] = 'Number of seats greater than 0';
        } 
        // if (ctype_digit($tn)) {
        //     $this->errorArray['TrainFcError'] = 'Num Wrong length';
        // }

    }
    private function validateTrainSleepingB($tn)
    {
        if($tn<0) {
            $this->errorArray['TrainSleepingBError'] = 'Number of seats greater than 0';
        } 
        // if (ctype_digit($tn)) {
        //     $this->errorArray['TrainFcError'] = 'Num Wrong length';
        // }

    }
    private function validateTrainweight($tn)
    {
        if($tn<0) {
            $this->errorArray['TrainweightError'] = 'weight greter than 0';
        }

    }
    private function validateRouteId($tn)
    {
        if (empty($tn)) {
        $this->errorArray['TrainRouteError'] = 'Route not valid';
        }
    }


    private function validateTrainName($tn, $rn) 

    {
        if (strlen($tn) < 2 || strlen($tn) > 50) {
            $this->errorArray['TrainNameError'] = 'Length should be in between 2 and 50 characters';
        }    

        if (is_numeric($tn)) {
            $this->errorArray['TrainNameError'] = 'Train name only letters required';
        }

        if (empty($tn)) {
            $this->errorArray['TrainNameError'] = 'Enter train name';
            
            // var_dump($this->errorArray);
        }
        // $this->my($tn, $rn);
        $results = $this->sameTrains($tn, $rn);
        // var_dump($results);
        if($results==='success'){
           
                    $this->errorArray['RoutIdError'] = 'Route_id is not valid';
                    // echo $rid;
          
                    
        }
       
        // $trains="";

        

    }

    private function validateTrainName1($tn) 

    {
        if (strlen($tn) < 2 || strlen($tn) > 50) {
            $this->errorArray['TrainNameError'] = 'Length should be in between 2 and 50 characters';
        }    

        if (is_numeric($tn)) {
            $this->errorArray['TrainNameError'] = 'Name should not start with a digit';
        }

        if (empty($tn)) {
            $this->errorArray['TrainNameError'] = 'Enter valid train name';
            
            // var_dump($this->errorArray);
        }

    }

    public function sameTrains($inputText , $rid){
        $query = APP::$APP->db->pdo->prepare("SELECT * FROM trains WHERE (train_name = :train_name AND route_id=:route_id) OR route_id=:route_id ");
        $query->bindValue(":train_name",$inputText);
        $query->bindValue(":route_id",$rid);
        $query->execute();

        $this->resultArray["trains"] = $query->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($this->resultArray["trains"]);
        // var_dump( $this->resultArray["trains"]);
       if(!empty($this->resultArray["trains"] )){
        return 'success';
       }
    }

    



    

}

?>