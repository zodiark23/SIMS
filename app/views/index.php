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
                    <p class="title">News and Events Board</p>

                    <div class="ne-content">
                        <div class="ne-item">
                            <!-- <img src="<?=BASE_URL?>/img/lnhs.jpg" alt="" class="ne-item-img"> -->
                            <div class="ne-item-details">

	                            <?php
	                            if ($this->displayNewsIndex) {

		                            foreach ($this->displayNewsIndex as $result) {

			                            $news_id = $result['news_id'];

			                            if (strlen(htmlspecialchars($result['news_content'])) > 250) {
			                                // News Title
				                            echo "<a class='ne-title'>".$result['news_title']."</a>";
				                            // Publisher and date
                                            echo "<p class='author-date'>"."By: "."<a href='''>"."admin "."</a>". " on " ."<span class='date'>".$result['create_date']."</span></p>";
                                            echo "<p class='ne-p'>";
                                            // Content
                                            echo substr(htmlspecialchars_decode($result['news_content']),0,250)."..."."</td>";
                                            echo "</p>";
                                            // View button
                                            echo "<a data-newsid='".$result['news_id']."' class='ne-title home-view-btn' value='VIEW' name='view-btn' style='font-size:100%;'>VIEW MORE...</a>";

                                            echo "<br>";
				                            echo "<br>";

			                            } else {
			                                // News title
				                            echo "<a class='ne-title'>".$result['news_title']."</a>";
				                            // Publisher and date
				                            echo "<p class='author-date'>"."By: "."<a href='''>"."admin "."</a>". " on " ."<span class='date'>".$result['create_date']."</span></p>";
				                            echo "<p class='ne-p'>";
				                            // News content
				                            echo htmlspecialchars_decode($result['news_content'])."</td>";
				                            echo "</p>";

				                            //View button
				                            echo "<a data-newsid='".$result['news_id']."' class='ne-title home-view-btn' value='VIEW' name='view-btn' style='font-size:100%;'>VIEW MORE... </a>";
				                            echo "<br>";
				                            echo "<br>";
			                            }
		                            }
	                            }else {
		                            echo "No data";
	                            }

	                            ?>

                                <div class='bg-modal'>

                                    <div class='modal-content'>

                                        <div class='close-modal'><i class="far fa-times-circle"></i></div>
                                        <div class='real-content'></div>
                                    </div>
                                </div>
                            </div>
                        </div>
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




