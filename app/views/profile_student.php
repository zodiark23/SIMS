
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
            <form id="profile-student-form" >
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

                <label>Date of birth: </label>
                <label>
                    <span ><?php echo $_SESSION['user']['birth_date']; ?></span>
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

                <label>House number & Street: </label>
                <label>
                    <span ><?php echo $_SESSION['user']['house_street_number']; ?></span>
                </label>

                <br>
                <br>

                <label>SubDivision / Barangay: </label>
                <label>
                    <span ><?php echo $_SESSION['user']['subdivision_barangay']; ?></span>
                </label>

                <br>
                <br>

                <label>Town / City: </label>
                <label>
                    <span ><?php echo $_SESSION['user']['town_city']; ?></span>
                </label>

                <br>
                <br>

                <label>Province: </label>
                <label>
                    <span ><?php echo $_SESSION['user']['province']; ?></span>
                </label>

                <br>
                <br>

                <label>Telephone number: </label>
                <label>
                    <span ><?php echo $_SESSION['user']['tel_number']; ?></span>
                </label>

                <br>
                <br>

                <label>Cellphone number: </label>
                <label>
                    <span ><?php echo $_SESSION['user']['cell_number']; ?></span>
                </label>

                <br>
                <br>
                <br>

                <a href="<?= BASE_URL ?>/account/update"><input type="button" class="outlined-button student_edit-btn" value="Edit Profile" /></a>
                <a href="<?= BASE_URL ?>/account/image"><input type="button" class="outlined-button student_edit-btn" value="Update Picture" /></a>
            </form>

        </div>
        <script>
        
        
        </script>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>


