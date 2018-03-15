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
 * @author schizonic
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

        $outward = false; //directional checking - It checks the outside scope compare to inside
        $inward = false;  //directional checking - It checks the inside scope and compare to outside

        if( strtotime($this->from) > strtotime($time) && strtotime($this->from) < strtotime($other_time)){
            $outward = true;
        }

        if( strtotime($this->to) > strtotime($time) && strtotime($this->to) < strtotime($other_time)){
            $outward = true;
        }


        if( strtotime($time) > strtotime($this->from) && strtotime($time) < strtotime($this->to)){
            $inward = true;
        }

        if( strtotime($other_time) > strtotime($this->from) && strtotime($other_time) < strtotime($this->to)){
            $inward = true;
        }


        if($inward == true || $outward == true){
            $available = false;
        }

        // if its exactly the same e.g set time is 8am,9am. While the checking time is also 8am,9am
        if(strtotime($time) == strtotime($this->from) && strtotime($other_time) == strtotime($this->to)){
            $available = false; 
        }
        // if checking time is same e.g 11am to 11am
        if(strtotime($time) == strtotime($other_time)){
            $available = false;
        }
        

        return $available;
    }
    
}