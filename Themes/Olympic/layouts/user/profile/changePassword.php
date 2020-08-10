<div class="profile-change-password bottom20">
	<div class="edit-area">

		<form  id="frmeditPass" method="post">
			<div id="mass_editpass"></div>
			<div class="row">
				<div class="col-xs-4">
					<label for="epass_oldpass"><?php echo @$data->LBL_OLD_PASSWORD?> (*):</label>
					<input type="password" 
							id="epass_oldpass" name="epass_oldpass" class="form-control sharp"   
							data-toggle="tooltip" data-placement="top" 
							placeholder="<?php echo @$data->PLH_OLD_PASSWORD?>" title="<?php echo @$data->VLD_OLD_PASSWORD?>"/>
				</div>
			</div>
			<div class="row"> 
				<div class="col-xs-4" >
					<label for="epass_newpass"><?php echo @$data->LBL_NEW_PASSWORD?> (*):</label>
					<input type="password" 
							id="epass_newpass" name="epass_newpass" class="form-control sharp"  
							data-toggle="tooltip" data-placement="top" 
							placeholder="<?php echo @$data->PLH_NEW_PASSWORD?>" title="<?php echo @$data->VLD_NEW_PASSWORD?>"/>
				</div>
				<div class="col-xs-4" >
					<label for="epass_cfrpass"><?php echo @$data->LBL_CONFIRM_PASSWORD?> (*):</label>
					<input type="password" 
							id="epass_cfrpass" name="epass_cfrpass" class="form-control sharp" 
							data-toggle="tooltip" data-placement="top" 
							placeholder="<?php echo @$data->PLH_CONFIRM_PASSWORD?>"  title="<?php echo @$data->VLD_CONFIRM_PASSWORD?>"/>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 top10" style="margin-top: 10px;" >
					<button type="submit"  class="btn btn-primary sharp">Cập Nhật</button>
					<button type="button" class="btn sharp" 
							onclick="$('.profile-edit-area').hide(); 
									$('.profile-detail-area').show(); return false;">Hủy</button>
				</div>
			</div>
		</form>  
	</div>
</div>