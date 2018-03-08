
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="main-container">
            <?php include("header.php"); ?>

            <div class="content-container clearfix">
                <div class="banner">
                    <img src="<?=BASE_URL?>/img/banner.jpg">
                </div>

                <div class="links">
                    <ul>
                        <li><a href="">Enroll Online</a></li>
                        <li><a href="">Online Admission</a></li>
                        <li><a href="">Forums</a></li>
                        <li><a href="">Web Mail</a></li>
                    </ul>
                </div>

                <div class="ne-board">
                    <p class="title">News and Events Board</p>

                    <div class="ne-content">
                        <div class="ne-item">
                            <img src="<?=BASE_URL?>/img/lnhs.jpg" alt="" class="ne-item-img">
                            <div class="ne-item-details">
                                <a href="" class="ne-title">Sample Title 1</a>
                                <p class="author-date">By: <a href="">admin</a> on <span class="date">02/26/18</span></p>
                                <p class="ne-p">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis amet minima alias sit dolorem nobis omnis deserunt officiis voluptates. Reiciendis eaque pariatur, aliquam enim sit cupiditate ad itaque officia consequuntur?
                                </p>
                                <a href="" class="readmore">Read more</a>
                            </div>
                        </div>
                        <div class="ne-item">
                            <img src="<?=BASE_URL?>/img/lnhs2.jpg" alt="" class="ne-item-img">
                            <div class="ne-item-details">
                                <a href="" class="ne-title">Sample Title 2</a>
                                <p class="author-date">By: <a href="">admin</a> on <span class="date">02/26/18</span></p>
                                <p class="ne-p">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis amet minima alias sit dolorem nobis omnis deserunt officiis voluptates. Reiciendis eaque pariatur, aliquam enim sit cupiditate ad itaque officia consequuntur?
                                </p>
                                <a href="" class="readmore">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="login-modal">
                <div class="login-box">
                    <a href="#0" class="close">
                        <i class="far fa-times-circle"></i>
                    </a>
                    <img src="<?=BASE_URL?>/img/logo.png" alt="" class="login-logo">

                    <form id="login-form" action="" method="post">
                        <div id="form-message"></div>
                        <input type="text" class="userid" placeholder="User ID" name="userid">
                        <input type="password" class="userpass" placeholder="Password" name="userpass">
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

        


