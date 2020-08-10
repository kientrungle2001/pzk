<?php 
		
		$items = $data->getItems();
        $items = buildTree($items);	
?>
		
<ul class="nav navbar-nav navbar-right">
<?php foreach($items as $item): ?>
<li class="dropdown"><a class="dropdown-toggle js-activated" href="/<?php echo @$item['alias']?>"><?php echo @$item['name']?></a>
	<?php  if(isset($item['children'])){ 
		$children = $item['children'];
	?>
	<ul class="dropdown-menu">
		<?php foreach($children as $subItem): ?>
		<li><a href="/<?php echo @$subItem['alias']?>"><?php echo @$subItem['name']?></a></li>
		<?php endforeach; ?>
	</ul>
	<?php  } ?>
</li>
<?php endforeach; ?>

<?php if(pzk_session('userId') <= 0):?>
<li>
	<a id="nobelLogin" href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-lg"><span class="glyphicon glyphicon-user"></span> Đăng ký</a></li>
<li>
	<a id="nobelLogin" href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-lg"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a></li>
<?php elseif(pzk_session('userId') >0 ):?>
<li>
	<span  class="color-white user_name pd-left-10"> Xin chào ( <?php $data->displayChildren('[id=userAccountUser]') ?> )</span>
</li>
<li>
	<a  href="<?=BASE_REQUEST?>/account/logout"><span>Thoát</span></a>
</li>
<?php endif; ?>
</ul>
<style>
.user_name {
	margin-top: 15px;
	display: inline-block;
}
</style>