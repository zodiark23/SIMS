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
     * @param string $curr_id The id of educational to bind this id. This way we can create multiple education but have different subjects
     */
    public function create(string $subject_name, int $curr_id){
        
        if(empty($subject_name) || empty($curr_id)){
            return false;
        }

        $stmt = $this->db->prepare("INSERT INTO `subjects` VALUES('0', :subject_name, :curr_id)");
        $result = $stmt->execute(["subject_name" => $subject_name, "curr_id" => $curr_id]);
        if($result){
            return true;
        }
        
        return false;

    }


}