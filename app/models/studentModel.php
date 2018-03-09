<?php

namespace SIMS\App\Models;

use SIMS\Classes\Model;
use SIMS\Classes\Database;
use SIMS\App\Entities\Student;


class StudentModel extends Model {
    
    /**
     * Represents all student related Business Logic
     */
    public function __construct(){
        $this->db = new Database();
        $this->table = "curriculum";
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
    
}
