<?php $id = pzk_request()->getSegment(3); ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
		<form action="/admin_service_packages/importCardPost/<?php echo $id ?>" method="post">
			<textarea class="form-control" name="content" rows="15"></textarea>
			<div style="margin-top: 20px;">
				<input class="btn btn-primary" type="submit" value="Nhập" /> <a href="/admin_service_packages/index">Quay lại</a>
			</div>
		</form>
		</div>
	</div>
</div>