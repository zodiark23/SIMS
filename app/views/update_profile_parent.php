
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
            <form id="update-profile-parent-form">
                <br>
                <h4>Account Info</h4>
                <div class='error_profile_parent_form'></div>
                <span class="input input--hoshi" style="width:45%">
                    <input value="<?= $_SESSION['user']['email'] ?>" class="input__field input__field--hoshi" type="text" id="parent_email"  name="parent_email">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="parent_email">
                        <span class="input__label-content input__label-content--hoshi">Email</span>
                    </label>
                </span>

                <br>

                <h4>Personal Data</h4>

                <span class="input input--hoshi" style="width:45%">
                    <input value="<?= $_SESSION['user']['first_name'] ?>" class="input__field input__field--hoshi" type="text" id="parent_first_name"  name="parent_first_name">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="parent_first_name">
                        <span class="input__label-content input__label-content--hoshi">First Name</span>
                    </label>
                </span>

                <span class="input input--hoshi" style="width:45%">
                    <input value="<?= $_SESSION['user']['middle_name'] ?>" class="input__field input__field--hoshi" type="text" id="parent_middle_name"  name="parent_middle_name">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="parent_middle_name">
                        <span class="input__label-content input__label-content--hoshi">Middle Name</span>
                    </label>
                </span>

                <span class="input input--hoshi" style="width:45%">
                    <input value="<?= $_SESSION['user']['last_name'] ?>" class="input__field input__field--hoshi" type="text" id="parent_last_name"  name="parent_last_name">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="parent_last_name">
                        <span class="input__label-content input__label-content--hoshi">Last Name</span>
                    </label>
                </span>

                <br>

                <span class="input input--hoshi" style="width:45%">
                    <input value="<?= $_SESSION['user']['contact_number'] ?>" class="input__field input__field--hoshi" type="text" id="parent_contact"  name="parent_contact">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="parent_contact">
                        <span class="input__label-content input__label-content--hoshi">Contact Number</span>
                    </label>
                </span>


                <br>
                <br>
                <br>
                
                <input type="submit" data-id="<?=$_SESSION['user']['parents_id']?>" class="outlined-button p_update-btn" value="Update" />
                <a href="<?= BASE_URL ?>/account"><input type="button" class="outlined-button p_cancel_btn" value="Cancel" ></a>
            </form>

        </div>
        <script>
        
        
        </script>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>


