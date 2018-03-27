$(function() {
	$('#menu_user').mouseover(function() {
		$('.menu_user').show();
	});
	$('#menu_user').mouseout(function() {
		$('.menu_user').hide();
	});
	$('.menu_user').mouseout(function() {
		$('.menu_user').hide();
	});
	$('.menu_user').mouseover(function() {
		$('.menu_user').show();
	});	
});

function checkLogin(){
	
	$.ajax({
		url: BASE_REQUEST+'/api_Account/checkLogin',
		data:{
			checkLogin: 1,
		}, 
		success:function(result){
			
			if(result !== ''){
				if(result === 'true'){
					
					alert("Tài khoản của bạn đã được đăng nhập trên máy tính khác !");
					window.location = BASE_REQUEST;
				}
			}
		}
	});
}

//checkLogin();

// setTimeout(function() {checkLogin() }, 30000);
