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

class AccountController extends Controller{

    public function __construct(){
        $this->view = new View("dashboard");


        $m = new CurriculumModel();
        $this->view->data = $m->list();

        //we use this way for default actions
        // invoke them on the actual page
        $this->roleModel = new RoleModel();
        $this->hasRights = $this->roleModel->verifyRights("ALL");
        $this->view->hasRights = $this->hasRights;

        /**
         * Teachers sidenav counter
         */
        $teacherModel = new TeacherModel();
        $result = $teacherModel->showAll();
        $this->side_nav_data['teacherCount'] = 0;
        $this->side_nav_data['teacherCount'] = count($result) > 0 ? (count($result) - 1) : 0;

        $studentModel = new StudentModel();
        $studentResult = $studentModel->showList();
        $this->side_nav_data['studentCount'] = $studentResult ? count($studentResult) : 0;
        
        /**
         * Schedules sidenav counter
         */
        $schedModel = new ScheduleModel();
        $schedResult = $schedModel->scheduleList();
        $this->side_nav_data['scheduleCount'] = $schedResult ? count($schedResult) : 0;

        /**
         * Subject sidenav counter
         */
         $subjectModel = new SubjectModel();
         $subjectResult = $subjectModel->list();
         $this->side_nav_data['subjectCount'] = $subjectResult ? count($subjectResult) : 0;
         
         $sectionModel= new SectionModel();
         $sectionResult = $sectionModel->list();
         $this->side_nav_data['sectionCount'] = $sectionResult ? count($sectionResult) : 0;
    }


    public function account(){
        $this->view = new View("dashboard");
    }

    public function grade_management(){

        $id = $_SESSION['user']['teacher_id'] ?? null;

        if(empty($id)){
            $this->error();
            return false;
        }

        $this->view = new View("grade_management");
        $teacherModel = new TeacherModel();
        
        // Value return here by section. Under that array is the array of student. The key of $result is the section id
        $result = $teacherModel->myStudents($id);
        
        $this->view->sectionStudents = $result;
        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }

    public function my_students(){
        $id = $_SESSION['user']['teacher_id'] ?? null;

        if(empty($id)){
            $this->error();
            return false;
        }

        $this->view = new View("my_students");
        $teacherModel = new TeacherModel();
        
        // Value return here by section. Under that array is the array of student. The key of $result is the section id
        $result = $teacherModel->myStudents($id);
        
        $this->view->sectionStudents = $result;
        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }

    public function update($id){
	    if(empty($id)){
		    $this->error();
		    return false;
	    }

	    if($id == 1 || $id == 2) { // Admin / teacher
		    $this->view = new View("update_profile_teacher");
		    $this->view->render();
	    }elseif($id == 3){ // Student
		    $this->view = new View("update_profile_student");
		    $this->view->render();
	    }elseif($id == 4){ // Parent
		    $this->view = new View("update_profile_parent");
		    $this->view->render();
	    }
	    else{
		    $this->error();
		    return false;
	    }
    }
}