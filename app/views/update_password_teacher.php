
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
            <h3 class="dashboard-section-title">Update Password</h3>
            <form id="update-password-teacher-form">
                <br>

                <div class='error_password_teacher_form'></div>

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

                <br>
                <br>
                <br>
                
                <input type="submit" data-id="<?=$_SESSION['user']['teacher_id']?>" class="outlined-button t_pass-btn" value="Update" />
                <a href="<?= BASE_URL ?>/account/profile"><input type="button" class="t_cancel_btn" value="Cancel" ></a>
            </form>

        </div>
        <script>
        
        
        </script>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>


