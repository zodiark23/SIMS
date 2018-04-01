<?php namespace SIMS\App\Models;

use SIMS\Classes\Model;
use SIMS\Classes\Database;

class ProfileModel extends Model {



	public function __construct()
	{
        $this->db = new Database();

	}

	public function setTeacher($teacher_id,$f_name,$m_name,$l_name,$email,$pass,$civil_status,$address){
		$stmt = $this->db->prepare("SELECT * FROM teachers WHERE teacher_id = :teacher_id");
		$stmt->execute([":teacher_id"=>$teacher_id]);
		$result = $stmt->fetchAll();
		foreach ($result as $r){
			$id = $r['teacher_id'];
		}
		if($result){
			$stmt = $this->db->prepare("UPDATE teachers SET first_name = :first_name, middle_name = :middle_name, last_name = :last_name, email = :email, password = :password, civil_status = :civil_status, address = :address, last_modified = :last_modified WHERE teacher_id = :teacher_id");
			$result = $stmt->execute([":first_name"=>$f_name,
				":middle_name"=>$m_name,
				":last_name"=>$l_name,
				":email"=>$email,
				":password"=>$pass,
				":civil_status"=>$civil_status,
				":address"=>$address,
				":last_modified"=>date("Y-m-d H:i:s"),
				":teacher_id"=>$id]);

			if($result){
				return true;
			}

		}
		return false;
	}

	public function setStudent($student_id,$f_name,$m_name,$l_name,$email,$pass,$house,$sub,$town,$province,$tel,$cell){
		$stmt = $this->db->prepare("SELECT * FROM students WHERE student_id = :student_id");
		$stmt->execute([":student_id"=>$student_id]);
		$result = $stmt->fetchAll();
		foreach ($result as $r){
			$id = $r['student_id'];
		}
		if($result){
			$stmt = $this->db->prepare("UPDATE students SET first_name = :first_name, middle_name = :middle_name, last_name = :last_name, email = :email, password = :password, last_updated= :last_updated, house_street_number = :house, subdivision_barangay = :sub, town_city = :town, province = :province, tel_number = :tel, cell_number = :cell WHERE student_id = :student_id");
			$result = $stmt->execute([":first_name"=>$f_name,
				":middle_name"=>$m_name,
				":last_name"=>$l_name,
				":email"=>$email,
				":password"=>$pass,
				":last_updated"=>date("Y-m-d H:i:s"),
				":house"=>$house,
				":sub"=>$sub,
				":town"=>$town,
				":province"=>$province,
				":tel"=>$tel,
				":cell"=>$cell,
				":student_id"=>$id]);

			if($result){
				return true;
			}
		}
		return false;
	}

	public function setParent($parent_id,$f_name,$m_name,$l_name,$email,$pass,$contact)
	{
		$stmt = $this->db->prepare("SELECT * FROM parents WHERE parents_id = :parent_id");
		$stmt->execute([":parent_id" => $parent_id]);
		$result = $stmt->fetchAll();
		foreach ($result as $r) {
			$id = $r['parents_id'];
		}
		if ($result) {
			$stmt = $this->db->prepare("UPDATE parents SET first_name = :f_name, middle_name = :m_name, last_name = :l_name, email = :email, password = :password, contact_number = :contact, last_updated= :last_updated WHERE parents_id = :parent_id");
			$result = $stmt->execute([":f_name" => $f_name,
				":m_name" => $m_name,
				":l_name" => $l_name,
				":email" => $email,
				":password" => $pass,
				":contact" => $contact,
				":last_updated" => date("Y-m-d H:i:s"),
				":parent_id" => $id]);

			if ($result) {
				return true;
			}
		}
		return false;
	}


}
