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
		<li class="bdbottom bg-danger"><a href="/contest/profile">Tài khoản :<?php echo product_price(pzk_user()->getWallets(pzk_session('userId'))); ?></a></li>
		<li class="bg-danger"><a href="/contest/profile">Trang cá nhân</a></li>
	</ul>
<?php endif; ?>
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>