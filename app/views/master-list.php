
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
            <h3 class="dashboard-section-title">Master List</h3>                        
            <form id="master-list-form" type='post' action='<?=BASE_URL?>/admin/master-pdf'>

                <br>

                <select id="cur_select" name="curr">
                    <option value="" selected disabled hidden>All Educational</option>
                    <?php

                    foreach($this->curriculumList as $c){
                        echo "<option value='".$c['curriculum_id']."'>".$c['description']."</option>";
                    }
                    ?>
                </select>
                

                <select id="sched_school_level" name="level">
                    <option value="" selected disabled hidden>Please Select Level</option>
                    
                </select>

                <select id="status_filter" name="status">
                    <option value="" selected disabled hidden>All</option>
                    <option value="passed">Passed</option>
                    <option value="progress">In Progress</option>
                    <option value="failed">Failed</option>
                    
                </select>


                
                <br>
                <br>
                <input type="submit" class="outlined-button" value="Generate" />
            </form>

        </div>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>


