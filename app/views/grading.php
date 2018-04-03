<html>
	<head>
		<script defer src="<?=BASE_URL?>/js/fontawesome-all.min.js"></script>
        <script src="<?=BASE_URL?>/js/vendor/modernizr-2.8.3.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?=BASE_URL?>/js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="<?=BASE_URL?>/js/lightbox.js"></script>
        <script src="<?=BASE_URL?>/js/jquery.tablesorter.min.js"></script>
        <script src="<?=BASE_URL?>/js/rQuery.js"></script>
		<script>
            var BASE_URL = "<?=BASE_URL?>";
        </script>
	</head>

	<style>
		body {
			margin: 0;
			font-family: sans-serif;
		}
		table {
			border-collapse: collapse;
			width: 100%;
			font-size: 12px;
		}
		table thead tr th {
			border: 1px solid #333;
			background: #4272D7;
			height: 50px;
			color: #fff;
			text-transform: uppercase;
		}
		table tbody tr td {
			border: 1px solid #333;
			text-align: center;
			height: 30px;
			position: relative;
		}
		.sims-danger {
			color : red;
		}

		.sims-success {
			color : green;
		}
		.sims-primary {
			color : #2196f3;
		}
		.grading-item {
			padding: 40px 0;
			max-width: 1200px;
			width: 100%;
			margin: auto;
		}
		.grading-period {
			text-align: center;
			font-size: 20px;
			font-weight: 700;
			margin-bottom: 30px; 
			position: relative;
		}
		.grading-period .goback {
			text-decoration: none;
			font-size: 12px;
			color: #333;
			float: right;
		}
		.grading-item table tbody tr td input {
			width: 100%;
			height: 100%;
			border: none;
			text-align: center;
			text-transform: uppercase;
		}
	</style>

	<body>
		<div class="grading-item">
			<div class="grading-period">
				Grading Form (<i><?= ($this->studentSection['section_name'] ?? "") ?></i>)
				<a href="<?=BASE_URL?>/account/grade-management" class="goback"><< Back</a>
			</div>

			<?php 
				$flags = [
					["flag_id" => 1, "description" => "1st Grading"],
					["flag_id" => 2, "description" => "2nd Grading"]
				];

				$subjectCount = $this->requiredSubjects ? count($this->requiredSubjects) : 0;
			?>
			<table>
				<thead>
					<tr>
						<th rowspan="2" style="width: 20%;">Student</th>
						<?php
							foreach($flags as $flag){
								echo "<th colspan='$subjectCount'> ".$flag['description']." </td> ";
							}
						?>

						<th colspan='<?= $subjectCount?>'>Final</th>
						
					</tr>
					<tr>
						<!-- Subjects -->
						<?php 
						foreach($flags as $flag){
							$flag_id = $flag['flag_id'];
							foreach($this->requiredSubjects as $subject){
								echo "<th data-flag='$flag_id'>".$subject[0]['subject_name']."</th>";
							}
						}

						// Final Grade Loop
						foreach($this->requiredSubjects as $subject){
							echo "<th data-flag='$flag_id'>".$subject[0]['subject_name']."</th>";
						}
						?>

						
					</tr>
					
				</thead>
				<tbody>

					<?php 
					if(empty($this->studentSection['data'])){
						// we add +1 on flags because of final grade
						$totalSpan = $subjectCount * (count($flags) + 1) + 1;
						echo "<tr><td colspan='$totalSpan'>No Students</td></tr>";
					}					
					foreach($this->studentSection['data'] as $student){
						
						if(!empty($student)){

						
					?>
					<tr>
						<td><?= $student[0]['first_name'] ?> <?= $student[0]['middle_name'] ?> <?= $student[0]['last_name'] ?></td>
						<!-- <td><input type="text" maxlength="3"></td> -->

						<!-- Grade on Subjects -->
						<?php 
						foreach($flags as $flag){
							$flag_id = $flag['flag_id'];
							foreach($this->requiredSubjects as $subject){
								$studentGrade = $this->studentGrades[$student[0]['student_id']] ?? [];
								$grade = $studentGrade[$flag_id][$subject[0]['subject_id']]->grade ?? "";
								$uid = $studentGrade[$flag_id][$subject[0]['subject_id']]->grade_id ?? 0;

								// if($studentGrade[$subject[0]['subject_id']]->flags != $flag_id){
								// 	$grade = "";
								// 	$uid = 0;
								// }

								echo "<td ><input value='$grade' class='grade-input-item' type='text' maxlength='3' data-section='".$this->targetSection."' data-flag='$flag_id' data-subject='".$subject[0]['subject_id']."' data-uid='$uid' data-student='".$student[0]['student_id']."' ></td>";
							}
						}
						?>

						<!-- Final Grade Loop -->
						<?php
							foreach($this->requiredSubjects as $subject){
								//loop through each flags and add them
								$finalGrade = 0;
								foreach($flags as $flag){
									$studentGrade = $this->studentGrades[$student[0]['student_id']] ?? [];
									$grade = $studentGrade[$flag['flag_id']][$subject[0]['subject_id']]->grade ?? 0;
									$finalGrade = (int)$finalGrade + (int)$grade;
									$uid = $studentGrade[$flag_id][$subject[0]['subject_id']]->grade_id ?? 0;
								}

								$finalGrade = $finalGrade / count($flag);
								
								$colorStatus = $finalGrade > $this->pass_threshold ? 'sims-success' : 'sims-danger';
								if($finalGrade == 0){
									$colorStatus = "";
									$finalGrade = "";
								}
								echo "<td class='$colorStatus'>$finalGrade</td>";
							}

						?>

						
					</tr>
					<?php 
				
						}//end of if count condition
					}// end of studentSection foreach
					?>
					
				</tbody>
			</table>

			<script>
				$(".grade-input-item").on("blur", function(){
					var value = $(this).val();
					var flag = $(this).data('flag');
					var subject = $(this).data('subject');
					var uid = $(this).attr('data-uid');
					var student = $(this).data('student');
					var section = $(this).data('section');

					var me = this;
					console.log(uid);
					
					var error = 0;
					if(isNaN(value)){
						alert("Please enter a valid number");
						error++;
					}
					if(value > 100){
						alert("Please do not exceed 100");
						$(this).val('');
						$(this).focus();
						error++;
					}

					
					var data = {
						section_id : section,
						student_id : student,
						subject_id : subject,
						grade : value,
						flag : flag,
						cid : uid
					};

					if(error == 0){
						//only save if there's a value
						if(value.length > 0){
							if(uid == 0){

								$.ajax({
									url: BASE_URL+"/php/encode_grade.php",
									type : 'post',
									data : data,
									beforeSend: function(){
										$(me).attr("disabled", true);
									},
									success : function(data){
										$(me).attr("disabled", false);
										var x = JSON.parse(data);
										//TODO loading gif
										if(x.code == "00"){
											$(me).attr('data-uid', x.cid);
										}
									}
								});
							}else{
								$.ajax({
									url: BASE_URL+"/php/amend_grade.php",
									type : 'post',
									data : data,
									success : function(data){
										var x = JSON.parse(data);
										//TODO loading gif
										
									}
								});
							}
						}
					}
				});

			</script>
		</div>
	</body>
</html>