
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="main-container">
            <?php include("header.php"); ?>

            <div class="content-container clearfix">
                <div class="mv-container">
                    <p class="mv-title">Vision</p>
                    <p class="mv-content">
                        Luakan High School is to be known as a model school, high standard in both academic and co-curricular affairs, a show window of Dep Ed Programs and Projects that prepares the students for college work or for the world of work, a globally competitive organization in many respects, Pro-God, Pro-People, Pro-Environment and Pro-Philippines. <br> <br>

                        Teachers are empowered with missionary spirits and working for the common good, loving, caring and concern to the welfare of students with high self-esteem, progressive, high dignity, committed, compassionate and self-less. <br> <br>
                            
                        Students are empowered with high self-esteem, high morale, with positive values, with great and contagious enthusiasm for learning and for developing their total person. <br> <br>
                            
                        Parents are empowered to support the school, always that ready to help the organization move forward in all aspects. <br> <br>
                            
                        Principal is empowered with high emotional and intellectual intelligence, compassionate and committed to make this vision to reality. 
                    </p>

                    <p class="mv-title">Mission</p>
                    <p class="mv-content">
                        1. Provides a learner-friendly environment that stimulates and catalyzes individual learning through an interactive process. <br> <br>
                        2. Uses the best available instructional materials and technologies to bring the world into the classroom. <br> <br>
                        3. Equips the students with varied skills in higher intellectual operations, critical and creative thinking in accessing, interpreting, analyzing, communicating information that they are provided to continue on learning on their own. <br> <br>
                        4. Develops the students to form desirable attitudes, and imbibe moral and spiritual values for understanding the nature and purpose of the human person. <br> <br>
                        5. Sustains itself on the partnerships and networking establish with and in the community where all linkages are made aware and encouraged to support the adoption of modernization in the school
                    </p>
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

