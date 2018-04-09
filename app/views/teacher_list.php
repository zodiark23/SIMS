<?php @session_start();?>
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
                        <li><a href="<?=BASE_URL?>/home/register">Enroll Online</a></li>
                        <li><a href="<?=BASE_URL?>/home/teachers">Teachers</a></li>
                    </ul>
                </div>

                <div class="ne-board">
                    <p class="title">Teachers</p>

                    <div class="ne-content">

                    <?php

                    if($this->teachers){
                        
                        foreach($this->teachers as $teacher){

                    

                    ?>
                        <div class='teacher-box'>
                            <div class="teacher-user-img">
                                <img src="<?=BASE_URL?>/<?= $this->profileImage[$teacher['teacher_id']] ?? '' ?>" />
                            </div>

                            <div class="teacher-info">
                                <span><?= $teacher['first_name'] ?? ''?> <?= $teacher['middle_name'] ?? ''?> <?= $teacher['last_name'] ?? ''?></span>

                                <p> Teacher </p>
                            </div>
                        </div>
	                           
                    <?php

                        }
                    }

                    ?>

                                
                    </div>
                </div>
            </div>

            <div class="login-modal">
                <div class="login-box">
                    <a href="<?=BASE_URL?>" class="close">
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

                $(".readmore").click(function(){
                    $(this).parent().find(".ne-p").addClass('active')
                });
            });
        </script>




