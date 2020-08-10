<?php 
	$districtId= $data->get('districtId');
	$areacode = _db()->getEntity('User.Account.User');
	$areas = $areacode->getAreaByParent($districtId);

 ?>
 <option value="" >Chọn trường</option>
<?php foreach($areas as $item): ?>
	<option value="<?php echo @$item['id']?>" ><?php echo @$item['name']?></option>
<?php endforeach; ?>