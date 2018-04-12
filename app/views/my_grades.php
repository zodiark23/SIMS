
<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="main-container">
<div class="content-container dashboard">
    <div class="dashboard-container">
        <div class="content-panel">
            <h3 class="dashboard-section-title">My Grades</h3>                        
            
            <?php 
            
            if(!empty($this->grades)){

                foreach($this->grades as $grade){
                    echo "<table style='width:100%' class='content-panel-table'>";
                    echo "<tr><th colspan='4'>".$grade['section']."</th></tr>";
                    
                    foreach($this->requiredSubjects[(int)$grade['level_id']] as $subject){
                         echo "<tr>
                                 <td>". ($subject->subject_id ?? 'err#' )."</td>";
                        //  if(!empty($grade['grades'])){
                        //     foreach($grade['grades'] as $grade){
                        //         echo "<tr>
                        //             <td>". ($grade[1]['subject'] ?? 'err#' )."</td>
                        //             <td>". ($grade[1]['grade'] ?? 'err#' )."</td>
                        //             <td>". ($grade[2]['grade'] ?? 'err#' )."</td>
                        //             <td></td>
                        //         </tr>";
                        //     }
                        // }


                        echo "<td></td>
                             </tr>";
                    }
                    

                    echo "</table>";
                }   

            }else{
                echo "No Grades Available yet";
            }
            
            
            ?>

        </div>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>


