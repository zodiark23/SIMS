<?php

namespace SIMS\App\Models;

use SIMS\Classes\Model;
use SIMS\Classes\Database;
use SIMS\App\Models\TimeModel;
use SIMS\App\Entities\Schedule;
use SIMS\App\Entities\ScheduleItem;
use Exception;



class ScheduleModel extends Model
{

    public function __construct(){
        $this->db = new Database();
        $this->table = "schedules";
    }


    /**
     * 
     * Logic runs different for Teacher and Student IDs.
     * Returns the lists of Schedule
     * 
     * @return array Schedule
     */
    public function mySchedule(int $user_id){

    }

    /**
     * Returns the information regarding the specified schedule
     */
    public function info(int $schedule_id){


    }

    /**
     * Creates a schedule with empty. 
     * This will throw and error if schedule name is missing
     * 
     * @throws Exception Missing Important Details
     */
    public function create(Schedule $schedule){
        
        //check for empty values
        if(empty($schedule->level_id) || empty($schedule->schedule_name) || empty($schedule->year_end) || empty($schedule->year_end)){
            throw new Exception("Missing important details");
            
        }

        $stmt = $this->db->prepare("INSERT INTO `schedules`
                (
                    schedule_name,
                    active,
                    level_id,
                    create_at,
                    last_updated,
                    modified_by,
                    year_start,
                    year_end
                )
                VALUES (
                    :schedule_name ,
                    :active ,
                    :level_id ,
                    :create_at,
                    :last_updated,
                    :modified_by,
                    :year_start,
                    :year_end
                )
        ");

        $stmt->execute([
            "schedule_name" => $schedule->schedule_name,
            "active" => $schedule->active,
            "level_id" => $schedule->level_id,
            "create_at" => $schedule->create_at,
            "last_updated" => $schedule->last_updated,
            "modified_by" => $schedule->modified_by,
            "year_start" => $schedule->year_start,
            "year_end" => $schedule->year_end
        ]);

        if($stmt->rowCount() > 0){
            return true;
        }

        return false;
    }


    /**
     * Method used to create schedule for the teacher
     * 
     * Throws Error on invalid validation
     * 
     * @param ScheduleItem $scheduleItem The schedule item to be created
     * 
     * @return bool True if created
     * 
     */
    public function addScheduleItem(ScheduleItem $scheduleItem){
        
        $hasConflict = $this->checkConflict($scheduleItem);
        if($hasConflict === true){
            throw new Exception("The teacher has time conflict on this schedule",409);
        }
        
        $stmt = $this->db->prepare("INSERT INTO `schedule_items` 
                (
                    schedule_id,
                    teacher_id,
                    section_id,
                    start_time,
                    end_time
                )
                VALUES (
                    :schedule_id,
                    :teacher_id,
                    :section_id,
                    :start_time,
                    :end_time
                )
        ");
        try {

            $stmt->execute([
                "schedule_id" => $scheduleItem->schedule_id,
                "teacher_id" => $scheduleItem->teacher_id,
                "section_id" => $scheduleItem->section_id,
                "start_time" => $scheduleItem->start_time,
                "end_time" => $scheduleItem->end_time
                ]);
        }catch(Exception $e){
            //incase of foreign key constraint
            throw new Exception("Unable to proceed with the process. Please check the associated teacher.", 500);
        }

        if($stmt->rowCount() > 0){
            return true;
        }

        return false;

    }
    /**
     * Checks if the current teacher is available for the target hours
     * 
     * @param int $schedule_id The schedule_id used to check the schedule_items
     * 
     * 
     * @return bool True is conflict.
     */
    public function checkConflict(ScheduleItem $schedule_item){
        if(strtotime($schedule_item->start_time) >= strtotime($schedule_item->end_time)){
            throw new Exception("You specify incorrect time. End time must be higher than start time.", 500);
        }

        $list = $this->scheduleItemList((int)$schedule_item->schedule_id, (int)$schedule_item->teacher_id);
        if($list == false){
            // most likely no found items
            return false;
        }
        $timeModel = new TimeModel();
        foreach($list as $item){
            $startTime = $item['start_time'];
            $endTime = $item['end_time'];
            $timeModel->setTime($startTime, $endTime);
            $available = $timeModel->check_availability($schedule_item->start_time, $schedule_item->end_time);

            if($available === false){
                //not available
                return true;
            }
        }

        return false;
    }

    /**
     * Returns all the schedule items for the target schedule id
     * 
     * @param int $schedule_id The schedule id to limit the result
     * @param int $teacher_id The teacher id schedules to return
     * 
     * @return bool|array 
     */
    public function scheduleItemList(int $schedule_id = 0, int $teacher_id = 0){
        $stmt = $this->db->prepare("SELECT * FROM `schedule_items` WHERE `schedule_id` = :sched_id AND `teacher_id` = :teacher_id ");

        $stmt->execute(["sched_id" => $schedule_id, "teacher_id" => $teacher_id]);

        $result = $stmt->fetchAll();

        if(count($result) > 0){
            return $result;
        }

        return false;

    }

    /**
     * Move the schedule of teacher to a target date.
     * It will validate if the teacher is still free for that time
     */
    public function moveSchedule(int $schedule_id , array $time, int $teacher_id){

    }





    
}
