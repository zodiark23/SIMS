<?php namespace SIMS\App\Models;

use SIMS\Classes\Model;
use SIMS\Classes\Database;
use SIMS\App\Entities\GradeScheme;
use PDO;
/**
 * Tied with 3 tables
 * 
 * sims.grades
 * sims.grade_scheme
 * sims.grade_scheme_item_id
 *
 */
class GradeModel extends Model {

    public function __construct(){
        $this->db = new Database();
        $this->table = "grades";
    }

    /**
     * Create a scheme
     */
    public function createScheme(GradeScheme $gradeScheme){
        $stmt = $this->db->prepare("INSERT INTO 
                                `grade_scheme`(
                                    `description`,
                                    `date_implemented`,
                                    `published`,
                                    `pass_threshold`
                                )

                                VALUES(
                                    :description,
                                    :date_implemented,
                                    :published,
                                    :pass_threshold
                                )
                        
                             ");
        $result = $stmt->execute([
            "description" => $gradeScheme->description,
            "date_implemented" => $gradeScheme->date_implemented,
            "published" => $gradeScheme->published,
            "pass_threshold" => $gradeScheme->pass_threshold,
        ]);


        $count = $result == true ? $stmt->rowCount() : 0;

        if($count > 0){
            $last_id = $this->db->lastInsertId();

            return ["grade_scheme_id" => $last_id ?? false];
        }

        return false;

    }

    public function gradeSchemeDetails(int $gradeSchemeId){
        $stmt = $this->db->prepare("SELECT * FROM `grade_scheme` WHERE `grade_scheme_id` = :cid LIMIT 1");
        $stmt->execute(["cid" => $gradeSchemeId ]);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        if($result){
            return $result;
        }
        return false;
    }
    /**
     * Updates the existing grade scheme
     */
    public function updateGradeScheme(GradeScheme $gradeScheme){
        $stmt = $this->db->prepare("UPDATE `grade_scheme`
                                SET
                                    `description`=:description,
                                    `date_implemented`=:date_implemented,
                                    `published`=:published,
                                    `pass_threshold`=:pass_threshold
                                WHERE
                                    grade_scheme_id = :cid
                        
                             ");
        $result = $stmt->execute([
            "description" => $gradeScheme->description,
            "date_implemented" => $gradeScheme->date_implemented,
            "published" => $gradeScheme->published,
            "pass_threshold" => $gradeScheme->pass_threshold,
            "cid" => $gradeScheme->grade_scheme_id
        ]);


        $count = $result == true ? $stmt->rowCount() : 0;

        if($stmt->rowCount() > 0 || $result == true){
            return true;
        }

        return false;
    }

    /**
     * Returns all the grade schemes
     * 
     * @return array
     */
    public function gradeSchemeList(){
        $stmt = $this->db->prepare("SELECT * FROM `grade_scheme`");
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        if($result){
            return $result;
        }
        return false;
    }

    /**
     * Method to allow grade encodings for a certain duration
     */
    public function addEncodingPeriod($dateString){

    }

    /**
     * Add grades to the student on a subject
     * 
     * @note Checks if the current user has rights ADD GRADE
     */
    public function encodeGrade(Grade $grade){
        
    }

    /** 
     * Assess the grade if pass or fail base on the threshold GradeScheme
     * 
     * @return bool True if passed
     */
    private function assess(Grade $grade, GradeScheme $gradeScheme){

    }

    /**
     * Method that links the level with its grade scheme
     * @return bool True if create/updated
     */
    public function gradeSchemeAttachTo(int $gradeSchemeId, int $level_id){
        // First check if there's an existing data create if no existing. Update if Existing

        $stmt = $this->db->prepare("SELECT * FROM `grade_scheme_item_id` WHERE school_level_id=:level_id");
        $stmt->execute(["level_id" => $level_id]);
        $result = $stmt->fetch();

        if(count($result) > 0 && $result){
            // Update
            $attachStmt = $this->db->prepare("UPDATE `grade_scheme_item_id` SET `grade_scheme_id`=:gsi WHERE `school_level_id`=:level_id");
            $attachStmt->execute(["gsi" => $gradeSchemeId , "level_id" => $level_id]);
            
            if($attachStmt){
                if($attachStmt->rowCount() > 0){
                    return true;
                }else{
                    return false;
                }
            }
        }else{
            // Create

            $insertStmt = $this->db->prepare("INSERT INTO `grade_scheme_item_id`(grade_scheme_id, school_level_id) VALUES(:gsi, :level_id) ");
            $insertStmt->execute(["gsi" => $gradeSchemeId , "level_id" => $level_id]);
            
            $count = $insertStmt->rowCount() ?? 0;

            if($count > 0){
                $last_id = $this->db->lastInsertId();
                return ["grade_scheme_id" => $last_id ?? false];
            }else{
                return false;
            }


        }

        
    }





}