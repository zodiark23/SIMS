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
                </div>
                <form id="display-news-form" method="post">
                    
                    <div class='error_news_form'></div>
                    <table style="width:100%" class="content-panel-table">
                        <tr>
                            <th>News</th>
                            <th>Published</th>
                            <th>Action</th>
                        </tr>

                        <tr>



                        </tr>
            </div>
        </div>

        </table>






                    <br>
                    <br>
                    <button class="outlined-button add-news" value="Add"><a href="<?=BASE_URL?>/admin/add_news">Add News</a></button>

                </form>
			</div>



			<?php include_once("side-nav.php") ?>
		</div>
	</div>
</div>
