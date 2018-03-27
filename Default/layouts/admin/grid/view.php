{? $item = $data->getItem();
$listSettingType = $data->get('listSettingType');
$fieldSettings = $data->get('fieldSettings');
$grid = $data->get('childGrid');
$detail = $data->get('parentDetail');
$childrenGridSettings = $data->get('childrenGridSettings');
$parentDetailSettings = $data->get('parentDetailSettings');
$gridIndex = $data->get('gridIndex');
?}
	{? if(!$data->get('isChildModule')): ?}
	<h1 class="text-center">{item[name]}{item[title]}</h1>
	<div class="navbar-collapse collapse navbar-default">
	<ul class="nav navbar-nav">
		<li><a class="label label-info" href="/admin_{data.get('module')}/index">Quay lại</a></li>
		<li><a class="label label-warning" href="/admin_{data.get('module')}/edit/{data.get('itemId')}">Sửa</a></li>
		<li class="{? if(!$gridIndex) echo 'active';?}"><a href="/Admin_{data.get('module')}/view/{data.get('itemId')}">Chi tiết</a></li>
	{ifvar childrenGridSettings}
	{each $childrenGridSettings as $gridFieldSettings}
		{? if($gridFieldSettings['index'] == $gridIndex){ $active = 'active'; } else { $active = ''; } ?}
		<li class="{active}"><a class="{active}" href="/Admin_{data.get('module')}/view/{data.get('itemId')}/{gridFieldSettings[index]}">{gridFieldSettings[label]}</a></li>
	{/each}
	{/if}
	{ifvar parentDetailSettings}
	{each $parentDetailSettings as $detailSettings}
		{? if($detailSettings['index'] == $gridIndex){ $active = 'active'; } else { $active = ''; } ?}
		<li class="{active}"><a class="{active}" href="/Admin_{data.get('module')}/view/{data.get('itemId')}/{detailSettings[index]}">{detailSettings[label]}</a></li>
	{/each}
	{/if}
	</ul>
	</div>
	{?	endif; ?}
	<br />

{ifvar detail}
	{? 
		$detail->set('itemId', $item[$detail->get('referenceField')]);
		$detail->display();
		
		?}
{else}
{ifvar grid}
	{? $grid->display(); ?}
{else}

{ifvar fieldSettings}
<div class="jumbotron">
{each $fieldSettings as $field}
	<div class="container">
		<div class="row">
			<div class="col-xs-2"><strong>{field[label]}</strong></div>
			<div class="col-xs-10">
		{?					
							$fieldObj = pzk_obj('Core.Db.Grid.Field.' . ucfirst($field['type']));
							foreach($field as $key => $val) {
								$fieldObj->set($key, $val);
							}
							$fieldObj->set('itemId', $item['id']);
							if($fieldObj->get('type') == 'parent') {
								$fieldObj->set('level', @$item['level']);
							}
							if($listSettingType &&  $fieldObj->get('type') == 'ordering') {
								$isOrderingField = true;
								$fieldObj->set('level', @$item['level']);
							}
							$fieldObj->set('row', $item);
							$fieldObj->set('value', @$item[$field['index']]);
							$fieldObj->display();
						?}
			</div>
		</div>
	</div>
{/each}
</div>
{else}
	{each $item as $val}
		{val}<br />
	{/each}
{/if}
{/if}
{/if}