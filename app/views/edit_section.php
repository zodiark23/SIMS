
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
            <h3 class="dashboard-section-title">Edit Section</h3>                        
            <form id="edit-section-form" data-id="<?= ($this->data['section_id'] ?? 0)?>">
                <span class="input input--hoshi" style="width:45%">
                
                    <input value="<?= ($this->data['section_name'] ?? 0) ?>" class="input__field input__field--hoshi" type="text" id="section_name"  name="section_name">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="section_name">
                        <span class="input__label-content input__label-content--hoshi">Section Name</span>
                    </label>
                </span>

                <br>

                <select id="cur_select" name="curr">
                    <option value="" selected disabled hidden>Curriculum</option>
                    <?php

                    foreach($this->curriculumList as $c){
                        $selected = "";

                        if($c['curriculum_id'] == $this->data['curr_id']){
                            $selected = "selected";
                        }
                        echo "<option $selected value='".$c['curriculum_id']."'>".$c['description']."</option>";
                    }
                    ?>
                </select>
                

                <select id="sched_school_level" name="level">
                    <option value="" selected disabled hidden>Please Select Level</option>
                    
                    <?php
                    foreach($this->levels as $level){
                        $selected = "";

                        if($level['level_id'] == $this->data['level_id']){
                            $selected = "selected";
                        }

                        echo "<option $selected value='".$level['level_id']."'>".$level['level_name']."</option>";
                    }

                    ?>
                </select>


                <select id="teachers_select" name="teacher_id">
                    <option value="" selected disabled hidden>Choose Teacher</option>
                    <?php

                    foreach($this->teachers as $t){
                        $selected = "";
                        if($t['teacher_id'] == $this->data['section_adviser']){
                            $selected = "selected";
                        }
                        echo "<option $selected value='".$t['teacher_id']."'>".($t['first_name'] ?? "")." ". ($t['middle_name'] ?? ""). " " . ($t['last_name'] ?? "") ."</option>";
                    }
                    ?>
                </select>

                

                
                <br>
                <br>
                <input type="submit" class="outlined-button" id="submit-edit-section" value="Create" />
            </form>

        </div>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>


