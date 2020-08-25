<?php  $user= pzk_user(); ?>
<div class="row">
	<form action="/profile/changeAvatarPost" method="post" id="frm_upload_avatar" 
				enctype="multipart/form-data" runat="server">
		<legend>Thay đổi Avatar</legend>

		<div class="form-group">
			<div class="col-xs-12">
				<img src="<?php echo $user->getavatar()?>" alt="<?php echo $user->getUsername()?>" class="img-circle" style="width: 120px; height: 120px">
			</div>
			<div class="show-message"></div>
			<div class="col-xs-12">
				<span class="top10"><?php echo @$data->LBL_UPLOAD_AVATAR?></span>
				<input name="fileToUpload" id="fileToUpload" type="file" class="sharp top10" />
				<input id="btt_upload_avatar" type="submit" class="btn btn-primary sharp top10" value="Upload" />
				<button type="button" class="btn sharp top10" onclick="$('.profile-edit-area').hide(); $('.profile-detail-area').show(); return false;">Hủy</button>	
			</div>
		
		</div>
		
	</form>	
</div>
