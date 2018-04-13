
<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->


<!-- TODO :
Fix the UI @morbid
    -->

<?php
if(!$this->hasRights){
    $this->unauthorized();
    exit;
}

?>

<div class="main-container">
<div class="content-container dashboard">
    <div class="dashboard-container">
        <div class="content-panel">
            <div class="content-head">
                <h3 class="dashboard-section-title">Education</h3>
                <div class="input-group">
                    <!-- <a class="outlined-button" href="<?=BASE_URL?>/admin/create-education">Create</a> -->
                    <input type="text" id="search-box" placeholder="Search">
                    <a href="javascript:void(0);" class="search-btn"><img src="<?=BASE_URL?>/img/search-icon.png" alt=""></a>
                </div>
            </div>

            <table style="width:100%" class="content-panel-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Duration</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $count = 0;
                        foreach($this->data as $cur_data){ 
                        $count++;
                    ?>
                    
                        <tr class='search_index'>
                            <td><?= ($count) ?></td>
                            <td><?= ($cur_data['description'] ?? "") ?></td>
                            <td><?= ($cur_data['year_duration'] ?? "") ?></td>
                            <td>
                                <a class='tbl-builder-btn' href="<?=BASE_URL?>/admin/show-education/<?=($cur_data['curriculum_id'] ?? "")?>">Info</a>
                                <a class="tbl-edit-btn" href="<?=BASE_URL?>/admin/edit-education/<?=($cur_data['curriculum_id'] ?? "")?>" >Edit</a>
                                <a class="tbl-delete-btn" href="<?=BASE_URL?>/admin/delete-education/<?=($cur_data['curriculum_id'] ?? "")?>" >Delete</a>
                            </td>
                        </tr>
                    
                    <?php } 
                         
                        if(!$this->data){
                            echo "<tr><td colspan='4'>No Data</td></tr>";
                        }
                    ?>
                </tbody>
            </table>

            <script>
                    $("#search-box").quicksearch('.search_index');
            </script>

        </div>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>


