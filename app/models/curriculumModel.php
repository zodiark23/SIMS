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
     * Toggle the state of curriculum to `active` or `inactive`
     * 
     * @todo Pending implementation
     */
    public function toggleState(){

    }

}