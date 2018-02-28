
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="main-container">
            <?php include("header.php"); ?>

            <div class="content-container clearfix">
                <div class="facilities-container">
                    <div class="facilities-img">
                        <a href="<?=BASE_URL?>/img/fac-1.jpg" data-lightbox="facilities">
                            <img src="<?=BASE_URL?>/img/fac-1.jpg" alt="">
                        </a>
                        <a href="<?=BASE_URL?>/img/fac-2.jpg" data-lightbox="facilities">
                            <img src="<?=BASE_URL?>/img/fac-2.jpg" alt="">
                        </a>
                        <a href="<?=BASE_URL?>/img/fac-3.jpg" data-lightbox="facilities">
                            <img src="<?=BASE_URL?>/img/fac-3.jpg" alt="">
                        </a>
                        <a href="<?=BASE_URL?>/img/fac-4.jpg" data-lightbox="facilities">
                            <img src="<?=BASE_URL?>/img/fac-4.jpg" alt="">
                        </a>
                        <a href="<?=BASE_URL?>/img/fac-5.jpg" data-lightbox="facilities">
                            <img src="<?=BASE_URL?>/img/fac-5.jpg" alt="">
                        </a>
                        <a href="<?=BASE_URL?>/img/fac-6.jpg" data-lightbox="facilities">
                            <img src="<?=BASE_URL?>/img/fac-6.jpg" alt="">
                        </a>
                        <a href="<?=BASE_URL?>/img/fac-7.jpg" data-lightbox="facilities">
                            <img src="<?=BASE_URL?>/img/fac-7.jpg" alt="">
                        </a>
                        <a href="<?=BASE_URL?>/img/fac-8.jpg" data-lightbox="facilities">
                            <img src="<?=BASE_URL?>/img/fac-8.jpg" alt="">
                        </a>
                        <a href="<?=BASE_URL?>/img/fac-9.jpg" data-lightbox="facilities">
                            <img src="<?=BASE_URL?>/img/fac-9.jpg" alt="">
                        </a>
                        <a href="<?=BASE_URL?>/img/fac-10.jpg" data-lightbox="facilities">
                            <img src="<?=BASE_URL?>/img/fac-10.jpg" alt="">
                        </a>
                        <a href="<?=BASE_URL?>/img/fac-11.jpg" data-lightbox="facilities">
                            <img src="<?=BASE_URL?>/img/fac-11.jpg" alt="">
                        </a>
                        <a href="<?=BASE_URL?>/img/fac-12.jpg" data-lightbox="facilities">
                            <img src="<?=BASE_URL?>/img/fac-12.jpg" alt="">
                        </a>
                        <a href="<?=BASE_URL?>/img/fac-13.jpg" data-lightbox="facilities">
                            <img src="<?=BASE_URL?>/img/fac-13.jpg" alt="">
                        </a>
                        <a href="<?=BASE_URL?>/img/fac-14.jpg" data-lightbox="facilities">
                            <img src="<?=BASE_URL?>/img/fac-14.jpg" alt="">
                        </a>
                    </div>
                </div>
            </div>

            <div class="login-modal">
                <div class="login-box">
                    <a href="#0" class="close">
                        <i class="far fa-times-circle"></i>
                    </a>
                    <img src="<?=BASE_URL?>/img/logo.png" alt="" class="login-logo">

                    <form action="">
                        <input type="text" class="userid" placeholder="User ID">
                        <input type="password" class="userpass" placeholder="Password">
                        <button class="login-btn">LOGIN</button>
                    </form>
                </div>
            </div>

            <div class="footer">
                <div class="footer-content">
                    <ul class="clearfix">
                        <li><a href=""><i class="fas fa-mobile"></i> 09896676789</a></li>
                        <li><a href=""><i class="fas fa-phone"></i> (+63 2) 621-6534</a></li>
                        <li><a href=""><i class="far fa-envelope"></i> lnhs@gmail.com</a></li>
                    </ul>
                    <p class="copyright">Copyright <i class="far fa-copyright"></i> 2018</p>
                </div>
            </div>
        </div>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?=BASE_URL?>/js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="<?=BASE_URL?>/js/swiper.min.js"></script>
        <script src="<?=BASE_URL?>/js/lightbox.js"></script>
        <script src="<?=BASE_URL?>/js/main.js"></script>
        <script>
            $(document).ready(function(){
                $(".login a").on("click", function(){
                    $(".login-modal").addClass("active");
                });

                $(".close").on("click", function(){
                    $(this).parents().removeClass("active");
                }); 
            });
        </script>

