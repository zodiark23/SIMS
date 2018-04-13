
<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="main-container">
<div class="content-container dashboard">
    <div class="dashboard-container">
        <div class="content-panel">
        <div class="content-head">
                <h3 class="dashboard-section-title">Student Overview</h3>
                <div class="input-group">
                    <input type="text" placeholder="Search" id="search-box">
                    <a href="javascript:void(0);" class="search-btn"><img src="<?=BASE_URL?>/img/search-icon.png" alt=""></a>
                </div>
            </div>                       
            <table width="100%" class='content-panel-table'>
                <tr>
                    <th>Full Name</th>
                    <th>Create Date</th>
                    
                    <th>Action</th>
                </tr>

                <?php
                    foreach($this->studentList as $sl){
                        echo "<tr class='search_index'>";
                        echo "<td>".$sl->first_name." ".$sl->middle_name." ".$sl->last_name."</td>";
                        echo "<td>".$sl->create_date."</td>";
                        echo "<td><a href='".BASE_URL."/admin/print-form/".$sl->student_id."'>Form 137</a> | <a href='".BASE_URL."/admin/enroll-student/".$sl->student_id."'>Enroll</a></td>";
                        echo "</tr>";
                    }
                ?>

                
            </table>

            <script>
                    $("#search-box").quicksearch('.search_index');
            </script>

        </div>

        <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>

