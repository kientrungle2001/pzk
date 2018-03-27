<?php if(pzk_session()->getLogin()):?>
	<span id="menu_user"><a class="color-white" href="/social/home?member=<?=pzk_session()->getUserId();?>"><b><?php if(empty(pzk_session()->get('name'))) :?> <?=pzk_session()->get('username')?> <?php else:?> <?=pzk_session()->get('name')?> <?php endif;?> </b></a></span>
	<div class="menu_user color-white ">
		<ul>
		    <li><a href="#">Tài khoản hiện có :<?php echo pzk_user()->getWallets(pzk_session('userId')); ?>vnđ</a></li>
		    
		    <li><a href="/profile/user?member=<?=pzk_session()->getUserId();  ?>">Vào trang cá nhân</a></li>
		    <li><a href="/payment/payment">Nạp tiền</a></li>
		    
		</ul>
	</div>
<?php endif; ?>
