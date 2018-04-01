<?php
namespace SIMS\App\Models;

use SIMS\Classes\Database;
use SIMS\Classes\Model;
use SIMS\App\Entities\Student;
use SIMS\App\Entities\Teacher;


class TeacherModel extends Model{

    /**
     * Teacher ID is *optional*
     * 
     * @param int $teacher_id The teacher_id to use.
     */
    public function __construct($teacher_id = false){
        $this->db = new Database();
        $this->table = "teachers";
    }



    public function list(){
        $stmt = $this->db->prepare("SELECT * FROM `teachers` WHERE `teacher_id` > 1");
        $stmt->execute();

        $result = $stmt->fetchAll();

        if(count($result) > 0){
            return $result;
        }

        return false;
    }


    /**
     * Method to create a new teacher
     * 
     * RIGHTS : CREATE_TEACHER
     * 
     * @param Teacher $teacher The teacher entity that contains the information
     * 
     * @return bool True if success
     */
    public function create(Teacher $teacher){

        $exists = $this->findById('email', $teacher->email);

        if($exists) {
            // stop execution
            // conflic
            return 409;
        }
        $stmt = $this->db->prepare("INSERT INTO teachers 
                            VALUES(
                                :teacher_id,
                                :first_name,
                                :middle_name,
                                :last_name,
                                :email,
                                :password,
                                :gender,
                                :date_of_birth,
                                :nationality,
                                :civil_status,
                                :address,
                                :create_date,
                                :last_modified,
                                :status,
                                :role_id
                             )
                        ");
        $stmt->execute([
            "teacher_id" => $teacher->teacher_id,
            "first_name" => $teacher->first_name,
            "middle_name" => $teacher->middle_name,
            "last_name" => $teacher->last_name,
            "email" => $teacher->email,
            "password" => $teacher->password,
            "gender" => $teacher->gender,
            "date_of_birth" => $teacher->date_of_birth,
            "nationality" => $teacher->nationality,
            "civil_status" => $teacher->civil_status,
            "address" => $teacher->address,
            "create_date" => date("Y-m-d H:i:s"),
            "last_modified" => date("Y-m-d H:i:s"),
            "status" => $teacher->status,
            "role_id" => $teacher->role_id,
        ]);

        if($stmt){
            return true;
        }

        return false;
        
    }

    /**
     * Get the students under this teacher
     */
    public function myStudents($teacher_id){
        $sectionModel = new SectionModel();
        $studentModel = new StudentModel();
        $sections = $sectionModel->getSectionByAdvisor($teacher_id);

        if(!$sections){
            return false;
        }
        $list = [];
        foreach($sections as $s){

            $students = $sectionModel->getStudents($s->section_id);
            $sectionStudents = array();
            if($students){

                foreach($students as $student){

                    $student_id = $student->student_id;
                    $result = $studentModel->findById("student_id",$student_id);
                    $sectionStudents[] = $result;
                }
            }
            $list[$s->section_id] = ["section_name" => $s->section_name, "data" => $sectionStudents];
        }

        return $list;

    }


    /**
     * Add grade to the student
     * 
     * Invokes GradeModel->add
     */
    public function addGrade($grade, Student $student){

    }

    /**
     * Edit the grade if its still encoding phase
     * 
     * But will not further change if the grade is published
     * 
     */
    public function editGrade($grade, Student $student){

    }

    /**
     * Returns the list of schedule
     * 
     * @return mixed
     */
    public function viewSchedule(){
    
    }

    /**
     * 
     * Drop the student on the subject
     */
    public function dropStudent(Student $student){

    }



}