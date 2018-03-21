
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
            <h3 class="dashboard-section-title">Schedule Builder</h3>
            <br>            


            <form id="sched-builder-form" data-arg='<?= ($this->schedInfo->schedule_id ?? 0)?>'>
                <select name='section_id'>
                    <?php

                    if($this->sectionList){

                        foreach($this->sectionList as $section){
                    ?>
                        <option value="<?= ($section['section_id'] ?? 0) ?>"><?= ($section['section_name'] ?? "") ?></option>
                    <?php        
                        }
                    }
                    ?>
                </select>

                <select name='teacher_id'>
                    <?php

                    if($this->teacherList){

                        foreach($this->teacherList as $teacher){
                    ?>
                        <option value="<?= ($teacher['teacher_id'] ?? 0) ?>"><?= ($teacher['first_name'] ?? "")." ".($teacher['middle_name'] ?? "")." ".($teacher['last_name'] ?? "") ?></option>
                    <?php        
                        }
                    }
                    ?>
                </select>


                <select name='subject_id'>
                    <?php

                    if($this->subjectList){
                        foreach($this->subjectList as $subject){
                    ?>
                        <option value="<?= ($subject['subject_id'] ?? 0) ?>"><?= ($subject['subject_name'] ?? "") ?></option>
                    <?php        
                        }
                    }
                    ?>
                </select>

                <select name="day">
                    <option value="">Select Day</option>
                    <option>Mon</option>
                    <option>Tue</option>
                    <option>Wed</option>
                    <option>Thu</option>
                    <option>Fri</option>
                    <option>Sat</option>
                    <option>Sun</option>
                </select>

                <select name="start_time">
                    <option value=""> Select Start Time </option>
                    <?= $this->timeSelection?>
                </select>

                <select name="end_time">
                    <option value=""> Select End Time </option>
                    <?= $this->timeSelection?>
                </select>
            
                <input type='submit' value='Add' />
            </form>                      
            

        </div>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>


