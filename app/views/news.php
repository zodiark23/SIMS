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

	                <textarea name='postCont' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['postCont'];}?></textarea>

                    <br>
                    <br>

                    <input type="submit" class="outlined-button" value="Add" />
                </form>
			</div>


			<?php include_once("side-nav.php") ?>
		</div>
	</div>
</div>
