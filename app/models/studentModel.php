<?php

namespace SIMS\App\Models;

use SIMS\Classes\Model;
use SIMS\Classes\Database;
use SIMS\App\Entities\Student;
use SIMS\App\Entities\EducationalAttainment;


class StudentModel extends Model {
    
    /**
     * Represents all student related Business Logic
     */
    public function __construct(){
        $this->db = new Database();
        $this->table = "students";
    }


    /**
     * Create a new student with a pending status
     * Status 0 by default.
     * 
     * Returns true if successful.
     * 
     * @param Student $student The student representation to be created
     * 
     * @return array|bool False if failed. Array with student id will be return in case of success
     */
    public function create(Student $student){
        $emailExists = $this->checkDuplicateEmail($student->email);
        if($emailExists == true){
            return ["code" => "DUPLICATE" , "message" => "Email is taken"];
        }
        $stmt = $this->db->prepare("INSERT INTO students(student_id, first_name,middle_name,last_name,birth_date,email,password,contact_number,create_date,last_updated,gender,house_street_number,subdivision_barangay,town_city,province,tel_number,cell_number,status,role_id)
                    VALUES(
                        0,
                        :first_name,
                        :middle_name,
                        :last_name,
                        :birth_date,
                        :email,
                        :password,
                        :contact_number,
                        :create_date,
                        :last_updated,
                        :gender,
                        :house_street_number,
                        :subdivision_barangay,
                        :town_city,
                        :province,
                        :tel_number,
                        :cell_number,
                        :status,
                        :role_id
                    )
                    ");
        $stmt->execute([
            "first_name" => $student->first_name,
            "middle_name" => $student->middle_name,
            "last_name" => $student->last_name,
            "birth_date" => $student->birth_date,
            "email" => $student->email,
            "password" => $student->password,
            "contact_number" => $student->contact_number,
            "create_date" => $student->create_date,
            "last_updated" => $student->last_updated,
            "gender" => $student->gender,
            "house_street_number" => $student->house_street_number,
            "subdivision_barangay" => $student->subdivision_barangay,
            "town_city" => $student->town_city,
            "province" => $student->province,
            "tel_number" => $student->tel_number,
            "cell_number" => $student->cell_number,
            "status" => $student->status,
            "role_id" => $student->role_id
        ]);

        $count = $stmt->rowCount();

        if($count > 0){
            $last_id = $this->db->lastInsertId();

            return ["student_id" => $last_id ?? false];
        }


        return false;
    }

    /**
     * Inserts the value to the educational_attainment table
     * 
     * Student previous school can be listed here
     * 
     * curriculum_id will become 0 if not existed in the educational list in admin settings
     * 
     * @param EducationalAttainment $educ The representation of Edu Attainment the student achieved
     * 
     * @return bool True if success
     */
    public function addEducationAttainment(EducationalAttainment $educ){
        $stmt = $this->db->prepare("INSERT INTO `educational_attainment`(curriculum_id,description,student_id,address,year_completed,create_date, last_modified)
                VALUES(
                    :curr_id,
                    :description,
                    :student_id,
                    :address,
                    :year_completed,
                    :create_date,
                    :last_modified
                )
        ");
        $educ->curriculum_id = 0;
        //check if its on curriculum list else we use 0
        $q = $this->findById("description",$educ->description, "curriculum" );
        if(count($q) > 0){
            $educ->curriculum_id = $q[0]['curriculum_id'] ?? 0;
        }



        $stmt->execute([
            "curr_id" => $educ->curriculum_id,
            "description" => $educ->description,
            "student_id" => $educ->student_id,
            "address" => $educ->address,
            "year_completed" => $educ->year_completed,
            "create_date" => $educ->create_date,
            "last_modified" => $educ->last_modified
        ]);

        if($stmt->rowCount() > 0){
            return true;
        }

        return false;
    }

    /**
     * Checks whether the email is already existing
     * 
     * @param string $email The email to be checked
     * 
     * @return bool True if found. False if not duplicate
     */
    public function checkDuplicateEmail($email) : bool{

        $result = $this->findById("email", $email);

        if( $result && count($result) > 0){
            return true;
        }
        return false;
    }

    /**
     * 
     * Returns the list of grades of the target student
     * 
     * 
     * @param int $student_id The id of student to view
     * @param int|bool $level The year level to target. If false returns all grade
     * 
     * @return Grades Grade Model
     */
    public function viewGrade($student_id, $level = false){

    }


    /**
     * 
     * Return the payment list / information related
     * 
     * @param int $student_id The target ID to retrieve payment
     * 
     * 
     * @return mixed 
     * 
     * @todo This should implement a Payment Model
     * 
     */
    public function viewPayment($student_id){
        
    }


    /**
     * Update the student information
     * 
     * Check if the student_id on the entity is the same with the session
     * 
     * If different ask for Role & Rights - Will not proceed if the executor dont have proper privilege
     * 
     * Rights :: UPDATE_STUDENT_INFO
     * 
     * 
     * @param Student $student_info The student
     */
    public function updateInfo(Student $student_info){
        // @todo check the rights
    }

    // Fetch student_id of the newly added student.
	public function getStudentID(Student $student){
    	$result = $this->create($student);
		if($result){

			$stmt = $this->db->prepare("SELECT student_id FROM students WHERE email = :email");
			$stmt->execute([":email"=>$student->email]);
			$result = $stmt->fetchAll();
			foreach ($result as $r){
				$student_id = $r['student_id'];
			}
			return $student_id;

		}
		return false;

	}

	// Generate access token
	public function setToken(Student $student){
    	$student_id = $this->getStudentID($student);

    	$stmt = $this->db->prepare("SELECT student_id FROM access_token WHERE student_id = :student_id");
    	$stmt->execute([":student_id"=>$student_id]);
    	$result = $stmt->fetchAll();

    	// If $result = true, the student_id is already saved on access_token table.
    	if($result){
    		return false;
	    } else {
		    $stmt = $this->db->prepare("INSERT INTO access_token (token_id,student_id,access_token,date_validity,status) VALUES (null,:student_id,:access_token,CURDATE()+6,'default')");
		    $result = $stmt->execute([":student_id"=>$student_id,
			    ":access_token"=>$student->password]);
		    if($result){
			    return true;
		    }
	    }
		return false;
	}

	public function getToken(Student $student){
    	$student_id = $this->getStudentID($student);

    	$stmt = $this->db->prepare("SELECT * FROM access_token WHERE student_id = :student_id");
    	$stmt->execute([":student_id"=>$student_id]);
    	$result = $stmt->fetchAll();
		foreach ($result as $r){
			$access_token = $r['access_token'];
		}

    	if($result){
    	    return $access_token;
	    }
	    return false;
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
