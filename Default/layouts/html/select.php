<div class="form-group">
    <label for="<?php echo @$data->name?>"><?php echo @$data->label?></label>
	<select name="<?php echo @$data->name?>" id="<?php echo @$data->name?>" class="form-control">
		<?php $data->displayChildren('all') ?>
	</select>
  </div>