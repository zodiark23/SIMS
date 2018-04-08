
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
            <h3 class="dashboard-section-title">Update Profile</h3>
            <form id="update-profile-student-form" method="POST" enctype="multipart/form-data">
                <br>
                <h4>Account Info</h4>
                <div class='error_profile_student_form'></div>



                <br>
                <br>

                <span class="input input--hoshi" style="width:45%">
                    <input value="<?= $_SESSION['user']['email'] ?>" class="input__field input__field--hoshi" type="text" id="student_email"  name="student_email">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="student_email">
                        <span class="input__label-content input__label-content--hoshi">Email</span>
                    </label>
                </span>

                <br>

                <h4>Personal Data</h4>

                <span class="input input--hoshi" style="width:45%">
                    <input value="<?= $_SESSION['user']['first_name'] ?>" class="input__field input__field--hoshi" type="text" id="student_first_name"  name="student_first_name">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="student_first_name">
                        <span class="input__label-content input__label-content--hoshi">First Name</span>
                    </label>
                </span>

                <span class="input input--hoshi" style="width:45%">
                    <input value="<?= $_SESSION['user']['middle_name'] ?>" class="input__field input__field--hoshi" type="text" id="student_middle_name"  name="student_middle_name">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="student_middle_name">
                        <span class="input__label-content input__label-content--hoshi">Middle Name</span>
                    </label>
                </span>

                <span class="input input--hoshi" style="width:45%">
                    <input value="<?= $_SESSION['user']['last_name'] ?>" class="input__field input__field--hoshi" type="text" id="student_last_name"  name="student_last_name">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="student_last_name">
                        <span class="input__label-content input__label-content--hoshi">Last Name</span>
                    </label>
                </span>

                <br>

                <span class="input input--hoshi" style="width:45%">
                    <input value="<?= $_SESSION['user']['tel_number'] ?>" class="input__field input__field--hoshi" type="text" id="student_tel_num"  name="student_tel_num">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="student_tel_num">
                        <span class="input__label-content input__label-content--hoshi">Telephone Number</span>
                    </label>
                </span>

                <span class="input input--hoshi" style="width:45%">
                    <input value="<?= $_SESSION['user']['cell_number'] ?>" class="input__field input__field--hoshi" type="text" id="student_cell_num"  name="student_cell_num">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="student_cell_num">
                        <span class="input__label-content input__label-content--hoshi">Cellphone Number</span>
                    </label>
                </span>

                <br>

                <span class="input input--hoshi" style="width:45%">
                    <input value="<?= $_SESSION['user']['house_street_number'] ?>" class="input__field input__field--hoshi" type="text" id="student_house_num"  name="student_house_num">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="student_house_num">
                        <span class="input__label-content input__label-content--hoshi">House Street Number</span>
                    </label>
                </span>

                <span class="input input--hoshi" style="width:45%">
                    <input value="<?= $_SESSION['user']['subdivision_barangay'] ?>" class="input__field input__field--hoshi" type="text" id="student_barangay"  name="student_barangay">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="student_barangay">
                        <span class="input__label-content input__label-content--hoshi">SubDivision / Barangay</span>
                    </label>
                </span>

                <br>

                <span class="input input--hoshi" style="width:45%">
                    <input value="<?= $_SESSION['user']['town_city'] ?>" class="input__field input__field--hoshi" type="text" id="student_town"  name="student_town">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="student_town">
                        <span class="input__label-content input__label-content--hoshi">Town / City</span>
                    </label>
                </span>

                <span class="input input--hoshi" style="width:45%">
                    <input value="<?= $_SESSION['user']['province'] ?>" class="input__field input__field--hoshi" type="text" id="student_province"  name="student_province">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="student_province">
                        <span class="input__label-content input__label-content--hoshi">Province</span>
                    </label>
                </span>


                <br>
                <br>
                <br>
                
                <input type="submit" data-id="<?=$_SESSION['user']['student_id']?>" class="outlined-button s_update-btn" value="Update" />
                <a href="<?= BASE_URL ?>/account"><input type="button" class="s_cancel_btn" value="Cancel" ></a>
            </form>

        </div>
        <script>
        
        
        </script>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>


