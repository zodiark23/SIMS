
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
                    echo "<tr style='font-weight:bold;'>
                        <td>Subject</td>
                        <td>1st QTR</td>
                        <td>2nd QTR</td>
                        <td>Final Grade</td>
                    </tr>";
                    foreach($this->requiredSubjects[(int)$grade['level_id']] as $subject){
                        $subjectName = $this->subjectModel->info((int)$subject->subject_id); 
                        echo "<tr>
                                 <td>". ($subjectName[0]['subject_name'] ?? 'err#')."</td>";
                        
                        echo  "<td class='".( ($grade['grades'][$subject->subject_id][1]['grade'] ?? '' ) > $grade['grade_scheme'] ? 'sims-success' : 'sims-danger' )."'>". ($grade['grades'][$subject->subject_id][1]['grade'] ?? '' )."</td>
                                <td class='".( ($grade['grades'][$subject->subject_id][2]['grade'] ?? '' ) > $grade['grade_scheme'] ? 'sims-success' : 'sims-danger' )."'>". ($grade['grades'][$subject->subject_id][2]['grade'] ?? '' )."</td>
                        ";

                        if(!empty($grade['grades'][$subject->subject_id][1]['grade']) && !empty($grade['grades'][$subject->subject_id][2]['grade']) ){
                            $finalGrade = (($grade['grades'][$subject->subject_id][1]['grade'] + $grade['grades'][$subject->subject_id][2]['grade'] ) )/ 2;
                            //we hardcode 2 since we only handle 2 flags(1st & 2nd Quarter)
                            $colorState = $finalGrade > $grade['grade_scheme'] ? 'sims-success' : 'sims-danger';
                            echo "<td class='$colorState'>$finalGrade</td>";
                        }
                        


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


