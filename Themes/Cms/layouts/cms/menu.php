<?php 
		
		$items = $data->getItems();
        $items = buildTree($items);	
?>
		
<ul class="nav navbar-nav navbar-right">
{each $items as $item}
<li class="dropdown"><a class="dropdown-toggle js-activated" href="/{item[alias]}">{item[name]}</a>
	{? if(isset($item['children'])){ 
		$children = $item['children'];
	?}
	<ul class="dropdown-menu">
		{each $children as $subItem}
		<li><a href="/{subItem[alias]}">{subItem[name]}</a></li>
		{/each}
	</ul>
	{? } ?}
</li>
{/each}

<?php if(pzk_session('userId') <= 0):?>
<li>
	<a id="nobelLogin" href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-lg"><span class="glyphicon glyphicon-user"></span> Đăng ký</a></li>
<li>
	<a id="nobelLogin" href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-lg"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a></li>
<?php elseif(pzk_session('userId') >0 ):?>
<li>
	<span  class="color-white user_name pd-left-10"> Xin chào ( {children [id=userAccountUser]} )</span>
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