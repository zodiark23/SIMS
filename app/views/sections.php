
<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->


<div class="main-container">
<div class="content-container dashboard">
    <div class="dashboard-container">
        <div class="content-panel">
            <div class="content-head">
                <h3 class="dashboard-section-title">Sections</h3> 
                <div class="input-group">                 
                    <a class="outlined-button" href="<?=BASE_URL?>/admin/add-section">Create</a>
                    <input type="text" id="search-box" placeholder="Search">
                    <a href="javascript:void(0);" class="search-btn"><img src="<?=BASE_URL?>/img/search-icon.png" alt=""></a>
                </div>      
            </div>
            <table style="width:100%" class="content-panel-table">
            
                <tr>
                    <th>#</th>
                    <th>Section Name</th>
                    <th>Level</th>
                    
                    <th>Action</th>
                </tr>

                <?php 
                    if($this->data){

                        foreach($this->data as $sched){
                            ?>
                <tr class='search_index'>
                    <td><?= $sched['section_id'] ?></td>
                    <td><?= $sched['section_name']?></td>
                    
                    <td><?= $this->levelNames[$sched['level_id']]?></td>
                    <td> <a class="tbl-edit-btn" href="<?=BASE_URL?>/admin/edit-section/<?=($sched['section_id'] ?? 0)?>">Edit</a> </td>
                </tr>
                <?php
                        }
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

            <script>
                    $("#search-box").quicksearch('.search_index');
            </script>
            

        </div>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>


