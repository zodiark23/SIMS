<?php namespace SIMS\App\Models;

use SIMS\Classes\Model;
use SIMS\Classes\Database;
use SIMS\App\Models\Grademodel;
use PDO;
use Exception;

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
     * Sets the subject as required on a level
     */
    public function attachSubjectToSchoolLevel(int $subject_id, int $level_id){
        if(empty($subject_id) || $subject_id == 0 || empty($level_id) || $level_id == 0){
            return false;
        }

        //check if this subject is already existing don't insert if existing
        $checkStmt = $this->db->prepare("SELECT * FROM `school_level_subjects` WHERE level_id = :level_id AND subject_id=:subject_id");
        $checkStmt->execute(["level_id" => $level_id , "subject_id" => $subject_id]);
        $result = $checkStmt->fetchAll(PDO::FETCH_OBJ);

        if(count($result) > 0){
            throw new Exception("Subject already existing on this level",400);
        }

        $stmt = $this->db->prepare("INSERT INTO `school_level_subjects`(subject_id, level_id)
                                           VALUES(
                                               :subject_id,
                                               :level_id
                                           )             
                                        ");
        $stmt->execute(["subject_id" => $subject_id , "level_id" => $level_id]);

        if($stmt->rowCount() > 0){
            return true;
        }

        return false;
    }

    /**
     * Detach the subject from the required.
     */
    public function detachSubjectToSchoolLevel(int $subject_id , int $level_id){
        if(empty($subject_id) || $subject_id == 0 || empty($level_id) || $level_id == 0){
            throw new Exception("Missing required parameters", 400);
        }

        $stmt = $this->db->prepare("DELETE FROM `school_level_subjects` WHERE subject_id=:subject_id AND level_id=:level_id");
        $stmt->execute(["level_id" => $level_id , "subject_id" => $subject_id]);

        if($stmt->rowCount() > 0){
            return true;
        }

        return false;
    }

    /**
     * Return all the subjects required/attached to this level.
     * 
     * @param int $level_id The level id you want to find.
     */
    public function showLevelRequiredSubjects(int $level_id){
        if(empty($level_id) || $level_id == 0){
            return false;
        }

        $stmt = $this->db->prepare("SELECT * FROM `school_level_subjects` WHERE level_id = :level_id");
        $stmt->execute(["level_id" => $level_id]);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        if(count($result) > 0){
            return $result;
        }
        return false;
    }

    /**
     * Finalize the grades
     */
    public function finalizeGrade(int $section_id){
        // temporary Since this wasn't inclued on the grade scheme
        $flags = [
            ["flag_id" => 1, "description" => "1st Grading"],
            ["flag_id" => 2, "description" => "2nd Grading"]
        ];
        
        if($section_id == 0 || empty($section_id)){
            throw new Exception("Invalid section id", 400);
        }

        $sectionModel = new SectionModel();
        $sectionInfo = $sectionModel->info($section_id);
        $level_id = $sectionInfo['level_id'] ?? 0;

        

        if($level_id == 0){
            throw new Exception("Invalid level id", 400);
        }
        // first get the students on the section having In Progress
        $gradeModel = new GradeModel();
        $studentStmt = $this->db->prepare("SELECT * FROM `student_educational` WHERE section_id =:section_id AND status=:status");
        $studentStmt->execute(["section_id" => $section_id , "status" => "In Progress"]);
        $students = $studentStmt->fetchAll(PDO::FETCH_OBJ);

        $currModel = new CurriculumModel();
        $subjects = $currModel->showLevelRequiredSubjects($level_id);

        $grades = []; //indexes are the student-id
        if($students){
            // Get the grades of per student student
            foreach($students as $student){

                $studentGrade = $gradeModel->getGrades($student->student_id, $section_id);
                
                    
                 
                $grades[$student->student_id] = $studentGrade;
            }

        }
        // Assess if pass or fail base on grade scheme
        $gradeSchemeResult = $currModel->schoolLevelGradeSchemeInfo($level_id);
        $gradeScheme = $gradeModel->gradeSchemeDetails((int)$gradeSchemeResult['grade_scheme_id'] ?? 0);
        $pass_threshold = $gradeScheme[0]->pass_threshold ?? 0;

        if($pass_threshold == 0){
            throw new Exception("Threshold should not be zero. 0 Given upon finalizing", 409);
        }

        $assessment = []; //index is the student. value contains passed or failed

        if($subjects){
            foreach($grades as $studentId => $studentGrades){
                $isFail = false;
                $summary = []; //summary of grades per subject of this student
                foreach($grades[$studentId] as $studentGrades){
                    if(!isset($summary[$studentGrades->subject_id])){
                        $summary[$studentGrades->subject_id] = 0;
                    }
                    $summary[$studentGrades->subject_id] += (int)$studentGrades->grade ?? 0;
                }

                foreach($summary as $total_grade){
                    $average = (int)$total_grade / count($flags);
                    
                    if($average < $pass_threshold){
                        $isFail = true;
                        break;
                    }
                }
        
                $assessment[$studentId] = $isFail;
            }
        }else{
            throw new Exception("No Subjects detected on this section", 500);
        }


        // update the student_education status if pass or fail
        // True if fail
        foreach($assessment as $studentId => $a){
            $status = $a == true ? "failed" : "passed";

            $stmt = $this->db->prepare("UPDATE `student_educational` SET `status`=:status WHERE section_id=:section_id AND student_id=:student_id");

            $stmt->execute(["status" => $status , "section_id" => $section_id , "student_id" => $studentId ]);

            
        }

        return $assessment;

    }


    /**
     * Toggle the state of curriculum to `active` or `inactive`
     * 
     * @todo Pending implementation
     */
    public function toggleState(){

    }

}