
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
                <form method="post" id="rightsForm">
				<h3 class="dashboard-section-title">Rights</h3>
				<br>
                <div class="legends">
                    <ul>
                        <li><div style="width: 10px; height: 10px; background: #4272d7;"></div> Active role</li>
                        <li><div style="width: 10px; height: 10px; background: #c93c3c;"></div> No access</li>
                    </ul>
                </div>
                <form method="post" id="rightsForm">
				<br>

                <span class="input input--hoshi" style="width:45%">
                    <input value="<?php echo $this->role_name[0]['role_name']; ?>" class="input__field input__field--hoshi" type="text" id="r_name"  name="r_name" >
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="r_name">
                        <span class="input__label-content input__label-content--hoshi">Update Role Name</span>
                    </label>
                </span>

                <br>
                <br>


				<table style="width:100%" class="roles-table">
						<tr>
                            
                                <?php
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
							
						</tr>

                </table>
                    <div style="text-align: center;">
                        <input type="submit" data-target="<?= ($this->role_id ?? "" )?>" id="save-btn">
                        <input type="submit" id="<?= ($this->role_id ?? "" )?>" class="outlined-button delete-role-btn" value="DELETE">
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