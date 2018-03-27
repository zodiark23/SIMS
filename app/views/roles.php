
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->


<!-- TODO :
Fix the UI @morbid
    -->

<div class="main-container">
	<div class="content-container dashboard">
		<div class="dashboard-container">
			<div class="content-panel">
                <h3 class="dashboard-section-title">Role</h3>
                <form id="create-role-form">
                    <div class='error_role_form'></div>
                    <span class="input input--hoshi" style="width:45%">
                    <input value="" class="input__field input__field--hoshi" type="text" id="r_name"  name="r_name">
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="r_name">
                        <span class="input__label-content input__label-content--hoshi">Role Name</span>
                    </label>
                </span>

                    <br>
                    <br>

                    <input type="submit" class="outlined-button" value="Add" />
                </form>

                <br>
                <br>
				<h3 class="dashboard-section-title">Manage Roles</h3>
                <table style="width:100%" class="content-panel-table">
                    <tr>
                        <th>Role Name</th>
                        <th>Action</th>
                    </tr>
                    
                            <?php

                            foreach($this->roles as $row)
                            {
                                echo "<tr>
                                <td>" . strtoupper($row['role_name']) . "</td>
                                <td><a  href='".BASE_URL."/admin/manage_roles/".$row['role_id']."' id='".$row['role_id']."' class='tbl-edit-btn'>Edit Rights</a></td>
                                </tr>";
                            }
                            ?>

                </table>
                <br>
                <br>
                <br>
                <br>





			</div>


			<?php include_once("side-nav.php") ?>
		</div>
	</div>
</div>
