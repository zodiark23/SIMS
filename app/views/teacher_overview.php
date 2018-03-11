
<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->


<!-- TODO :
Fix the UI @morbid
    -->

<div class="main-container">
<div class="content-container dashboard">
    <div class="dashboard-container">
        <div class="content-panel">
            <h3 class="dashboard-section-title">Overview</h3>
            <br>
            <br>
            

            <table style="width:100%">
                <tr>
                    <td>#</td>
                    <td>Name</td>
                    <td>Create Date</td>
                    <td>Last Modified</td>
                    <td>Status</td>
                    <td>Action</td>
                </tr>
                <?php 
                    $count = 0;
                    foreach($this->teachers as $cur_data){
                    //exclude teacher #1
                    
                    if($cur_data['teacher_id'] != 1){

                    $count++;
                ?>
                <tr>
                    <td><?= ($count) ?></td>
                    <td><?= ($cur_data['first_name'] ?? "")." ". ($cur_data['last_name'] ?? "") ?></td>
                    <td><?= date("M dS, Y h:i:s a", strtotime( ($cur_data['create_date'] ?? "") ) ) ?></td>
                    <td><?= date("M dS, Y h:i:s a", strtotime( ($cur_data['last_modified'] ?? "") ) ) ?></td>
                    <td class='success'><?= (($cur_data['status'] ?? "" ) == 1 ) ? "active" : "terminated" ?></td>
                    <td>
                        <a href="<?=BASE_URL?>/admin/edit-teacher/<?=($cur_data['curriculum_id'] ?? "")?>" >Edit</a>
                       
                        <a href="<?=BASE_URL?>/admin/Deactivate/<?=($cur_data['curriculum_id'] ?? "")?>" >Deactivate</a>
                    </td>
                </tr>
                <?php } 
           
                    }
                ?>
            </table>

        </div>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>


