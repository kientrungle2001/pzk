<?php 
$userId = pzk_or(pzk_request()->getSegment(3), pzk_session()->get('userId'));
$user = $data->getUserById($userId);

  ?>
<div style='margin-top: 50px;' class="container">
	
	<div class="row top20">
		<div class="col-md-4 col-sm-4 avatar">
			<img src="<?php if ($user['avatar']) { echo $user['avatar'];}else{ echo "/Default/skin/nobel/ptnn/media/noavatar.gif";} ?>" alt="trang cá nhân" class="img-circle center-block" style="width:120px; height:120px;">
			
		</div>
		<div class="co-md-8 col-sm-8">
			<div class="profile-detail-area">
				<ul class="list-unstyled">
					<li class="top10"><strong>Họ và tên : </strong> <?php echo $user['name']; ?></li>
					<li class="top10"><strong>Nick name : </strong><?php echo $user['username']; ?></li>
					<li class="top10"><strong>Ngày sinh : </strong><?php echo $user['birthday']; ?></li>
					<li class="top10"><strong>Giới tính : </strong><?php if($user['sex'] == 1){ echo "Nam";}else{ echo "Nữ";} ?></li>
					<li class="top10"><strong>Địa chỉ : </strong><?php echo $user['address']; ?></li>
					<li class="top10"><strong>Trường : </strong><?php echo $user['schoolname']; ?></li>
					<li class="top10"><strong>Lớp: </strong><?php echo $user['class']. $user['classname']; ?></li>
					
				</ul>
				
			</div>
			
		</div>
	</div>
</div>