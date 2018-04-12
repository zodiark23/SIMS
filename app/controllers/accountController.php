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


class AccountController extends Controller{

    public function __construct(){
	    @session_start();
	    $id = $_SESSION['user']['role_id'] ?? 0;
	    $email = $_SESSION['user']['email'] ?? 0;
	    $student_id = $_SESSION['user']['student_id'] ?? 0;
//
	    $profileModel = new ProfileModel();
//
	    $profileModel->getProfileImage($email);
	    $educ = $profileModel->getEducAttain($student_id);



	    if($id == 1 || $id == 2) { // Admin / teacher
		    $this->view = new View("profile_teacher");
//		    $this->view->image = $image;
	    }elseif($id == 3){ // Student
		    $this->view = new View("profile_student");
		    $this->view->educ = $educ;
//		    $this->view->image = $image;
	    }elseif($id == 4){ // Parent
		    $this->view = new View("profile_parent");
//		    $this->view->image = $image;
	    }else{

		    return false;
	    }


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
	    @session_start();
	    $id = $_SESSION['user']['role_id'];


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

	public function profile(){
		@session_start();
		$id = $_SESSION['user']['role_id'];


		if($id == 1 || $id == 2) { // Admin / teacher
			$this->view = new View("profile_teacher");
			$this->view->pointer = $this->pointer;
        	$this->view->side_nav_data = $this->side_nav_data;
			$this->view->render();
		}elseif($id == 3){ // Student
			$this->view = new View("profile_student");
			$this->view->pointer = $this->pointer;
        	$this->view->side_nav_data = $this->side_nav_data;
			$this->view->render();
		}elseif($id == 4){ // Parent
			$this->view = new View("profile_parent");
			$this->view->pointer = $this->pointer;
        	$this->view->side_nav_data = $this->side_nav_data;
			$this->view->render();
		}
		else{
			$this->error();
			return false;
		}
	}

	public function update(){
		@session_start();
		$id = $_SESSION['user']['role_id'];

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

	public function image(){
		@session_start();
		$id = $_SESSION['user']['role_id'];

		if($id == 1 || $id == 2) { // Admin / teacher
			$this->view = new View("picture_teacher");
			$this->view->render();
		}elseif($id == 3){ // Student
			$this->view = new View("picture_student");
			$this->view->render();
		}elseif($id == 4){ // Parent
			$this->view = new View("picture_parent");
			$this->view->render();
		}
		else{
			$this->error();
			return false;
		}
	}

	public function password(){
		@session_start();
		$id = $_SESSION['user']['role_id'];

		if($id == 1 || $id == 2) { // Admin / teacher
			$this->view = new View("update_password_teacher");
			$this->view->render();
		}elseif($id == 3){ // Student
			$this->view = new View("update_password_student");
			$this->view->render();
		}elseif($id == 4){ // Parent
			$this->view = new View("update_password_parent");
			$this->view->render();
		}
		else{
			$this->error();
			return false;
		}
	}

	public function my_grades(){
		$student_id = $_SESSION['user']['student_id'] ?? '';

		if(empty($student_id)){
			$this->error();
			return false;
		}
		$this->view = new View("my_grades");

		$structuredGrades = [];
		$requiredSubjects = [];

		
		$studentModel = new StudentModel();
		$subjectModel = new SubjectModel();
		$sectionModel = new SectionModel();
		$curriculumModel = new CurriculumModel();

		// Index of $grades contain the section_id 
		$grades = $studentModel->viewGrade( (int)$student_id);
		

		//Rebuild the array with proper name values
		if($grades){

			foreach($grades as $section_id => $raw_grades){
				
				$detailedGrades = [];
				$requiredSubjects[$raw_grades['level_id']]= $curriculumModel->showLevelRequiredSubjects($raw_grades['level_id']);

				if($raw_grades['grades']){
					foreach($raw_grades['grades'] as $grade){
						$subjectInfo = $subjectModel->info($grade->subject_id);

						$detailedGrades[$grade->subject_id][$grade->flags] = ["subject" => ($subjectInfo[0]['subject_name'] ?? 'err#') , "grade" => $grade->grade];
					}
				}

				$sectionInfo = $sectionModel->info($section_id);
				
				$structuredGrades[] = [ "level_id" => $raw_grades['level_id'] , "section" => ($sectionInfo['section_name'] ?? $section_id ) , "grades" => $detailedGrades];
			}

		}
		


		$this->view->requiredSubjects = $requiredSubjects;
		$this->view->grades = $structuredGrades;
		$this->view->render();
	}

}