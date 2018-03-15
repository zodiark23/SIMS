<?php


include("../config.php");
include("../classes/autoloader.php");
loadPackage("../");


use SIMS\App\Entities\ScheduleItem;
use SIMS\App\Models\ScheduleModel;


$si = new ScheduleItem();
$si->schedule_id = "2";
$si->section_id = "1";
$si->teacher_id = "4";
$si->day = "Mon"; //@TODO : Implement day functionality
$si->start_time = "11:20";
$si->end_time = "11:30";

$scheduleModel = new ScheduleModel();


try {

    $result = $scheduleModel->addScheduleItem($si);
    if($result == true){
        $callback['code'] = "00";
        $callback['message'] = "Schedule was added";
    }
} catch (Exception $e){
    // Typically happens when the method detected a collision with time schedule for the teacher
    $callback['code'] = $e->getCode();
    $callback['message'] = $e->getMessage();
}
    
echo json_encode($callback, JSON_PRETTY_PRINT);


