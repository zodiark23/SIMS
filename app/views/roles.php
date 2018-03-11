
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
				<h3 class="dashboard-section-title">Roles</h3>
				<br>
				<br>
                <table style="width:100%">
                    <tr>
                            <a href='<?=BASE_URL?>/admin/manage_roles'>
                            <?php

                            foreach($this->roles as $row)
                            {
	                            echo "<td><a class='outlined-button' name='role' href='".BASE_URL."/admin/manage_roles/".$row['role_id']."' id='".$row['role_id']."' >" . strtoupper($row['role_name']) . "</a></td>";
                            }
                            ?>
                            </a>
                    </tr>

                </table>

			</div>

			<?php include_once("side-nav.php") ?>
		</div>
	</div>
</div>
