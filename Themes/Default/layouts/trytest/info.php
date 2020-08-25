<div class="container fulllook2 text-left">
	<div class="row">
		<div class="col-md-1">&nbsp;</div>			
		<div class="col-xs-11 col-md-11 ">
			<div class="top145 pull-right">
				<a href="<?=FL_URL?>"><h1>FULL LOOK</h1></a>
				<h4>Phần mềm Khảo sát và Phát triển năng lực toàn diện bằng tiếng Anh</h4>
				<?php echo partial('Themes/Default/layouts/home/aboutbtn');?>
			</div>
		</div>
	</div>
</div>

<?php $data->displayChildren('[position=top-menu]') ?>
<style>
	.formtest{
		margin-bottom: 20px;
	}
</style>
<?php $userInfo = $data->getUserInfo(); ?>
<div class='container'>
	<div class='formtest'>
		<h3> Thông tin chi tiết của thí sinh </h3>
		<hr>
		<form action='/trytest/saveUser' method='post'>
		<div class="form-group">
			<label for="nameTrytest">Họ và tên</label>
			<input type="text" name='name' value="<?php echo @$userInfo['name']?>" class="form-control" id="nameTrytest" placeholder="Họ và tên">
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" name='email' value="<?php echo @$userInfo['email']?>" class="form-control" id="email" placeholder="Email">
		</div>
		<div class="form-group">
			<label for="phoneTrytest">Số điện thoại</label>
			<input type="text" name='phone' value="<?php echo @$userInfo['phone']?>" class="form-control" id="phoneTrytest" placeholder="phone">
		</div>
		<div class="form-group">
			<label for="school">Trường</label>
			<input type="text" name='school' value="<?php echo @$userInfo['school']?>" class="form-control" id="school" placeholder="Trường">
		</div>
		<div class="form-group">
			<label for="address">Địa chỉ</label>
			<input type="text" name='address' value="<?php echo @$userInfo['address']?>" class="form-control" id="address" placeholder="Địa chỉ">
		</div>
		<button onclick='return loginTrytest();' type="submit" class="btn btn-primary">Cập nhật</button>
		</form>
		<?php
		$messages = pzk_notifier_messages();
		if($messages) {
			?>
			<?php foreach($messages as $item): ?>
			<h4 style="color: red;"><?php echo @$item['message']?></h4>
			<?php endforeach; ?>
		<?php } ?>
	</div>
</div>

<script>
function loginTrytest() {
	username = $('#nameTrytest').val();
	if(!username) {
		alert('Họ và tên không được để trống');
		$('#nameTrytest').focus();
		return false;
	}
	email = $('#email').val();
	if(!email) {
		alert('Email không được để trống');
		$('#email').focus();
		return false;
	}
	phone = $("#phoneTrytest").val();
	if(!phone) {
		alert('Phone không được để trống');
		$('#phoneTrytest').focus();
		return false;
	}
}
</script>