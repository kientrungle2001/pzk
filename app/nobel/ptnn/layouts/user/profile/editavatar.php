
<?php 
	$user= pzk_user();
?>

<div id="editavatar">
	<div class="layout_title"> THAY ĐỔI AVATAR</div>
	<div class="clear"></div>
	<div class="avatar">
		<img src="<?php echo $user->getAvatar(); ?>"alt="" width="120px" height="120px">
	</div>
	<div class="note_upload">
		<span class="note_favorite">Lưu ý khi upload ảnh: </span><br>
		<span >Upload ảnh lên từ máy của bạn:Chỉ chấp nhận định dạng ảnh .JPG và .JPEGdung lượng ảnh tối đa 488kb.</span> <br>
		<span>Sau khi upload ảnh thành công, bạn nhấn <a href onclick="pzk_{data.id}.reloadAvatar();">Vào đây</a> để cập nhật ảnh đại diện</span>
	</div>
	<div class="showmessage"></div>
	<div class="clear"></div>
	<div class="show_note">
		<form action="/Profile/postAvatar" method="post" id="frm_upload_avatar" enctype="multipart/form-data" runat="server">
    	
		<input name="fileToUpload" id="fileToUpload" type="file" />
		<input type="submit"   id="btt_upload_avatar" value="Upload" />
		</form>
	</div>

</div>
