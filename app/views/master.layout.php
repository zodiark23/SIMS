<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=1200px">
        <base href="/sims">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/normalize.min.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/fonts/roboto.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/lightbox.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/swiper.min.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/reset.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/main.css">
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL?>/css/haruki-inputs.css" />
        <script defer src="<?=BASE_URL?>/js/fontawesome-all.min.js"></script>
        <script src="<?=BASE_URL?>/js/vendor/modernizr-2.8.3.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?=BASE_URL?>/js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="<?=BASE_URL?>/js/lightbox.js"></script>
        <script src="<?=BASE_URL?>/js/jquery.tablesorter.min.js"></script>
        <script src="<?=BASE_URL?>/js/rQuery.js"></script>
        <script>
            var BASE_URL = "<?=BASE_URL?>";
        </script>
        <script src="<?=BASE_URL?>/js/main.js"></script>
        <script src="<?=BASE_URL?>/js/core.js"></script>
        <script src="<?=BASE_URL?>/vendor/tinymce/js/tinymce/tinymce.min.js"></script>
        <script>
		    tinymce.init({
			    selector: '#newsContent',
			    plugins: ["code image imagetools autolink textcolor colorpicker fullscreen",
				    "help media wordcount"],
			    toolbar: 'undo redo | code | image | forecolor backcolor | fullscreen | media | help ',
			    menubar: false,
			    browser_spellcheck: true,
			    media_alt_source: false,
			    media_poster: false,
			    mobile: {
				    theme: 'mobile'
			    },
			    // without images_upload_url set, Upload tab won't show up
			    images_upload_url: 'upload.php',

			    // override default upload handler to simulate successful upload
			    images_upload_handler: function (blobInfo, success, failure) {
				    var xhr, formData;

				    xhr = new XMLHttpRequest();
				    xhr.withCredentials = false;
				    xhr.open('POST', 'upload.php');

				    xhr.onload = function () {
					    var json;

					    if (xhr.status != 200) {
						    failure('HTTP Error: ' + xhr.status);
						    return;
					    }

					    json = JSON.parse(xhr.responseText);

					    if (!json || typeof json.location != 'string') {
						    failure('Invalid JSON: ' + xhr.responseText);
						    return;
					    }

					    success(json.location);
				    };

				    formData = new FormData();
				    formData.append('file', blobInfo.blob(), blobInfo.filename());

				    xhr.send(formData);
			    }
		    });
        </script>


    </head>


    <body>

    <?php

    include(__DIR__."/".$this->view.".php");
    ?>




        <script src="<?=BASE_URL?>/js/classie.js"></script>
        <script>
			(function() {
				runClassieInput();
            })();
        </script>
    </body>
    </html>




    