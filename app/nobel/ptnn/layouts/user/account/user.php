<?php if(pzk_session()->getLogin()):?>
	<span id="menu_user"><a class="color-white" href="/social/home?member=<?=pzk_session()->getUserId();?>"><b><?php if(empty(pzk_session()->getName())) :?> <?=pzk_session()->getUsername()?> <?php else:?> <?=pzk_session()->getName()?> <?php endif;?> </b></a></span>
	<div class="menu_user color-white ">
		<ul>
		    <li><a href="#">Tài khoản hiện có :<?php echo pzk_user()->getWallets(pzk_session('userId')); ?>vnđ</a></li>
		    
		    <li><a href="/profile/user?member=<?=pzk_session()->getUserId();  ?>">Vào trang cá nhân</a></li>
		    <li><a href="/payment/payment">Nạp tiền</a></li>
		    
		</ul>
	</div>
<?php endif; ?>
