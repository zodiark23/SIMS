<?php

namespace SIMS\App\Models;

use SIMS\Classes\Model;
use SIMS\Classes\Database;
use SIMS\App\Models\TimeModel;



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
     * Used to create schedule for the teacher
     * 
     */
    public function addSchedule(array $time, int $teacher_id){

    }

    /**
     * Move the schedule of teacher to a target date.
     * It will validate if the teacher is still free for that time
     */
    public function moveSchedule(int $schedule_id , array $time, int $teacher_id){

    }





    
}
