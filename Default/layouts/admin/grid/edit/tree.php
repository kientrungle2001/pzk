<?php  
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 12);
$mdsize 		= pzk_or($data->get('mdsize'), 12);
?>
<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="form-group clearfix">
		<label for="<?php  echo $data->get('index')?><?php echo $rand ?>"><?php  echo $data->get('label')?></label><div><a onclick="$('#modalEdit<?php  echo $data->get('index')?>').modal('show'); return false;" href="#" class="btn btn-default">Mở</a> </div>
	</div>
</div>

<div id="modalEdit<?php  echo $data->get('index')?>" class="modal fade  sharp" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title"><?php  echo $data->get('label')?></h4>
      </div>
      <div class="modal-body">
			<?php 
			$items = _db ()->select ( '*' )->from ( $data->get('table') )->orderBy('id desc')->where(pzk_or($data->get('condition'), '1'))->result ();
			$items = buildTree($items);
			show_menu($items, 'treed-' . $data->get('index'), '', '', true, 'render_tree_input', array('name' => $data->get('index')));
			?>
			<?php if(0):?>
			<div
			 multiple="multiple"
			id="<?php  echo $data->get('index')?><?php echo $rand ?>" name="<?php  echo $data->get('index')?>[]" size="10">
						<?php
										$parents = _db ()->select ( '*' )->from ( $data->get('table') )->result ();
										if (isset ( $parents [0] ['parent'] )) {
											$parents = treefy ( $parents, 'parent', 0 );
											echo "<div data-value='0'><input type=\"checkbox\" name=\"".$data->get('index')."[]\"> <a class=\"treeitem\">Danh mục gốc</a></div>";
										} else {
											echo "<div data-value='0'><input type=\"checkbox\" name=\"".$data->get('index')."[]\"> Danh mục gốc</div>";
										}
										?>
				<?php foreach($parents as $parent): ?>
				<?php
										$selected = '';
										$trimIds = trim ( $data->get('value'), ',' );
										$arrIds = explode ( ',', $trimIds );
										if (in_array ( $parent [$data->get('show_value')], $arrIds )) {
											$selected = 'selected="selected"';
										}
										?>
				<div <?php echo $selected; ?>
						data-value="<?php echo $parent[$data->get('show_value')]; ?>" data-parent="{parent['parent']}">
						
					<?php if(isset($parent['parent'])){ echo str_repeat('--', $parent['level']); } ?>
					<input type="checkbox" name="<?php  echo $data->get('index')?>[]" value="<?php echo $parent[$data->get('show_value')]; ?>"> <a class="treeitem"><?php echo $parent[$data->get('show_name')]; ?></a>
				</div> <?php endforeach; ?>

			</div>
			<?php endif;?>
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
$('.treed-<?php  echo $data->get('index')?>').treed();
var val = '<?php  echo $data->get('value')?>';
$('.treed-<?php  echo $data->get('index')?> .treeitem-input').each(function(index, input){
	var value = input.value;
	if(val.indexOf(value) !== -1) {
		input.checked = true;
	}
})
</script>