<?php namespace SIMS\App\Controllers;

use SIMS\Classes\Controller;
use SIMS\Classes\View;
use SIMS\App\Models\AdminModel;

class AdminController extends Controller{
    public function __construct(){
        $this->view = new View("admin_create_education");
        $this->view->action = "new";
    }


    public function create_education(){
        $this->view = new View("admin_create_education");
        $this->model = new AdminModel();

        $this->view->action = "new";

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

        $this->view->render();
    }
}