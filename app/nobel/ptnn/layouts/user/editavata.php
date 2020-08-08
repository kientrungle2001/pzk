<!DOCTYPE html>
<?php 
$items=_db()->useCB()->select('user.*')->from('user')->where(array('username',pzk_session()->getUsername()))->result_one();
?>
<html>
<body>
<div style="border-width: 1px;border-style: solid; border-color: #FF7357;  width:80%; hight: 80%; ">
<div>
	<img src="<?php echo $items['avata']; ?>"alt="" width="200px" height="200px">
</div>
<form action="/User/editavataPost" method="post" enctype="multipart/form-data">
    Upload ảnh lên từ máy của bạn:Chỉ chấp nhận định dạng ảnh .JPG và .JPEG, dung lượng ảnh tối đa 488kb.
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
</div>
</body>
</html>