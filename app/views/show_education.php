
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
                </tr>

                <?php
                if(count($this->info) > 0){
                    foreach($this->info as $level){
                        echo "
                        <tr>
                            <td>".$level['level_name']."</td>
                            <td><span class='sims-primary'>75 / 100</span></td>
                            <td><span class='sims-danger'>Not Configured</span></td>
                            <td>".(($level['published'] == 1) ? "<span class='sims-success'>Yes</span>" : "<span class='sims-danger'>No</span>")."</td>
                        

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

