<?php


include("../config.php");
include("../classes/autoloader.php");
loadPackage("../");


use SIMS\App\Entities\ScheduleItem;
use SIMS\App\Models\ScheduleModel;

$id = (int)$_POST['cid'];
$scheduleModel = new ScheduleModel();


try{
    $result = $scheduleModel->deleteScheduleItem($id);
    if($result == true){
        $callback["code"] = "00";
        $callback['message'] = "Schedule Item deleted";
    }else{
        $callback["code"] = "00";
        $callback['message'] = "Unexpected Error happened upon executing delete action. Please contact developer";
    }

}catch(Exception $e){
    $callback["code"] = $e->getCode();
    $callback['message'] = $e->getMessage();
}



echo json_encode($callback, JSON_PRETTY_PRINT);