
<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->


<!-- TODO :
refactor hoshi inline widths here @morbid
add styling on bottom note
    -->

<div class="main-container">
<div class="content-container dashboard">
    <div class="dashboard-container">
        <div class="content-panel">
            <h3 class="dashboard-section-title">My Profile</h3>
            <form id="profile-student-form">
                <br>
                <h4>Account Info</h4>

                <br>
                <br>

                <div class='error_profile_student_form'></div>

                <label>Email: </label>
                <label>
                    <span ><?php echo $_SESSION['user']['email']; ?></span>
                </label>

                <br>
                <br>

                <label>Name: </label>
                <label>
                    <span ><?php echo ucfirst($_SESSION['user']['first_name'])." ".ucfirst($_SESSION['user']['last_name']); ?></span>
                </label>

                <br>
                <br>


                <label>Gender: </label>
                <label>
                    <span ><?php if($_SESSION['user']['gender'] == 1){
                        echo "Male";
	                    } else {
                        echo "Felmale";
	                    }?></span>
                </label>

                <br>
                <br>

                <label>Date of birth: </label>
                <label>
                    <span ><?php echo $_SESSION['user']['date_of_birth']; ?></span>
                </label>

                <br>
                <br>

                <label>Nationality: </label>
                <label>
                    <span ><?php echo $_SESSION['user']['nationality']; ?></span>
                </label>

                <br>
                <br>

                <label>Civil Status: </label>
                <label>
                    <span ><?php echo $_SESSION['user']['civil_status']; ?></span>
                </label>

                <br>
                <br>

                <label>Address: </label>
                <label>
                    <span ><?php echo $_SESSION['user']['address']; ?></span>
                </label>


                <br>
                <br>
                <br>

                <a href="<?= BASE_URL ?>/account/update"><input type="button" class="outlined-button teacher_edit-btn" value="Edit Profile" /></a>
            </form>

        </div>
        <script>
        
        
        </script>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>


