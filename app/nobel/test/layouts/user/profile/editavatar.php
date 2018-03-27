
<?php 
	$user= $data->loadAvatar();
?>

<div id="editavatar">
	<div class="layout_title"> THAY ĐỔI AVATAR</div>
	<div class="clear"></div>
	<div class="avatar">
		<img src="<?php echo $user->get('avatar'); ?>"alt="" width="120px" height="120px">
	</div>
	<div class="showmessage"> <p class="fontmessage"><?php echo $data->get('message'); ?></p></div>
	<div class="showmessage"> <p class="show_error"><?php echo $data->get('error'); ?></p></div>
	<div class="clear"></div>
	<div class="show_note">
		<form action="/Profile/editavatarPost" method="post" id="frm_upload_avatar" enctype="multipart/form-data" runat="server">
    	<span class="show_note">Upload ảnh lên từ máy của bạn:Chỉ chấp nhận định dạng ảnh .JPG và .JPEGdung lượng ảnh tối đa 488kb.</span>
		<input name="fileToUpload" id="fileToUpload" type="file" />
		<input type="submit"   id="btt_upload_avatar" value="Upload" />
		</form>
	</div>

</div>
<script>
	var fileToUpload= $('#fileToUpload').val();
	$('#frm_upload_avatar').submit(function() { 
		if(!fileToUpload){
			alert('chua chon file anh');
			return false;
		}else return true;
	}
</script>