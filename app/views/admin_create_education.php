
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->


        <!-- TODO :
        refactor hoshi inline widths here @morbid
        add styling on bottom note
         -->

        <?php

            $published = false;
        ?>
        <div class="main-container">
            <div class="content-container dashboard">
                <div class="dashboard-container">
                    <div class="content-panel">
                        <h3 class="dashboard-section-title">Educational Setup</h3>                        

                        <form id="edu_setup">
                            <span class="input input--hoshi" style="width:45%">
                                <input value="<?=($this->data["adminModel"]["description"] ?? "")?>" class="input__field input__field--hoshi" type="text" id="description"  name="description">
                                <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="description">
                                    <span class="input__label-content input__label-content--hoshi">Description</span>
                                </label>
                            </span>
                            
                            <span class='input input--hoshi' style="width:45%">
                                <input value="<?=($this->data["adminModel"]["year_duration"] ?? "")?>" class='input__field input__field--hoshi' type='text' id='duration' id='duration'>
                                <label class='input__label input__label--hoshi input__label--hoshi-color-1' for='input-4'>
                                    <span class='input__label-content input__label-content--hoshi'>Duration</span>
                                </label>
                            </span>


                        </form>


                        <h3 class="dashboard-section-title">School Levels</h3>

                        <div class="school-level-section">
                            <form id="school-level-form">
                                <table style="width:100%" class='school-level-list'>
                                    <?php

                                    if($this->action == "new"){
                                    
                                    ?>
                                    <tr>
                                        <td>
                                            <span class='input input--hoshi'>
                                                <input class='input__field input__field--hoshi' type='text' class='level_item' data-id="" name='level_name[]'>
                                                <label class='input__label input__label--hoshi input__label--hoshi-color-1' for='level_item'>
                                                    <span class='input__label-content input__label-content--hoshi'>Level Name</span>
                                                </label>
                                            </span>

                                            <button type="button" id="add_school_level" class='util-btn'>
                                                <img src="<?=BASE_URL?>/img/add_icon.png" />
                                            </button>
                                        </td>
                                            
                                    </tr>
                                    <?php }
                                    elseif($this->action == "edit" && !empty($this->data["schoolLevels"])){
                                        foreach($this->data["schoolLevels"] as $key => $levels){
                                            if($levels["published"] == "1"){
                                                $published = true; // this will disable editing
                                            }

                                            ?>
                                            <tr>
                                                <td>
                                                    <span class='input input--hoshi'>
                                                        <input <?= ($published == true ? "disabled" : "")?> class='input__field input__field--hoshi' type='text' value="<?= $levels['level_name']?>" class='level_item' data-id="" name='level_name[]'>
                                                        <label class='input__label input__label--hoshi input__label--hoshi-color-1' for='level_item'>
                                                            <span class='input__label-content input__label-content--hoshi'>Level Name</span>
                                                        </label>
                                                    </span>
                                                    <?php 
                                                    if($published == false){

                                                        if($key == 0){ ?>

                                                        <button type="button" id="add_school_level" class='util-btn'>
                                                            <img src="<?=BASE_URL?>/img/add_icon.png" />
                                                        </button>
                                                        <?php } 
                                                        else { ?>
                                                            <button type='button' class='del-school-level util-btn'>
                                                            <img src="<?=BASE_URL?>/img/trash_icon.png" />
                                                            </button>
                                                        <?php
                                                        }

                                                    }
                                                    ?>
                                                </td>
                                                    
                                            </tr>
                                            <?php
                                            
                                        }
                                        
                                    }
                                    
                                    ?>
                                    
                                </table>
                            </form>
                        </div>
                        <?php if(!$published){ ?>
                            <div class='btn-container'>
                            <input type="button" class="outlined-button" data-curr-id="<?= ($this->data["adminModel"]["curriculum_id"] ?? "" ) ?>" id="submit-educational" value="<?= ($this->action == "new" ? "Create" : "Save") ?>" />
                            <?php if($this->action == "edit"){ ?>
                                <input type="button" class="outlined-button" data-curr-id="<?= ($this->data["adminModel"]["curriculum_id"] ?? "" ) ?>" id="publish-educational" value="Publish" />
                            <?php 
                            }
                            echo "</div>";
                        
                        } //end of $published block
                        else{
                            echo "<div class='notice-field'> <img src='".BASE_URL."/img/lock_icon.png' />Further editing is disabled </div>";
                        }
                        ?>

                    </div>

                    <?php include_once("side-nav.php") ?>
                </div>
            </div>
        </div>

        
