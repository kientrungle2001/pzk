<?php
$controller = pzk_controller();
$request = pzk_request();
$sortFields = $data->get('sortFields');
$filedFilters = $data->get('filterFields');
$searchFields = $data->get('searchFields');
$Searchlabels = $data->get('searchLabels');
//type setting
$listSettingType = $data->get('listSettingType');
$listFieldSettings = $data->get('listFieldSettings');

$orderBy = $data->get('orderBy');
$pageSize = $data->get('pageSize');

$keyword = $data->get('keyword');
$records = $data->getItems($keyword, $searchFields);
$countItems = $data->getCountItems($keyword, $searchFields);
$pages = ceil($countItems / $data->get('pageSize'));
$actions = $data->get('actions');
//build data parent
if($listSettingType =='parent') {
	// require_once BASE_DIR . '/lib/recursive.php';
	$items = treefy($records);
} else {
	$items = $records;
}
$quickMode = $data->get('quickMode');
$columnDisplay = $data->get('columnDisplay');
$normalMode = true;
if($quickFieldSettings = $data->get('quickFieldSettings')) {
	// nothing
} else {
	$quickFieldSettings = array(
		array(
			'index'	=> 'name',
			'type'	=> 'text',
			'label'	=> 'Tiêu đề'
		)
	);
}


if($quickMode) {
	$listFieldSettings = $quickFieldSettings;
	$colSize = 2;
	$normalMode = false;
	$data->set('quickMode', true);
} else {
	$colSize = 10;
	$normalMode = true;
	$data->set('quickMode', false);
}
?>
<?php if(!pzk_request()->get('isAjax')):?>
<style type="text/css">
h4 {
	font-size: 14px!important;
}
</style>
<style type="text/css">
table .header-fixed {
  position: fixed;
  top: 40px;
  z-index: 1020; /* 10 less than .navbar-fixed to prevent any overlap */
  border-bottom: 1px solid #d5d5d5;
  -webkit-border-radius: 0;
     -moz-border-radius: 0;
          border-radius: 0;
  -webkit-box-shadow: inset 0 1px 0 #fff, 0 1px 5px rgba(0,0,0,.1);
     -moz-box-shadow: inset 0 1px 0 #fff, 0 1px 5px rgba(0,0,0,.1);
          box-shadow: inset 0 1px 0 #fff, 0 1px 5px rgba(0,0,0,.1);
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false); /* IE6-9 */
}
</style>
<script type="text/javascript">
(function($) {

$.fn.fixedHeader = function (options) {
 var config = {
   topOffset: 40,
   bgColor: '#EEEEEE'
 };
 if (options){ $.extend(config, options); }

 return this.each( function() {
  var o = $(this);

  var $win = $(window)
    , $head = $('thead.header', o)
    , isFixed = 0;
  var headTop = $head.length && $head.offset().top - config.topOffset;

  function processScroll() {
    if (!o.is(':visible')) return;
    var i, scrollTop = $win.scrollTop();
    var t = $head.length && $head.offset().top - config.topOffset;
    if (!isFixed && headTop != t) { headTop = t; }
    if      (scrollTop >= headTop && !isFixed) { isFixed = 1; }
    else if (scrollTop <= headTop && isFixed) { isFixed = 0; }
    isFixed ? $('thead.header-copy', o).removeClass('hide')
            : $('thead.header-copy', o).addClass('hide');
  }
  $win.on('scroll', processScroll);

  // hack sad times - holdover until rewrite for 2.1
  $head.on('click', function () {
    if (!isFixed) setTimeout(function () {  $win.scrollTop($win.scrollTop() - 47) }, 10);
  })

  $head.clone().removeClass('header').addClass('header-copy header-fixed').appendTo(o);
  var ww = [];
  o.find('thead.header > tr:first > th').each(function (i, h){
    ww.push($(h).width());
  });
  $.each(ww, function (i, w){
    o.find('thead.header > tr > th:eq('+i+'), thead.header-copy > tr > th:eq('+i+')').css({width: w});
  });

  o.find('thead.header-copy').css({ margin:'0 auto',
                                    width: o.width(),
                                   'background-color':config.bgColor });
  processScroll();
 });
};

$(function() {
	$('.table-fixed-header').fixedHeader();
});

})(jQuery);

