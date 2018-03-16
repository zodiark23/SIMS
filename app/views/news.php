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
                            if ($this->displayNews){
                                foreach ($this->displayNews as $result){
                                    // Title and Content
                                    echo "<tr><td>".htmlspecialchars_decode($result['news_title']);
                                    echo "<br><br>";
                                    echo htmlspecialchars_decode($result['news_content'])."</td>";

                                    // Published
                                    if($result['news_publish'] == 0){
                                        echo "<td>Published</td>";
                                    }

                                    // Edit button here
                                    echo "<td><button class='outlined-button' value='Edit'>"."EDIT"."</button>";

                                    // Delete button here
                                    echo "<button class='outlined-button' value='Delete'>"."DELETE"."</button>";
                                    // View button here
                                    echo "<button class='outlined-button' value='VIEW'>"."VIEW"."</button></td>";
                                }
                                }else {
                                echo "No data";
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
