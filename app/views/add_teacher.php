
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
            <h3 class="dashboard-section-title">Create Teacher</h3>                        
            <form id="create-teacher-form">
                <br>
                <h4>Account Info</h4>
                <div class='error_teacher_form'></div>
                <span class="input input--hoshi" style="width:45%">
                    <input value="" class="input__field input__field--hoshi" type="text" id="t_email"  name="t_email">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="t_email">
                        <span class="input__label-content input__label-content--hoshi">Email</span>
                    </label>
                </span>

                <br>

                <span class="input input--hoshi" style="width:45%">
                    <input value="" class="input__field input__field--hoshi" type="password" id="t_pass"  name="t_pass">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="t_pass">
                        <span class="input__label-content input__label-content--hoshi">Password</span>
                    </label>
                </span>

                <span class="input input--hoshi" style="width:45%">
                    <input value="" class="input__field input__field--hoshi" type="password" id="t_pass_confirm"  name="t_pass_confirm">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="t_pass_confirm">
                        <span class="input__label-content input__label-content--hoshi">Confirm Password</span>
                    </label>
                </span>

                <h4>Personal Data</h4>

                <span class="input input--hoshi" style="width:45%">
                    <input value="" class="input__field input__field--hoshi" type="text" id="t_first_name"  name="t_first_name">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="t_first_name">
                        <span class="input__label-content input__label-content--hoshi">First Name</span>
                    </label>
                </span>

                <span class="input input--hoshi" style="width:45%">
                    <input value="" class="input__field input__field--hoshi" type="text" id="t_middle_name"  name="t_middle_name">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="t_middle_name">
                        <span class="input__label-content input__label-content--hoshi">Middle Name</span>
                    </label>
                </span>

                <span class="input input--hoshi" style="width:45%">
                    <input value="" class="input__field input__field--hoshi" type="text" id="t_last_name"  name="t_last_name">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="t_last_name">
                        <span class="input__label-content input__label-content--hoshi">Last Name</span>
                    </label>
                </span>

                <br>

                <span class="input input--hoshi" style="width:45%">
                    <input value="" class="input__field input__field--hoshi" type="text" id="t_contact"  name="t_contact">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="t_contact">
                        <span class="input__label-content input__label-content--hoshi">Contact Number</span>
                    </label>
                </span>

                <span class="input input--hoshi" style="width:45%">
                    <input value="" class="input__field input__field--hoshi" type="text" id="t_nationality"  name="t_nationality">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="t_nationality">
                        <span class="input__label-content input__label-content--hoshi">Nationality</span>
                    </label>
                </span>


                <span class="input input--hoshi" style="width:45%">
                    <input value="" class="input__field input__field--hoshi" type="text" id="t_civil_status"  name="t_civil_status">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="t_civil_status">
                        <span class="input__label-content input__label-content--hoshi">Civil Status</span>
                    </label>
                </span>

                <br>

                <span class="input input--hoshi" style="width:94%;max-width:initial;">
                    <input value="" class="input__field input__field--hoshi" type="text" id="t_address"  name="t_address">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="t_address">
                        <span class="input__label-content input__label-content--hoshi">Address</span>
                    </label>
                </span>

                <br>
                <h4>Date of Birth</h4>

                <span class="input input--hoshi" style="width:20%;">
                    <input value="" class="input__field input__field--hoshi" type="text" id="t_birth_month"  name="t_birth_month">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="t_birth_month">
                        <span class="input__label-content input__label-content--hoshi">MM</span>
                    </label>
                </span>


                <span class="input input--hoshi" style="width:20%;">
                    <input value="" class="input__field input__field--hoshi" type="text" id="t_birth_day"  name="t_birth_day">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="t_birth_day">
                        <span class="input__label-content input__label-content--hoshi">DD</span>
                    </label>
                </span>


                <span class="input input--hoshi" style="width:20%;">
                    <input value="" class="input__field input__field--hoshi" type="text" id="t_birth_year"  name="t_birth_year">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="t_birth_year">
                        <span class="input__label-content input__label-content--hoshi">YYYY</span>
                    </label>
                </span>


                <br>



                <span class="input input--hoshi" style="width:45%">
                <br>
                <br>
                    <input type="radio" id="t_gender_01" name="t_gender" value="1"> <label for="t_gender_01">Male</label>
                    <input type="radio" id="t_gender_02" name="t_gender" value="2"> <label for="t_gender_02">Female</label>
                </span>
                <br>
                <br>
                
                <input type="submit" class="outlined-button" value="Add" />
            </form>

        </div>
        <script>
        
        
        </script>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>


