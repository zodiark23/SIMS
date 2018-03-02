
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="main-container">
            <div class="content-container dashboard">
                <div class="dashboard-container">
                    <div class="content-panel">
                        <table class="db-table admin-tab">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>ID Number</th>
                                    <th>Age</th>
                                    <th>Sex</th>
                                    <th>DoB</th>
                                    <th>Address</th>
                                    <th>Contact Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Reyan Tropia</td>
                                    <td>12345667</td>
                                    <td>99</td>
                                    <td>Male</td>
                                    <td>01/01/91</td>
                                    <td>Olongapo City Home for the Aged</td>
                                    <td>09867286654</td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="db-table admin-tab">
                            <thead>
                                <tr>
                                    <th>Teacher Name</th>
                                    <th>ID Number</th>
                                    <th>Sex</th>
                                    <th>Time</th>
                                    <th>Contact Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Gabriel Montemayor</td>
                                    <td>12345689</td>
                                    <td>Male</td>
                                    <td>8:00 - 17:30</td>
                                    <td>09485768855</td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="db-table admin-tab">
                            <thead>
                                <tr>
                                    <th>News&Events Title</th>
                                    <th>Image</th>
                                    <th>Published By</th>
                                    <th>Date</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Sample title 1</td>
                                    <td><img src="<?=BASE_URL?>/img/lnhs.jpg" alt=""></td>
                                    <td>admin</td>
                                    <td>02/26/18</td>
                                    <td>
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis amet minima alias sit dolorem nobis omnis deserunt officiis voluptates. Reiciendis eaque pariatur, aliquam enim sit cupiditate ad itaque officia consequuntur?
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="side-nav">
                        <div class="admin">
                            <img src="<?=BASE_URL?>/img/reyan.jpg" alt="" class="adm-img">
                            <span class="adm-name">Reyan Tropia <i class="fas fa-user-secret"></i></i></span>
                        </div>

                        <div class="nav-list">
                            <ul>
                                <li><a href="">Admin</a></li>
                                <li><a href="">Students <span class="count">1000</span></a></li>
                                <li><a href="">Teachers <span class="count">20</span></a></li>
                                <li><a href="">News &amp; Events <span class="count">5</span></a></li>
                            </ul>
                        </div>
                        <div class="admin-out">
                            <a href="">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="js/jquery.tablesorter.min.js"></script>
        <script src="js/main.js"></script>
