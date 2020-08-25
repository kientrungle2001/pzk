<?php $language =pzk_global()->getLanguage(); ?>
<div class="item reposive">
	<img class="item" src="/Themes/Hanoistar/skin/images/bg_tuvan.png" />
	<div class="item box_tuvanhd absolute">
		<div class="container">
			<div class="col-md-6 text-center">
				<h2 style = "color: #ff0090; font-family: cadena;">Tư vấn tâm lý</h2>
				<textarea id="cttamly" name="tamly" class="item"></textarea>
				<img id="sendTamly" class="mgt10 pointer" src="/Themes/Hanoistar/skin/images/tamly.png" />
				
			</div>
			<div class="col-md-6 text-center">
				<h2 style="color: #1b35a4; font-family: cadena;">Tư vấn học tập</h2>
				<textarea id="cthoctap" name="hoctap" class="item"></textarea>
				<img id="sendHoctap" class="mgt10 pointer" src="/Themes/Hanoistar/skin/images/gui_hoctap.png" />
			</div>
		</div>
	</div>	
	<div class="bt_tuvan item cadena text-center">
		Để được trao đổi trực tiếp (chat trực tuyến) với các chuyên gia tâm lí, em có thể đăng nhập web:<br/><br/>
		<a href="http://ask14.vn/">http://ask14.vn</a><br/><br/>
		(Thời gian được hỗ trợ trực tuyến: 10h30 – 13h30, tất cả các ngày, trừ ngày chủ nhật)

	</div>
</div>
<script>
$(document).ready(function() {
	$('#sendHoctap').click(function(){
		<?php if(pzk_session('userId')): ?>
		var contenthoc = $('#cthoctap').val();
		if(contenthoc == ''){
			alert('Chưa nhập nội dung');
			$('#cthoctap').focus();
			return false;
		}else{
			
			$.ajax({
			  method: "POST",
			  url: "/tuvan/save",
			  data: { content: contenthoc, type: 'hoctap' }
			}).done(function( msg ) {
				if(msg == 1){
					$('#cthoctap').val('');
					alert("Gửi thành công");
					
				}
			});
		}
		<?php else: ?>
		var state = confirm("Bạn cần đăng nhập để gửi tư vấn");
			if(state == true){
				$("#LoginModal").modal();
			}
		<?php endif; ?>
		
	});
	$('#sendTamly').click(function(){
		<?php if(pzk_session('userId')): ?>
		var tamly = $('#cttamly').val();
		if(tamly == ''){
			alert('Chưa nhập nội dung');
			$('#cttamly').focus();
			return false;
		}else{
			
			$.ajax({
			  method: "POST",
			  url: "/tuvan/save",
			  data: { content: tamly, type: 'tamly' }
			}).done(function( msg ) {
				if(msg == 1){
					$('#cttamly').val('');
					alert("Gửi thành công");
					
				}
				
			});
		}
		<?php else: ?>
		var state = confirm("Bạn cần đăng nhập để gửi tư vấn");
			if(state == true){
				$("#LoginModal").modal();
			}
		<?php endif; ?>
	});
});	
</script>
