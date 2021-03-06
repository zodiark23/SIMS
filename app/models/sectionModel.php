<?php
namespace SIMS\App\Models;

use SIMS\Classes\Model;
use SIMS\Classes\Database;


use SIMS\App\Entities\Section;
use PDO;
use Exception;

class SectionModel extends Model{

    public function __construct(){
        $this->db = new Database();
        $this->table = "sections";
    }

    /**
     * Method to create a section
     * 
     * @param Section $section The section entity representation
     * 
     * @return bool True if inserted.
     * 
     * @throws Exception If the id is detector for admin or empty.
     * 
     */
    public function create(Section $section){
        if(empty($section->section_adviser) || $section->section_adviser == 1){
            throw new Exception("Invalid Advisor ID");
        }

        $stmt = $this->db->prepare("SELECT * FROM `sections` WHERE curr_id = :curr_id AND level_id = :level_id AND section_adviser = :section_adviser");
        $stmt->execute([':curr_id'=>$section->curr,
	        ':section_adviser'=>$section->section_adviser,
	        ':level_id'=>$section->level_id]);
        $result = $stmt->fetchAll();

        if($result){
        	return false;
        }
        $stmt = $this->db->prepare("INSERT INTO `sections`
                (
                    `section_name`,
                    `section_adviser`,
                    `level_id`,
                    `curr_id`
                )

                VALUES (
                    :section_name,
                    :section_adviser,
                    :level_id,
                    :curr_id
                )
        
         ");


        $stmt->execute([
            "section_name" => $section->section_name,
            "section_adviser" => $section->section_adviser,
            "level_id" => $section->level_id,
            "curr_id" => $section->curr
        ]);

        if($stmt->rowCount() > 0){
            return true;
        }

        return false;
    }

    /**
     * Returns the sections this teacher manage
     */
    public function getSectionByAdvisor($teacher_id){
        $stmt = $this->db->prepare("SELECT * FROM `sections` WHERE section_adviser = :teacher_id");
        $stmt->execute(["teacher_id" => $teacher_id]);

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if(count($result) > 0){
            return $result;
        }

        return false;
    }

    /**
     * Get the student this section has.
     * Default status `In Progress`
     */
    public function getStudents($section_id, $status = "In Progress"){
        $stmt = $this->db->prepare("SELECT * FROM `student_educational` WHERE section_id = :section_id AND `status`=:status");
        $stmt->execute(["section_id" => $section_id , "status" => $status]);

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        if(count($result) > 0){
            return $result;
        }
        return false;
    }

    /**
     * Updates the target section
     * 
     * @param Section $section The representation of section
     */
    public function update(Section $section){
        if(empty($section->section_id)){
            return false;
        }

	    $stmt = $this->db->prepare("SELECT * FROM `sections` WHERE curr_id = :curr_id AND level_id = :level_id AND section_adviser = :section_adviser AND section_name = :section_name");
	    $stmt->execute([':curr_id'=>$section->curr,
		    ':section_adviser'=>$section->section_adviser,
		    ':level_id'=>$section->level_id,
		    ':section_name'=>$section->section_name]);
	    $result = $stmt->fetchAll();

	    if($result){
		    return false;
	    }
        $stmt = $this->db->prepare("UPDATE `sections` 
                    SET 
                        `section_name`=:section_name , 
                        `section_adviser`=:section_adviser , 
                        `level_id` = :level_id ,
                        `curr_id` = :curr_id

                    WHERE `section_id` = :section_id");

        $result = $stmt->execute([
            "section_name" => $section->section_name,
            "section_adviser" => $section->section_adviser,
            "level_id" => $section->level_id,
            "curr_id" => $section->curr,
            "section_id" => $section->section_id
        ]);

        if($stmt->rowCount() > 0 || $result == true){
            return true;
        }

        return false;
    }

    /**
     * Returns the list of all sections
     */
    public function list($level_id = NULL){


        if(!empty($level_id)){

            $stmt = $this->db->prepare("SELECT * FROM `sections` WHERE `level_id` = :level_id");
            $stmt->execute(["level_id" => $level_id]);
        }else{
            $stmt = $this->db->prepare("SELECT * FROM `sections`");
            $stmt->execute();
        }

        $result = $stmt->fetchAll();

        if(count($result) > 0){
            return $result;
        }
        return false;
    }

    /**
     * Returns information about the target section
     */
    public function info($id){
        $stmt = $this->db->prepare("SELECT * FROM `sections` WHERE `section_id` = :section_id");
        $stmt->execute([ "section_id" => $id]);

        $result = $stmt->fetch();

        if(count($result) > 0){
            return $result;
        }
        return false;
        
    }
}