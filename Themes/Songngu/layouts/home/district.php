<?php 
	$provinceId= $data->getProvinceId();
	$areacode = _db()->getEntity('User.Account.User');
	$areas = $areacode->getAreaByParent($provinceId);

 ?>
 <option value="all" >Chọn quận/ huyện</option>
<?php foreach($areas as $item): ?>
	<option value="<?php echo @$item['id']?>" ><?php echo @$item['name']?></option>
<?php endforeach; ?>