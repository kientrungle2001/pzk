<p class="t-weight text-center btn-custom8 mgright textcl">Các tin cùng chuyên mục</p>
<?php  $items = $data->getItems(); ?>
<?php foreach($items as $item): ?>
<a onclick='chitiet(<?php echo @$item['id']?>); return false;' href="#" ><h4 class="top20"><?php echo @$item['title']?></h4></a>
<?php endforeach; ?>