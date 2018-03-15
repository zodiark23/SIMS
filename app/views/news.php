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
                <form id="create-role-form">
                    <br>
                    <h3 class="dashboard-section-title">Publish News</h3>
                    <div class='error_role_form'></div>
                    <br>
                    <br>

                    <p><label>Title</label><br />
                        <input type='text' name='newsTitle' id="newsTitle"></p>
                    <br>
                    <br>


	                <textarea class="tinymce" name='newsContent' cols='105' rows='30'></textarea>

                    <!--- tinymce CDN-->
                    <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
                    <script>
                        tinymce.init({
                            selector: ".tinymce",
                            plugins: [
                                "advlist autolink lists link image charmap print preview anchor",
                                "searchreplace visualblocks code fullscreen",
                                "insertdatetime media table contextmenu paste"
                            ],
                            browser_spellcheck: true,
                            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image "
                        });
                    </script>

                    <br>
                    <br>

                    <input type="submit" value="Add" id="dru">
                </form>
			</div>


			<?php include_once("side-nav.php") ?>
		</div>
	</div>
</div>
