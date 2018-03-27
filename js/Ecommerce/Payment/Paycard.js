
POST_CARD_URL 					= '/Payment/cardPost';
POST_CARD_RESPONSE_OK 			= 'ok';
POST_CARD_VALIDATE_CODE_SUCCESS	= 1;
POST_CARD_VALIDATE_CODE_FAIL	= 0;
POST_CARD_VALIDATE_MESSAGE_PINCARD_FAIL		=	'Bạn phải nhập mã thẻ cào';
POST_CARD_VALIDATE_MESSAGE_SERIALCARD_FAIL	=	'Bạn phải nhập serial thẻ cào';
PzkEcommercePaymentPaycard = PzkObj.pzkExt({
	init: function() {
		
	},
	postCard: function() {
		var that = this;
		
		this.parseFormData();
		
		this.validateFormData();
		if(this.isValidateSuccess()) {
			$.ajax({
				url: POST_CARD_URL,
				data: {
					pm_typecard: 		this.pm_typecard,
					pm_txt_serialcard: 	this.pm_txt_serialcard,
					pm_txt_pincard: 	this.pm_txt_pincard
				},
				success: function(result) {
					that.handlePostCardResponse(result);
				},
				type: 'POST'
			});
		} else {
			alert(this.validateResult.message);
		}
	},
	parseFormData: function() {
		this.pm_txt_pincard 		= 		$('#pm_txt_pincard').val();
		this.pm_txt_serialcard 		=		$('#pm_txt_serialcard').val();
		this.pm_typecard			= 		$('#pm_typecard').val();
	},
	validateFormData: function() {
		var response_code 	= POST_CARD_VALIDATE_CODE_SUCCESS;
		var message 		= null;
		if (this.pm_txt_pincard == '') {
			response_code 	=	POST_CARD_VALIDATE_CODE_FAIL;
			message			=	POST_CARD_VALIDATE_MESSAGE_PINCARD_FAIL;
		} else if(this.pm_txt_serialcard == '') {
			response_code 	=	POST_CARD_VALIDATE_CODE_FAIL;
			message			=	POST_CARD_VALIDATE_MESSAGE_SERIALCARD_FAIL;
		}
		this.validateResult = {
			response_code: response_code, 
			message: message
		};
	},
	isValidateSuccess: function() {
		return this.validateResult.response_code == POST_CARD_VALIDATE_CODE_SUCCESS;
	},
	handlePostCardResponse: function(result) {
		var res						= result.split('/');
		
		this.parseResponse(res);
		
		if( this.isSuccessResponse() )
		{
			this.showSuccessResult();
			
		}
		else{
			this.showFailResult();
			//alert('nap the that bai');
			
		}
	},
	parseResponse: function(res) {
		
		this.response_code 			= res[1];
		this.response_card_amount 	= res[0];
		this.response_card_error	= res[0];
		this.response_total_amount	= res[2];
	},
	isSuccessResponse: function() {
		return this.response_code == POST_CARD_RESPONSE_OK;
	},
	
	showSuccessResult:function() {
		//alert("Nap the thanh coong");
		$('#pm_result').html('<span class="label label-success"><span class="glyphicon glyphicon-ok"></span><span>  Bạn vừa nạp tiền thành công, số tiền là:  '+	this.response_card_amount	+'</span></span>');
		
		$('#wallet_money').html(this.response_total_amount);
		$('#show_result_service').html('');
	},
	showFailResult: function() {
		
		$('#pm_result').html('<span class="label label-danger"><span class="glyphicon glyphicon-remove"></span><span>'+	this.response_card_error	+'</span></span>');
		$('#show_result_service').html('');
	}
});