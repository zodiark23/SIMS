<?php namespace SIMS\App\Models;

use SIMS\Classes\Model;
use SIMS\Classes\Database;

class AccessTokenModel extends Model {

	public function __construct()
	{
		$this->db = new Database();
        $this->table = "access_token";
	}

	public function getStudentID($access_token){
		$stmt = $this->db->prepare("SELECT act.student_id FROM access_token act JOIN students s ON act.student_id = s.student_id WHERE act.access_token = :access_token");
		$stmt->execute([":access_token"=>$access_token]);
		$result = $stmt->fetchAll();
		foreach($result as $r){
			$student_id = $r['student_id'];
		}
		if($result){
			return $student_id;
		}
		return false;
	}

	public function setPassword($access_token,$student_password){
		$student_id = $this->getStudentID($access_token);

		$stmt = $this->db->prepare("UPDATE students SET password = :password WHERE student_id = :student_id");
		$result = $stmt->execute([":password"=>$student_password,
			":student_id"=>$student_id]);
		($result) ? true : false;
	}


	// Set access token status to 1 if the user accessed the validity link within 7 days
	public function tokenValidity($access_token){
		$current_date = date("Y-m-d");
		$stmt = $this->db->prepare("SELECT * FROM access_token WHERE access_token = :access_token");
		$stmt->execute([":access_token"=>$access_token]);
		$result = $stmt->fetchAll();
		foreach ($result as $r){
			$access_token = $r['access_token'];
			$validity = $r['date_validity'];
		}

		if($validity >= $current_date){
			$stmt = $this->db->prepare("UPDATE access_token SET status = 1 WHERE access_token = :access_token");
			$result = $stmt->execute([":access_token"=>$access_token]);
			if($result){
				return true;
			}
		}
		return false;

	}

}
