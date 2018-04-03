
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
            <form class="clearfix" id="sched-builder-form" data-arg='<?= ($this->schedInfo->schedule_id ?? 0)?>'>
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

                <!-- <select name="day">
                    <option value="">Select Day</option>
                    <option>Mon</option>
                    <option>Tue</option>
                    <option>Wed</option>
                    <option>Thu</option>
                    <option>Fri</option>
                    <option>Sat</option>
                    <option>Sun</option>
                </select> -->

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
            .scheduleWrapper{
                width:100%;
                overflow: auto;
                margin-top:20px;
                min-height:500px;
                height:500px;
            }
            .scheduleBuilderTable{
                margin-top:20px;
                min-width:100%;
                width:1500px;
                position:relative;
                
                min-height:500px;
                height:500px;
                z-index:2;
            }

            .sched-item{
                width: 160px;
                height: 97px; /*Due to border 3x bottom*/
                background : #577f92;
                position:absolute;
                color: white;
                z-index:10;
                border-bottom: 3px solid #2f576b
                
                /* display:none; */
            }

            .sched-item .item-close{
                position:absolute;
                top:6px;
                right:3px;
                color:white;
                background:transparent;
                border:none;
                outline:0;
            }
            .sched-item .sched-cont{
                margin:18px 9px;
            }
            .sched-item .sched-cont .title{
                letter-spacing: 1.1px;
                text-transform: uppercase;
                display:block;
                margin-bottom:10px;
            }
            .sched-item .sched-cont .text{
                font-style:italic;

            }

            .sched-item .sched-cont .time{
                position:absolute;
                font-size:14px;
                letter-spacing:1.1px;
                bottom:5px;
                right:6px;
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
                min-width: 160px;
                
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
            <div class='scheduleWrapper'>
                <div class='scheduleBuilderTable'>
            <?php

            

            
            if(!empty($this->builderUI)){

                //create the timeline
                echo "<div class='events' >";
                    echo "<div data-sid='' class='top-info'>Time</div>";
                    foreach($this->builderUI['sections'] as $section){

                        $sectionName = "err#";

                        foreach($this->sectionList as $sl){
                            if($sl['section_id'] == $section){
                                $sectionName = $sl['section_name'];
                            }
                        }
                        
                        echo "<div data-sid='$section' class='top-info'>$sectionName</div>";
                    }
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
                    
                    $subjectName = "err#";
                    $teacherName = "err#";
                    
                    foreach($this->subjectList as $s){
                        if($s['subject_id'] == $body['subject']){
                            $subjectName =  $s['subject_name'];
                        }
                    }

                    foreach($this->teacherList as $t){
                        if($t['teacher_id'] == $body['teacher']){
                            $teacherName =  $t['first_name']. " ".substr($t['last_name'],0,1).".";
                        }
                    }

                    echo "<div class='sched-item' data-sname='".$subjectName."' data-sj='".$body['subject']."' data-section='".$body['section']."' data-teacher='".$body['teacher']."' data-sched-start-time='".$body['start_time']."' data-sched-end-time='".$body['end_time']."'>";
                    echo "<div class='sched-cont'>";
                    echo "<span class='title'>".$subjectName."</span>";
                    echo "<span class='text'>".$teacherName."</span>";
                    echo "<span class='time'>".date("H:i",strtotime($body['start_time']))."-".date("H:i",strtotime($body['end_time'])) ."</span>";
                    echo "</div>";
                    echo "<button class='item-close' data-b80bb7740288fda1f201890375a60c8f='".$body['sched_item_id']."'>X</button>";
                    echo "</div>";
                }
            } else{
                echo "No data";
            }
            
            
            ?>
                </div>
            </div>

            <script>
            delay = 0;

            function recomputeWidth(){
                //recompute scheduleBuilderTable base on 
                var width = 0;

                $(".events .top-info").each(function(){
                    var itemWidth = $(this).width();
                    if(!isNaN(parseFloat(itemWidth))){
                        width += parseFloat(itemWidth);
                    }
                });

                if(width > 0){
                    $(".scheduleBuilderTable").width(width + 30);
                }


                

            }


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

                heightValue = heightValue - 3;
                $(this).height(heightValue);

                
                
                // console.log(pos1);
                if(!pos1 || !pos2){
                    alert("Unknown error on the javascript scheduler. Javascript is required to view the builder.");
                }
                
                //adding 50 due to li
                var x = pos1.top + (50);
                var y = pos2.left + 2;
                
                delay+=30;
                setTimeout( function(){

                $(me).animate({top: x, left:y}, 300);
                
                },delay);
                
            });

            $(".item-close").on("click", function(){
                var cid = $(this).data("b80bb7740288fda1f201890375a60c8f");
                
                var c = confirm("This process is irreversible. Do you want to continue?");

                if(c){
                    $.ajax({
                        url:BASE_URL+"/php/delete_schedule_item.php",
                        data : {cid : cid},
                        type : "post",
                        success : function(data){
                            x = JSON.parse(data);
                            if(x.code == "00"){
                                alert(x.message);
                                location.reload();
                            }else{
                                alert(x.message);
                            }
                        }
                    })
                }
            });

            recomputeWidth();
            </script>
            

        </div>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>


