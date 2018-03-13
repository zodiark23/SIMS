<?php namespace SIMS\App\Entities;


/**
 * 
 * Object representation of student
 */
class Student{

    public $student_id;

    public $first_name;
    public $middle_name;
    public $last_name;

    public $email;
    public $password;
    public $contact_number;

    public $create_date;
    public $last_updated;

    public $gender;
    public $house_street_number;
    public $subdivision_barangay;
    public $town_city;
    public $province;
    public $tel_number;
    public $cell_number;
    

    public $status = 0;
    public $role_id;


}