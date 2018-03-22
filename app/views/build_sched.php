
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
            <h3 class="dashboard-section-title">Schedule Builder</h3>
            <br>            


            <form id="sched-builder-form" data-arg='<?= ($this->schedInfo->schedule_id ?? 0)?>'>
                <select name='section_id'>
                    <?php

                    if($this->sectionList){

                        foreach($this->sectionList as $section){
                    ?>
                        <option value="<?= ($section['section_id'] ?? 0) ?>"><?= ($section['section_name'] ?? "") ?></option>
                    <?php        
                        }
                    }
                    ?>
                </select>

                <select name='teacher_id'>
                    <?php

                    if($this->teacherList){

                        foreach($this->teacherList as $teacher){
                    ?>
                        <option value="<?= ($teacher['teacher_id'] ?? 0) ?>"><?= ($teacher['first_name'] ?? "")." ".($teacher['middle_name'] ?? "")." ".($teacher['last_name'] ?? "") ?></option>
                    <?php        
                        }
                    }
                    ?>
                </select>


                <select name='subject_id'>
                    <?php

                    if($this->subjectList){
                        foreach($this->subjectList as $subject){
                    ?>
                        <option value="<?= ($subject['subject_id'] ?? 0) ?>"><?= ($subject['subject_name'] ?? "") ?></option>
                    <?php        
                        }
                    }
                    ?>
                </select>

                <select name="day">
                    <option value="">Select Day</option>
                    <option>Mon</option>
                    <option>Tue</option>
                    <option>Wed</option>
                    <option>Thu</option>
                    <option>Fri</option>
                    <option>Sat</option>
                    <option>Sun</option>
                </select>

                <select name="start_time">
                    <option value=""> Select Start Time </option>
                    <?= $this->timeSelection?>
                </select>

                <select name="end_time">
                    <option value=""> Select End Time </option>
                    <?= $this->timeSelection?>
                </select>
            
                <input type='submit' value='Add' />
            </form>    

            <style>
            .scheduleBuilderTable{
                margin-top:20px;
                width:100%;
                position:relative;
                overflow:scroll;
                min-height:80%;
                z-index:2;
            }

            .sched-item{
                width: 100px;
                height: 100px;
                background : #577f92;
                position:absolute;
                color: white;
                z-index:10;
                /* display:none; */
            }

            .scheduleBuilderTable .timeline{
                position:absolute;
                width:100%;
                height:100%;
                z-index:1;
            }

            .scheduleBuilderTable .timeline ul li{
                
                list-style:none;
                position:relative;
                line-height:50px;
                font-size:20px;
                color:#7f7a7a;
            }

            .scheduleBuilderTable .timeline ul li::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 1px;
                background: #cec7c7;
            }

            .scheduleBuilderTable .timeline ul li:first-child::before{
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 1px;
                background: #cec7c7;
            }
            .scheduleBuilderTable .events{
                height:40px;
            }
            .scheduleBuilderTable .events .top-info{
                min-width: 100px;
                width:20%;
                background:#f6b067;
                margin:2px;
                float:left;
                height:40px;
                line-height:40px;
                text-align:center;
                font-size:15px;
                color:#414421;
                
            }
            
            
            </style>
            <div class='scheduleBuilderTable' style="width:100%">
            <?php

            

            
            if(!empty($this->builderUI)){

                //create the timeline
                echo "<div class='events' >";
                    echo "<div data-sid='' class='top-info'>Time</div>";
                    echo "<div data-sid='3' class='top-info'>Quigley</div>";
                    echo "<div data-sid='1' class='top-info'>Mcketing</div>";
                echo "</div>";

                echo $timeline = "
                
                
                <div class='timeline'>
                    <ul>
                
                ";
                
                foreach($this->builderUI['time'] as  $time){
                    echo "<li class='time-event' data-time='".$time."'>".date("H:i",strtotime($time))."</li>";
                }

                echo "</ul> 
                </div>";

                

                foreach($this->builderUI['body'] as $body){
                    $difference = ($body['endPosition'] - $body['startPosition'] ) + 1;
                    $expand = $difference > 1 ? $difference : 0;
                    $subjectName = "err#";

                    foreach($this->subjectList as $s){
                        if($s['subject_id'] == $body['subject']){
                            $subjectName =  $s['subject_name'];
                        }
                    }

                    echo "<div class='sched-item' data-sname='".$subjectName."' data-sj='".$body['subject']."' data-section='".$body['section']."' data-teacher='".$body['teacher']."' data-sched-start-time='".$body['start_time']."' data-sched-end-time='".$body['end_time']."'>";
                    echo $subjectName;
                    echo "</div>";
                }
            } else{
                echo "No data";
            }
            
            
            ?>
            </div>

            <script>
            $(".sched-item").each(function(){
                
                var subjectName = $(this).data('sname');
                var start = $(this).data('sched-start-time');
                var end = $(this).data('sched-end-time');
                var section = $(this).data("section");
                var teacher = $(this).data("teacher");
                var subject = $(this).data("sj");

                /** Find the position */
                var posY = $(".time-event[data-time='"+start+"']").offsetTop;
                var posX = 300;
                // $(".events .top-info").each(function(){
                //     var sid = $(this).data('sid');

                //     if(sid == subject){
                //         posX = $(this).position();
                //     }
                // });
                console.log(posX, posY);

                // if(!posX || !posY){
                //     alert("Unknown error on the javascript scheduler");
                // }
                
                var x = posY;
                var y = 0;
                
                $(this).animate({top: x, left:y}, 200);
                
            });
            </script>
            

        </div>

        <?php //include_once("side-nav.php") ?>
    </div>
</div>
</div>


