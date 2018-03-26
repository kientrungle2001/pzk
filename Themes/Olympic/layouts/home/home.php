<div class="container">
	<div class="row">
	<style>
			.tff4b58:hover{ background: #ff4b58;}
			.td59e00:hover{ background: #d59e00;}
			.t0074ed:hover{ background: #0074ed;}
			.t009a2c:hover{ background: #009a2c;}
			.subtopic{cursor: pointer;}
		</style>
			<div class="col-md-3 col-xs-12 bdrtopic">
		<span style="color: #ff4b58 !important;" class="font-submenu">
			<img src="<?=BASE_URL?>/Default/skin/nobel/olympic/Themes/olympic/image/a.png">
			Ôn luyện theo chủ đề			</span>
										<div class="col-xs-12 subtopic tff4b58">
							<span>
							Từ đơn - từ phức							</span>
							</div>	
												<div class="col-xs-12 subtopic tff4b58">
							<span>
							Từ láy và các loại từ láy							</span>
							</div>	
												<div class="col-xs-12 subtopic tff4b58">
							<span>
							Từ ghép và các loại từ ghép							</span>
							</div>	
												<div class="col-xs-12 subtopic tff4b58">
							<span >
							Luyện tập tổng hợp đơn phức láy ghép							</span>
							</div>	
											
					
			
			
		</div>
			<div class="col-md-3 col-xs-12 bdrtopic">
		<span style="color: #d59e00 !important;" class="font-submenu" >
			<img src="<?=BASE_URL?>/Default/skin/nobel/olympic/Themes/olympic/image/b.png">
			Ôn luyện theo dạng			</span>
				<div class="col-xs-12 subtopic td59e00">
							<span>
							Dạng trắc nghiệm							</span>
				</div>	
				<div class="col-xs-12 subtopic td59e00">
							<span>
							Dạng điền từ							</span>
				</div>	
				<div class="col-xs-12 subtopic td59e00">
							<span>
							Chọn từ đồng nghĩa							</span>
				</div>	
				<div class="col-xs-12 subtopic td59e00">
							<span>
							Kéo từ vào chủ đề							</span>
				</div>	
					
			
			
		</div>
			<div class="col-md-3 col-xs-12 bdrtopic">
		<span style="color: #0074ed !important;" class="font-submenu" >
			<img src="<?=BASE_URL?>/Default/skin/nobel/olympic/Themes/olympic/image/c.png">
			Thi trực tuyến			</span>
										<div class="col-xs-12 subtopic t0074ed">
							<span>
							Đề 1							</span>
							</div>	
												<div class="col-xs-12 subtopic t0074ed">
							<span >
							Đề 2							</span>
							</div>	
							<div class="col-xs-12 subtopic t0074ed">
							<span >
							Đề 3							</span>
							</div>	
							<div class="col-xs-12 subtopic t0074ed">
							<span >
							Đề 4							</span>
							</div>	
											
					
			
			
		</div>
			<div class="col-md-3 col-xs-12 bdrtopic">
		<span style="color: #009a2c !important;" class="font-submenu" >
			<img src="<?=BASE_URL?>/Default/skin/nobel/olympic/Themes/olympic/image/d.png">
			Trò chơi			</span>
									
					<div class="col-xs-12 subtopic t009a2c">
							<span >
							Gia đình tranh tài							</span>
							</div>
			
			
		</div>
		</div>
</div>
<script>

<?php if(pzk_session('userId')) { ?>
$('.subtopic').click(function(){
	alert('Bạn phải chọn lớp');
});
<?php } else { ?>
$('.subtopic').click(function(){
	alert('Bạn cần đăng nhập trước');
});

<?php } ?>

</script>