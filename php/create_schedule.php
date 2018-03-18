<?php

@session_start();
include("../config.php");
include("../classes/autoloader.php");
loadPackage("../");


use SIMS\App\Entities\Schedule;
use SIMS\App\Models\ScheduleModel;


$user = $_SESSION['user']['teacher_id'] ?? 0;

if($user === 0){
    $callback['code'] = "401";
    $callback['message'] = "No user detected.";
    echo json_encode($callback, JSON_PRETTY_PRINT);
    exit;
}


$schedule = new Schedule();
$schedule->schedule_name = $_POST['schedule_name'] ?? "";
$schedule->active = 1;
$schedule->level_id = (int)$_POST['level'] ?? "";
$schedule->modified_by = $user;
$schedule->year_end = $_POST['sched_year_end'] ?? "";
$schedule->year_start = $_POST['sched_year_start'] ?? "";
$schedule->create_at = date("Y-m-d H:i:s");
$schedule->last_updated = date("Y-m-d H:i:s");


$scheduleModel = new ScheduleModel();

try{
   $result = $scheduleModel->create($schedule);

   if($result === true){
       $callback['code'] = "00";
       $callback['message'] = "Schedule added to the system";
   }
    
} catch(Exception $e){
    $callback['code'] = "500";
    $callback['message'] = "Server Error: ".$e->message;
}


echo json_encode($callback, JSON_PRETTY_PRINT);