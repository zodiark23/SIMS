
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


                        <span class="input input--kohana">
                            <input class="input__field input__field--kohana" type="text" id="input-29">
                            <label class="input__label input__label--kohana" for="input-29">
                                <i class="fa fa-fw fa-clock-o icon icon--kohana"></i>
                                <span class="input__label-content input__label-content--kohana">Time</span>
                            </label>
                        </span>
                    </div>

                    <?php include_once("side-nav.php") ?>
                </div>
            </div>
        </div>

        
