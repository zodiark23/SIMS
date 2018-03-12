
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
            <h3 class="dashboard-section-title">Create Roles</h3>
            <form id="create-role-form">
                <br>
                <h4>Roles Info</h4>
                <div class='error_role_form'></div>
                <span class="input input--hoshi" style="width:45%">
                    <input value="" class="input__field input__field--hoshi" type="text" id="r_name"  name="r_name">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="r_name">
                        <span class="input__label-content input__label-content--hoshi">Role Name</span>
                    </label>
                </span>
                <!-- TODO: For confirmation with reyan-->
               <!-- <br>

                <span class="input input--hoshi" style="width:45%">
                    <input value="" class="input__field input__field--hoshi" type="text" id="r_default"  name="r_default">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="r_default">
                        <span class="input__label-content input__label-content--hoshi">Default number</span>
                    </label>
                </span>-->

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


