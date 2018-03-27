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

PzkUserAccountLoginmobile = PzkObj.pzkExt({
	
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
				url:BASE_REQUEST + '/api_Account/loginPost',
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

		function register(){
			var validator= $("#registerForm").validate();
			var error= validator.numberOfInvalids();
			if(error>0) return false;
			var name 		= $('#name').val();
			var username 	= $('#username').val();
			var email 		= $('#email').val();
			var sex			= $('#sex').val();
			var password1	= $('#password1').val();
			var birthday	= $('#birthday').val();
			var phone		= $('#phone').val();
			var captcha		= $('#captcha').val();
			var areacode		= $('#areacode').val();
			$.ajax({
				url:BASE_REQUEST + '/api_Account/registerPost',
				data:{
					name: 			name,
					username: 		username,
					email: 			email,
					sex: 			sex,
					password1: 		password1,
					birthday: 		birthday,
					phone: 			phone,
					captcha:		captcha,
					areacode:       areacode
				}, 
				success:function(result){
					
					if(result == -1){
							alert("Tên đăng nhập đã được sử dụng. Bạn vui lòng chọn tên đăng nhập khác");
						}else if(result == 0){
							alert("Email đã được sử dụng. Bạn vui lòng chọn email khác");
						}else if(result == 1){
							$("#registerForm").hide();
							$("#register_successful").show();
						}else if(result == 11){
							if(clicked_url){
								window.location = BASE_REQUEST+clicked_url;
								return true;
							}
							window.location = BASE_REQUEST+'/';								
						}else if(result == 2){
							alert("Mã bảo mật chưa đúng");
						}
				}
			});
			return false;
		}
		this.register = register;
		
		function set_birthday(){
			var day 	= $("#day").val();
			var month 	= $("#month").val();
			var year 	= $("#year").val();

			var birthday = month+'/'+day+'/'+year;
			

			$("#birthday").val(birthday);

		}
		this.set_birthday = set_birthday;
		
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		});
		
		$(document).ready(function () {
			
			$('#loginForm').validate({
				rules: {
					userlogin: {
						minlength: 3,
						required: true
					},
					userpassword: {
						required: true,
						minlength: 6
						
					},
				},
				messages: {
					userlogin: {
						required: "Yêu cầu nhập tên đăng nhập",
						minlength: "",
					},
					userpassword: {
						required: 	"Yêu cầu nhập mật khẩu",
						minlength: 	""
						
					},
				}
			});
			jQuery.validator.addMethod("username", function(value, element) {
		// Kiểm tra định dạng của chuỗi nhập vào bằng biểu thức chính quy
		return this.optional( element ) || /^[a-zA-Z0-9._]*$/.test( value );
		}, 'Tên đăng nhập không được chứa ký tự đặc biệt, không chứa khoảng trắng');

			$("#registerForm").validate({
				rules: {
					
					username: {
						required: true,
						minlength: 5,
						username: true
					},
					name: {
						required: true
					},
					password1: {
						required: true,
						minlength: 6
					},
					email: {
						required: true,
						email: true
					},
					birthday_day:{
						required: true
					},
					birthday_month:{
						required: true
					},
					birthday_year:{
						required: true
					},
					phone:{
						required: true,
						number:true
					},
					captcha: "required"
				},
				messages: {
					name :"Hãy điền họ tên của bạn ",
					username: {
						required: "Yêu cầu nhập tên đăng nhập",
						minlength: "Tên đăng nhập tối thiểu phải 6 ký tự",
						username: "Tên đăng nhập chưa hợp lệ"
						
					},
					password1: {
						required: 	"Yêu cầu nhập mật khẩu đầy đủ",
						minlength: 	"Mật khẩu tối thiểu phải 6 ký tự "
						
					},
					email: "Email chưa đúng định dạng",
					birthday_day:"",
					birthday_month:"",
					birthday_year:"",
					phone:"Số điện thoại không hợp lệ",
					captcha: "Nhập mã captcha"
				}
			});
		});

	}
});