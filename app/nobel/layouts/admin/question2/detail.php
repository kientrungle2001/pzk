<?php
$item = $data->getItem();
?>
<h3>Câu hỏi: {item[name]}</h3>
<div class="row">
<div class="col-lg-12">
<a class="btn btn-primary" href="{url /admin_}{? echo pzk_request()->getController(); ?}/edit/{item[id]}">Sửa</a>
<a class="btn btn-default" href="{url /admin_}{? echo pzk_request()->getController(); ?}/index">Trở lại</a>
</div>
</div>
{children all}