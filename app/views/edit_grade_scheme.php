
<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<div class="main-container">
<div class="content-container dashboard">
    <div class="dashboard-container">
        <div class="content-panel">
            <h3 class="dashboard-section-title">Edit Grade Schemes</h3>

            <form id="edit-grade-scheme-form" data-cid="<?= ($this->info->grade_scheme_id ?? 0) ?>" >
                <span class="input input--hoshi" style="width:45%">
                    <input class="input__field input__field--hoshi" type="text" id="gs_description"  value="<?= ($this->info->description ?? "") ?>" name="gs_description">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="gs_description">
                        <span class="input__label-content input__label-content--hoshi">Description</span>
                    </label>
                </span>

                <span class="input input--hoshi" style="width:45%">
                    <input class="input__field input__field--hoshi" type="text" id="pass_threshold"  value="<?= ($this->info->pass_threshold ?? "") ?>" name="pass_threshold">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="pass_threshold">
                        <span class="input__label-content input__label-content--hoshi">Passing Threshold</span>
                    </label>
                </span>

                <div class='informative-block'>
                <img src="<?=BASE_URL?>/img/info_icon.png"/>
                <span>
                    Passing Threshold is the percentage for passing over 100. The system will use this scheme to detect if the student passed/failed. E.g 75 will be evaluated as 75%
                </span>
                </div>

                <br>
                <input type="submit" class="outlined-button" value="Save" />

    

            </form>                     
                

        </div>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>

