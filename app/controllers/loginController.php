<?php namespace SIMS\App\Controllers;

use SIMS\Classes\Controller;
use SIMS\Classes\View;
use SIMS\App\Models\LoginModel;

class LoginController extends Controller{

    public function __construct(){
        $this->view = new View("index");
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
	        $this->model = new LoginModel();
        }
    }
}
