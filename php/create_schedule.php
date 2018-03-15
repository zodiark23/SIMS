<?php


include("../config.php");
include("../classes/autoloader.php");
loadPackage("../");


use SIMS\App\Entities\Schedule;
use SIMS\App\Models\ScheduleModel;



/**
 * @TODO : Refactor to reflect user input
 */


$schedule = new Schedule();
$schedule->schedule_name = "High School Schedule";
$schedule->active = 1;
$schedule->level_id = 1;
$schedule->modified_by = "1";
$schedule->year_end = '2018';
$schedule->year_start = '2019';
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