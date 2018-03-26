<?php if(pzk_session()->get('login')):?>
	<span id="menu_user">
	<a href="/Profile/detail"><span style="color:white!important;"><b>
	<?php if(!pzk_session()->get('name')) :?> 
		<?=pzk_session()->get('username')?> 
	<?php else:?> 
		<?=pzk_session()->get('name')?> 
	<?php endif;?> 
	</b></span>
	</span></a>
	<ul class="dropdown-menu col-xs-12 ">
		<li class="bdbottom bg-danger hidden-xs"><a href="/home/about">Mua tài khoản</a></li>
		<li class="bg-danger"><a href="/Profile/detail">Trang cá nhân</a></li>
	</ul>
<?php endif; ?>
