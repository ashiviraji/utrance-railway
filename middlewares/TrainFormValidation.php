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
            $this->errorArray['TrainNameError'] = 'Train name not valid';
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
        $results1 = $this->sameTrainname($tn, $rn);
        if($results1==='success'){
          
            $this->errorArray['TrainNameError'] = 'Train Name already exists';
            // echo $rid;
  
            }
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
            $this->errorArray['TrainNameError'] = 'train name not valid';
        }    

        if (is_numeric($tn)) {
            $this->errorArray['TrainNameError'] = 'first name only letters required';
        }

        if (empty($tn)) {
            $this->errorArray['TrainNameError'] = 'enter valid train name';
            
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

    public function sameTrainname($inputText , $rid){
        $query = APP::$APP->db->pdo->prepare("SELECT COUNT(train_name) FROM trains WHERE train_name = :train_name ");
        $query->bindValue(":train_name",$inputText);
     
        $query->execute();
       

        $this->resultArray = $query->fetchAll(PDO::FETCH_ASSOC);
         
        // var_dump( $this->resultArray["trains"]);
       if($this->resultArray[0]['COUNT(train_name)']=='2' ){
         return 'success';
        
       }
    }

    



    

}

?>