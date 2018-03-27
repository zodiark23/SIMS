
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
            <div class="content-head">
                <h3 class="dashboard-section-title">Overview</h3>
                <div class="input-group">
                    <input type="text" placeholder="Search" id="search-box">
                    <a href="javascript:void(0);" class="search-btn"><img src="<?=BASE_URL?>/img/search-icon.png" alt=""></a>
                </div>
            </div>
            <table style="width:100%" class="content-panel-table">
                <thead>
                    <tr>
                        <th style="width: 30px;">#</th>
                        <th>Name</th>
                        <th>Create Date</th>
                        <th>Last Modified</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
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
                            <a class="tbl-edit-btn" href="<?=BASE_URL?>/admin/edit-teacher/<?=($cur_data['curriculum_id'] ?? "")?>" >Edit</a>
                        
                            <a class="tbl-delete-btn" href="<?=BASE_URL?>/admin/Deactivate/<?=($cur_data['curriculum_id'] ?? "")?>" >Deactivate</a>
                        </td>
                    </tr>
                    <?php } 
            
                        }
                    ?>
                </tbody>
            </table>

        </div>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>


