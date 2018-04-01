<?php namespace SIMS\App\Controllers;

use SIMS\App\Models\ProfileModel;
use SIMS\Classes\Controller;
use SIMS\Classes\View;

class AccountController extends Controller{

    public function __construct(){
        $this->view = new View("dashboard");
    }


    public function account(){
        $this->view = new View("dashboard");
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