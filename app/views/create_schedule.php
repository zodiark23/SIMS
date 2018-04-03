
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
            <h3 class="dashboard-section-title">Create Schedule</h3>                        
            <form id="create-schedule-form">
                <span class="input input--hoshi" style="width:45%">
                    <input value="" class="input__field input__field--hoshi" type="text" id="schedule_name"  name="schedule_name">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="schedule_name">
                        <span class="input__label-content input__label-content--hoshi">Schedule Name</span>
                    </label>
                </span>
                <br>

                <span class="input input--hoshi" style="width:45%">
                    <input value="" class="input__field input__field--hoshi" type="text" id="sched_year_start"  name="sched_year_start">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="sched_year_start">
                        <span class="input__label-content input__label-content--hoshi">Start Year</span>
                    </label>
                </span>
                <span class="input input--hoshi" style="width:45%">
                    <input value="" class="input__field input__field--hoshi" type="text" id="sched_year_end"  name="sched_year_end">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="sched_year_end">
                        <span class="input__label-content input__label-content--hoshi">End Year</span>
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
                

                <br>
                <br>
                
                <input type="submit" class="outlined-button" data-curr-id="<?= ($this->data["adminModel"]["curriculum_id"] ?? "" ) ?>" id="submit-create-subject" value="Create" />
            </form>

        </div>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>


