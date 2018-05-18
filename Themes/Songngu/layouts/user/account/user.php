<?php $language = pzk_global()->get('language'); ?>
<?php if(pzk_session()->get('login')):?>
	<span id="menu_user">
	<span class="color-white" ><b>
	<?php if(!pzk_session()->get('name')) :?> 
		<?=pzk_session()->get('username')?> 
	<?php else:?> 
		<?=pzk_session()->get('name')?> 
	<?php endif;?> 
	</b></span>
	</span>
	<ul class="dropdown-menu col-xs-12 ">
		<li class="bdbottom bg-danger hidden-xs"><a href="#"><?=$language['wallet_account'];?> :<?php echo product_price(pzk_user()->getWallets(pzk_session('userId'))); ?></a></li>
		<?php if(pzk_session('adminUser') && pzk_session('adminUser') == pzk_session('username') ): ?>
		<li class="bg-danger"><a href="/Monitor/index">Trang quản trị</a></li>
		<?php if(pzk_session('adminClassname')): ?>
			<li class="bg-danger"><a href="/Profile/teacher">Lịch giảng</a></li>
		<?php endif;?>	
		<?php else: ?>
		<li class="bdbottom bg-danger hidden-xs"><a href="/Home/detail"><?=$language['purchase'];?></a></li>
		<li class="bg-danger"><a href="/Profile/detail"><?=$language['personal-page'];?></a></li>
		<?php endif;?>
	</ul>
<?php endif; ?>
