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
        <script>window.jQuery || document.write('<script src="<?=BASE_URL?>/js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="<?=BASE_URL?>/js/lightbox.js"></script>
        <script src="<?=BASE_URL?>/js/jquery.tablesorter.min.js"></script>
        <script>
            var BASE_URL = "<?=BASE_URL?>";
        </script>
        <script src="<?=BASE_URL?>/js/main.js"></script>
        <script src="<?=BASE_URL?>/js/core.js"></script>

    </head>


    <body>

    <?php

    include($this->view.".php");
    ?>




        <script src="<?=BASE_URL?>/js/classie.js"></script>
        <script>
			(function() {
				// trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
				if (!String.prototype.trim) {
					(function() {
						// Make sure we trim BOM and NBSP
						var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
						String.prototype.trim = function() {
							return this.replace(rtrim, '');
						};
					})();
				}

				[].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
					// in case the input is already filled..
					if( inputEl.value.trim() !== '' ) {
						classie.add( inputEl.parentNode, 'input--filled' );
					}

					// events:
					inputEl.addEventListener( 'focus', onInputFocus );
					inputEl.addEventListener( 'blur', onInputBlur );
				} );

				function onInputFocus( ev ) {
					classie.add( ev.target.parentNode, 'input--filled' );
				}

				function onInputBlur( ev ) {
					if( ev.target.value.trim() === '' ) {
						classie.remove( ev.target.parentNode, 'input--filled' );
					}
				}
            })();
        </script>
    </body>
    </html>




    