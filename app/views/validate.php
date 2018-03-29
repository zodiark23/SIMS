
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
                <h3 class="dashboard-section-title">Update your password</h3>
                <form method="post" id="update-student-password-form" >
                    <br>


                    <br>

                    <span class="input input--hoshi" style="width:45%">
                    <input  class="input__field input__field--hoshi" type="password" id="s_pass"  name="s_pass">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="s_pass">
                        <span class="input__label-content input__label-content--hoshi">Password</span>
                    </label>
                </span>

                    <span class="input input--hoshi" style="width:45%">
                    <input class="input__field input__field--hoshi" type="password" id="s_pass_confirm"  name="s_pass_confirm">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="s_pass_confirm">
                        <span class="input__label-content input__label-content--hoshi">Confirm Password</span>
                    </label>
                </span>

                    <br>

                    <input type="submit" data-sid="<?=$this->student_id?>" data-token="<?=$this->token?>" id="update_pass" class="outlined-button" value="Update" >
                </form>

            </div>



        </div>
    </div>
</div>


