<div class="form-group">
	<label for="<?php echo @$data->name?>"><?php echo @$data->label?></label>
	<textarea class="form-control" id="<?php echo @$data->name?>" name="<?php echo @$data->name?>" placeholder="<?php echo @$data->label?>" rows="<?php echo @$data->rows?>">
		<?php $data->displayChildren('all') ?>
	</textarea>
</div>