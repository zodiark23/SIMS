<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->


<!-- TODO :
Fix the UI @morbid
    -->

<div class="main-container">
	<div class="content-container dashboard">
		<div class="dashboard-container">
			<div class="content-panel">
                <div class="content-head">
                    <h3 class="dashboard-section-title">Resend approval codes</h3>
                </div>
                <form id="approval-form" method="post">
                    
                    <div class='error_news_form'></div>
                    <table style="width:100%" class="content-panel-table">
                        <tr>
                            <th>Student</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>


	                    <?php
	                    if($this->students){
		                    foreach ($this->students as $student){
			                    $f_name = $student['first_name'];
			                    $s_name = $student['last_name'];
			                    $student_id = $student['student_id'];
								$email = $student['email'];
								echo "<tr>";
								echo "<td>".$f_name." ".$s_name."</td>";
								echo "<td>".$email."</td>";
								// Resend email to the student | Set the access_token to 1
								echo "<td><input type='button'  class='tbl-builder-btn resend-btn' value='Resend' data-target='".$student_id."' data-f_name='".$f_name."' data-email='".$email."'> | <input type='button'  class='tbl-delete-btn reject-btn' value='Reject' data-target='".$student_id."' data-f_name='".$f_name."' data-email='".$email."'></td>";
								echo "</tr>";
		                    }
	                    }
	                    ?>

            </div>
        </div>

        </table>



                    <br>
                    <br>


                </form>


    </div>



			<?php include_once("side-nav.php") ?>
		</div>
	</div>
</div>
