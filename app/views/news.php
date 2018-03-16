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
                <form id="display-news-form" method="post">
                    <br>
                    <h3 class="dashboard-section-title">Publish News</h3>
                    <div class='error_news_form'></div>
                    <br>
                    <br>
                    <table style="width:100%">
                        <tr>
                            <th>News</th>
                            <th>Published</th>
                            <th>Action</th>
                        </tr>

                        <tr>

                            <?php
                            if ($this->displayNews) {


	                            foreach ($this->displayNews as $result) {

		                            if (strlen(htmlspecialchars($result['news_content'])) > 10) {
			                            // Title and Content
			                            echo "<tr><td>".$result['news_title'];
			                            echo "<br><br>";
			                            echo substr(htmlspecialchars_decode($result['news_content']),0,250)."..."."</td>";


			                            // Published button here (YES/NO)
                                        echo "<td>".$result['news_publish'];


			                            // Edit button here
			                            echo "<td><input type='button' class='outlined-button' value='Edit' id='edit-btn' name='edit-btn'></button>";

			                            // Delete button here
			                            echo "<input type='button' data-news-id=<? class='outlined-button' value='Delete' id='delete-btn' name='delete-btn'>";
			                            // View button here
			                            echo "<input type='button' class='outlined-button' value='VIEW' id='view-btn' name='view-btn'></td>";
		                            }
	                            }
                            }else {
                                echo "<td>"."No data"."</td>";
                            }
                            ?>

                        </tr>
                    </table>

                    <br>
                    <br>
                    <button class="outlined-button" value="Add"><a href="<?=BASE_URL?>/admin/add_news">Add News</a></button>

                </form>
			</div>


			<?php include_once("side-nav.php") ?>
		</div>
	</div>
</div>
