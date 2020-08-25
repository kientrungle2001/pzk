<?php if(pzk_session()->getLogin()):?>
	<span id="menu_user">
	<span class="color-white" ><b>
	<?php if(!pzk_session()->getName()) :?> 
		<?=pzk_session()->getUsername()?> 
	<?php else:?> 
		<?=pzk_session()->getName()?> 
	<?php endif;?> 
	</b></span>
	</span>
	<div class="menu_user color-white ">
		<ul>
		    <li><a href="/home/about">Mua tài khoản</a></li>
		    <li><a href="/Profile/detail">Trang cá nhân</a></li>
		</ul>
	</div>
<?php endif; ?>
