<?php 
	$districtId= $data->getDistrictId();
	$areas = $data->getAreaByParent($districtId);

 ?>
 <option value="all" >Chọn trường</option>
<?php foreach($areas as $item): ?>
	<option value="<?php echo @$item['id']?>" ><?php echo @$item['name']?></option>
<?php endforeach; ?>