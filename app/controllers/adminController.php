<?php namespace SIMS\App\Controllers;

use SIMS\Classes\Controller;
use SIMS\Classes\View;
use SIMS\App\Models\AdminModel;

class AdminController extends Controller{

    public function __construct(){
        $this->view = new View("admin_create_education");
    }


    public function manage_education($id = "1"){
        $this->view = new View("admin_create_education");
        $this->model = new AdminModel();

        $data = $this->model->findById("curriculum_id",$id);

        if(!empty($data)){
            /** Format the data and Pass the it to view*/
            /** Select the first entry since are using PK viewing */
            $this->view->data["adminModel"] = $data[0];
            
        }

        $this->view->render();
    }
}