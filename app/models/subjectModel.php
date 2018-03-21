<?php namespace SIMS\App\Models;

use SIMS\Classes\Model;
use SIMS\Classes\Database;


class SubjectModel extends Model{


    public function __construct(){
        $this->db = new Database();
        $this->table = "subjects";
    }

    /**
     * Method to create a new subject
     * 
     * @param string $subject_name - The name of the subject
     * @param int $curr_id The id of educational to bind this id. This way we can create multiple education but have different subjects
     */
    public function create(string $subject_name, int $curr_id){
        
        if(empty($subject_name) || empty($curr_id)){
            return false;
        }

        $stmt = $this->db->prepare("INSERT INTO `subjects` VALUES(:s_id, :subject_name, :curr_id, 1)");
        $result = $stmt->execute(["s_id" => 0 ,"subject_name" => $subject_name, "curr_id" => $curr_id]);
        if($result){
            return true;
        }
        
        return false;

    }

    /**
     * Update the information of this subject
     * 
     * @param int $subject_id The subject id you wish to edit
     * @param string $subject_name - The name of the subject
     * @param int $curr_id The id of educational to bind this id. This way we can create multiple education but have different subjects
     * 
     * @return bool Returns true if the database is updated
     */
    public function update($subject_id, $subject_name , $curr_id){
        if(empty($subject_name) || empty($curr_id)){
            return false;
        }

        $stmt = $this->db->prepare("UPDATE `subjects` SET `subject_name`=:subject_name, `curriculum_id`=:curr_id WHERE `subject_id`=:subj_id");
        $result = $stmt->execute(["subj_id" => $subject_id , "subject_name" => $subject_name, "curr_id" => $curr_id]);
        if($result){
            return true;
        }
        
        return false;
    }

    /**
     * Returns the list of subject for that curriculum
     * 
     * @param int|bool $curr_id The field constraint to return. False on default
     */
    public function list($curr_id = false){
        if($curr_id == false){

            $stmt = $this->db->prepare("SELECT * FROM `subjects` WHERE `status` = 1");
        }else{
            $stmt = $this->db->prepare("SELECT * FROM `subjects` WHERE `curriculum_id` = :curr_id AND `status`=1");
        }


        $stmt->execute(["curr_id" => $curr_id]);

        $result = $stmt->fetchAll();

        
        if( count($result) > 0){
            return $result;
        }

        return false;
    }


    /**
     * Returns the subject informations
     * 
     * @param int $subject_id The subject id you wish to retrieve info
     * 
     * @return mixed
     */
    public function info($subject_id){
        if(empty($subject_id)){
            return false;
        }

        $stmt = $this->db->prepare("SELECT * FROM `subjects` WHERE `subject_id` = :s_id");
        $stmt->execute( ["s_id" => $subject_id]);

        $result = $stmt->fetchAll();

        if( count($result) > 0){
            return $result;
        }

        return false;

    }

    /**
     * Change the status to 0. Only status 1 are fetch.
     * 
     * We cannot delete subjects as they might be reference by other table/views
     * 
     * @param int $subject_id The subject ID you wish to delete
     * 
     * @return bool True if success
     */
    public function delete(int $subject_id){
        if(empty($subject_id)){
            return false;
        }
        
        $stmt = $this->db->prepare("UPDATE `subjects` SET `status`=0 WHERE `subject_id` = :s_id");
        $stmt->execute( ["s_id" => $subject_id]);

        if($stmt){
            return true;
        }
        return false;
    }


}