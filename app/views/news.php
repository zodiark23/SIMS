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
                    <h3 class="dashboard-section-title">Publish News</h3>
                    <div class="input-group">
                        <a class="outlined-button" href="<?=BASE_URL?>/admin/add_news">Create</a>
                        <input type="text" id="search-box" placeholder="Search">
                        <a href="javascript:void(0);" class="search-btn"><img src="<?=BASE_URL?>/img/search-icon.png" alt=""></a>
                    </div>
                </div>
                <form id="display-news-form" method="post">

                    <div class='error_news_form'></div>
                    <table style="width:100%" class="content-panel-table">
                        <tr>
                            <th>News</th>

                            <th>Action</th>
                        </tr>

                        <tr>

                            <?php
                            if ($this->displayNews) {


	                            foreach ($this->displayNews as $result) {

	                                $news_id = $result['news_id'];

		                            if (strlen(htmlspecialchars($result['news_content'])) > 250) {


			                            // Title and Content
			                            echo "<tr><td style='padding: 5px 0 5px 15px; text-align: left; width: 400px;'>".$result['news_title'];
			                            echo "<br><br>";
			                            echo substr(htmlspecialchars_decode($result['news_content']),0,250)."..."."</td>";





			                            // Edit button here
			                            echo "<td><a class='tbl-edit-btn' value='Edit' id='".$result['news_id']."' name='edit-btn' href='".BASE_URL."/admin/edit_news/".$result['news_id']."'>".'EDIT'."</a>";
										echo " | ";
			                            // Delete button here
			                            echo "<input type='button' class='tbl-delete-btn delete-btn' value='Delete' id='".$result['news_id']."' name='delete-btn'>";
										echo " | ";

			                            // View button here
			                            echo "<input type='button' data-newsid='".$result['news_id']."' class='tbl-builder-btn view-btn' value='VIEW' name='view-btn'></td>";





		                            } else {

			                            // Title and Content
			                            echo "<tr><td style='padding: 5px 0 5px 15px; text-align: left; width: 400px;'>".$result['news_title'];
			                            echo "<br><br>";
			                            echo htmlspecialchars_decode(($result['news_content']))."</td>";


			                            // Edit button here
			                            echo "<td><a class='tbl-edit-btn' value='Edit' id='".$result['news_id']."' name='edit-btn' href='".BASE_URL."/admin/edit_news/".$result['news_id']."'>".'Edit'."</a>";
										echo " | ";
			                            // Delete button here
			                            echo "<input type='button' class='delete-btn tbl-delete-btn' value='Delete' id='".$result['news_id']."' name='delete-btn'>";
										echo " | ";
			                            // View button here
			                            echo "<input type='button' data-newsid='".$result['news_id']."' class='view-btn tbl-builder-btn' value='VIEW' name='view-btn'></td>";


                                    }
	                            }
                            }else {
                                echo "<td colspan='3'>"."No data"."</td>";
                            }

                            ?>

                        </tr>
            </div>
        </div>

        </table>
                    <div class='bg-modal'>

                        <div class='modal-content'>
                            <div class='close-modal'><i class="far fa-times-circle"></i></div>
                            <div class='real-content'></div>
                        </div>
                    </div>





                    <br>
                    <br>


                </form>
			</div>



			<?php include_once("side-nav.php") ?>
		</div>
	</div>
</div>
