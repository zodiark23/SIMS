<?php
namespace SIMS\App\Models;

use SIMS\Classes\Model;
use SIMS\Classes\Database;


use SIMS\App\Entities\Section;
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


        $stmt = $this->db->prepare("INSERT INTO `sections`
                (
                    `section_name`,
                    `section_adviser`
                )

                VALUES (
                    :section_name,
                    :section_adviser
                )
        
         ");


        $stmt->execute([
            "section_name" => $section->section_name,
            "section_adviser" => $section->section_adviser 
        ]);

        if($stmt->rowCount() > 0){
            return true;
        }

        return false;
    }
}