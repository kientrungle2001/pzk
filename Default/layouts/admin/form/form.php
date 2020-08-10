<?php
$controller = $data;
$item = $data->get('item');
$row = $item;
$fieldSettings = $controller->get('fieldSettings');
$tabs = $controller->get('tabs');
$actions = $data->get('actions');
?>
<div class="panel panel-default">
<div class="panel-heading">
    <?php  if(@$data->backHref && @$data->backLabel) { ?>
  <a class="btn btn-xs btn-default" href="<?php echo @$data->backHref?>"><span class="glyphicon glyphicon-arrow-left"></span></a>
  <?php  } ?>
	<b><?php echo $data->get('label'); ?>
	<?php  if(@$data->backHref && @$data->backLabel) { ?>
  <a class="btn btn-xs btn-default pull-right" href="<?php echo @$data->backHref?>"><span class="glyphicon glyphicon-remove-sign"></span> <?php echo @$data->backLabel?></a>
  <?php  } ?>
	</b>
</div>
<div class="panel-body borderadmin">
<form role="form" method="<?php echo @$data->method?>" enctype="multipart/form-data"  action="<?php echo @$data->action?>">
  <input type="hidden" name="id" value="<?php echo @$item['id']?>" />
   <?php if($tabs) { ?>
       <div class="form-group clearfix">
           <ul class="nav nav-tabs" role="tablist">
               <?php
               $i=1;
               foreach($tabs as $tab) { ?>
                   <li role="presentation" <?php if($i == 1) { echo "class='active'"; }?> ><a href="#<?php echo @$tab['index']?>" aria-controls="<?php echo @$tab['name']?>" role="tab" data-toggle="tab"><?php echo @$tab['name']?></a></li>
                   <?php $i++; } ?>

           </ul>

           <div class="tab-content">
               <?php
               $i=1;
               foreach($tabs as $tab) { ?>
                   <div role="tabpanel" class="tab-pane <?php if($i == 1) { echo "active"; }?>" id="<?php echo @$tab['index']?>">
						<?php  
						foreach($tab['fields'] as $field ) { 
							$fieldObj = pzk_obj('Core.Db.Grid.Edit.' . ucfirst($field['type'])); 
					
							foreach($field as $key => $val) {
								$fieldObj->set($key, $val);
							}
							$fieldObj->set('value', @$row[$field['index']]); 
							$fieldObj->display();
					   } 
					   ?>
                   </div>
                   <?php $i++; } ?>

           </div>


       </div>
    <?php }else { ?>

  <?php foreach($fieldSettings as $field): ?>
  
  <?php 
			if(pzk_request('hidden_' . $field['index'])) {
				echo '<div style="display: none;">';
			}
		    $fieldObj = pzk_obj('Core.Db.Grid.Edit.' . ucfirst($field['type'])); 
    
			foreach($field as $key => $val) {
				$fieldObj->set($key, $val);
			}
			$fieldObj->set('value', @$row[$field['index']]); 
			$fieldObj->display();
			if(pzk_request('hidden_' . $field['index'])) {
				echo '</div>';
			}
	?>
  <?php endforeach; ?>

  <?php } ?>
  <div class="col-xs-12" style="position: fixed; bottom: 50px; padding: 10px; background: #555;">
  <?php foreach($actions as $action): ?>
  <button type="submit" name="<?php echo @$action['name']?>" value="1" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span> <?php echo @$action['label']?></button>
  <?php endforeach; ?>
  <?php  if(@$data->backHref && @$data->backLabel) { ?>
  <a class="btn btn-default" href="<?php echo @$data->backHref?>"><span class="glyphicon glyphicon-remove-sign"></span> <?php echo @$data->backLabel?></a>
  <?php  } ?>
  </div>
</form>
 <script type="text/javascript">
	$(function () {
        setTinymce();
	});
</script>
</div>
</div>