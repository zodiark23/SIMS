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
        $stmt = $this->db->prepare("INSERT INTO curriculum VALUES('', :description, :duration) ");

        $stmt->execute([ "description" => $description, "duration" => $duration ]);

        if($stmt){
            return true;
        }

        return false;

    }


    public function editEducational($description, $duration, $id){
        if(empty($description) || empty($duration)){
            return false;
        }

        $stmt = $this->db->prepare("UPDATE curriculum SET `description`=:desc , `duration`=:duration WHERE curriculum_id=:id");

        $stmt->execute(["desc" => $description , "duration" => $duration, "id" => $id]);

        if($stmt){
            return true;
        }
        return false;


    }


}