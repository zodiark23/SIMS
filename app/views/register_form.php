
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="main-container">
            <div class="reg-form-header">
                <div class="back-to-homepage">
                    <a href="<?= BASE_URL ?>"><i class="fas fa-angle-double-left"></i> HOME</a>
                </div>
                <img src="<?=BASE_URL?>/img/logo.png" alt="Luakan National High School">
                <p class="sc-name">Luakan National High School</p>
                <p class="sc-address">Dinalupihan, Bataan 2110</p>
            </div>

            <form action="" id="student-form" class="reg-form">
                <table>
                    <tbody>
                        <tr>
                            <td colspan="7" class="head">Name of Student:</td>
                        </tr>
                        <tr>
                            <td colspan="2">Last:</td>
                            <td colspan="5"><input name="s_last_name" type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="2">First:</td>
                            <td colspan="5"><input name="s_first_name" type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="2">Middle:</td>
                            <td colspan="5"><input name="s_middle_name" type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="head">Sex:</td>
                            <td colspan="3" class="head">Date of Birth (MM,DD,YYYY):</td>
                            <td class="head">Nationality:</td>
                            <td class="head">Place of Birth (City/Town or Province):</td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">
                                <input type="radio" value="1" name="sex" id="s-male">
                                <label for="s-male">Male</label>
                            </td>
                            <td style="width: 100px;">
                                <input type="radio" value="2" name="sex" id="s-female">
                                <label for="s-female">Female</label>
                            </td>
                            <td style="width: 50px;">
                                <input name="s_month" type="number" id="mm">
                            </td>
                            <td style="width: 50px;">
                                <input name="s_day" type="number" id="dd">
                            </td>
                            <td style="width: 100px;">
                                <input name="s_year" type="number" id="yyyy">
                            </td>
                            <td style="width: 150px;"><input name="s_nationality" type="text"></td>
                            <td><input name="s_place_of_birth" type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="head">Elementary School Name:</td>
                            <td class="head">Month/Year of Completion:</td>
                        </tr>
                        <tr>
                            <td colspan="6" ><input name="edu_elementary_name" type="text"></td>
                            <td><input name="edu_elem_year_completed" type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="head">Elementary School Address:</td>
                            <td class="head">Region:</td>
                        </tr>
                        <tr>
                            <td colspan="6" ><input name="edu_elem_address" type="text"></td>
                            <td><input name="s_region" type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="7" class="head">House Number and Street:</td>
                        </tr>
                        <tr>
                            <td colspan="7"><input name="s_house_street_number" type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="7" class="head">Subdivision/Barangay:</td>
                        </tr>
                        <tr>
                            <td colspan="7"><input name="s_sub_barangay" type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="7" class="head">Town/City:</td>
                        </tr>
                        <tr>
                            <td colspan="7"><input name="s_town_city" type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="7" class="head">Province:</td>
                        </tr>
                        <tr>
                            <td colspan="7"><input name="province" type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="head">Telephone Number:</td>
                            <td colspan="5"><input name="s_tel_number" type="number"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="head">Cellphone Number:</td>
                            <td colspan="5"><input name="s_cell_number" type="number"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="head">Email Address:</td>
                            <td colspan="5"><input name="s_email" type="text"></td>
                        </tr>
                    </tbody>
                </table>
                <table style="margin-top: 10px; text-align: center;">
                    <tr>
                        <td><input type="radio" id="new-student" name="enlistment"> <label for="new-student">New Student</label></td>
                        <td><input type="radio" id="transferee" name="enlistment"> <label for="transferee">Transferee</label></td>
                        <td><input type="radio" id="balik-skwela" name="enlistment"> <label for="balik-skwela">Balik-skwela</label></td>
                    </tr>
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
                <a href="javascript: $('#student-form').submit()"><i class="far fa-save"></i> Save</a>
            </div>
            

        </div>

        
    
