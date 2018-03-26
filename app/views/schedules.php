
<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->


<div class="main-container">
<div class="content-container dashboard">
    <div class="dashboard-container">
        <div class="content-panel">
            <h3 class="dashboard-section-title">Schedules</h3>                        
            <br>
            <a class="outlined-button" href="<?=BASE_URL?>/admin/create-schedule">Create</a>
            <br>
            <br>
            <br>
            <table style="width:100%">
            
                <tr>
                    <th>#</th>
                    <th>Schedule Name</th>
                    <th>Year</th>
                    <th>Level</th>
                    <th>Action</th>
                </tr>

                <?php 
                    if($this->data){
                        foreach($this->data as $sched){
                ?>
                <tr>
                    <td><?= $sched['schedule_id'] ?></td>
                    <td><?= $sched['schedule_name']?></td>
                    <td><?= $sched['year_start']."-".$sched['year_end']?></td>
                    <td><?= $this->levelNames[$sched['level_id']]?></td>
                    <td>
                    <a href='<?=BASE_URL?>/admin/schedule/<?= $sched['schedule_id']?>'>Builder</a>| 
                    Edit | 
                    <a href='<?=BASE_URL?>/admin/delete-schedule/<?= $sched['schedule_id']?>'>Delete</a>
                    </td>
                </tr>
                <?php
                        }
                    }else{
                        echo "<td colspan='5'>No data</td>";
                    }
                ?>



                <?php 
                    if( count($this->data) <= 0){
                ?>
                <tr>
                    <td colspan="5">No data found</td>
                </tr>
                <?php } ?>
            </table>


            

        </div>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>