</script>
<div class="row">
	<div id="grid-nav" class="col-sm-2">
	{children [role=nav]}
	</div>
	
	<div id="grid-list" class="col-sm-{colSize}">
		<!-- Show data -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<a class="btn  btn-xs btn-danger" href="/Admin_home/index" data-toggle="tooltip" data-placement="top" title="Trang Tổng"><span class="glyphicon glyphicon-dashboard"></span></a>
				<a class="btn  btn-xs btn-primary" href="#" onclick="pzk_list.toggleNavigation(); return false;" data-toggle="tooltip" data-placement="top" title="Thu gọn Bên Trái"><span class="glyphicon glyphicon-indent-right"></span></a>
				<a class="btn  btn-xs btn-primary" href="#" onclick="pzk_list.togglePadding(); return false;" data-toggle="tooltip" data-placement="top" title="Thu gọn dòng"><span class="glyphicon glyphicon-resize-small"></span></a>
				
				<a class="btn  btn-xs btn-primary" href="#" onclick="pzk_list.toggleLabel(); return false;" data-toggle="tooltip" data-placement="top" title="Thu gọn nhãn"><span class="glyphicon glyphicon-tasks"></span></a>
				
				<b>{ifprop title}{? echo $data->get('title') ?}{else}{? echo $request->get('controller') ?}/{? echo $request->get('action') ?}{/if}</b>
				<a style="margin-left: 5px;" class="btn  btn-xs btn-primary pull-right" href="#" onclick="pzk_list.verify();" data-toggle="tooltip" data-placement="top" title="Kiểm tra"><span class="glyphicon glyphicon-warning-sign"></span></a>
				<a style="margin-left: 5px;" class="btn  btn-xs btn-primary pull-right" href="{url /Admin}_{? echo $data->get('module') ?}/changeQuickMode" data-toggle="tooltip" data-placement="top" title="Xem Nhanh"><span class="glyphicon glyphicon-list-alt"></span></a>
				<a style="margin-left: 5px;" class="btn  btn-xs btn-primary pull-right" href="#" onclick="$('#columnDialog').modal('show'); return false;" data-toggle="tooltip" data-placement="top" title="Ẩn / Hiện Cột"><span class="glyphicon glyphicon-th"></span></a>
				<?php if($data->get('checkAdd')) { ?>
					<a style="margin-left: 10px;" class="btn  btn-xs btn-primary pull-right" href="{url /Admin}_{? echo $data->get('module') ?}/add"><span class="glyphicon glyphicon-plus"></span> {ifvar normalMode}{? echo $data->get('addLabel') ?}{/if}</a>
				<?php } ?>
				<span class="pull-right">
				{children [role=filter]}
				</span>
				<?php
				//add more menu link
				if($data->get('links')) {
					foreach($data->get('links') as $val) {
						
						?>
							<a target="{val[target]}" style="margin-left: 10px;" class="btn  btn-xs btn-primary pull-right " href="{val[href]}">{val[name]}</a>
						<?php
					}
				}
				?>

			</div>
			<div id="admin_table_{? echo $data->get('id') ?}" class="table table-hover table-bordered table-striped table-condensed">
				<div class="header">
				<div>
					<span><input type="checkbox" id="selecctall"/></span>
					<span>#</span>
					{each $listFieldSettings as $field}
					{? if ($columnDisplay && !@$columnDisplay[$field['index']]) { continue; }
					if(@$field['role'] && pzk_session('adminLevel') != @$field['role']) {continue;}
					?}
					<span>
					<span title="{field[label]}" class="glyphicon glyphicon-remove-circle column-toogle-{field[index]}" style="cursor: pointer;" onclick="pzk_list.toogleDisplay('{field[index]}');"></span>
					{? if ($field['type'] == 'ordering') { ?}
						<span class="glyphicon glyphicon-floppy-disk" style="cursor: pointer;" onclick="pzk_list.saveOrdering('{field[index]}');"></span>
					{? } ?}
					<span class="column-header-{field[index]}">
					{? if ($field['type'] != 'group') { ?}
					<a href="#" onclick="pzk_list.toggleOrderBy('{field[index]}'); return false;">{field[label]}</a>
					{? } else { ?}
						{field[label]}
					{? } ?}
					{? if(@$field['filter']) { ?}
					<?php 
						$filterField = @$field['filter'];
						$filterFieldObj = pzk_obj_once ( array('Core.Db.Grid.Edit.' . ucfirst($filterField ['type']), 'filter_' . $field['index'] ));
						foreach ( $filterField as $key => $val ) {
							$filterFieldObj->set ( $key, $val );
						}
						$filterFieldObj->set ('layout', 'admin/grid/index/filter/' . $filterField ['type'] );
						$value = $controller->getFilterSession ()->get ( $filterField ['index'] );
						$filterFieldObj->set ('value', $value );
						$filterFieldObj->display ();
					?>
					{? } ?}
					</span>
					&nbsp;<span class="column-sorter-{field[index]} glyphicon glyphicon-chevron-up" style="cursor: pointer;"></span>
					</span>
					{/each}
					{ifvar normalMode}
					<span>Hành động</span>
					{/if}
				</div>
				</div>
				<div>
				<div>
					<span colspan="<?php echo (3 + count($listFieldSettings))?>">
					
					<form class="form-inline">
					{ifvar normalMode}<strong>Số mục: </strong>{/if}
					<select name="pageSize" class="form-control input-sm pageSize" onchange="pzk_list.changePageSize(this.value);">
						<option value="10">10</option>
						<option value="20">20</option>
						<option value="30">30</option>
						<option value="50">50</option>
						<option value="100">100</option>
						<option value="200">200</option>
						<option value="500">500</option>
						<option value="1000">1000</option>
					  </select>
					  <script type="text/javascript">
						$('#pageSize').val('{pageSize}');
					  </script>
					
					{ifvar normalMode}<strong>Trang: </strong>{/if}
					<?php for ($page = 0; $page < $pages; $page++) {
						if($pages > 10 && ($page < $data->pageNum - 5 || $page > $data->pageNum + 5) && $page != 0 && $page != $pages-1)
							continue;
						if($page == $data->pageNum) { $btn = 'btn-primary'; }
						else { $btn = 'btn-default'; }
					?>
					<a class="btn btn-xs {btn}" href="#" onclick="pzk_list.changePage({page}); return false;">{? echo ($page + 1)?}</a>
					<?php } ?>
					{ifvar normalMode}(<?php echo $countItems. ' bản ghi'; ?>){/if}{ifvar quickMode}<?php echo $countItems . ' rows'; ?>{/if}
					<?php if(count($actions)): ?>
					<div style="float:right;">
					<strong>Hành động: </strong>
				  <select id="gridAction" name="action" class="form-control input-sm">
						<option selected="selected" value="">Thao tác</option>
						{each $actions as $action}
							<option value="{action[value]}">{action[label]}</option>
						{/each}
					</select>
					<div  id="gridaction" style="margin-left: 10px;" class="btn  btn-sm pull-right btn-danger" onclick="pzk_{? echo $data->get('id') ?}.performAction()" >
						<span class="glyphicon glyphicon-execute"></span> Thực hiện
					</div>
					</div>
					<?php endif; ?>
					</form>
					</span>
				</div>
				<?php if($items) {  ?>
				{each $items as $item}

				<div id="row-{item[id]}" class="row-item row-item-{item[id]} row-parent-{item[parent]}" rel="{item[id]}">
					<span><input class="grid_checkbox" type="checkbox" name="grid_check[]" value="{item[id]}" /></span>
					<span style="white-space: nowrap;">
					<?php if($listSettingType == 'parent'):?>
					<a class="row-toggle-btn" id="row-toggle-btn-{item[id]}" rel="{item[id]}" data-expansionDisplay="1" href="#" onclick="pzk_list.toggleRow({item[id]}); event.stopPropagation(); return false;"><span class="glyphicon glyphicon-folder-open"></span></a><?php endif; ?> {item[id]} | 
					{ifvar normalMode}
					<?php if($data->get('checkEdit')) { ?><a href="{url /Admin}_{? echo $data->get('module') ?}/edit/{item[id]}" class="text-center"><span class="glyphicon glyphicon-edit"></span></a><?php } ?>
					{/if}
					</span>
					{? $isOrderingField = false; ?}
					{each $listFieldSettings as $field}
					{? if ($columnDisplay && !@$columnDisplay[$field['index']]) { continue; }
					if(@$field['role'] && pzk_session('adminLevel') != @$field['role']) {continue;}
					?}
					{?
						$fieldObj = pzk_obj_once(array('Core.Db.Grid.Field.' . ucfirst($field['type']), 'list_'. $field['index']));
						foreach($field as $key => $val) {
							$fieldObj->set($key, $val);
						}
						$fieldObj->set('itemId', $item['id']);
						if($fieldObj->get('type') == 'parent') {
							$fieldObj->set('level', $item['level']);
						}
						if($listSettingType &&  $fieldObj->get('type') == 'ordering') {
							$isOrderingField = true;
							$fieldObj->set('level', $item['level']);
						}
						$fieldObj->set('row', $item);
						$fieldObj->set('value', @$item[$field['index']]);
					?}
				<span <?php if($isOrderingField): ?>style="white-space: nowrap;"<?php endif; ?>><span class="column-{field[index]}">{? $fieldObj->display(); ?}</span>{? if($fieldObj->get('link')): ?} <a href="{? echo $fieldObj->get('link')?}{? echo $fieldObj->get('itemId') ?}"><span class="glyphicon glyphicon-link"></span></a>{? endif;?}</span>
					{/each}
					{ifvar normalMode}
					<span style="white-space: nowrap"><?php if($data->get('checkEdit')) { ?><a href="{url /Admin}_{? echo $data->get('module') ?}/edit/{item[id]}" class="text-center"><span class="glyphicon glyphicon-edit"></span></a><?php } ?>
					<?php if($data->get('checkDialog')) { ?><a href="#" onclick="pzk_list.dialog({item[id]}); return false;"><span class="glyphicon glyphicon-info-sign"></span></a><?php } ?>
					<?php if($data->get('checkDel')) { ?><a class="color_delete text-center" href="{url /Admin}_{? echo $data->get('module') ?}/del/{item[id]}"><span class="glyphicon glyphicon-remove"></span><?php } ?>
					</span>
					{/if}
				</div>
				{/each}
				<?php } ?>
				<div>
					<span colspan="<?php echo (3 + count($listFieldSettings))?>">
					<form class="form-inline">
					{ifvar normalMode}<strong>Số mục: </strong>{/if}
					<select name="pageSize" class="pageSize form-control input-sm" onchange="pzk_list.changePageSize(this.value);">
						<option value="10">10</option>
						<option value="20">20</option>
						<option value="30">30</option>
						<option value="50">50</option>
						<option value="100">100</option>
						<option value="200">200</option>
						<option value="500">500</option>
						<option value="1000">1000</option>
					  </select>
					  <script type="text/javascript">
						$('.pageSize').val('{pageSize}');
					  </script>

					{ifvar normalMode}<strong>Trang: </strong>{/if}
					<?php for ($page = 0; $page < $pages; $page++) {
						if($pages > 10 && ($page < $data->pageNum - 5 || $page > $data->pageNum + 5) && $page != 0 && $page != $pages-1)
							continue;
						if($page == $data->pageNum) { $btn = 'btn-primary'; }
						else { $btn = 'btn-default'; }
					?>
					<a class="btn btn-xs {btn}" href="#" onclick="pzk_list.changePage({page}); return false;">{? echo ($page + 1)?}</a>
					<?php } ?>
					<?php if(count($actions)): ?>
					<div style="float:right;">
					<strong>Hành động: </strong>
				  <select id="gridAction" name="action" class="form-control input-sm">
						<option selected="selected" value="">Thao tác</option>
						{each $actions as $action}
							<option value="{action[value]}">{action[label]}</option>
						{/each}
					</select>
					<div  id="gridaction" style="margin-left: 10px;" class="btn  btn-sm pull-right btn-danger" onclick="pzk_{? echo $data->get('id') ?}.performAction()" >
						<span class="glyphicon glyphicon-execute"></span> Thực hiện
					</div>
					</div>
					<?php endif; ?>
					</form>
					</span>
				</div>

				</div>
			</div>
			<div class="panel-footer item">
				<?php if($data->get('checkDel')) { ?>
				<div  id="griddelete" style="margin-left: 10px;" class="btn  btn-sm pull-right btn-danger" >
					<span class="glyphicon glyphicon-remove"></span>{ifvar normalMode} Xóa tất{/if}
				</div>
				<?php } ?>
				<?php if($data->get('checkAdd')) { ?>
				<a class="btn  btn-sm btn-primary pull-right" href="{url /Admin}_{? echo $data->get('module') ?}/add"><span class="glyphicon glyphicon-plus"></span> {ifvar normalMode}{? echo $data->get('addLabel') ?}{/if}</a>
				<?php } ?>
				<div>
				{children [role=export]}
				</div>


			</div>
		</div>
	</div>
	{ifvar quickMode}
	<div id="grid-detail" class="col-sm-8">
		
	</div>
	{/if}
