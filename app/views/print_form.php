<?php

require 'vendor/autoload.php';
use Mpdf\Mpdf;
$mpdf = new \Mpdf\Mpdf(['format' => 'A4']);

// $mpdf->debug = true;
ob_start();
?>

<html>
	<head>
		<title>School Management System - Print Form</title>
	</head>
	<style>
		@page {
			margin-left: 0.5cm;
			margin-right: 0.5cm;
			margin-top:0.5cm;
		}
	</style>
	<style>
		body {
			margin: 0;
			font-family: sans-serif;
		}
		table {
			border-collapse: collapse;
			width: 100%;
			max-width: 1200px;
			margin: auto;
			font-size: 12px;
		}
		table thead tr th {
			border: 1px solid #333;
		}
		.w-border tbody tr td {
			border: 1px solid #333;
			height: 18px;
		}
		.tc {
			text-align: center;
		}
		.bold {
			font-weight: bold;
		}
		.header {
			background: #ccc;
		}
		.form-table	{
			width: 100%;
			border-collapse: collapse;
			max-width: 1200px;
			margin: 15px auto;
		}
		.form-table .kne-logo {
			width: 80px;
		}
		.form-table .deped-logo {
			width: 120px;
		}
		.vat {
			vertical-align: top;
		}
		.w-3 {
			width: 33.33%;
		}
		.top-border {
			position: relative;
			font-size: 10px;
		}
		.top-border:before {
			content: "";
			position: absolute;
			top: 0;
			width: 95%;
			left: 0;
			right: 0;
			margin: auto;
			height: 1px;
			background: #000;
		}

		.max-width {
			width: 100%;
		}
		.underscore{
			border-bottom:1px solid #000;
		}

		.magic-line{
			border-bottom: 5px solid #fff;
		}
	</style>
	<body>
		<table class="form-table">
			<tr>
				<td rowspan="3" class="tc" style="width: 20%;"><img src="img/deped_logo_new.jpg" style='width:90px;height:100px' alt="" class="kne-logo"></td>
				<td class="tc">REPUBLIC OF THE PHILIPPINES</td>
				<td rowspan="3" class="tc" style="width: 20%;"><img src="img/new_kne_logo.jpg" alt="" style='width:120px;height:120px;' class="deped-logo"></td>
			</tr>
			<tr>
				<td class="tc vat">DEPARTMENT OF EDUCATION</td>
			</tr>
			<tr>
				<td class="tc bold" style="">SENIOR HIGH SCHOOL STUDENT PERMANENT RECORD</td>
			</tr>
		</table>

		<table>
			<tr>
				<td class="bold tc header" colspan="4">LEARNER'S INFORMATION</td>
			</tr>
			<tr>
				<td><span>LAST NAME:</span><span class='underscore' style='width:1cm'><?=$this->student->last_name ?? "" ?></span></td>
				<td>FIRST NAME: <span class='underscore' style='display:block'><?=$this->student->first_name ?? "" ?></span></td>
				<td>MIDDLE NAME: <span class='underscore' style='display:block'><?=$this->student->middle_name ?? "" ?></span></td>
			</tr>
		</table>
		<table>
			<tr>
				<td>LRN:</td>
				<td>Date of Birth(MM/DD/YYYY): <span class='underscore' style='display:block'><?=date("m/d/Y", strtotime($this->student->birth_date)) ?? "" ?></span></td>
				<td>Sex: <span class='underscore' style='display:block'><?= ( ($this->student->gender) == 1 ? "Male" : (($this->student->gender == 2) ? "Female" : "")) ?></span></td>
				<td>Date of SHS Admission(MM/DD/YYYY):</td>
			</tr>
		</table>

		<table>
			<tr>
				<td class="bold tc header" colspan="5">ELIGIBILITY FOR SHS ENROLMENT</td>
			</tr>
			<tr>
				<td><input type="checkbox"> High School Complete*</td>
				<td>Gen. Ave:</td>
				<td><input type="checkbox"> Junior High School Complete</td>
				<td>Gen. Ave:</td>
			</tr>
			<tr>
				<td colspan="2">Date of Graduation/Completion(MM/DD/YYYY):</td>
				<td colspan="2">Name of School:</td>
				<td>School Address:</td>
			</tr>
			<tr>
				<td><input type="checkbox"> PEPT Passer**</td>
				<td>Rating:</td>
				<td><input type="checkbox"> ALS A&amp;E Passer***</td>
				<td>Rating:</td>
				<td><input type="checkbox"> Others(Pls. Specify):</td>
			</tr>
			<tr>
				<td colspan="2">Date of Examination/Assessment(MM/DD/YYYY):</td>
				<td colspan="3">Name and Address of Community Learning Center:</td>
			</tr>
			<tr>
				<td colspan="2">*High School Completers are students who graduated from secondary school under the old curriculum</td>
				<td colspan="3">***ALS A&amp;E - Alternative Learning System Accreditation and Equivalency Test for JHS</td>
			</tr>
			<tr>
				<td colspan="5">**PEPT - Philippine Educational Placement Test for JHS</td>
			</tr>
		</table>
		<br>
		<table>
			<tr>
				<td class="bold tc header" colspan="5">SCHOLASTIC RECORD</td>
			</tr>
			<tr>
				<td class="bold">SCHOOL: <?= isset($this->levelList[0]) ? "Luakan High School" : "" ?></td>
				<td class="bold">SCHOOL ID:</td>
				<td class="bold">GRADE LEVEL: <?= ($this->levelList[0]["level_info"]["level_name"] ?? "") ?></td>
				<td class="bold">SY:</td>
				<td class="bold">SEM:</td>
			</tr>
			<tr>
				<td class="bold" colspan="2">TRACK/STRAND:</td>
				<td class="bold" colspan="3">SECTION: <?= ($this->levelList[0]["section_info"]["section_name"] ?? "") ?></td>
			</tr>
		</table>
		<table class="w-border">
			<thead class="header">
				<tr>
					<th rowspan="2" style="width: 150px;">Indicate if Subject is
					CORE, APPLIED, or
					SPECIALIZED
					</th>
					<th rowspan="2">SUBJECTS</th>
					<th colspan="2">QUARTER</th>
					<th rowspan="2" style="width: 100px;">SEM FINAL GRADE</th>
					<th rowspan="2" style="width: 100px;">ACTION TAKEN</th>
				</tr>
				<tr>
					<th style="width: 50px;">&nbsp;</th>
					<th style="width: 50px;">&nbsp;</th>
				</tr>
			</thead>
			<tbody>

				<?php 
				$subjects = $this->levelList[0]["subjects"] ?? [];
				
				foreach($subjects as $subject_name => $subject_grades){
					$avg = "";
					$status = "";
				?>
				<tr>
					<td></td>
					<td><span style='color:#fff'>_</span> <?= $subject_name ?? "" ?></td>
					<td><center><?= $subject_grades[1] ?? "" ?></center></td>
					<td><center><?= $subject_grades[2] ?? ""?></center></td>
					<td>
						<center>
						<?php
						 //total grade divided by 2(default 2 flags)
						 $total_grade = ((int)$subject_grades[1] ?? 0 )+ ((int)$subject_grades[2] ?? 0);
						 $avg = $total_grade / 2; //we still don't have configurable flags
						 echo $avg;
						?>
						</center>
					</td>
					<td>
						<center>
						<?php
						//status
						$status = $avg > $this->levelList[0]['pass_threshold'] ? "Passed" : "Failed";
						echo $status;
						?>
						</center>
					</td>
				</tr>
				<?php }
				
				//balance the lines. Must be 12 lines.
				for ($i = 0; $i < (12 - count($subjects)); $i++) {
					echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
				}
				?>
				<tr>
					<td colspan="4" class="header bold" style="text-align: right;">General Ave. for the Semester:</td>
					<td></td>
					<td></td>
				</tr>
			</tbody>
		</table>
		<table>
			<tr>
				<td class="bold" colspan="3">REMARKS:</td>
			</tr>
			<tr>
				<td class="bold w-3" style="padding-bottom: 20px;">Prepared By:</td>
				<td class="bold w-3" style="padding-bottom: 20px;">Certified True and Correct:</td>
				<td class="bold w-3" style="padding-bottom: 20px;">Date Checked(MM/DD/YYYY):</td>
			</tr>
			<tr>
				<td><center class='underscore'><?= $this->levelList[0]['adviser']['first_name'] ?? ""?> <?= $this->levelList[0]['adviser']['middle_name'] ?? ""?> <?= $this->levelList[0]['adviser']['last_name'] ?? ""?></center></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td class="tc w-3 top-border">Signature of Adviser over Printed Name</td>
				<td class="tc w-3 top-border">Signature of Authorized Person over Printed Name, Designation</td>
				<td class="tc w-3 top-border"></td>
			</tr>
		</table>
		<br>
		<br>
		<table>
			<tr>
				<td class="bold tc" style="width: 150px;">REMEDIAL CLASSES</td>
				<td class="bold">Conducted from (MM/DD/YYYY):</td>
				<td class="bold">to (MM/DD/YYYY):</td>
				<td class="bold">SCHOOL:</td>
				<td class="bold">SCHOOL ID:</td>
			</tr>
		</table>
		<table class="w-border">
			<thead class="header">
				<tr>
					<th style="width: 150px;">Indicate if Subject is
					CORE, APPLIED, or
					SPECIALIZED</th>
					<th>SUBJECTS</th>
					<th style="width: 50px;">SEM FINAL GRADE</th>
					<th style="width: 50px;">REMEDIAL CLASS MARK</th>
					<th style="width: 100px;">RECOMPUTED FINAL GRADE</th>
					<th style="width: 100px;">ACTION TAKEN</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tbody>
		</table>
		<table>
			<tr>
				<td>Name of Teacher/Adviser:</td>
				<td style="width: 300px;">Signature:</td>
			</tr>
		</table>
		<!-- End of First Block -->
		<br>
		<br>
		<br>
		<table>
		<tr>
				<td class="bold">SCHOOL: <?= isset($this->levelList[1]) ? "Luakan High School" : "" ?></td>
				<td class="bold">SCHOOL ID:</td>
				<td class="bold">GRADE LEVEL: <?= ($this->levelList[1]["level_info"]["level_name"] ?? "") ?></td>
				<td class="bold">SY:</td>
				<td class="bold">SEM:</td>
			</tr>
			<tr>
				<td class="bold" colspan="2">TRACK/STRAND:</td>
				<td class="bold" colspan="3">SECTION: <?= ($this->levelList[1]["section_info"]["section_name"] ?? "") ?></td>
			</tr>
		</table>
		<table class="w-border">
			<thead class="header">
				<tr>
					<th rowspan="2" style="width: 150px;">Indicate if Subject is
					CORE, APPLIED, or
					SPECIALIZED
					</th>
					<th rowspan="2">SUBJECTS</th>
					<th colspan="2">QUARTER</th>
					<th rowspan="2" style="width: 100px;">SEM FINAL GRADE</th>
					<th rowspan="2" style="width: 100px;">ACTION TAKEN</th>
				</tr>
				<tr>
					<th style="width: 50px;">&nbsp;</th>
					<th style="width: 50px;">&nbsp;</th>
				</tr>
			</thead>
			<tbody>

				<?php 
				$subjects = $this->levelList[1]["subjects"] ?? [];
				
				foreach($subjects as $subject_name => $subject_grades){
					$avg = "";
					$status = "";
				?>
				<tr>
					<td></td>
					<td><span style='color:#fff'>_</span> <?= $subject_name ?? "" ?></td>
					<td><center><?= $subject_grades[1] ?? "" ?></center></td>
					<td><center><?= $subject_grades[2] ?? ""?></center></td>
					<td>
						<center>
						<?php
						 //total grade divided by 2(default 2 flags)
						 $total_grade = ((int)$subject_grades[1] ?? 0 )+ ((int)$subject_grades[2] ?? 0);
						 $avg = $total_grade / 2; //we still don't have configurable flags
						 echo $avg;
						?>
						</center>
					</td>
					<td>
						<center>
						<?php
						//status
						$status = $avg > $this->levelList[1]['pass_threshold'] ? "Passed" : "Failed";
						echo $status;
						?>
						</center>
					</td>
				</tr>
				<?php }
				
				//balance the lines. Must be 12 lines.
				for ($i = 0; $i < (12 - count($subjects)); $i++) {
					echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
				}
				?>
				<tr>
					<td colspan="4" class="header bold" style="text-align: right;">General Ave. for the Semester:</td>
					<td></td>
					<td></td>
				</tr>
			</tbody>
		</table>
		<table>
			<tr>
				<td class="bold" colspan="3">REMARKS:</td>
			</tr>
			<tr>
				<td class="bold w-3" style="padding-bottom: 20px;">Prepared By:</td>
				<td class="bold w-3" style="padding-bottom: 20px;">Certified True and Correct:</td>
				<td class="bold w-3" style="padding-bottom: 20px;">Date Checked(MM/DD/YYYY):</td>
			</tr>
			<tr>
				<td><center class='underscore'><?= $this->levelList[1]['adviser']['first_name'] ?? ""?> <?= $this->levelList[1]['adviser']['middle_name'] ?? ""?> <?= $this->levelList[1]['adviser']['last_name'] ?? ""?></center></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td class="tc w-3 top-border">Signature of Adviser over Printed Name</td>
				<td class="tc w-3 top-border">Signature of Authorized Person over Printed Name, Designation</td>
				<td class="tc w-3 top-border"></td>
			</tr>
		</table>
		<br>
		
		<table>
			<tr>
				<td class="bold tc" style="width: 150px;">REMEDIAL CLASSES</td>
				<td class="bold">Conducted from (MM/DD/YYYY):</td>
				<td class="bold">to (MM/DD/YYYY):</td>
				<td class="bold">SCHOOL:</td>
				<td class="bold">SCHOOL ID:</td>
			</tr>
		</table>
		<table class="w-border">
			<thead class="header">
				<tr>
					<th style="width: 150px;">Indicate if Subject is
					CORE, APPLIED, or
					SPECIALIZED</th>
					<th>SUBJECTS</th>
					<th style="width: 50px;">SEM FINAL GRADE</th>
					<th style="width: 50px;">REMEDIAL CLASS MARK</th>
					<th style="width: 100px;">RECOMPUTED FINAL GRADE</th>
					<th style="width: 100px;">ACTION TAKEN</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tbody>
		</table>
		<table>
			<tr>
				<td>Name of Teacher/Adviser:</td>
				<td style="width: 300px;">Signature:</td>
			</tr>
		</table>
		<br>
		<br>
		<!-- End of 2nd block -->
		<table>
		<tr>
				<td class="bold">SCHOOL: <?= isset($this->levelList[2]) ? "Luakan High School" : "" ?></td>
				<td class="bold">SCHOOL ID:</td>
				<td class="bold">GRADE LEVEL: <?= ($this->levelList[2]["level_info"]["level_name"] ?? "") ?></td>
				<td class="bold">SY:</td>
				<td class="bold">SEM:</td>
			</tr>
			<tr>
				<td class="bold" colspan="2">TRACK/STRAND:</td>
				<td class="bold" colspan="3">SECTION: <?= ($this->levelList[2]["section_info"]["section_name"] ?? "") ?></td>
			</tr>
		</table>
		<table class="w-border">
			<thead class="header">
				<tr>
					<th rowspan="2" style="width: 150px;">Indicate if Subject is
					CORE, APPLIED, or
					SPECIALIZED
					</th>
					<th rowspan="2">SUBJECTS</th>
					<th colspan="2">QUARTER</th>
					<th rowspan="2" style="width: 100px;">SEM FINAL GRADE</th>
					<th rowspan="2" style="width: 100px;">ACTION TAKEN</th>
				</tr>
				<tr>
					<th style="width: 50px;">&nbsp;</th>
					<th style="width: 50px;">&nbsp;</th>
				</tr>
			</thead>
			<tbody>

				<?php 
				$subjects = $this->levelList[2]["subjects"] ?? [];
				
				foreach($subjects as $subject_name => $subject_grades){
					$avg = "";
					$status = "";
				?>
				<tr>
					<td></td>
					<td><span style='color:#fff'>_</span> <?= $subject_name ?? "" ?></td>
					<td><center><?= $subject_grades[1] ?? "" ?></center></td>
					<td><center><?= $subject_grades[2] ?? ""?></center></td>
					<td>
						<center>
						<?php
						 //total grade divided by 2(default 2 flags)
						 $total_grade = ((int)$subject_grades[1] ?? 0 )+ ((int)$subject_grades[2] ?? 0);
						 $avg = $total_grade / 2; //we still don't have configurable flags
						 echo $avg;
						?>
						</center>
					</td>
					<td>
						<center>
						<?php
						//status
						$status = $avg > $this->levelList[1]['pass_threshold'] ? "Passed" : "Failed";
						echo $status;
						?>
						</center>
					</td>
				</tr>
				<?php }
				
				//balance the lines. Must be 12 lines.
				for ($i = 0; $i < (12 - count($subjects)); $i++) {
					echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
				}
				?>
				<tr>
					<td colspan="4" class="header bold" style="text-align: right;">General Ave. for the Semester:</td>
					<td></td>
					<td></td>
				</tr>
			</tbody>
		</table>
		<table>
			<tr>
				<td class="bold" colspan="3">REMARKS:</td>
			</tr>
			<tr>
				<td class="bold w-3" style="padding-bottom: 20px;">Prepared By:</td>
				<td class="bold w-3" style="padding-bottom: 20px;">Certified True and Correct:</td>
				<td class="bold w-3" style="padding-bottom: 20px;">Date Checked(MM/DD/YYYY):</td>
			</tr>
			<tr>
				<td><center class='underscore'><?= $this->levelList[2]['adviser']['first_name'] ?? ""?> <?= $this->levelList[2]['adviser']['middle_name'] ?? ""?> <?= $this->levelList[2]['adviser']['last_name'] ?? ""?></center></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td class="tc w-3 top-border">Signature of Adviser over Printed Name</td>
				<td class="tc w-3 top-border">Signature of Authorized Person over Printed Name, Designation</td>
				<td class="tc w-3 top-border"></td>
			</tr>
		</table>

		<table>
			<tr>
				<td class="bold tc" style="width: 150px;">REMEDIAL CLASSES</td>
				<td class="bold">Conducted from (MM/DD/YYYY):</td>
				<td class="bold">to (MM/DD/YYYY):</td>
				<td class="bold">SCHOOL:</td>
				<td class="bold">SCHOOL ID:</td>
			</tr>
		</table>
		<table class="w-border">
			<thead class="header">
				<tr>
					<th style="width: 150px;">Indicate if Subject is
					CORE, APPLIED, or
					SPECIALIZED</th>
					<th>SUBJECTS</th>
					<th style="width: 50px;">SEM FINAL GRADE</th>
					<th style="width: 50px;">REMEDIAL CLASS MARK</th>
					<th style="width: 100px;">RECOMPUTED FINAL GRADE</th>
					<th style="width: 100px;">ACTION TAKEN</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tbody>
		</table>
		<table>
			<tr>
				<td>Name of Teacher/Adviser:</td>
				<td style="width: 300px;">Signature:</td>
			</tr>
		</table>
		<br>
		<br>
		<table>
			<tr>
				<td class="bold">SCHOOL: <?= isset($this->levelList[3]) ? "Luakan High School" : "" ?></td>
				<td class="bold">SCHOOL ID:</td>
				<td class="bold">GRADE LEVEL: <?= ($this->levelList[3]["level_info"]["level_name"] ?? "") ?></td>
				<td class="bold">SY:</td>
				<td class="bold">SEM:</td>
			</tr>
			<tr>
				<td class="bold" colspan="2">TRACK/STRAND:</td>
				<td class="bold" colspan="3">SECTION: <?= ($this->levelList[3]["section_info"]["section_name"] ?? "") ?></td>
			</tr>
		</table>
		<table class="w-border">
			<thead class="header">
				<tr>
					<th rowspan="2" style="width: 150px;">Indicate if Subject is
					CORE, APPLIED, or
					SPECIALIZED
					</th>
					<th rowspan="2">SUBJECTS</th>
					<th colspan="2">QUARTER</th>
					<th rowspan="2" style="width: 100px;">SEM FINAL GRADE</th>
					<th rowspan="2" style="width: 100px;">ACTION TAKEN</th>
				</tr>
				<tr>
					<th style="width: 50px;">&nbsp;</th>
					<th style="width: 50px;">&nbsp;</th>
				</tr>
			</thead>
			<tbody>

				<?php 
				$subjects = $this->levelList[3]["subjects"] ?? [];
				
				foreach($subjects as $subject_name => $subject_grades){
					$avg = "";
					$status = "";
				?>
				<tr>
					<td></td>
					<td><span style='color:#fff'>_</span> <?= $subject_name ?? "" ?></td>
					<td><center><?= $subject_grades[1] ?? "" ?></center></td>
					<td><center><?= $subject_grades[2] ?? ""?></center></td>
					<td>
						<center>
						<?php
						 //total grade divided by 2(default 2 flags)
						 $total_grade = ((int)$subject_grades[1] ?? 0 )+ ((int)$subject_grades[2] ?? 0);
						 $avg = $total_grade / 2; //we still don't have configurable flags
						 echo $avg;
						?>
						</center>
					</td>
					<td>
						<center>
						<?php
						//status
						$status = $avg > $this->levelList[3]['pass_threshold'] ? "Passed" : "Failed";
						echo $status;
						?>
						</center>
					</td>
				</tr>
				<?php }
				
				//balance the lines. Must be 12 lines.
				for ($i = 0; $i < (12 - count($subjects)); $i++) {
					echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
				}
				?>
				<tr>
					<td colspan="4" class="header bold" style="text-align: right;">General Ave. for the Semester:</td>
					<td></td>
					<td></td>
				</tr>
			</tbody>
		</table>
		<table>
			<tr>
				<td class="bold" colspan="3">REMARKS:</td>
			</tr>
			<tr>
				<td class="bold w-3" style="padding-bottom: 20px;">Prepared By:</td>
				<td class="bold w-3" style="padding-bottom: 20px;">Certified True and Correct:</td>
				<td class="bold w-3" style="padding-bottom: 20px;">Date Checked(MM/DD/YYYY):</td>
			</tr>
			<tr>
				<td><center class='underscore'><?= $this->levelList[3]['adviser']['first_name'] ?? ""?> <?= $this->levelList[3]['adviser']['middle_name'] ?? ""?> <?= $this->levelList[3]['adviser']['last_name'] ?? ""?></center></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td class="tc w-3 top-border">Signature of Adviser over Printed Name</td>
				<td class="tc w-3 top-border">Signature of Authorized Person over Printed Name, Designation</td>
				<td class="tc w-3 top-border"></td>
			</tr>
		</table>

		<table>
			<tr>
				<td class="bold tc" style="width: 150px;">REMEDIAL CLASSES</td>
				<td class="bold">Conducted from (MM/DD/YYYY):</td>
				<td class="bold">to (MM/DD/YYYY):</td>
				<td class="bold">SCHOOL:</td>
				<td class="bold">SCHOOL ID:</td>
			</tr>
		</table>
		<table class="w-border">
			<thead class="header">
				<tr>
					<th style="width: 150px;">Indicate if Subject is
					CORE, APPLIED, or
					SPECIALIZED</th>
					<th>SUBJECTS</th>
					<th style="width: 50px;">SEM FINAL GRADE</th>
					<th style="width: 50px;">REMEDIAL CLASS MARK</th>
					<th style="width: 100px;">RECOMPUTED FINAL GRADE</th>
					<th style="width: 100px;">ACTION TAKEN</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tbody>
		</table>
		<table>
			<tr>
				<td>Name of Teacher/Adviser:</td>
				<td style="width: 300px;">Signature:</td>
			</tr>
		</table>
		<!-- <br> -->
		<table>
			<tr>
				<td class="bold">Track/Strand Accomplished:</td>
				<td class="bold" style="width: 200px;">SHS General Average:</td>
			</tr>
			<tr>
				<td class="bold">Awards/Honors Received:</td>
				<td class="bold" style="width: 350px;">Date of SHS Graduation (MM/DD/YYYY):</td>
			</tr>
		</table>
		<table>
			<tr>
				<td class="bold" style="width: 50%;">Certified by:</td>
				<td class="bold" style="width: 50%;">Place School Seal Here:</td>
			</tr>
			<tr>
				<td style="width: 50%">
					<br>
					<table>
						<tr>
							<td class="tc top-border" style="width: 70%;">
								Signature of School Head over Printed Name
							</td>
							<td class="tc top-border">
								Date
							</td>
						</tr>
						<tr>
							<td colspan="2" style="border: 1px solid #000;">
								<strong>NOTE:</strong>

								<p style="font-size: 11px;">This permanent record or a photocopy of this permanent record that bears the seal of the school and the original
								signature in ink of the School Head shall be considered valid for all legal purposes. Any erasure or alteration
								made on this copy should be validated by the School Head.
								If the student transfers to another school, the originating school should produce one (1) certified true copy of this
								permanent record for safekeeping. The receiving school shall continue filling up the original form.
								Upon graduation, the school from which the student graduated should keep the original form and produce one (1)
								certified true copy for the Division Office</p>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="font-size: 11px;"><strong>REMARKS:</strong> (Please indicate the purpose for which this permanent record will be used)</td>
						</tr>
						<tr>
							<td class="bold" style="padding-top: 10px;">Date Issued (MM/DD/YYYY):</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>


<?php
$html  = ob_get_contents();
ob_clean();
try{

	$mpdf->WriteHTML($html);
	$mpdf->Output();
}catch(\Mpdf\MpdfException $e){
	echo $e->getMessage();
}
?>