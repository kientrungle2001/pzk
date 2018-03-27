{? 
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 	12);
$mdsize 	= pzk_or($data->get('mdsize'), 	12);
?}

<div class="col-xs-{xssize} col-md-{mdsize}">
	<div class="form-group clearfix">
		<label for="{? echo $data->get('index')?}{rand}">{? echo $data->get('label')?}</label>
		<select
			class="form-control" id="{? echo $data->get('index')?}{rand}"
			name="{? echo $data->get('index')?}">
        <?php
								$allControllers = array ();
								$arrcontroller = glob ( BASE_DIR . '/app/' . pzk_app ()->getPathByName () . '/controller/Admin/*.php' );
								$subs = glob ( BASE_DIR . '/app/' . pzk_app ()->getPathByName () . '/controller/Admin/*/*.php' );
								$arrSubController = array ();
								foreach ( $subs as $sub ) {
									$arrsub = explode ( '/', $sub );
									$countarr = count ( $arrsub );
									$arrSubController [] = $arrsub [$countarr - 2] . '_' .  substr ( end ( $arrsub ), 0, - 4 );
								}
								
								?>
        <option
				value="<?php if(pzk_request('action') =='add') { echo '0_'.time(); } elseif(substr($data->get('value'), 0, 2) == '0_') { echo $data->get('value'); } ?>">Chọn
				controller</option>
		{each $arrcontroller as $val }
		<?php if (!isset($allControllers[$val])) { $allControllers[$val] = true; } else { continue; } ?>
		<option
				value="<?php echo 'Admin_'.basename($val,".php");  ?>">
				<?php echo 'Admin_'.basename($val,".php");  ?></option>
		{/each}
        {each $arrSubController as $val }
		<?php if (!isset($allControllers[$val])) { $allControllers[$val] = true; } else { continue; } ?>
        <option value="<?php echo 'Admin_'.$val;  ?>">
            <?php echo 'Admin_'.$val;  ?></option>
        {/each}
		<?php
		$arrcontroller = glob ( BASE_DIR . '/app/' . pzk_app ()->getPackageByName () . '/controller/Admin/*.php' );
		$subs = glob ( BASE_DIR . '/app/' . pzk_app ()->getPackageByName () . '/controller/Admin/*/*.php' );
		$arrSubController = array ();
		foreach ( $subs as $sub ) {
			$arrsub = explode ( '/', $sub );
			$countarr = count ( $arrsub );
			$arrSubController [] = $arrsub [$countarr - 2] . '_' . substr ( end ( $arrsub ), 0, - 4 );
		}
		
		?>
		{each $arrcontroller as $val }
		<?php if (!isset($allControllers[$val])) { $allControllers[$val] = true; } else { continue; } ?>
		<option
				value="<?php echo 'Admin_'.basename($val,".php");  ?>">
				<?php echo 'Admin_'.basename($val,".php");  ?></option>
		{/each}
        {each $arrSubController as $val }
		<?php if (!isset($allControllers[$val])) { $allControllers[$val] = true; } else { continue; } ?>
        <option value="<?php echo 'Admin_'.$val;  ?>">
            <?php echo 'Admin_'.$val;  ?></option>
        {/each}
		<?php
		$arrcontroller = glob ( BASE_DIR . '/Default/controller/Admin/*.php' );
		$subs = glob ( BASE_DIR . '/Default/controller/Admin/*/*.php' );
		$arrSubController = array ();
		foreach ( $subs as $sub ) {
			$arrsub = explode ( '/', $sub );
			$countarr = count ( $arrsub );
			$arrSubController [] = $arrsub [$countarr - 2] . '_' . substr ( end ( $arrsub ), 0, - 4 );
		}
		
		?>
		{each $arrcontroller as $val }
		<?php if (!isset($allControllers[$val])) { $allControllers[$val] = true; } else { continue; } ?>
		<option
				value="<?php echo 'Admin_'.basename($val,".php");  ?>">
				<?php echo 'Admin_'.basename($val,".php");  ?></option>
		{/each}
        {each $arrSubController as $val }
		<?php if (!isset($allControllers[$val])) { $allControllers[$val] = true; } else { continue; } ?>
        <option value="<?php echo 'Admin_'.$val;  ?>">
            <?php echo 'Admin_'.$val;  ?></option> {/each}
		</select>
		<script type="text/javascript">
		
			
			
			var my_options = $("#{? echo $data->get('index')?}{rand} option");

			my_options.sort(function(a,b) {
				if (a.text > b.text) return 1;
				else if (a.text < b.text) return -1;
				else return 0
			})

			$("#{? echo $data->get('index')?}{rand}").empty().append( my_options );
			$("#{? echo $data->get('index')?}{rand} option").each(function(){
			  $(this).siblings("[value="+ this.value+"]").remove();
			});
		</script>
	</div>
</div>
<script>
	$("#{? echo $data->get('index')?}{rand}").val("<?php echo $data->get('value'); ?>");
		
</script>
