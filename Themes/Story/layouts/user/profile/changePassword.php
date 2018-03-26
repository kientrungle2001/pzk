<div class="profile-change-password bottom20">
	<div class="edit-area">

		<form  id="formEditPass" method="post">
			<div id="mass_editpass"></div>
			<div class="row">
				<div class="col-xs-4">
					<label for="oldpassword">{data.LBL_OLD_PASSWORD} (*):</label>
					<input type="password" 
							id="oldpassword" name="oldpassword" class="form-control sharp"   
							data-toggle="tooltip" data-placement="top" 
							placeholder="{data.PLH_OLD_PASSWORD}" title="{data.VLD_OLD_PASSWORD}"/>
				</div>
			</div>
			<div class="row"> 
				<div class="col-xs-4" >
					<label for="newpassword">{data.LBL_NEW_PASSWORD} (*):</label>
					<input type="password" 
							id="newpassword" name="newpassword" class="form-control sharp"  
							data-toggle="tooltip" data-placement="top" 
							placeholder="{data.PLH_NEW_PASSWORD}" title="{data.VLD_NEW_PASSWORD}"/>
				</div>
				<div class="col-xs-4" >
					<label for="confirmpassword">{data.LBL_CONFIRM_PASSWORD} (*):</label>
					<input type="password" 
							id="confirmpassword" name="confirmpassword" class="form-control sharp" 
							data-toggle="tooltip" data-placement="top" 
							placeholder="{data.PLH_CONFIRM_PASSWORD}"  title="{data.VLD_CONFIRM_PASSWORD}"/>
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