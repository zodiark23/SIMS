
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
            <h3 class="dashboard-section-title">Manage Grades</h3>                        
            
            <table width="100%" class='content-panel-table'>
            <tr>
                <th>#</th>
                <th>Section</th>
                <th>Action</th>
            </tr>
            <?php
            
            if($this->sectionStudents){
                $count = 1; //to hide the id and provide count on table
                foreach($this->sectionStudents as $section => $data){
                    echo "<tr>
                        <td>$count</td>
                        <td>".$data['section_name']."</td>
                        <td><a class='tbl-edit-btn' href='".BASE_URL."/grades/encode/$section'>Encode Grades</a></td>
                    
                        </tr>
                    ";
                    $count++;
                }
            }else{
                echo "<tr><td colspan=3>No Data Found</td></tr>";
            }
            ?>

            </table>

        </div>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>