</div>

	
<!-- Modal -->
<div class="modal fade" id="dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Chi tiết</h4>
      </div>
      <div class="modal-body">
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="columnDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ẩn hiện các cột</h4>
      </div>
      <div class="modal-body">
		<form method="post" action="/Admin_{? echo $data->get('module') ?}/columnDisplay">
		  <div class="form-group row">
		  
		  {each $listFieldSettings as $field}
			  {? 
			  $checked = 'checked';
			  if ($columnDisplay && !@$columnDisplay[$field['index']]) { $checked = ''; }
			  if(@$field['role'] && pzk_session('adminLevel') != @$field['role']) {continue;}
			  ?}
			<div class="col-sm-12">
				<label>
				  <input {checked} name="columnDisplay[{field[index]}]" value="1" type="checkbox"> {field[label]}
				</label>
			</div>
		  {/each}
		  </div>
		  <button type="submit" class="btn btn-default">Submit</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
<!-- js check all -->
<?php else: ?>
<div>
		<span colspan="<?php echo (3 + count($listFieldSettings))?>">
		<form class="form-inline" role="form">
		{ifvar normalMode}<strong>Số mục: </strong>{/if}
		<select name="pageSize" class="pageSize form-control input-sm" onchange="pzk_list.changePageSize(this.value);">
			<option value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option value="50">50</option>
			<option value="100">100</option>
			<option value="200">200</option>
		  </select>

		{ifvar normalMode}<strong>Trang: </strong>{/if}
		<?php for ($page = 0; $page < $pages; $page++) {
			if($pages > 10 && ($page < $data->pageNum - 5 || $page > $data->pageNum + 5) && $page != 0 && $page != $pages-1)
				continue;
			if($page == $data->pageNum) { $btn = 'btn-primary'; }
			else { $btn = 'btn-default'; }
		?>
		<a class="btn btn-xs {btn}" href="#" onclick="pzk_list.changePage({page}); return false;">{? echo ($page + 1)?}</a>
		<?php } ?>
		{ifvar normalMode}(<?php echo $countItems. ' bản ghi'; ?>){/if}{ifvar quickMode}<?php echo $countItems . ' rows'; ?>{/if}
		<?php if(count($actions)): ?>
		<div style="float:right;">
		<strong>Hành động: </strong>
	  <select id="gridAction" name="action" class="form-control input-sm">
			<option selected="selected" value="">Thao tác</option>
			{each $actions as $action}
				<option value="{action[value]}">{action[label]}</option>
			{/each}
		</select>
		<div  id="gridaction" style="margin-left: 10px;" class="btn  btn-sm pull-right btn-danger" onclick="pzk_{? echo $data->get('id') ?}.performAction()" >
            <span class="glyphicon glyphicon-execute"></span> Thực hiện
        </div>
		</div>
		<?php endif; ?>
		</form>
		</span>
	</div>
    <?php if($items) {  ?>
	{each $items as $item}

	<div id="row-{item[id]}" class="row-item row-item-{item[id]} row-parent-{item[parent]}" rel="{item[id]}">
		<span><input class="grid_checkbox" type="checkbox" name="grid_check[]" value="{item[id]}" /></span>
        <span style="white-space: nowrap;"><?php if($listSettingType == 'parent'):?><a class="row-toggle-btn" id="row-toggle-btn-{item[id]}" rel="{item[id]}" data-expansionDisplay="1" href="#" onclick="pzk_list.toggleRow({item[id]}); event.stopPropagation(); return false;"><span class="glyphicon glyphicon-folder-open"></span></a><?php endif;?> {item[id]} 
		{ifvar normalMode}
		<?php if($data->get('checkEdit')) { ?><a href="{url /Admin}_{? echo $data->get('module') ?}/edit/{item[id]}" class="text-center"><span class="glyphicon glyphicon-edit"></span></a><?php } ?>
		{/if}
		</span>
		{? $isOrderingField = false; ?}
		{each $listFieldSettings as $field}
		{? if ($columnDisplay && !@$columnDisplay[$field['index']]) { continue; }
		if(@$field['role'] && pzk_session('adminLevel') != @$field['role']) {continue;}
		?}
		{?
			$fieldObj = pzk_obj_once(array('Core.Db.Grid.Field.' . ucfirst($field['type']), 'list_'. $field['index']));
			foreach($field as $key => $val) {
				$fieldObj->set($key, $val);
			}
			$fieldObj->set('itemId', $item['id']);
			if($fieldObj->get('type') == 'parent') {
				$fieldObj->set('level', $item['level']);
			}
			if($listSettingType &&  $fieldObj->get('type') == 'ordering') {
				$isOrderingField = true;
				$fieldObj->set('level',$item['level']);
			}
			$fieldObj->set('row', $item);
			$fieldObj->set('value', @$item[$field['index']]);
		?}
			<span <?php if($isOrderingField): ?>style="white-space: nowrap;"<?php endif; ?>><span class="column-{field[index]}">{? $fieldObj->display(); ?}</span>{? if($fieldObj->get('link')): ?} <a href="{? echo $fieldObj->get('link')?}{? echo $fieldObj->get('itemId')?}"><span class="glyphicon glyphicon-link"></span></a>{? endif;?}</span>
		{/each}
		{ifvar normalMode}
		<span style="white-space: nowrap">
		<?php if($data->get('checkEdit')) { ?>
			<a href="{url /Admin}_{? echo $data->get('module') ?}/edit/{item[id]}" class="text-center"><span class="glyphicon glyphicon-edit"></span></a>
			<?php } ?>
			<?php if($data->get('checkDialog')) { ?>
			<a href="#" onclick="pzk_list.dialog({item[id]}); return false;"><span class="glyphicon glyphicon-info-sign"></span></a>
			<?php } ?>
			<?php if($data->get('checkDel')) { ?>
			<a class="color_delete text-center" href="{url /Admin}_{? echo $data->get('module') ?}/del/{item[id]}"><span class="glyphicon glyphicon-remove"></span>
			<?php } ?>
			</span>
		{/if}
		
	</div>
	{/each}
    <?php } ?>
	<div>
		<span colspan="<?php echo (3 + count($listFieldSettings))?>">
		<form class="form-inline" role="form">
		{ifvar normalMode}<strong>Số mục: </strong>{/if}
		<select name="pageSize" class="pageSize form-control input-sm" onchange="pzk_list.changePageSize(this.value);">
			<option value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option value="50">50</option>
			<option value="100">100</option>
			<option value="200">200</option>
		  </select>
		  <script type="text/javascript">
			$('.pageSize').val('{pageSize}');
		  </script>

		{ifvar normalMode}<strong>Trang: </strong>{/if}
		<?php for ($page = 0; $page < $pages; $page++) {
			if($pages > 10 && ($page < $data->pageNum - 5 || $page > $data->pageNum + 5) && $page != 0 && $page != $pages-1)
				continue;
			if($page == $data->pageNum) { $btn = 'btn-primary'; }
			else { $btn = 'btn-default'; }
		?>
		<a class="btn btn-xs {btn}" href="#" onclick="pzk_list.changePage({page}); return false;">{? echo ($page + 1)?}</a>
		<?php } ?>
		<?php if(count($actions)): ?>
		<div style="float:right;">
		<strong>Hành động: </strong>
	  <select id="gridAction" name="action" class="form-control input-sm">
			<option selected="selected" value="">Thao tác</option>
			{each $actions as $action}
				<option value="{action[value]}">{action[label]}</option>
			{/each}
		</select>
		<div  id="gridaction" style="margin-left: 10px;" class="btn  btn-sm pull-right btn-danger" onclick="pzk_{? echo $data->get('id') ?}.performAction()" >
            <span class="glyphicon glyphicon-execute"></span> Thực hiện
        </div>
		</div>
		<?php endif; ?>
		</form>
		</span>
	</div>
<?php endif;?>