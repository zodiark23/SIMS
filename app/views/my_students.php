
<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="main-container">
<div class="content-container dashboard">
    <div class="dashboard-container">
        <div class="content-panel">
            <h3 class="dashboard-section-title">My Students</h3>                        
            
            <?php
            
            if($this->sectionStudents){
                foreach($this->sectionStudents as $sectionName => $data){

            ?>
            <table width="100%" class='content-panel-table'>
            <tr>
                <th colspan=3><?= $data['section_name'] ?></th>
            </tr>

            <?php
            $students = $data['data'];
                foreach($students as $student){
                    echo "
                        <tr>
                        <td>".($student[0]['first_name'] ?? "Err#")." ".($student[0]['middle_name'] ?? "Err#")." ".($student[0]['last_name'] ?? "Err#")."</td>
                        <td></td>
                        <td></td>
                        </tr>
                    ";
                }
            if(count($students) <= 0){
                echo "<tr><td colspan=3>No Students Found</td></tr>";
            }
            ?>
            </table>
            <?php
                }

            }
            
            ?>
        </div>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>


