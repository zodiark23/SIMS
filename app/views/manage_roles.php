
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
				<h3 class="dashboard-section-title">Rights</h3>
				<br>
				<br>

                <form method="post" id="rightsForm">
				<table style="width:100%" class="roles-table">
						<tr>
                            <td>
                                <?php
//                                $rolesname = $_SESSION['rolename'];


                                foreach($this->rights_list as $row)
                                {
                                    $checked = "";
                                    $rightsID = $row['rights_id'];
                                    $rightscode = $row['rights_code'];

                                    if( in_array($rightscode, $this->currentRights)){
                                        $checked = "checked";
                                    }

	                                echo "<td><label><input type='checkbox' name='rights[]' class=".$rightscode." value=".$rightsID." $checked><span>" . str_replace("_"," ",$rightscode) . "</span></label></td>";

                                }

                                ?>
							</td>
						</tr>

                </table>
                    <div style="text-align: center;">
                        <input type="submit" data-target="<?= ($this->role_id ?? "" )?>" id="save-btn">
                    </div>
                </form>

			</div>

			<?php include_once("side-nav.php") ?>
		</div>
	</div>
</div>

<script>
    $(document).ready(function(){
        if ( $('.roles-table tr td label checkbox').is(':checked') ) {
            console.log("checked");
        }
        $('.roles-table tr td label').click(function(){
            $(this).find('checkbox').attr('checked');
        });
    });
</script>