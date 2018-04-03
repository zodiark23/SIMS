
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
            <form id="update-profile-teacher-form">
                <br>
                <h4>Account Info</h4>
                <div class='error_profile_teacher_form'></div>
                <span class="input input--hoshi" style="width:45%">
                    <input value="<?= $_SESSION['user']['email'] ?>" class="input__field input__field--hoshi" type="text" id="teacher_email"  name="teacher_email">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="teacher_email">
                        <span class="input__label-content input__label-content--hoshi">Email</span>
                    </label>
                </span>

                <br>

                <span class="input input--hoshi" style="width:45%">
                    <input value="" class="input__field input__field--hoshi" type="password" id="teacher_pass"  name="teacher_pass">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="teacher_pass">
                        <span class="input__label-content input__label-content--hoshi">Password</span>
                    </label>
                </span>

                <span class="input input--hoshi" style="width:45%">
                    <input value="" class="input__field input__field--hoshi" type="password" id="teacher_pass_confirm"  name="teacher_pass_confirm">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="teacher_pass_confirm">
                        <span class="input__label-content input__label-content--hoshi">Confirm Password</span>
                    </label>
                </span>

                <h4>Personal Data</h4>

                <span class="input input--hoshi" style="width:45%">
                    <input value="<?= $_SESSION['user']['first_name'] ?>" class="input__field input__field--hoshi" type="text" id="teacher_first_name"  name="teacher_first_name">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="teacher_first_name">
                        <span class="input__label-content input__label-content--hoshi">First Name</span>
                    </label>
                </span>

                <span class="input input--hoshi" style="width:45%">
                    <input value="<?= $_SESSION['user']['middle_name'] ?>" class="input__field input__field--hoshi" type="text" id="teacher_middle_name"  name="teacher_middle_name">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="teacher_middle_name">
                        <span class="input__label-content input__label-content--hoshi">Middle Name</span>
                    </label>
                </span>

                <span class="input input--hoshi" style="width:45%">
                    <input value="<?= $_SESSION['user']['last_name'] ?>" class="input__field input__field--hoshi" type="text" id="teacher_last_name"  name="teacher_last_name">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="teacher_last_name">
                        <span class="input__label-content input__label-content--hoshi">Last Name</span>
                    </label>
                </span>

                <br>

                <span class="input input--hoshi" style="width:45%">
                    <input value="<?= $_SESSION['user']['civil_status'] ?>" class="input__field input__field--hoshi" type="text" id="teacher_civil_status"  name="teacher_civil_status">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="teacher_civil_status">
                        <span class="input__label-content input__label-content--hoshi">Civil Status</span>
                    </label>
                </span>

                <br>

                <span class="input input--hoshi" style="width:94%;max-width:initial;">
                    <input value="<?= $_SESSION['user']['address'] ?>" class="input__field input__field--hoshi" type="text" id="teacher_address"  name="teacher_address">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="teacher_address>
                        <span class="input__label-content input__label-content--hoshi">Address</span>
                    </label>
                </span>



                <br>
                <br>
                <br>
                
                <input type="submit" data-id="<?=$_SESSION['user']['teacher_id']?>" class="outlined-button t_update-btn" value="Update" />
                <a href="<?= BASE_URL ?>/account"><input type="button" class="t_cancel_btn" value="Cancel" ></a>
            </form>

        </div>
        <script>
        
        
        </script>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>


