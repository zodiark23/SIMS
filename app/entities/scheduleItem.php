<?php

namespace SIMS\App\Entities;

/**
 * Schedule Item Representation
 */
class ScheduleItem {
    public $sched_item_id;
    public $schedule_id;
    public $teacher_id;
    public $section_id;
    public $start_time;
    public $end_time;
    public $subject_id;
    /**
     * The day for this schedule.
     * Typically Mon, Tue, Wed, Thu, Fri, Sat, Sun
     * 
     * date("D") is used
     */
    public $day;
}