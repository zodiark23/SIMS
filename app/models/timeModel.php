<?php

namespace SIMS\App\Models;

use SIMS\Classes\Database;
use SIMS\Classes\Model;

/**
 * 
 * Sample usage
 * 
 * Way #1
 * 
 * > `$isAvailable = $t->setTime("8:00", "9:00")->check_availability("8:00");`
 * 
 * Way #2
 * 
 * > `$isAvailable = $t->setTime("8:00", "9:00")->check_availability("8:00", "8:30");`
 * 
 * 
 */
class TimeModel 
{

    
    public function __construct(){


    }
    /**
     * Set the time to check.
     * This should be used in chain with `check_availability()`
     * 
     */
    public function setTime(string $from , string $to){
        $this->from = date("H:i:s" , strtotime($from));
        $this->to = date("H:i:s", strtotime($to) );

        return $this;
    }

    /**
     * Checks if the time given is in between time
     * 
     * @param string $time The time to compare against the set time.
     * @param string $other_time The end time to check.
     * 
     * @return bool False if not available
     */
    public function check_availability(string $time = "", string $other_time =""){
        $available = true;

        // Only checks the first args
        if( ( strtotime($time) >= strtotime($this->from) ) && ( strtotime($time) <= strtotime($this->to) ) ){
            $available = false;
        }

        if(!empty($other_time)){
            // Only checks the first args
            if( ( strtotime($other_time) > strtotime($this->from) ) && ( strtotime($other_time) < strtotime($this->to) ) ){
                $available = false;
            }
        }

        

        return $available;
    }
    
}