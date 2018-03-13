<?php namespace SIMS\App\Entities;


class EducationalAttainment {
    public $ea_id;
    public $curriculum_id;// This is 0 if not from this school
    public $description;
    public $student_id;
    public $address;
    public $create_date;
    public $last_modified;
}