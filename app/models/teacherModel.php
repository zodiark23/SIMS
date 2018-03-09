<?php
namespace SIMS\App\Models;

use SIMS\Classes\Database;
use SIMS\Classes\Model;
use SIMS\App\Entities\Student;


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