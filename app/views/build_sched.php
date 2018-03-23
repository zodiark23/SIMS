
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
                min-height:500px;
                height:500px;
                z-index:2;
            }

            .sched-item{
                width: 100px;
                height: 97px; /*Due to border 3x bottom*/
                background : #577f92;
                position:absolute;
                color: white;
                z-index:10;
                border-bottom: 3px solid #2f576b
                
                /* display:none; */
            }

            .scheduleBuilderTable .timeline{
                margin-top:50px;
                position:absolute;
                width:100%;
                height:100%;
                z-index:1;
            }

            .scheduleBuilderTable .timeline ul{
                
                width:100%;
                height:100%;
            }

            .scheduleBuilderTable .timeline ul li{
                
                list-style:none;
                position:relative;
                height:100px;
                font-size:14px;
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
                position:absolute;
                height:100%;
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
                    echo "<li class='time-event' data-time='".$time."'><span>".date("H:i",strtotime($time))."</span></li>";
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
                    echo "<div class='g'>";
                    echo $subjectName;
                    echo "</div>";
                    echo "</div>";
                }
            } else{
                echo "No data";
            }
            
            
            ?>
            </div>

            <script>
            delay = 0;
            $(".sched-item").each(function(){

                var me = this;
                
                var subjectName = $(this).data('sname');
                var start = $(this).data('sched-start-time');
                var end = $(this).data('sched-end-time');
                var section = $(this).data("section");
                var teacher = $(this).data("teacher");
                var subject = $(this).data("sj");

                var height = $(this).height();
                var width = $(this).width();
                // console.log(height);
                /** Find the position */
                var pos1 = $(".time-event[data-time='"+start+"']").position();
                var pos2 = $(".events .top-info[data-sid='"+section+"']").position();

                /** Compute the height using start & end time*/
                
                var startLocation = $(".time-event[data-time='"+start+"']").position();
                var endLocation = $(".time-event[data-time='"+end+"']").position();
                var heightValue = endLocation.top - startLocation.top;
                if(isNaN(heightValue)){
                    alert("Invalid height value");
                }
                $(this).height(heightValue);

                
                
                // console.log(pos1);
                if(!pos1 || !pos2){
                    alert("Unknown error on the javascript scheduler");
                }
                
                //adding 50 due to li
                var x = pos1.top + (50);
                var y = pos2.left + 2;
                
                delay+=30;
                setTimeout( function(){

                $(me).animate({top: x, left:y}, 300);
                
                },delay);
                
            });
            </script>
            

        </div>

        <?php //include_once("side-nav.php") ?>
    </div>
</div>
</div>


