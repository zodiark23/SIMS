<?php namespace SIMS\App\Models;

use SIMS\Classes\Model;
use SIMS\Classes\Database;

class RejectModel extends Model {

	public function __construct()
	{
		$this->db = new Database();
        $this->table = "access_token";
	}

	public function getStudentID($student_id){
		$stmt = $this->db->prepare("SELECT * FROM students WHERE student_id = :student_id");
		$stmt->execute([":student_id"=>$student_id]);
		$result = $stmt->fetchAll();
		foreach($result as $r){
			$s_id = $r['student_id'];
		}
		if($result){
			return $s_id;
		}
		return false;
	}

	public function deleteStudentDetails($student_id){
		$id = $this->getStudentID($student_id);
		$stmt = $this->db->prepare("DELETE act,ea FROM access_token act JOIN educational_attainment ea ON act.student_id=ea.student_id WHERE act.student_id = :student_id");
		$result = $stmt->execute([":student_id"=>$id]);
		if($result){
			$stmt = $this->db->prepare("DELETE FROM students WHERE student_id = :student_id");
			$result = $stmt->execute([":student_id"=>$id]);
			if($result){
				return true;
			}
		}
		return false;
	}




}
