
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
            <h3 class="dashboard-section-title">Create Subjects</h3>                        
            <form id="create-subject-form">
                <span class="input input--hoshi" style="width:45%">
                    <input value="" class="input__field input__field--hoshi" type="text" id="subject_name"  name="subject_name">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="subject_name">
                        <span class="input__label-content input__label-content--hoshi">Subject Name</span>
                    </label>
                </span>

                <select name="curr">
                    <?php

                    foreach($this->curriculumList as $c){
                        echo "<option value='".$c['curriculum_id']."'>".$c['description']."</option>";
                    }
                    ?>
                </select>
                
                <input type="button" class="outlined-button" data-curr-id="<?= ($this->data["adminModel"]["curriculum_id"] ?? "" ) ?>" id="submit-create-subject" value="Create" />
            </form>

        </div>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>


