<?php namespace SIMS\App\Models;

use SIMS\Classes\Model;
use SIMS\Classes\Database;

class AccessTokenModel extends Model {

	public function __construct()
	{
		$this->db = new Database();
        $this->table = "access_token";
	}

	public function getStatus($access_token){
		$stmt = $this->db->prepare("SELECT * FROM access_token WHERE access_token = :access_token");
		$stmt->execute([":access_token"=>$access_token]);
		$result = $stmt->fetchAll();
		foreach ($result as $r){
			$status = $r['status'];
		}
		if($result){
			return $status;
		}
		return false;

	}

	// Checks the validity of the access_token
	public function getValidity($access_token){
		$date = date("Ymd");
		$current_date = intval($date);

		$stmt = $this->db->prepare("SELECT * FROM access_token WHERE access_token = :access_token");
		$stmt->execute([":access_token" => $access_token]);
		$result = $stmt->fetchAll();
		foreach ($result as $r) {
			$date_validity = $r['date_validity'];
		}

		// Convert the date to int and strip the dashes.
		$validity = intval(str_replace(["-", "–"], '', $date_validity));

		if($validity < $current_date){
			return true;
		}
		return false;

	}

	public function getStudentID($student_id){
		$stmt = $this->db->prepare("SELECT student_id FROM access_token WHERE access_token = :access_token");
		$stmt->execute([":access_token"=>$student_id]);
		$result = $stmt->fetchAll();
		foreach($result as $r){
			$s_id = $r['student_id'];
		}
		if($result){
			return $s_id;
		}
		return false;
	}

	public function getToken($access_token){
		$stmt = $this->db->prepare("SELECT * FROM access_token WHERE access_token = :access_token");
		$stmt->execute([":access_token"=>$access_token]);
		$result = $stmt->fetchAll();
		foreach ($result as $r){
			$token = $r['access_token'];
		}
		if($result){
			return $token;
		}
		return false;
	}


	// Set access token status to 1 if the user accessed the validity link within 7 days
	public function setPassword($student_id,$student_password)
	{

		$stmt = $this->db->prepare("UPDATE `students` SET `password` = :password WHERE student_id = :student_id");
		$result = $stmt->execute([":password" => md5($student_password),
			":student_id" => $student_id]);
		if ($result) {
			$stmt = $this->db->prepare("UPDATE `access_token` SET status = 1 WHERE student_id = :student_id");
			$result = $stmt->execute([":student_id" => $student_id]);
			if ($result) {
			    $stmt = $this->db->prepare("UPDATE `students` SET status = 1 WHERE student_id = :student_id");
			    $result = $stmt->execute([":student_id" => $student_id]);
			    if($result) {
                    return true;
                }
			}
		}
		return false;
	}



}
