<?php $signActive = pzk_user()->checkPayment('full')?>
Chọn ngôn ngữ hiển thị: <a class="btn btn-danger" rel="/language/en" onclick="select_language('en');return false;" href="#">Tiếng Anh</a> | <a class="btn btn-warning" rel="/language/vn" onclick="select_language('vn');return false;" href="#">Tiếng Việt</a> | <a class="btn btn-success" rel="/language/ev" onclick="select_language('ev');return false;" href="#">Song ngữ</a>
<h3 class="hidden-xs">Phần mềm Luyện thi vào lớp 6 Trần Đại Nghĩa - (Giá 600.000đ/1 năm sử dụng)</h3>
<div class="btncon">
	<?php if(!$signActive) { ?>
	<a href="/"><button type="button" class="btn btn-default sharp btn-info">Dùng thử</button></a>
	<?php } ?>
	<a href="/home/about"><button style="<?php if(!$signActive) { ?>height: 50px;<?php } ?>" type="button" class="btn btn-default sharp btn-danger">Chi tiết<?php if(!$signActive) { ?> và mua sản phẩm<?php } ?></button></a>
	<a href="/Huong-dan-su-dung"><button type="button" class="btn sharp  btn-warning ">Hướng dẫn sử dụng</button></a>
</div>
<script>
function select_language(lang) {
	$.ajax({url: '/language/'+lang, success: function(){ window.location.reload(); }});
}
</script>