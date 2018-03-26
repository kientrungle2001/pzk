<div class="pzk-register">
	<div class="container">
		<div class="col-xs-12 pd-0">
			<div class="col-xs-5 pd-right-0 pzk-newsletter-field">
				<label class="pzk-color-title pzk-newsletter-text" for="newsletter-to">
					Đăng ký để nhận thông tin bài học mới nhất
				</label>
			</div>
			<form method="post" onsubmit="return validateForm()" action="" name="newsletter">
				<div class="col-xs-5 pd-0 pzk-newsletter-field">
					<input id="newsletter-to" class="form-control" type="text" placeholder="Nhập thông tin email của bạn ..." name="newsletter_to">
				</div>
				<div class="col-xs-2 pzk-newsletter-field">
					<button class="btn btn-register pull-left" type="button" onclick="send_news_letter_request()">Đăng ký ngay <span class="glyphicon glyphicon-send"></span></button>
				</div>
			</form>
		</div>
	</div>	
</div>