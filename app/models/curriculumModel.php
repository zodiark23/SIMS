<?php namespace SIMS\App\Models;

use SIMS\Classes\Model;
use SIMS\Classes\Database;


class CurriculumModel extends Model{


    public function __construct(){
        $this->db = new Database();
        $this->table = "curriculum";
    }


    /**
     * Returns the list of all available Curriculum
     */
    public function list(){
        $stmt = $this->db->prepare("SELECT * FROM $this->table");
        
        $result = $stmt->execute();
        
        if($result){
            return $stmt->fetchAll();
        }

        return false;
    }

    /**
     * Delete the target curriculum.
     * 
     * `Note : This will only delete curriculum that is not published`
     * 
     */
    public function delete(int $curr_id){
        $isPublished = false;
        $stmt = $this->db->prepare("SELECT published FROM school_levels WHERE curriculum_id = :curr_id");

        $stmt->execute(["curr_id" => $curr_id]);

        $result = $stmt->fetchAll();

        foreach($result as $r){
            if($r["published"] == "1"){
                $isPublished = true;
            }
        }


        if($isPublished){
            return false;
        }else{
            // only delete if its not published

            $stmt = $this->db->prepare("DELETE FROM `school_levels` WHERE curriculum_id = :curr_id");
            $stmt->execute(["curr_id" => $curr_id]);

            if($stmt->rowCount() > 0){
                // delete the curriculum now
                $stmt = $this->db->prepare("DELETE FROM `curriculum` WHERE curriculum_id = :curr_id");
                $stmt->execute(["curr_id" => $curr_id]);
                if($stmt->rowCount() > 0){
                    return true;
                }else{
                    // Unable to delete the curriculum but deleted the school level
                    return false;
                }
            }else{
                // Unable to delete
                return false;
            }
        }



        

    }

    /**
     * Returns the school levels base on curr_id
     * 
     * @param int $curr_id The curriculum id of the school levels you wish to retrieve
     * @param bool $showAll If true it will return all school levels even not published
     * 
     * @return bool|aray
     */
    public function schoolLevels(int $curr_id, $showAll = false){
        if($showAll == false){

            $stmt = $this->db->prepare("SELECT * FROM `school_levels` WHERE curriculum_id = :cid AND `published` = 1");
            $stmt->execute([ "cid" => $curr_id]);
        }else if ($showAll == true){
            $stmt = $this->db->prepare("SELECT * FROM `school_levels` WHERE curriculum_id = :cid");
            $stmt->execute([ "cid" => $curr_id]);
        }

        $result = $stmt->fetchAll();

        if(count($result) > 0){
            return $result;
        }

        return false;
    }

    
    /**
     * Returns the information about the level id
     * 
     * @param int $level_id The target id to fetch info
     * 
     * @return bool|array
     */
    public function schoolLevelInfo(int $level_id){
        $stmt = $this->db->prepare("SELECT * FROM `school_levels` WHERE `level_id` = :lid ");
        $stmt->execute([ "lid" => $level_id]);

        $result = $stmt->fetch();

        if(count($result) > 0){
            return $result;
        }

        return false;
    }

    /**
     * Returns the Grade Scheme Id that this level is using
     * 
     * @param int $level_id
     */
    public function schoolLevelGradeSchemeInfo(int $level_id){
        if($level_id == 0 || empty($level_id)){
            return false;
        }

        $stmt = $this->db->prepare("SELECT * FROM `grade_scheme_item_id` WHERE `school_level_id` = :level_id ");
        $stmt->execute(["level_id" => $level_id]);

        $result = $stmt->fetch();

        if(count($result) > 0 ){
            return $result;
        }
        return false;
    }


    /**
     * Toggle the state of curriculum to `active` or `inactive`
     * 
     * @todo Pending implementation
     */
    public function toggleState(){

    }

}