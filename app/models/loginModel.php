<?php namespace SIMS\App\Models;

use SIMS\Classes\Model;
use SIMS\Classes\Database;

class LoginModel extends Model {

	private $userEmail;
	private $userPass;
	private $dbtable;

	public function __construct()
	{
        $this->db = new Database();
//        $this->table = "teachers";
	}

	private function process($p1, $p2, $table){
        @session_start();

		$this->userEmail = $p1;
		$this->userPass = $p2;
		$this->dbtable = $table;

		$stmt = $this->db->prepare("SELECT * FROM $table WHERE email=:email AND password=:password");
		$stmt->execute([":email"=> $p1, ":password"=>md5($p2)]);

		$result = $stmt->fetchAll();

		if(count($result) > 0){

            foreach($result as $key => $val){

                $_SESSION['user'][$key] = $val;
            }

			return true;

		} else {

			return false;

		}
	}

	public function adminLogin($userid,$userpassword){

		return $this->process($userid,$userpassword,"teachers");

	}

	public function teacherLogin($userid,$userpassword){

		return $this->process($userid,$userpassword,"teachers");

	}

	public function studentLogin($userid,$userpassword){

		return $this->process($userid,$userpassword,"students");

	}

	public function parentLogin($userid,$userpassword){

		return $this->process($userid,$userpassword,"parents");
	}
}
