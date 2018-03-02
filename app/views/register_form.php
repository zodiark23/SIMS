
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="main-container">
            <div class="reg-form-header">
                <div class="back-to-homepage">
                    <a href="index2.html"><i class="fas fa-angle-double-left"></i> HOME</a>
                </div>
                <img src="<?=BASE_URL?>/img/logo.png" alt="Luakan National High School">
                <p class="sc-name">Luakan National High School</p>
                <p class="sc-address">Dinalupihan, Bataan 2110</p>
            </div>

            <form action="" class="reg-form">
                <table>
                    <tbody>
                        <tr>
                            <td colspan="7" class="head">Name of Student:</td>
                        </tr>
                        <tr>
                            <td colspan="2">Last:</td>
                            <td colspan="5"><input type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="2">First:</td>
                            <td colspan="5"><input type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="2">Middle:</td>
                            <td colspan="5"><input type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="head">Sex:</td>
                            <td colspan="3" class="head">Date of Birth (MM,DD,YYYY):</td>
                            <td class="head">Nationality:</td>
                            <td class="head">Place of Birth (City/Town or Province):</td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">
                                <input type="radio" name="sex" id="s-male">
                                <label for="s-male">Male</label>
                            </td>
                            <td style="width: 100px;">
                                <input type="radio" name="sex" id="s-female">
                                <label for="s-female">Female</label>
                            </td>
                            <td style="width: 50px;">
                                <input type="number" id="mm">
                            </td>
                            <td style="width: 50px;">
                                <input type="number" id="dd">
                            </td>
                            <td style="width: 100px;">
                                <input type="number" id="yyyy">
                            </td>
                            <td style="width: 150px;"><input type="text"></td>
                            <td><input type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="head">Elementary School Name:</td>
                            <td class="head">Month/Year of Completion:</td>
                        </tr>
                        <tr>
                            <td colspan="6" ><input type="text"></td>
                            <td><input type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="head">Elementary School Address:</td>
                            <td class="head">Region:</td>
                        </tr>
                        <tr>
                            <td colspan="6" ><input type="text"></td>
                            <td><input type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="7" class="head">House Number and Street:</td>
                        </tr>
                        <tr>
                            <td colspan="7"><input type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="7" class="head">Subdivision/Barangay:</td>
                        </tr>
                        <tr>
                            <td colspan="7"><input type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="7" class="head">Town/City:</td>
                        </tr>
                        <tr>
                            <td colspan="7"><input type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="7" class="head">Province:</td>
                        </tr>
                        <tr>
                            <td colspan="7"><input type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="head">Telephone Number:</td>
                            <td colspan="5"><input type="number"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="head">Cellphone Number:</td>
                            <td colspan="5"><input type="number"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="head">Email Address:</td>
                            <td colspan="5"><input type="text"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="acknowledgement">
                    <p>I understand that all information I provide in this form may be used by the Department of Education and I consent to such with the assurance that my personal details will be kept confidential.</p>
                </div>
                <div class="signature">
                    <div class="st-name">
                        <input type="text" id="st-name">
                        <p>Signature over Printed Name of the Student</p>
                    </div>
                    <div class="reg-date">
                        <input type="text" id="reg-date">
                        <p>Date</p>
                    </div>
                </div>
            </form>

            <div class="print-btn">
                <a href="javascript:void(0)"><i class="far fa-save"></i> Save</a>
            </div>

        </div>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="js/main.js"></script>
    
