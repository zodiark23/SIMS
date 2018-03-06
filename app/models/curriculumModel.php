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

}