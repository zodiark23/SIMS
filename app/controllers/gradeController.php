<?php namespace SIMS\App\Controllers;

use SIMS\App\Models\ProfileModel;
use SIMS\Classes\Controller;
use SIMS\Classes\View;
use SIMS\App\Models\CurriculumModel;
use SIMS\App\Models\RoleModel;
use SIMS\App\Models\TeacherModel;
use SIMS\App\Models\SubjectModel;
use SIMS\App\Models\ScheduleModel;
use SIMS\App\Models\SectionModel;
use SIMS\App\Models\StudentModel;
use SIMS\App\Models\GradeModel;

class GradeController extends Controller{

    public function __construct(){
        $this->view = new View("grade_builder");
        
    }


    public function default(){
        $this->error();
        return false;
    }

    public function encode($section_id){


        $id = $_SESSION['user']['teacher_id'] ?? null;
        if(empty($id) || $id == null){
            $this->unauthorized();
            return false;
        }
        $this->view = new View("grading");
        
        

        $teacherModel = new TeacherModel();
        $list = $teacherModel->myStudents($id);

        // get the target $section_id on the link. Return 401 if this teacher doesn't hold the section

        $studentSection = $list[$section_id] ?? null;

        if($studentSection == null || empty($studentSection)){
            $this->unauthorized();
            exit;
        }

        

        $sectionModel = new SectionModel();
        $result = $sectionModel->info($section_id);
        $level_id = (int)$result['level_id'] ?? 0;

        


        //get the student grades form into an array callable by subject
        $gradeModel = new GradeModel();
        $studentGrades = [];
        foreach($studentSection['data'] as $ss){
            $result = $gradeModel->getGrades($ss[0]['student_id'] , $section_id);
            $formatted = [];
            if($result){

                foreach($result as $raw_grade){
                    //extract the subject_id and make it the key
                    $formatted[$raw_grade->flags][$raw_grade->subject_id] = $raw_grade;
                }
            }
            $studentGrades[$ss[0]['student_id']] = $formatted;
        }

       


        $curriculumModel = new CurriculumModel();
        $subjectResult = $curriculumModel->showLevelRequiredSubjects($level_id);
        $subjecModel = new SubjectModel();
        $requiredSubjects = array();
        
        if($subjectResult){
            foreach($subjectResult as $subj){
                $requiredSubjects[] = $subjecModel->info($subj->subject_id);
            }
        }

         //get the grade scheme this level is using
        $gradeSchemeId = $curriculumModel->schoolLevelGradeSchemeInfo($level_id);
        $gradeScheme = $gradeModel->gradeSchemeDetails((int)$gradeSchemeId['grade_scheme_id'] ?? 0);

        $this->view->pass_threshold = $gradeScheme ? ((float)$gradeScheme[0]->pass_threshold ?? 0) : false;
        $this->view->targetSection = $section_id;
        $this->view->studentGrades = $studentGrades; //Contains all the grade this section have. Each array represents a student
        $this->view->studentSection = $studentSection;
        $this->view->requiredSubjects = $requiredSubjects ?? [];
        $this->view->raw_view();
    }



}