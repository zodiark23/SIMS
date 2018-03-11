<?php namespace SIMS\App\Entities;


/**
 * 
 * Object representation of Teacher
 */
class Teacher{

    public $teacher_id;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $email;
    public $password;
    public $gender;
    public $date_of_birth;
    public $nationality;
    public $civil_status;
    public $address;
    public $status;
    public $role_id;

    /**
     * Create an teacher model
     */
    public function __construct($teacher_id = 0, $first_name= "", $middle_name= "", $last_name= "", $email= "", $password= "", $gender= "", $date_of_birth= "", $nationality= "", $civil_status= "",$address= "", $status= "", $role_id = ""){


        $this->teacher_id = $teacher_id;
        $this->first_name = $first_name;
        $this->middle_name = $middle_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
        $this->gender = $gender;
        $this->date_of_birth = $date_of_birth;
        $this->nationality = $nationality;
        $this->civil_status = $civil_status;
        $this->address = $address;
        $this->status = $status;
        $this->role_id = $role_id;
    }

}