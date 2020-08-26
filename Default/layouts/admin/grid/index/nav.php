<?php
$controller = pzk_controller();
$sortFields = $data->getSortFields();
$filterFields = $data->get ('filterFields');
$searchFields = $data->get ('searchFields');
$searchLabel = $data->get ('searchLabel');
$orderBy = $data->get ('orderBy');
$view = $data->get ('view');
$columns = $data->get ('columns');
$keyword = $data->get ('keyword');
$updateData = $data->getUpdateData();
$updateDataTo = $data->getUpdateDataTo();

?>
<!-- search, filter, sort -->
<div class="well well-sm" style="position: relative;">
<?php if($sortFields or $filterFields or $searchFields):?>
      <div style="position: absolute; right: 5px; top: 1px; z-index: 1;">
			<a href="#" onclick="$('#navbarForm').toggle(); return false;"><span class="glyphicon glyphicon-minus"></span></a>
	  </div>
	  <form id="navbarForm"
		action="<?php echo BASE_REQUEST . '/Admin' ?>_<?php echo @$controller->module?>/searchFilter">
		<div class="row">
           <?php if ($searchFields) : ?>
              <div class="form-group col-xs-12">
				<label>Tìm theo </label><br /> <input type="text" name="keyword" class="form-control"
					placeholder="<?php if($searchLabel){ echo $searchLabel; } ?>" value="<?php echo $keyword ?>" onkeyup="pzk_list.search(this.value);" />
			</div>
            <?php endif; ?>
        <?php if ($filterFields) :?>
			<?php foreach ( $filterFields as $field ) :?>
				<?php if ($field ['type'] == 'status') : ?>
                <div class="form-group col-xs-12">
					<label><?php echo @$field['label']?></label><br /> 
					<select id="<?php echo @$field['index']?>"
						name="<?php echo @$field['index']?>" class="form-control"
						onchange="pzk_list.filter('<?php echo @$field['type']?>', '<?php echo @$field['index']?>', this.value);">
						<option value="">Tất cả</option>
						<option value="0">Chưa kích hoạt</option>
						<option value="1">kích hoạt</option>
	
					</select>
					<script type="text/javascript">
	                	<?php $status = $controller->getFilterSession()->get($field['index']); ?>
	                    $('#<?php echo @$field['index']?>').val('<?php echo $status ?>');
	                </script>
				</div>
                <?php  elseif($field['type'] == 'select') : ?>
                    <div class="form-group col-xs-12">
						<label><?php echo @$field['label']?></label><br /> 
						<select id="<?php echo @$field['index']?>" name="<?php echo @$field['index']?>" class="select2-container form-control select2" onchange="pzk_list.filter('<?php echo @$field['type']?>', '<?php echo @$field['index']?>', this.value);">
                            <?php
						$parents = _db ()->select ( '*' )->from ( $field ['table'] )->where(pzk_or(@$field['condition'], '1'))->orderBy(pzk_or(@$field['orderBy'], 'id asc'))->result ();
							if (isset ( $parents [0] ['parent'] )) {
								$parents = treefy ( $parents, 'parent', 0 );
								echo "<option value='' >--Tất cả</option>";
							} else {
								echo "<option value=''>Tất cả</option>";
							}
							?>
							<?php if(isset($field['notAccept']) && $field['notAccept'] == '1'):?>
								<option value='0'>(Trống)</option>
							<?php endif;?>
                            <?php foreach($parents as $parent): ?>
                            <option value="<?php echo $parent[$field['show_value']]; ?>"><?php if(isset($parent['parent'])){ echo str_repeat('--', @$parent['level']); } ?>
                                #<?php echo @$parent['id']?> - <?php echo $parent[$field['show_name']]; ?>
                            </option> <?php endforeach; ?>
						</select>
						<script type="text/javascript">
                            <?php $select = $controller->getFilterSession()->get($field['index']); ?>
                            $('#<?php echo @$field['index']?>').val('<?php echo $select ?>');
							$( "#<?php echo @$field['index']?>" ).select2( { placeholder: "<?php echo @$field['label']?>", maximumSelectionSize: 6 } );
                        </script>
					</div>
               	<?php elseif($field['type'] == 'datetime'):?>
                	<div class="form-group col-xs-12">
                		<label><?php echo @$field['label']?></label><br /> 
                		<select id="<?php echo @$field['index']?>" name="<?php echo @$field['index']?>" class="form-control" onchange="pzk_list.filter('<?php echo @$field['type']?>', '<?php echo @$field['index']?>', this.value);">
                			<option value="">Tất cả</option>
                			<?php foreach($field['option'] as $key => $value):?>
                				<option value="<?=$key;?>"><?=$value;?></option>
                			<?php endforeach;?>
                		</select>
                		<script type="text/javascript">
                            <?php $datetime = $controller->getFilterSession()->get($field['index']); ?>
                            $('#<?php echo @$field['index']?>').val('<?php echo $datetime ?>');
                        </script>
                	</div>
                <?php else :?>
                	<?php 
					$fieldObj = pzk_obj ( 'Core.Db.Grid.Edit.' . ucfirst($field ['type']) );
					foreach ( $field as $key => $val ) {
						$fieldObj->set ( $key, $val );
					}
					$fieldObj->set ('layout', 'admin/grid/filter/' . $field ['type'] );
					$value = $controller->getFilterSession ()->get ( $field ['index'] );
					$fieldObj->set ('value',  $value );
					$fieldObj->display ();
					?>
				<?php endif;?>
			<?php  endforeach; ?>
		<?php endif; ?>
	    <?php if($sortFields) : ?>
		    	<div class="form-group col-xs-12">
					<label>Sắp xếp</label><br /> 
					<select id="orderBy" name="orderBy" class="select2-container form-control select2" onchange="pzk_list.changeOrderBy(this.value);">
	                	<?php foreach ($sortFields as $value => $label){ ?>
	                    <option value="<?php echo $value ?>"><?php echo $label ?></option>
	                    <?php } ?>
	                </select>
					<script type="text/javascript">
	                	$('#orderBy').val('<?php echo $orderBy ?>');
						$("#orderBy" ).select2( { placeholder: "Sắp xếp", maximumSelectionSize: 6 } );
	                </script>
				</div>
	    <?php endif; ?>
       	<?php if($searchFields) :?>
        	<div class="form-group col-xs-12 hidden">
				<label>&nbsp;</label><br />
				<button type="submit" value="<?php echo ACTION_SEARCH; ?>" name="submit_action" class="btn btn-primary btn-sm">
					<span class="glyphicon glyphicon-search"></span> Tìm kiếm
				</button>
	   		</div>
      	<?php endif; ?>
        <div class="form-group col-xs-12 hidden">
			<label>&nbsp;</label><br />
			<button type="submit" value="<?php echo ACTION_RESET; ?>" name="submit_action" class="btn btn-default btn-sm">
				<span class="glyphicon glyphicon-refresh"></span> Reset
			</button>
		</div>
		</div>
		<div class="row">
			<div class="form-group col-xs-12 hidden">
				<label>Hiển thị</label><br /> <select id="view" name="view"
					class="form-control"
					onchange="pzk_list.changeView(this.value);">
					<option value="grid">Grid</option>
					<option value="tile">Tile</option>
				</select>
				<script type="text/javascript">
                      $('#view').val('<?php echo $view ?>');
                  </script>
			</div>
			<div class="form-group col-xs-12 hidden">
				<label>Cột</label><br /> <select id="columns" name="columns"
					class="form-control"
					onchange="pzk_list.changeColumns(this.value);">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="6">6</option>
					<option value="12">12</option>
				</select>
				<script type="text/javascript">
                      $('#columns').val('<?php echo $columns ?>');
                  </script>
			</div>
			<div class="form-group col-xs-12 hidden">
				<label>&nbsp;</label><br />
				<button type="button" value="<?php echo ACTION_RESET; ?>"
					name="sidebar_action" class="btn btn-default btn-sm"
					onclick="pzk_list.toogleSidebar(); return false;">
					<span class="glyphicon glyphicon-refresh"></span> <span
						class="btn-sidebar-action-label">Ẩn Sidebar</span>
				</button>
			</div>
			<div style="margin-left: 15px;"
				class="form-group col-xs-12">
				<label>&nbsp;</label><br />
				<button type="button" value="" name="submit_action"
					class="btn btn-primary btn-sm"
					onclick="window.location='/Admin_<?php  echo $data->getModule() ?>/add';">
					<span class="glyphicon glyphicon-add"></span> Thêm mới
				</button>
			</div>

		</div>

	</form>
	<?php if(0) : ?>
	<form id="commandlineForm" role="commandline" action="#">
		<div class="form-group col-xs-12">
			<input type="text" name="commandline"
				class="form-control"
				placeholder="Gõ lệnh vào đây"
				value="" />
			<label>Kết quả: </label><span id="commandlineResult">&nbsp;</span>
		</div>
	</form>
	<div class="row">
		<div class="col-xs-12">
			<button type="button" value="<?=ACTION_RESET; ?>"
				name="navbar_action" class="btn btn-default btn-sm"
				onclick="pzk_list.toogleNavbar(); return false;">
				<span class="glyphicon glyphicon-refresh"></span> <span
					class="btn-navbar-action-label">Ẩn Navbar</span>
			</button>
		</div>
	</div>
	<?php endif; ?>
<?php endif;?>
</div>
<!-- end well -->
<!-- end search, filter, sort -->
<!-- update menu -->
<?php if($updateData && pzk_request()->getAction()=='index'): ?>
	<div id="showmenucate">
		<?php
		foreach ($updateData as $item) {
			$fieldObj = pzk_obj('Core.Db.Grid.Menu.' . ucfirst($item['type']));
			foreach($item as $key=>$val) {
				$fieldObj->set($key, $val);
			}
			$fieldObj->display();

		}?>
	</div>
<?php endif; ?>

<!-- update menu -->
<?php if($updateDataTo && pzk_request()->getAction()=='index'): ?>
	<div id="showmenucate">
		<?php

		foreach ($updateDataTo as $item) {
			$fieldObj = pzk_obj('Core.Db.Grid.UpdateData.UpdateData');
			foreach($item as $key=>$val) {
				$fieldObj->set($key, $val);
			}
			$fieldObj->display();
		}
		?>
	</div>
<?php endif; ?>
