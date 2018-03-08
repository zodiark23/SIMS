
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
            <h3 class="dashboard-section-title">Education</h3>
            <br>
            <br>
            <a class="outlined-button" href="<?=BASE_URL?>/admin/create-education">Create</a>

            <table style="width:100%">
                <tr>
                    <td>#</td>
                    <td>Name</td>
                    <td>Duration</td>
                    <td>Action</td>
                </tr>
                <?php 
                    $count = 0;
                    foreach($this->data as $cur_data){ 
                    $count++;
                ?>
                <tr>
                    <td><?= ($count) ?></td>
                    <td><?= ($cur_data['description'] ?? "") ?></td>
                    <td><?= ($cur_data['year_duration'] ?? "") ?></td>
                    <td>
                        <a href="<?=BASE_URL?>/admin/edit-education/<?=($cur_data['curriculum_id'] ?? "")?>" >Edit</a>
                        <a href="<?=BASE_URL?>/admin/delete-education/<?=($cur_data['curriculum_id'] ?? "")?>" >Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </table>

        </div>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>


