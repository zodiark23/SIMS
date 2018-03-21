<?php namespace SIMS\App\Controllers;

use SIMS\Classes\Controller;
use SIMS\Classes\View;

class IndexController extends Controller
{



    public function __construct(){
        $this->view = new View("index");
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

        $this->view->render();

        if(!isset($_SESSION['role_id'] )){
        	?>
			<script language="javascript">
				$(".login-modal").show();
			</script>
			<?php

        }
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
