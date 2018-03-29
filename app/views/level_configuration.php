
<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="main-container">
<div class="content-container dashboard">
    <div class="dashboard-container">
        <div class="content-panel">
            <h3 class="dashboard-section-title"><?= ($this->level_info['level_name'] ?? "Err#") ?></h3>                        
            <table width="100%" class='content-panel-table'>
                <tr>
                    <th colspan=2 style='text-align:left;padding-left:15px;'>Grade Settings</th>
                </tr>
                <tr>
                    <td >
                        Grade Scheme
                    </td>
                    <td style='height:60px;'>
                        <select id="modify-gradeScheme" data-cid="<?= ($this->level_info['level_id'] ?? 0 )?>">
                            <option value="" selected disabled hidden>Not Set</option>
                            <?php
                                if($this->gradeSchemes){

                                    foreach($this->gradeSchemes as $gs){
                                        $selected = ($this->selectedGradeScheme == $gs->grade_scheme_id ) ? "selected" : "";
                                        echo "
                                        <option $selected value='".$gs->grade_scheme_id."'>".$gs->description."</option>
                                        ";
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
            </table>
            <table width="100%" class='content-panel-table'>
                <tr>
                    <th colspan=2 style='text-align:left;padding-left:15px;'>Subjects</th>
                </tr>
                <tr>
                    <td colspan="2">No data</td>
                </tr>
            </table>

            <h3 class="dashboard-section-title" style="background:transparent;color:#303030">Add Required Subjects</h3>  
            <form id="add-level-requirements">
                <select>
                    <option value="">Choose Subject</option>
                    <?php
                        foreach($this->subjects as $s){
                            echo "
                                <option value='".$s['subject_id']."'>".$s['subject_name']."</option>
                            ";
                        }
                    ?>
                </select>

                <input type="submit" class="outlined-button" value="Add" />
            </form>
        </div>
        <script>
            $(document).ready(function(){
                $("#modify-gradeScheme").on("change", function(){
                    var cid = $(this).data('cid');

                    var value = $(this).val();

                    $.ajax({
                        url : BASE_URL+"/php/attachGradeScheme.php",
                        data : "scheme_id="+value+"&level_id="+cid,
                        type : "post",
                        beforeSend: function(data){
                            $('html, body').css("cursor", "hand");
                        },
                        success : function(data){
                            $('html, body').css("cursor", "auto");
                            var x = JSON.parse(data);

                            if(x.code == "00"){
                                alert(x.message);

                            }else{
                                alert(x.message);
                            }
                        }
                    })

                    
                });
            });
        </script>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>

