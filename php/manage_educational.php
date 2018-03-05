<?php
include_once("../config.php");
include("../classes/autoloader.php");

loadPackage("../");

use SIMS\App\Models\AdminModel;

$hasErrors = 0;

$adminModel = new AdminModel();

$action = $_POST['action'] ?? "";



if($action == "create"){

    $curriculum_id = $adminModel->insertEducational($_POST['description'] , $_POST['duration']);
    
    
    if($curriculum_id){
        foreach($_POST['level_name'] as $level){
            $result = $adminModel->insertSchoolLevel($curriculum_id, $level);
            
            if(!$result){
                $hasErrors++;
            }
        }
    }
    
    
    if($hasErrors == 0){
        $callback['code'] = "00";
        $callback['message'] = "Successfully performed the operation.";
    }else{
        $callback['code'] = "01";
        $callback['message'] = "Unable to proceed with the operation. Please contact support.";
    }
    
    
    echo json_encode($callback, JSON_PRETTY_PRINT);
} else if ($action == "save"){

    $curriculum_id = $_POST['curr_id'] ?? "";
    if(!empty($curriculum_id)){

        $result = $adminModel->editEducational($_POST['description'], $_POST['duration'], $curriculum_id);
        if(!$result){
            $hasErrors++;
        }

        $result = $adminModel->deleteSchoolLevel($curriculum_id);

        if($curriculum_id){
            foreach($_POST['level_name'] as $level){
                $result = $adminModel->insertSchoolLevel($curriculum_id, $level);
                
                if(!$result){
                    $hasErrors++;
                }
            }
        }


        if($hasErrors == 0){
            $callback['code'] = "00";
            $callback['message'] = "Information saved.";
        }else{
            $callback['code'] = "01";
            $callback['message'] = "Unable to proceed with the operation. Please contact support.";
        }
        


        echo json_encode($callback, JSON_PRETTY_PRINT);
    }
}