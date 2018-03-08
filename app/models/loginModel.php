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

		$this->userEmail = $p1;
		$this->userPass = $p2;
		$this->dbtable = $table;

		$stmt = $this->db->prepare("SELECT * FROM $table WHERE email=:email AND password=:password");
		$stmt->execute([":email"=>"$p1", ":password"=>"$p2"]);

		$result = $stmt->fetchAll();

		if(count($result) > 0){

			foreach ($result as $r){
				$role_id = $r['role_id'];
				$first_name = $r['first_name'];
				$last_name = $r['last_name'];
			}

			$_SESSION['role_id'] = $role_id;
			$_SESSION['first_name'] = $first_name;
			$_SESSION['last_name'] = $last_name;

		} else {

			echo "Invalid email and password";

		}
	}

	public function adminLogin($userid,$userpassword){

		$this->process($userid,$userpassword,"teachers");

	}

	public function teacherLogin($userid,$userpassword){

		$this->process($userid,$userpassword,"teachers");

	}

	public function studentLogin($userid,$userpassword){

		$this->process($userid,$userpassword,"students");

	}

	public function parentLogin($userid,$userpassword){

		$this->process($userid,$userpassword,"parents");
	}
}
