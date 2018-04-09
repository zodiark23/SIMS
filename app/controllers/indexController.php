<?php namespace SIMS\App\Controllers;

use SIMS\App\Entities\Student;
use SIMS\App\Models\StudentModel;
use SIMS\App\Models\AccessTokenModel;
use SIMS\Classes\Controller;
use SIMS\Classes\View;
use SIMS\App\Models\NewsModel;

class IndexController extends Controller
{



    public function __construct(){
        $this->view = new View("index");

        $this->model = new NewsModel();

        $displayNewsIndex = $this->model->displayNewsIndex();

        $this->view->displayNewsIndex = $displayNewsIndex;
    }

    public function register(){
        $this->view = new View("register_form");
        $this->view->render();
    }


    public function facilities(){
        $this->view = new View("facilities");
        $this->view->render();
    }

    public function mission(){
        $this->view = new View("mv");
        $this->view->render();
    }

    public function login(){
        $this->view = new View("index");

	    $this->model = new NewsModel();

	    $displayNewsIndex = $this->model->displayNewsIndex();

	    $this->view->displayNewsIndex = $displayNewsIndex;

        $this->view->render();

        if(!isset($_SESSION['role_id'] )){
        	?>
			<script language="javascript">
				$(".login-modal").show();
			</script>
			<?php

        }
    }

	public function validate($id){


		if(empty($id)){
			$this->error();
			return false;
		}

		$this->view = new View("validate");
//		$this->model = new StudentModel();
//
//		$this->model->tokenValidity($id);
        $this->model = new AccessTokenModel();

        $status = $this->model->getStatus($id);

        if($status === '1'){
            $this->unauthorized();
            return false;
        }

        // Get the student_id based on the access_token
        $student_id = $this->model->getStudentID($id);
        $this->view->student_id = $student_id;

        // Get the access_token
        $token = $this->model->getToken($id);
        $this->view->token = $token;


        // If date_validity is lower than current date, student cannot access the update password page
        $validity = $this->model->getValidity($id);

        if($validity){
	        $this->unauthorized();
	        return false;
        }

		$this->view->render();

	}

    public function logout(){
        @session_start();
        //clear all session variables
        session_unset();
        //destroy the session
        session_destroy();

        
        @header("Location: ../");
        // $this->view = new View("logout");
        // $this->view->render();

    }


}
