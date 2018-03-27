var vWin;
var vWinG;
function gWin() {
	if (vWinG.closed) {
		window.location.reload();
	}
	else {
		setTimeout(function() {gWin()}, 500);
	}
}
function tWin() {
	if (vWin.closed) {
		window.location.reload();
	}
	else {
		setTimeout(function() {tWin()}, 500);
	}
}

PzkUserAccountLoginsn = PzkObj.pzkExt({
	
	init: function(){
		$( "#nobelLogin" ).click(function() {
			$('#nobelMyModal').modal('show');
		});
		clicked_url ='';
		$( ".login_required" ).click(function() {
			$('#nobelMyModal').modal('show');
			clicked_url= $(this).prop('rel');		
		});
		
		
		function LoginFB(){
			var url = BASE_REQUEST + '/Account/loginfacebook';
			var width = 900;
			var Xpos = ((screen.availWidth - width)/2);
			var height = 500;
			var Ypos =((screen.availHeight - height)/2);                
			vWin=window.open(url,"CM_OpenID","width=" + width + ",height=" + height + ",resizable,scrollbars=yes,status=1");        
			tWin();

		}
		this.LoginFB = LoginFB;
		function LoginGoogle(){
			var urlgoogle = BASE_REQUEST + '/Account/logingoogle';
			var width = 900;
			var Xpos = ((screen.availWidth - width)/2);
			var height = 500;
			var Ypos =((screen.availHeight - height)/2);                
			vWinG=window.open(urlgoogle,"CM_OpenID","width=" + width + ",height=" + height + ",resizable,scrollbars=yes,status=1");        
			gWin();	
		}
		this.LoginGoogle = LoginGoogle;

		function login(){
			var userlogin 		= $('#userlogin').val();
			var userpassword	= $('#userpassword').val();
			if(userlogin == '' || userpassword == '') return false;
			$.ajax({
				url:BASE_REQUEST + '/Api_Account/loginPost',
				data:{
					userlogin: userlogin,
					userpassword:userpassword,
				}, 
				success:function(result){
					
						if(result == -1){
							if(clicked_url){
								window.location = BASE_REQUEST+clicked_url;
								return true;
							}
							window.location = BASE_REQUEST+'/';
						}else if(0 === result || '0' === result || null === result){
							alert("Tài khoản của bạn đăng bị khóa hoặc chưa kích hoạt");
						}else if(result == 1){
							alert("Mật khẩu đăng nhập chưa đúng");
						}else if(result == 2){
							alert("Tên đăng nhập chưa đúng");
						}else if(result == 3){
							alert("Bạn phải nhập đầy đủ tên đăng nhập và mật khẩu");
						}
					
				}
			});
			
			return false;
		}
		
		this.login = login;
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		});
		
		$(document).ready(function () {
			
			$('#loginForm').validate({
				rules: {
					userlogin: {
						required: true
					},
					userpassword: {
						required: true
					},
				},
				messages: {
					userlogin: {
						required: "Yêu cầu nhập tên đăng nhập"
						
					},
					userpassword: {
						required: 	"Yêu cầu nhập mật khẩu"
						
					}
				}
			});
			
			
		});

	
	 

	}
});