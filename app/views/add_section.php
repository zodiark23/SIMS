
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
            <h3 class="dashboard-section-title">Add Section</h3>                        
            <form id="create-section-form">
                <span class="input input--hoshi" style="width:45%">
                    <input value="" class="input__field input__field--hoshi" type="text" id="section_name"  name="section_name">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="section_name">
                        <span class="input__label-content input__label-content--hoshi">Section Name</span>
                    </label>
                </span>

                <br>

                <select id="cur_select" name="curr">
                    <option value="" selected disabled hidden>Curriculum</option>
                    <?php

                    foreach($this->curriculumList as $c){
                        echo "<option value='".$c['curriculum_id']."'>".$c['description']."</option>";
                    }
                    ?>
                </select>
                

                <select id="sched_school_level" name="level">
                    <option value="" selected disabled hidden>Please Select Level</option>
                    
                </select>


                <select id="teachers_select" name="teacher_id">
                    <option value="" selected disabled hidden>Choose Teacher</option>
                    <?php

                    foreach($this->teachers as $t){
                        echo "<option value='".$t['teacher_id']."'>".($t['first_name'] ?? "")." ". ($t['middle_name'] ?? ""). " " . ($t['last_name'] ?? "") ."</option>";
                    }
                    ?>
                </select>



                
                <br>
                <br>
                <input type="submit" class="outlined-button" id="submit-create-section" value="Create" />
            </form>

        </div>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>


