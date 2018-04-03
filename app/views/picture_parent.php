
<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->


<!-- TODO :
refactor hoshi inline widths here @morbid
add styling on bottom note
    -->

<div class="main-container">
<div class="content-container dashboard">
    <div class="dashboard-container">
        <div class="content-panel">
            <h3 class="dashboard-section-title">Update parent Picture</h3>
            <form enctype="multipart/form-data" method="POST" action="<?= BASE_URL ?>/php/pic_update.php">


                <br>
                <br>
                <p>Upload your an image</p>
                <br>
                <br>
                <input type="file" name="uploaded_file" id="uploaded_file">
                <br>
                <br>
                <input type="submit" id="s_update-gtn" class="outlined-button" value="Upload">

                <br>
                <br>

            </form>

        </div>


	    <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>


