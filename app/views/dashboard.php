
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="main-container">
            ad
        </div>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="js/swiper.min.js"></script>
        <script src="js/jquery.tablesorter.min.js"></script>
        <script src="js/main.js"></script>

        <script>
            $(document).ready(function(){
                $('.menu-bars').on("click", function(){
                    $(this).parent().find('.parent-ul').toggleClass('active');
                });
                
                $(".parent-ul>li>a").on('click', function(){
                    if ($(this).parent().hasClass('active')) {
                        $(this).parent().removeClass('active');
                    } else {
                        $(".parent-ul>li").removeClass('active');
                        $(this).parent().toggleClass('active');
                    }

                });

                $('html').click(function(e) {
                    if( !$(e.target).closest(".side-menu").find("a").hasClass("menu-bars") ){
                        $(".side-menu ul").removeClass('active');
                    }
                });



                $("#db-table").tablesorter({sortList: [[0,0]]});

            });
        </script>
