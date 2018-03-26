<div class="btncon">
	<a href="/payment/cardmobile"><button type="button" class="btn btn-default sharp btn-info">Nạp thẻ cào</button></a>
	<a href="/contest/about"><button  type="button" class="btn btn-default sharp btn-danger">Nộp lệ phí thi</button></a>
	<?php if(pzk_session('username')){ ?>
	<a rel="/contest/index" class="login_required" data-toggle="modal" data-target=".bs-example-modal-lg" style="cursor:pointer;">Xin chào <?php echo pzk_session('username')?></a>
	<a href="/api_account/logout?backHref=contest/index">Thoát</a>
	<?php }else { ?>
	<a rel ="/contest/index" class="login_required" data-toggle="modal" data-target=".bs-example-modal-lg" style="cursor:pointer;">Đăng ký/ Đăng nhập </a>
	<?php } ?>
</div>