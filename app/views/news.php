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
                        <div class="bg-modal">
                            <div class="modal-content">
                                <div class="close-modal">+</div>

                        <tr>

                            <?php
                            if ($this->displayNews) {


	                            foreach ($this->displayNews as $result) {

	                                $news_id = $result['news_id'];

		                            if (strlen(htmlspecialchars($result['news_content'])) > 250) {
			                            // Title and Content
			                            echo "<tr><td>".$result['news_title'];
			                            echo "<br><br>";
			                            echo substr(htmlspecialchars_decode($result['news_content']),0,250)."..."."</td>";


			                            // Published button here (YES/NO)
                                        echo "<td>".$result['news_publish'];


			                            // Edit button here
			                            echo "<td><a class='outlined-button' value='Edit' id='".$result['news_id']."' name='edit-btn' href='".BASE_URL."/admin/edit_news/".$result['news_id']."'>".'EDIT'."</a>";

			                            // Delete button here
			                            echo "<input type='button' class='delete-btn' value='Delete' id='".$result['news_id']."' name='delete-btn'>";


			                            // View button here
			                            echo "<input type='button' data-newsid='".$result['news_id']."' class='view-btn' value='VIEW' name='view-btn'></td>";

//			                            echo "<div class='bg-modal'><div class='modal-content'><div class='close-modal'>+</div>".$result['news_title']."<br><br>".htmlspecialchars_decode($result['news_content'])."</td></div></div></div>";



		                            } else {

			                            // Title and Content
			                            echo "<tr><td>".$result['news_title'];
			                            echo "<br><br>";
			                            echo htmlspecialchars_decode($result['news_content'])."</td>";

			                            // Published button here (YES/NO)
			                            echo "<td>".$result['news_publish'];

			                            // Edit button here
			                            echo "<td><a class='outlined-button' value='Edit' id='".$result['news_id']."' name='edit-btn' href='".BASE_URL."/admin/edit_news/".$result['news_id']."'>".'EDIT'."</a>";

			                            // Delete button here
			                            echo "<input type='button' class='delete-btn' value='Delete' id='".$result['news_id']."' name='delete-btn'>";

			                            // View button here
			                            echo "<input type='button' data-newsid='".$result['news_id']."' class='view-btn' value='VIEW' name='view-btn'></td>";
//			                            echo "<div class='bg-modal'><div class='modal-content'><div class='close-modal'>+</div>".$result['news_title']."<br><br>".htmlspecialchars_decode($result['news_content'])."</td></div></div></div>";
		                                
                                    }
	                            }
                            }else {
                                echo "<td>"."No data"."</td>";
                            }

//                            echo "<div class='bg-modal'><div class='modal-content'><div class='close-modal'>+</div>".$result['news_title']."<br><br>".htmlspecialchars_decode($result['news_content'])."</td></div></div></div>";
                            ?>

                        </tr>
            </div>
        </div>

        </table>
<!--                    <div class='bg-modal'>-->
<!--                        <div class='modal-content'>-->
<!--                            <div class='close-modal'>+</div>-->
<!--                            test-->
<!--                        </div>-->
<!--                    </div>-->



                    <br>
                    <br>
                    <button class="outlined-button" value="Add"><a href="<?=BASE_URL?>/admin/add_news">Add News</a></button>

                </form>
			</div>


			<?php include_once("side-nav.php") ?>
		</div>
	</div>
</div>
