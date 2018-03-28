
<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<div class="main-container">
<div class="content-container dashboard">
    <div class="dashboard-container">
        <div class="content-panel">
            <div class="content-head">
                <h3 class="dashboard-section-title">Grading Schemes</h3>                        
                <div class="input-group">                 
                        <a class="outlined-button" href="<?=BASE_URL?>/admin/add-grade-scheme">Create</a>
                        <input type="text" id="search-box" placeholder="Search">
                        <a href="javascript:void(0);" class="search-btn"><img src="<?=BASE_URL?>/img/search-icon.png" alt=""></a>
                </div>
            </div>
            <table width="100%" class="content-panel-table">
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>Threshold</th>
                    <th>Date Implemented</th>
                    <th>References</th>
                    <th>Action</th>
                </tr>

                <?php 
                
                if(count($this->grade_schemes) <= 0){
                    echo "<tr><td colspan='5'>No data</td></tr>";
                }else{
                    foreach($this->grade_schemes as $gs){
                        echo "
                            <tr>
                                <td>".($gs->grade_scheme_id ?? "err#")."</td>
                                <td>".($gs->description ?? "")."</td>
                                <td class='sims-primary'>".($gs->pass_threshold ?? "")."/100</td>
                                <td>".($gs->date_implemented ?? "")."</td>
                                <td>0</td>
                                <td> <a href='".BASE_URL."/admin/edit-grade-scheme/".($gs->grade_scheme_id ?? "")."'>Edit</a></td>
                            </tr>
                        
                        ";
                    }
                }
                
                
                ?>
            </table>

        </div>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>

