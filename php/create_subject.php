<?php
include_once("../config.php");
include("../classes/autoloader.php");

loadPackage("../");

use SIMS\App\Models\SubjectModel;



$subjectModel = new SubjectModel();

$subjectModel->create("Math",6);