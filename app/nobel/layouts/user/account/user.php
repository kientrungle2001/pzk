<?php if(pzk_session()->getLogin()):?>
	<span id="menu_user">
	<span class="color-white" ><b>
	<?php if(!pzk_session()->get('name')) :?> 
		<?=pzk_session()->get('username')?> 
	<?php else:?> 
		<?=pzk_session()->get('name')?> 
	<?php endif;?> 
	</b></span>
	</span>
	<div class="menu_user color-white ">
		<ul>
		    <!-- <li><a href="/payment/bank">Mua tài khoản</a></li> -->
		    <li><a href="<?=BASE_URL?>/profile/detail">Trang cá nhân</a></li>
		</ul>
	</div>
<?php endif; ?>
