<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <link rel="shortcut icon" href="<?=BASE_URL?>/img/favicon.ico" />
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
                // enable title field in the Image dialog
                image_title: true,
                // enable automatic uploads of images represented by blob or data URIs
                automatic_uploads: true,
                // URL of our upload handler (for more details check: https://www.tinymce.com/docs/configure/file-image-upload/#images_upload_url)
                // images_upload_url: 'postAcceptor.php',
                // here we add custom filepicker only to Image dialog
                file_picker_types: 'image',
                // and here's our custom image picker
                file_picker_callback: function(cb, value, meta) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');

                    // Note: In modern browsers input[type="file"] is functional without
                    // even adding it to the DOM, but that might not be the case in some older
                    // or quirky browsers like IE, so you might want to add it to the DOM
                    // just in case, and visually hide it. And do not forget do remove it
                    // once you do not need it anymore.

                    input.onchange = function() {
                        var file = this.files[0];

                        var reader = new FileReader();
                        reader.onload = function () {
                            // Note: Now we need to register the blob in TinyMCEs image blob
                            // registry. In the next release this part hopefully won't be
                            // necessary, as we are looking to handle it internally.
                            var id = 'blobid' + (new Date()).getTime();
                            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);

                            // call the callback and populate the Title field with the file name
                            cb(blobInfo.blobUri(), { title: file.name });
                        };
                        reader.readAsDataURL(file);
                    };

                    input.click();
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




