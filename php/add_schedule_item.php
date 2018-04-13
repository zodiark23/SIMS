<?php


include("../config.php");
include("../classes/autoloader.php");
loadPackage("../");


use SIMS\App\Entities\ScheduleItem;
use SIMS\App\Models\ScheduleModel;


$si = new ScheduleItem();
$si->schedule_id = $_POST['sched_id'] ?? 0;
$si->section_id = $_POST['section_id'] ?? 0;
$si->teacher_id = $_POST['teacher_id'] ?? 0;
$si->subject_id = $_POST['subject_id'] ?? 0;
$si->day = implode("-", ($_POST['days'] ?? []) ) ?? ""; //@TODO : Implement day functionality
$si->start_time = $_POST['start_time'];
$si->end_time = $_POST['end_time'];

$scheduleModel = new ScheduleModel();


try {

    $result = $scheduleModel->addScheduleItem($si);
    if($result == true){
        $callback['code'] = "00";
        $callback['message'] = "Schedule was added";
    }else{
        $callback['code'] = "500";
        $callback['message'] = "Unexpected behavior happen. Please contact technical team.";
    }
} catch (Exception $e){
    // Typically happens when the method detected a collision with time schedule for the teacher
    $callback['code'] = $e->getCode();
    $callback['message'] = $e->getMessage();
}
    
echo json_encode($callback, JSON_PRETTY_PRINT);


