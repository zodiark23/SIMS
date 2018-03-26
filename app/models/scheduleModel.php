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
     * Create the visible array layout for easy looping
     * 
     * Algorithm
     * 1. Create a unique set of time that was used
     * 2. Extract Unique Sections
     * 3. Assign the Teacher and subject at proper time
     * 4. (html) Properly control the array to be looped
     */
    public function scheduleBuilder($scheduleID){
        $schedules = $this->showScheduleItemList($scheduleID);

        if($schedules == false){
            return false;
        }

        /** Extract the unique times */
        $timeArray = [];
        $sectionArray = [];

        /** Extracting Phase */
        foreach($schedules as $sched){
            $timeArray[$sched['start_time']] = $sched['start_time'];
            $timeArray[$sched['end_time']] = $sched['end_time'];
            $sectionArray[$sched['section_id']] = $sched['section_id'];
        }

        sort($timeArray, SORT_NUMERIC);

        /**
         * Building Phase
         * 
         * Generation of actual loopable array for table
         */

        $builderArray = [];
        $body = []; //actual data schedules
        $builderArray["sections"] = $sectionArray; // this will be used on TH looping
        $builderArray["time"] = $timeArray; // this will be used on TH looping
        
        foreach($schedules as $sched){
            /** detect position on rowspan */
            $startPosition = array_search($sched['start_time'], $timeArray);
            $endPosition = array_search($sched['end_time'], $timeArray);
            $body[] = [
                    "start_time" => $sched['start_time'],
                    "end_time" => $sched['end_time'],
                    "startPosition" => $startPosition,
                    "endPosition" => $endPosition,
                    "subject" => $sched['subject_id'],
                    "section" => $sched['section_id'],
                    "teacher" => $sched['teacher_id'],
                    "sched_item_id" => $sched["sched_item_id"] 
                ];
        }


        $builderArray["body"] = $body;


        if(!empty($builderArray)){
            return $builderArray;
        }

        return false;
    }
    



    /**
     * Returns the information regarding the specified schedule
     */
    public function info(int $schedule_id){
        $stmt = $this->db->prepare("SELECT * FROM `schedules` WHERE `schedule_id` = :sched_id");
        $stmt->execute(["sched_id" => $schedule_id]);

        $result = $stmt->fetchObject();
        if($stmt && $result){
            return $result;
        }

        return false;

    }

    /**
     * Shows the schedule item info.
     * Only returns the specific schedule item. Please check showScheduleItemList() to pull the complete records
     * 
     * @param int $schedule_item_id The specific target id you wish to retrieve
     */
    public function showScheduleItem(int $schedule_item_id){
        $stmt = $this->db->prepare("SELECT * FROM `schedule_items` WHERE `sched_item_id` = :sched_item_id");
        $stmt->execute(["sched_item_id" => $schedule_item_id]);

        $result = $stmt->fetchAll();

        if(count($result) > 0){
            return $result;
        }

        return false;

    }

    /**
     * Returns all the schedule items the schedule have
     * 
     * @param int $schedule_id Unique id to filter the schedule items
     * 
     * @return bool|array
     */
    public function showScheduleItemList(int $schedule_id){
        $stmt = $this->db->prepare("SELECT * FROM `schedule_items` WHERE `schedule_id` = :schedule_id");
        $stmt->execute(["schedule_id" => $schedule_id]);

        $result = $stmt->fetchAll();

        if(count($result) > 0){
            return $result;
        }

        return false;
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
     * Method to delete the actual schedule not the schedule.
     * 
     * >Deletes all the schedule items before deleting the schedule
     */
    public function deleteSchedule(int $scheduleId){
        if(empty($scheduleId)){
            throw new Exception("No unique id detected.", 400);
        }

        $stmt = $this->db->prepare("DELETE FROM `schedule_items` WHERE `schedule_id`=:id");
        $stmt->execute(["id" => $scheduleId]);

        if($stmt){
            $query = $this->db->prepare("DELETE FROM `schedules` WHERE `schedule_id`=:id");
            $query->execute(["id" => $scheduleId]);

            if($query){
                return true;
            }
        }

        return false;
    }

    /**
     * Method to delete an entry within the schedule
     */
    public function deleteScheduleItem(int $scheduleItemId){
        if(empty($scheduleItemId)){
            throw new Exception("No unique id detected.", 400);
        }

        $stmt = $this->db->prepare("DELETE FROM `schedule_items` WHERE `sched_item_id`=:id");
        $stmt->execute(["id" => $scheduleItemId]);

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
        $sectionHasConflict = $this->sectionConflict($scheduleItem);
        if($sectionHasConflict === true){
            throw new Exception("The section already has schedule for the selected time period",409);
        }
        
        $stmt = $this->db->prepare("INSERT INTO `schedule_items` 
                (
                    schedule_id,
                    teacher_id,
                    section_id,
                    subject_id,
                    start_time,
                    end_time
                )
                VALUES (
                    :schedule_id,
                    :teacher_id,
                    :section_id,
                    :subject_id,
                    :start_time,
                    :end_time
                )
        ");
        try {

            $stmt->execute([
                "schedule_id" => $scheduleItem->schedule_id,
                "teacher_id" => $scheduleItem->teacher_id,
                "section_id" => $scheduleItem->section_id,
                "subject_id" => $scheduleItem->subject_id,
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
    private function checkConflict(ScheduleItem $schedule_item){
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
     * Checks if the sections will overlap.
     * 
     * We will return true if section has a conflict with the schedule to be added
     */
    private function sectionConflict(ScheduleItem $schedule_item){
        if(strtotime($schedule_item->start_time) >= strtotime($schedule_item->end_time)){
            throw new Exception("You specify incorrect time. End time must be higher than start time.", 500);
        }

        $list = $this->scheduleItemBySection((int)$schedule_item->schedule_id, (int)$schedule_item->section_id);
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
     * Returns all the schedule items for the target schedule id with option to filter by sections
     * 
     * @param int $schedule_id The schedule id to limit the result
     * @param int $Section The section id schedules to return
     * 
     * @return bool|array 
     */
    public function scheduleItemBySection(int $schedule_id = 0, int $section_id = 0){
        $stmt = $this->db->prepare("SELECT * FROM `schedule_items` WHERE `schedule_id` = :sched_id AND `section_id` = :section_id ");

        $stmt->execute(["sched_id" => $schedule_id, "section_id" => $section_id]);

        $result = $stmt->fetchAll();

        if(count($result) > 0){
            return $result;
        }

        return false;

    }


    /**
     * Returns all the schedules
     * 
     * @return bool|array 
     */
    public function scheduleList(){
        $stmt = $this->db->prepare("SELECT * FROM `schedules`");

        $stmt->execute();

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
