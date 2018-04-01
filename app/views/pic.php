
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
            <h3 class="dashboard-section-title">Update Profile</h3>
            <form enctype="multipart/form-data" method="POST">
                <br>
                <h4>Account Info</h4>


                <p>Upload your file</p>
                <input type="file" name="uploaded_file" id="uploaded_file"><br />
                <input type="submit" value="Upload">

                <br>
                <br>

<!--                <input type="submit" data-id="--><!--" class="outlined-button s_upload-btn" value="Update" name="submit"/>-->
<!--                <input type="submit" class="outlined-button s_upload-btn" value="Upload">-->

     <?php

	            if(!empty($_FILES['uploaded_file']))
	            {

                    var_dump($_FILES);
		            $path = "user_uploads/";
		            $pathfile = $_SESSION['user']['student_id']. basename( $_FILES['uploaded_file']['name']);

		            var_dump(is_writable($path));
		            var_dump($path);
		            if(move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], $path)) {
			            echo "The file ".  basename( $_FILES['uploaded_file']['name']).
				            " has been uploaded";
		            } else{
			            echo "There was an error uploading the file, please try again!";
		            }
	            }
	            ?>
            </form>

        </div>


	    <?php include_once("side-nav.php") ?>
    </div>
</div>
</div>


