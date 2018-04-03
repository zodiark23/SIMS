
<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="main-container">
<div class="content-container dashboard">
    <div class="dashboard-container">
        <div class="content-panel">
            <h3 class="dashboard-section-title">Enrollment</h3>                        
            <table width="100%" class='content-panel-table'>
                <tr>
                    <th colspan=2>Personal Info</th>
                </tr>
                <tr>
                    <td>Full Name</td>
                    <td><?= $this->student->first_name ?? ""?> <?= $this->student->middle_name ?? ""?> <?= $this->student->last_name ?? ""?></td>
                </tr>

                <tr>
                    <td>Age</td>
                    <td>
                        <?php
                        $dateOfBirth = $this->student->birth_date;
                        $today = date("Y-m-d");
                        $age_diff = date_diff(date_create($dateOfBirth), date_create($today));
                        echo $age_diff->format("%y");
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Birthdate</td>
                    <td><?= $this->student->birth_date?></td>
                </tr>

                <tr>
                    <td>Gender</td>
                    <td><?= $this->student->gender == 1 ? "Male" : "Female" ?></td>
                </tr>

                <tr>
                    <td>Cellphone #</td>
                    <td><?= $this->student->cell_number ?? ''?></td>
                </tr>

                <tr>
                    <td>Tel #</td>
                    <td><?= $this->student->tel_number ?? '' ?></td>
                </tr>

                <tr>
                    <th colspan="2">Educational Attainment</th>
                </tr>

                <?php
                if($this->studentEducational === false){
                    echo '<tr>
                        <td colspan="2">No Data Available</td>
                    </tr>';
                }else{
                    foreach($this->studentEducational as $se){
                        foreach($this->curriculumList as $c){
                            $currName = "";
                            if($c['curriculum_id'] == $this->levelNames[$se->level_id]['curriculum_id'] ){
                                $currName = $c['description'];
                                break;
                            }
                        }

                        if($this->sectionList){
                            // find the section name
                            foreach($this->sectionList as $sl){
                                $sectionName = "";
                                if($sl['section_id'] == $se->section_id){
                                    $sectionName = $sl['section_name'];
                                    break;
                                }
                            }
                        }
                        echo "<tr>
                            <td>". $currName. " / ".$this->levelNames[$se->level_id]['level_name']. " / ".$sectionName . "</td>
                            <td>".$se->status."</td>
                        </tr>";
                    }
                }
                
                
                ?>

                <form id="enrollStudentForm" data-cid="<?= $this->student->student_id ?? 0?>">
                <tr>
                    <th colspan="2">Enrollment Information</th>
                </tr>
                <tr>
                    <td>Curriculum</td>
                    <td>
                        <select id="cur_select" name="curr">
                        <option value="" hidden>Curriculum</option>
                        <?php

                        foreach($this->curriculumList as $c){
                            echo "<option value='".$c['curriculum_id']."'>".$c['description']."</option>";
                        }
                        ?>
                        </select>
                    </td>
                </tr>
                 <tr>
                    <td>School Level</td>
                    <td>
                        <select id="sched_school_level" class='loadSections' name="level">
                            <option value=""  hidden>Please Select Level</option>
                        </select>
                    </td>
                </tr>

                 <tr>
                    <td>Section</td>
                    <td>
                        <select id="section_select" name="section">
                            <option value=""  hidden>Please Select Section</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td colspan="2"><input class='outlined-button' type="submit" value="Enroll"/></td>
                </tr>
                
                </form>
                
            </table>
            

        </div>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>

