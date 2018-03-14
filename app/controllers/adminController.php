<?php namespace SIMS\App\Controllers;

use SIMS\Classes\Controller;
use SIMS\Classes\View;
use SIMS\App\Models\AdminModel;
use SIMS\App\Models\CurriculumModel;
use SIMS\App\Models\SubjectModel;
use SIMS\App\Models\TeacherModel;
use SIMS\App\Models\RoleModel;


class AdminController extends Controller{
    public $side_nav_data = [];

    public function __construct(){
        $this->view = new View("educational_list");
        $this->view->action = "new";

        /**
         * Teachers sidenav counter
         */
        $teacherModel = new TeacherModel();
        $result = $teacherModel->showAll();
        $this->side_nav_data['teacherCount'] = 0;

        if($result){
            $this->side_nav_data['teacherCount'] = count($result) > 0 ? (count($result) - 1) : 0;
        }
    }


    public function education(){
        $this->view = new View("educational_list");
        $m = new CurriculumModel();
        $this->view->data = $m->list();

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
        $this->view = new View("admin_create_education");
        $this->model = new AdminModel();

        $this->view->action = "new";

        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }


    public function edit_education($id){

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

        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }


    public function create_subject(){
        $this->view = new View("create_subject");
        $currModel = new CurriculumModel();
        $this->view->curriculumList = $currModel->list();

        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }


    public function edit_subject($id){
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

        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }


    public function subject_list(){
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

        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }

    public function overview_teacher(){
        $this->view = new View("teacher_overview");
        $this->model = new TeacherModel();
        $this->view->teachers = $this->model->showAll();

        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }

    public function create_teacher(){
        $this->view = new View("add_teacher");

        $this->view->side_nav_data = $this->side_nav_data;
        $this->view->render();
    }

	public function roles(){

		$this->view = new View("roles");
		$this->model = new RoleModel();

		$role = $this->model->getRole();

		$this->model->verifyRights("ALL");


		$this->view->roles = $role;

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

		$this->view->role_id = $id;

		$this->view->currentRights = $currentRights;

		$this->view->render();

	}

	public function add_roles(){
    	$this->view = new View("add_roles");

		$this->view->render();

	}
}
