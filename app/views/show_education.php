
<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="main-container">
<div class="content-container dashboard">
    <div class="dashboard-container">
        <div class="content-panel">
            <h3 class="dashboard-section-title"><?= $this->cur_name ?></h3>                        
            <table width="100%" class='content-panel-table'>
                <tr>
                    <th>Level Name</th>
                    <th>Grade Scheme</th>
                    <th>Requirements</th>
                    <th>Published</th>
                    <th>Action</th>
                </tr>

                <?php
                if(count($this->info) > 0){
                    foreach($this->info as $level){
                        $gradeScheme = $this->gradeSchemes[$level['level_id']][0]->pass_threshold ?? 0;
                        $threshold = $gradeScheme > 0 ? "<span class='sims-primary'>".$gradeScheme . "/ 100</span>" : "<span class='sims-danger'>Not configured</span>";
                        $requirements = $this->requirements[$level['level_id']] == false ? "<span class='sims-danger'>Not Configured</span>" : "<span class='sims-success'>Configured</span>";
                        echo "
                        <tr>
                            <td>".$level['level_name']."</td>
                            <td>$threshold</td>
                            <td>".$requirements."</td>
                            <td>".(($level['published'] == 1) ? "<span class='sims-success'>Yes</span>" : "<span class='sims-danger'>No</span>")."</td>
                            <td><a class='sims-primary' href='".BASE_URL."/admin/level-configuration/".$level['level_id']."'>Configure</a></td>
                        

                        </tr>
                        ";
                    }
                }else{
                    echo '<tr><td colspan="2">No data</td></tr>';
                }


                ?>
            </table>

        </div>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>

