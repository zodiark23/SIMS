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
                <form id="publish-news-form" method="post">
                    <br>
                    <h3 class="dashboard-section-title">Add News</h3>
                    <div class='error_news_form'></div>
                    <br>
                    <br>

                    <p>
                        <label>Title</label>
                        <br>
                        <input type="text" name="newsTitle" id="newsTitle">
                    </p>
                    <br>
                    <br>
	                <textarea class="tinymce" id="newsContent" name="newsContent" cols='105' rows='30'></textarea>
                    <br>
                    <br>

                    <input type="submit" class="outlined-button" value="Add" id="save-news">
                    <input name="image" type="file" id="upload-img" class="hidden" onchange="">



                </form>
			</div>


			<?php include_once("side-nav.php") ?>
		</div>
	</div>
</div>
