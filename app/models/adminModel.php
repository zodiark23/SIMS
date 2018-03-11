<?php namespace SIMS\App\Models;

use SIMS\Classes\Model;
use SIMS\Classes\Database;


class AdminModel extends Model{

    public function __construct(){
        $this->db = new Database();
        $this->table = "curriculum";
    }

    

    /**
     * Insert details to curriculum table
     * 
     * @param string $description - Description text for this education
     * @param int $duration - Years to finish
     */
    public function insertEducational($description, $duration){
        if( empty($description) || empty($duration)){
            return false;
        }
        $stmt = $this->db->prepare("INSERT INTO curriculum(description,year_duration)  VALUES(:description, :duration) ");

        $result = $stmt->execute([ "description" => $description, "duration" => $duration ]);
        
        if($result){
            return $this->db->lastInsertId();
        }

        return false;

    }


    public function editEducational($description, $duration, $id){
        if(empty($description) || empty($duration)){
            return false;
        }

        $stmt = $this->db->prepare("UPDATE `curriculum` SET `description`=:desc,`year_duration`=:duration WHERE `curriculum_id` = :id");

        $stmt->execute(["desc" => $description , "duration" => $duration, "id" => $id]);

        if($stmt){
            return true;
        }
        return false;


    }

    /**
     * Inserts data to school levels
     * 
     * @param int $curriculum_id - The id this school level is tied
     * @param string $level_name - The actual name this level has
     */
    public function insertSchoolLevel($curriculum_id, $level_name){
        if(empty($curriculum_id) || empty($level_name)){
            return false;
        }

        $stmt = $this->db->prepare("INSERT INTO school_levels VALUES('0', :curr_id, :level_name, 0) ");

        $stmt->execute([ "curr_id" => $curriculum_id, "level_name" => $level_name ]);

        if($stmt){
            return true;
        }
        return false;
    }

    /**
     * Delete all school levels with this ID
     * 
     * Typically used when editing as we don't update this field.
     * 
     * You cant delete items flagged with published
     * 
     * @param int $curriculum_id The id to be deleted
     */
    public function deleteSchoolLevel($curriculum_id){

        if(empty($curriculum_id)){
            return false;
        }

        $stmt = $this->db->prepare("DELETE FROM school_levels WHERE curriculum_id = :curr_id");

        $stmt->execute(["curr_id" => $curriculum_id]);

        if($stmt){
            return true;
        }

        return false;
    }



    /**
     * Publish the school levels
     * 
     * Editing will now be disabled
     * 
     * @param int $curriculum_id The curr id to update in `school_levels` table
     * 
     * @return bool
     */
    public function publishSchoolLevels($curriculum_id){
        $stmt = $this->db->prepare("UPDATE school_levels SET `published`=1 WHERE curriculum_id=:curr_id");

        $stmt->execute(["curr_id" => $curriculum_id]);

        if($stmt){
            return true;
        }
        return false;
    }


}