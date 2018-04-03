<?php namespace SIMS\App\Entities;


class Grade {
    public $grade_id = 0;
    public $section_id;
    public $student_id;
    public $subject_id;
    public $grade;
    public $created_date;
    public $modified_date;
    public $flags;
    public $result = "";
}