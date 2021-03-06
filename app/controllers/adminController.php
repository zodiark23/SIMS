<?php namespace SIMS\App\Controllers;

use SIMS\App\Models\StudentModel;
use SIMS\Classes\Controller;
use SIMS\Classes\View;
use SIMS\App\Models\AdminModel;
use SIMS\App\Models\CurriculumModel;
use SIMS\App\Models\SubjectModel;
use SIMS\App\Models\TeacherModel;
use SIMS\App\Models\RoleModel;
use SIMS\App\Models\NewsModel;
use SIMS\App\Models\ScheduleModel;
use SIMS\App\Models\SectionModel;
use SIMS\App\Models\TimeModel;
use SIMS\App\Models\GradeModel;
use SIMS\App\Models\RejectModel;


class AdminController extends Controller{
    public $side_nav_data = [];

    public function __construct(){


        $this->view = new View("educational_list");
        $this->view->action = "new";
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


    public function education(){
        $this->view = new View("educational_list");
        $m = new CurriculumModel();
        $this->view->data = $m->list();

        $roles = new RoleModel();
        $hasRights = $roles->verifyRights("ALL");
        $this->view->hasRights = $this->hasRights;

		if(!$hasRights){
			$this->unauthorized();
			return false;
        }

        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }

    public function level_configuration($id){
        $this->view = new View("level_configuration");

        $curriculumModel = new CurriculumModel();
        $level_info = $curriculumModel->schoolLevelInfo($id);

        $getRequiredSubjects = $curriculumModel->showLevelRequiredSubjects((int)$id);



        if(!$level_info){
            $this->error();
            return false;
        }
        $gradeSchemeResult = $curriculumModel->schoolLevelGradeSchemeInfo((int)$level_info['level_id'] ?? 0);


        $gradeModel = new GradeModel();
        $gradeSchemes = $gradeModel->gradeSchemeList();

        $subjectModel = new SubjectModel();
        $subjects = $subjectModel->list($level_info['curriculum_id']);

        $this->view->requiredSubjects = $getRequiredSubjects;
        $this->view->selectedGradeScheme = $gradeSchemeResult["grade_scheme_id"] ?? 0;
        $this->view->level_info = $level_info;
        $this->view->gradeSchemes = $gradeSchemes;
        $this->view->subjects = $subjects;
        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }

    public function show_education($id){

        // Check rights
        $userHasRights = $this->roleModel->verifyRights("ALL");
        if(!$userHasRights){
            // Check users with this rights
            $commonRights = $this->roleModel->verifyRights("MANAGE_EDUCATION");
            if(!$commonRights){

                $this->unauthorized();
                return false;
            }
        }

        if(empty($id)){
            $this->error();
            return false;
        }

        $this->view = new View("show_education");
        $model = new CurriculumModel();
        $result = $model->schoolLevels($id, true);

        $adminModel = new AdminModel();
        $curriculumName = $adminModel->findById("curriculum_id",$id);
        if(empty($curriculumName)){
            $this->error();
            return false;
        }

        // Get the Grade Scheme Info for each level
        $gradeModel = new GradeModel();
        $gradeSchemeArray = [];
        // Get also if required subject is configured
        $levelRequirements = [];
        foreach($result as $r){
            $gradeSchemeResult = $model->schoolLevelGradeSchemeInfo( ((int)$r["level_id"] ?? 0) );
            $gradeSchemeId = $gradeSchemeResult["grade_scheme_id"] ?? 0;
            $gradeSchemeDetails = $gradeModel->gradeSchemeDetails((int)$gradeSchemeId);

            $gradeSchemeArray[$r['level_id']] = $gradeSchemeDetails ?: [];


            $requiredSubject = $model->showLevelRequiredSubjects( ((int)$r['level_id'] ?? 0) ) ;

            $levelRequirements[$r['level_id']] = $requiredSubject == false ? false : true;
        }

        $this->view->requirements = $levelRequirements;
        $this->view->gradeSchemes = $gradeSchemeArray;
        $this->view->cur_name = $curriculumName[0]["description"] ?? "Err#";
        $this->view->info = $result;
        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }


    public function delete_education($id){
        if(empty($id)){
            $this->error();
            return false;


        }
        $this->view = new View("educational_list");

        $m = new CurriculumModel();
        $result = $m->delete($id);


        header("Location: ../education");

        exit;

    }


    public function create_education(){
        $roles = new RoleModel();
        $hasRights = $roles->verifyRights("ALL");
        $this->view->hasRights = $this->hasRights;

		if(!$hasRights){
			$this->unauthorized();
			return false;
        }

        $this->view = new View("admin_create_education");
        $this->model = new AdminModel();

        $this->view->action = "new";

        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }


    public function edit_education($id){
        // Check rights
        $userHasRights = $this->roleModel->verifyRights("ALL");
        if(!$userHasRights){
            // Check users with this rights
            $commonRights = $this->roleModel->verifyRights("ALL");
            if(!$commonRights){

                $this->unauthorized();
                return false;
            }
        }

        if(empty($id)){
            $this->error();
            return false;
        }

        $this->view = new View("admin_create_education");
        $this->model = new AdminModel();

        $this->view->action  = "edit";

        $data = $this->model->findById("curriculum_id",$id);

        if(!empty($data)){
            /** Format the data and Pass the it to view*/
            /** Select the first entry since are using PK viewing */
            $this->view->data["adminModel"] = $data[0];

            // Start fetching the school levels this item have

            $levels = $this->model->findById("curriculum_id", $id, "school_levels");

            if(!empty($levels)){
                $this->view->data['schoolLevels'] = $levels;
            }

        }else{
            $this->error();
            return false;
        }

        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }


    public function create_subject(){

        // Check rights
        $userHasRights = $this->roleModel->verifyRights("ALL");
        if(!$userHasRights){
            // Check users with this rights
            $commonRights = $this->roleModel->verifyRights("ADD_SUBJECT");
            if(!$commonRights){

                $this->unauthorized();
                return false;
            }
        }

        $this->view = new View("create_subject");
        $currModel = new CurriculumModel();
        $this->view->curriculumList = $currModel->list();

        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }


    public function edit_subject($id){

        // Check rights
        $userHasRights = $this->roleModel->verifyRights("ALL");
        if(!$userHasRights){
            // Check users with this rights
            $commonRights = $this->roleModel->verifyRights("EDIT_SUBJECT");
            if(!$commonRights){

                $this->unauthorized();
                return false;
            }
        }

        $this->view = new View("edit_subject");
        $currModel = new CurriculumModel();
        $subjectModel = new SubjectModel();
        $info = $subjectModel->info($id);

        if($info == false){
            $this->error();
            return false;
        }

        $this->view->curriculumList = $currModel->list();
        $this->view->subjectInfo = $info[0];

        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }


    public function subject_list(){


        // Check rights
        $userHasRights = $this->roleModel->verifyRights("ALL");
        if(!$userHasRights){
            // Check users with this rights
            $commonRights = $this->roleModel->verifyRights("VIEW_SUBJECT");
            if(!$commonRights){

                $this->unauthorized();
                return false;
            }
        }


        $data = [];

        $this->view = new View("subject_list");
        $currModel = new CurriculumModel();
        $subjectModel = new SubjectModel();

        $result = $currModel->list();

        foreach($result as $curriculum){

            $subjects = $subjectModel->list($curriculum['curriculum_id']);

            $data[$curriculum["description"]] = $subjects;
        }

        $this->view->data = $data;

        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }

    public function overview_teacher(){
        // Check rights
        $userHasRights = $this->roleModel->verifyRights("ALL");
        if(!$userHasRights){
            // Check users with this rights
            $commonRights = $this->roleModel->verifyRights("VIEW_TEACHER");
            if(!$commonRights){

                $this->unauthorized();
                return false;
            }
        }

        $this->view = new View("teacher_overview");
        $this->model = new TeacherModel();
        $this->view->teachers = $this->model->showAll();

        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }

    public function create_teacher(){
        // Check rights
        $userHasRights = $this->roleModel->verifyRights("ALL");
        if(!$userHasRights){
            // Check users with this rights
            $commonRights = $this->roleModel->verifyRights("ADD_TEACHER");
            if(!$commonRights){

                $this->unauthorized();
                return false;
            }
        }

        $this->view = new View("add_teacher");

        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }

	public function roles(){

		$this->view = new View("roles");
		$this->model = new RoleModel();

		$role = $this->model->getRole();

		$hasRights = $this->model->verifyRights("ALL");

		if(!$hasRights){
			$this->unauthorized();
			return false;
		}

		$this->view->roles = $role;
        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
		$this->view->render();
	}

	public function manage_roles($id){
		if(empty($id)){
			$this->error();
			return false;
		}
		$this->view = new View("manage_roles");
		$this->model = new RoleModel();
		$rights_list = $this->model->getRights();

		// Check if the role has / have rights.
		$currentRights = $this->model->setRights($id);

		// Display all rights from the rights table.
		$this->view->rights_list = $rights_list;

		// Display the role name for update
		$display_role = $this->model->displayRole($id);

		$this->view->role_name = $display_role;

		$this->view->role_id = $id;

		$this->view->currentRights = $currentRights;
        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
		$this->view->render();

	}

	public function add_roles(){
    	$this->view = new View("add_roles");

        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
		$this->view->render();
	}

	public function news(){
        // Check rights
        $userHasRights = $this->roleModel->verifyRights("ALL");
        if(!$userHasRights){
            // Check users with this rights
            $commonRights = $this->roleModel->verifyRights("ADD_NEWS");
            if(!$commonRights){

                $this->unauthorized();
                return false;
            }
        }

    	$this->view = new View("news");

    	$this->model = new NewsModel();

    	$displayNews = $this->model->displayNews();

    	$this->view->displayNews = $displayNews;
        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
    	$this->view->render();
	}

	public function add_news(){
        $this->view = new View("add_news");
        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }

    /**
     * This is the actual adding of sched
     */
    public function schedule($id){
        $this->view = new View("build_sched");

        $schedModel = new ScheduleModel();
        $this->view->schedInfo = $schedModel->info((int)$id);

        if($this->view->schedInfo == false){
            $this->error();
            return false;
        }

        $level_id = $this->view->schedInfo->level_id;

        /** Get the sections to filtered by Level ID. Used in displaying in views */
        $sectionModel = new SectionModel();
        $sectionList = $sectionModel->list($level_id);
        /** Get the teachers to be displayed when using the schedule builder */
        $teacherModel = new TeacherModel();
        $teacherList = $teacherModel->list();
        /** Get CurriculumID and use that to fetch the subjects for this level */
        $curriculumModel = new CurriculumModel();
        $levelInfo = $curriculumModel->schoolLevelInfo($level_id);

        $curriculumID = (int)$levelInfo['curriculum_id'] ?? 0;
        /** Use the curriculum ID to find all the specific subjets */
        $subjectModel = new SubjectModel();
        $subjectList = $subjectModel->list($curriculumID);


        $timeModel = new TimeModel();
        $timeSelection = $timeModel->generateTime();


        $builderUI = $schedModel->scheduleBuilder($this->view->schedInfo->schedule_id);

        /** Pass the data to the view */

        $this->view->sectionList = $sectionList;
        $this->view->teacherList = $teacherList;
        $this->view->curriculumID = $curriculumID;
        $this->view->subjectList = $subjectList;
        $this->view->timeSelection = $timeSelection;


        $this->view->builderUI = $builderUI;

        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }


    /**
     * Anyone with access can perform this action
     */
    public function delete_schedule($id){
        if(empty($id)){
            $this->error();
            return false;
        }

        // Check rights
        $userHasRights = $this->roleModel->verifyRights("ALL");
        if(!$userHasRights){
            // Check users with this rights
            $commonRights = $this->roleModel->verifyRights("MANAGE_SCHEDULE");
            if(!$commonRights){

                $this->unauthorized();
                return false;
            }
        }


        $scheduleModel = new ScheduleModel();
        $result = $scheduleModel->deleteSchedule($id);
        if($result){

            header("Location: ../manage_schedule");
            exit;
        }else{
            $this->error();
            return false;
        }
    }


    public function manage_schedule(){
        // Check rights
        $userHasRights = $this->roleModel->verifyRights("ALL");
        if(!$userHasRights){
            // Check users with this rights
            $commonRights = $this->roleModel->verifyRights("MANAGE_SCHEDULE");
            if(!$commonRights){

                $this->unauthorized();
                return false;
            }
        }


        $this->view = new View("schedules");
        $schedModel = new ScheduleModel();
        $curriculumModel = new CurriculumModel();
        $this->view->data = $schedModel->scheduleList();

        $levelNames = [];
        if($this->view->data){

            foreach($this->view->data as $sched){
                $result = $curriculumModel->schoolLevelInfo($sched['level_id']);

                if($result !== false){
                    $levelNames[$result['level_id']] = $result['level_name'];
                }

            }
        }

        $this->view->levelNames = $levelNames;

        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }

    public function create_schedule(){

        // Check rights
        $userHasRights = $this->roleModel->verifyRights("ALL");
        if(!$userHasRights){
            // Check users with this rights
            $commonRights = $this->roleModel->verifyRights("ADD_SCHEDULE");
            if(!$commonRights){

                $this->unauthorized();
                return false;
            }
        }


        $this->view = new View("create_schedule");
        $x= new ScheduleModel();

        $currModel = new CurriculumModel();
        $this->view->curriculumList = $currModel->list();

        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }

    public function print_schedule($id){
        $userHasRights = $this->roleModel->verifyRights("ALL");
        if(!$userHasRights){
            // Check users with this rights
            $commonRights = $this->roleModel->verifyRights("MANAGE_SCHEDULE");
            if(!$commonRights){

                $this->unauthorized();
                return false;
            }
        }

        $this->view = new View("print_schedule");
        $this->view->schedule_id = $id;
        $this->view->raw_view();
    }

    public function add_section(){

        // Check rights
        $userHasRights = $this->roleModel->verifyRights("ALL");
        if(!$userHasRights){
            // Check users with this rights
            $commonRights = $this->roleModel->verifyRights("ADD_SECTION");
            if(!$commonRights){

                $this->unauthorized();
                return false;
            }
        }


        $this->view = new View("add_section");

        $currModel = new CurriculumModel();
        $this->view->curriculumList = $currModel->list();

        $teacherModel = new TeacherModel();
        $this->view->teachers = $teacherModel->list();
        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }


    public function edit_section($id){

        // Check rights
        $userHasRights = $this->roleModel->verifyRights("ALL");
        if(!$userHasRights){
            // Check users with this rights
            $commonRights = $this->roleModel->verifyRights("EDIT_SECTION");
            if(!$commonRights){

                $this->unauthorized();
                return false;
            }
        }


        $this->view = new View("edit_section");
        $sectionModel = new SectionModel();

        $this->view->data = $sectionModel->info($id);

        $curr_id = $this->view->data['curr_id'] ?? 0;


        $currModel = new CurriculumModel();
        $this->view->curriculumList = $currModel->list();

        // The level this curriculum had
        $this->view->levels  = $currModel->schoolLevels($curr_id);


        $teacherModel = new TeacherModel();
        $this->view->teachers = $teacherModel->list();
        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }

    public function section_list(){


        // Check rights
        $userHasRights = $this->roleModel->verifyRights("ALL");
        if(!$userHasRights){
            // Check users with this rights
            $commonRights = $this->roleModel->verifyRights("VIEW_SECTION");
            if(!$commonRights){

                $this->unauthorized();
                return false;
            }
        }


        $this->view = new View("sections");

        $sectionModel = new SectionModel();
        $this->view->data = $sectionModel->list();

        $curriculumModel = new CurriculumModel();
        if($this->view->data){

            foreach($this->view->data as $sched){
                $result = $curriculumModel->schoolLevelInfo($sched['level_id']);

                if($result !== false){
                    $levelNames[$result['level_id']] = $result['level_name'];
                }
            }

        }

        $this->view->levelNames = $levelNames ?? [];
        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();

    }

    public function grade_schemes(){

        // Check rights
        $userHasRights = $this->roleModel->verifyRights("ALL");
        if(!$userHasRights){
            // Check users with this rights
            $commonRights = $this->roleModel->verifyRights("MANAGE_GRADE_SCHEME");
            if(!$commonRights){

                $this->unauthorized();
                return false;
            }
        }


        $this->view = new View("grade_schemes");
        $gradeModel = new GradeModel();

        $lists = $gradeModel->gradeSchemeList();
        $references = [];
        if($lists){

            foreach($lists as $list){
                $reference = $gradeModel->getSchemeReferences( ($list->grade_scheme_id ?? 0 ) );
                $references[($list->grade_scheme_id ?? "")] = $reference != false ? count($reference) : 0;
            }

        }

        $this->view->references = $references;
        $this->view->grade_schemes = $lists;
        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }

    public function add_grade_scheme(){
        // Check rights
        $userHasRights = $this->roleModel->verifyRights("ALL");
        if(!$userHasRights){
            // Check users with this rights
            $commonRights = $this->roleModel->verifyRights("MANAGE_GRADE_SCHEME");
            if(!$commonRights){

                $this->unauthorized();
                return false;
            }
        }

        $this->view = new View("add_grade_scheme");

        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }

    public function edit_grade_scheme($id){
        // Check rights
        $userHasRights = $this->roleModel->verifyRights("ALL");
        if(!$userHasRights){
            // Check users with this rights
            $commonRights = $this->roleModel->verifyRights("MANAGE_GRADE_SCHEME");
            if(!$commonRights){

                $this->unauthorized();
                return false;
            }
        }

        if(empty($id)){
            $this->error();
            return false;
        }
        $this->view = new View("edit_grade_scheme");
        $gradeModel = new GradeModel();

        $info = $gradeModel->gradeSchemeDetails($id);

        $this->view->info = $info[0] ?? null;
        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }

    public function edit_news($id){
        // Check rights
        $userHasRights = $this->roleModel->verifyRights("ALL");
        if(!$userHasRights){
            // Check users with this rights
            $commonRights = $this->roleModel->verifyRights("EDIT_NEWS");
            if(!$commonRights){

                $this->unauthorized();
                return false;
            }
        }

    	if(empty($id)){
    		$this->error();
    		return false;
	    }
    	$this->view = new View("edit_news");

    	$this->model = new NewsModel();

    	$news_content = $this->model->getNews($id);

    	$this->view->news_content = $news_content;

    	$this->view->news_id = $id;
        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
	    $this->view->render();
    }

	public function approval(){
        // Check rights
        $userHasRights = $this->roleModel->verifyRights("ALL");
        if(!$userHasRights){
            // Check users with this rights
            $commonRights = $this->roleModel->verifyRights("APPROVE_STUDENT");
            if(!$commonRights){

                $this->unauthorized();
                return false;
            }
        }

		$this->view = new View("approval");

		$this->model = new StudentModel();

		$student = $this->model->getStudents();

		$this->view->students = $student;
        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
		$this->view->render();
    }


    public function student_overview(){
        // Check rights
        $userHasRights = $this->roleModel->verifyRights("ALL");
        if(!$userHasRights){
            // Check users with this rights
            $commonRights = $this->roleModel->verifyRights("MANAGE_STUDENT");
            if(!$commonRights){

                $this->unauthorized();
                return false;
            }
        }

        $this->view = new View("student_overview");

        $studentModel = new StudentModel();
        $result = $studentModel->showList();

        $this->view->studentList = $result != false ? $result : [];
        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }

    public function enroll_student($id){
        // Check rights
        $userHasRights = $this->roleModel->verifyRights("ALL");
        if(!$userHasRights){
            // Check users with this rights
            $commonRights = $this->roleModel->verifyRights("MANAGE_STUDENT");
            if(!$commonRights){

                $this->unauthorized();
                return false;
            }
        }

        $studentModel = new StudentModel();
        $student = $studentModel->studentInfo((int)$id);

        if($student == false || empty($student)){
            $this->error();
            return false;
        }



        $currModel = new CurriculumModel();
        $sectionModel = new SectionModel();





        $this->view = new View("enroll_student");
        $this->view->studentEducational = $studentModel->studentEducationalList((int)$id);
        $this->view->student = $student;
        $this->view->curriculumList = $currModel->list();
        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->sectionList = $sectionModel->list();

        //get the proper name for the level
        $levelNames = [];
        foreach($this->view->curriculumList as $cl){
            $levels = $currModel->schoolLevels($cl['curriculum_id']);
            if($levels){
                foreach($levels as $level){
                    $levelNames[$level['level_id']] = $currModel->schoolLevelInfo($level['level_id']);
                }
            }

        }
        $this->view->levelNames = $levelNames ?? [];
        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }


    public function print_form($id){
        if(empty($id) || $id == ""){
            $this->error();
            return false;
        }
        // Check rights
        $userHasRights = $this->roleModel->verifyRights("ALL");
        if(!$userHasRights){
            // Check users with this rights
            $commonRights = $this->roleModel->verifyRights("MANAGE_STUDENT");
            if(!$commonRights){

                $this->unauthorized();
                return false;
            }
        }


        $studentModel = new StudentModel();
        $studentInfo = $studentModel->studentInfo($id);

        if(!$studentInfo){
            $this->error();
            return false;
        }

        $educational = $studentModel->studentEducationalList($id);

        $currModel = new CurriculumModel();
        $gradeModel = new GradeModel();
        $subjectModel = new SubjectModel();
        $sectionModel = new SectionModel();
        $teacherModel = new TeacherModel();
        $levelList = [];
        $grades = [];
        if($educational){
            foreach($educational as $studentEducational){
                $level_info = $currModel->schoolLevelInfo($studentEducational->level_id);
                $grades = $gradeModel->getGrades((int)$studentEducational->student_id ?? 0, (int)$studentEducational->section_id ?? 0);
                $section_info  = $sectionModel->info((int)$studentEducational->section_id);
                $teacher = $teacherModel->findById('teacher_id',$section_info['section_adviser'] ?? 0);
                $gradeSchemeInfo = $currModel->schoolLevelGradeSchemeInfo($studentEducational->level_id);
                $gradeScheme = $gradeModel->gradeSchemeDetails( ($gradeSchemeInfo['grade_scheme_id'] ?? 0) );
                $subjects = [];

                if($grades){
                    // format the grades with key of subjectname
                    foreach($grades as $grade){
                        $subject_details = $subjectModel->info((int)$grade->subject_id ?? 0);
                        $subjectDetail = $subject_details[0];
                        $subjects[$subjectDetail['subject_name']][$grade->flags] = $grade->grade;
                    }
                }
                $levelList[] = ["section_info" => $section_info , "level_info" => $level_info, "subjects" => $subjects, "pass_threshold" => $gradeScheme[0]->pass_threshold ?? 0 , "adviser" => $teacher[0] ?? []];
            }

        }




        $this->view = new View("print_form");
        $this->view->levelList = $levelList;
        $this->view->student = $studentInfo;
        $this->view->raw_view();


    }

    public function master_list(){

        // Check rights
        $userHasRights = $this->roleModel->verifyRights("ALL");
        if(!$userHasRights){
            $this->unauthorized();
            return false;

        }

        $this->view = new View("master-list");


        $currModel = new CurriculumModel();
        $this->view->curriculumList = $currModel->list();
        $this->view->pointer = $this->pointer;
        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }


    public function master_pdf(){

        // Check rights
        $userHasRights = $this->roleModel->verifyRights("ALL");
        if(!$userHasRights){
            // Check users with this rights
            $commonRights = $this->roleModel->verifyRights("MANAGE_STUDENT");
            if(!$commonRights){

                $this->unauthorized();
                return false;
            }
        }


        $this->view = new View('master-pdf');
        $this->view->raw_view();
    }


}
