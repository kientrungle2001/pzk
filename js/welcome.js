var vWin;
var vWinG;
function gWin() {
	if (vWinG.closed) {
		document.location = document.location;
	}
	else {
		setTimeout("gWin()", 500);
	}
}
function tWin() {
	if (vWin.closed) {
		document.location = document.location;
	}
	else {
		setTimeout("tWin()", 500);
	}
}
PzkWelcome = PzkObj.pzkExt({
	init: function(){
		$( "#login" ).click(function() {
			$('#myModal').modal('show')
		});
			
		$(document).ready(function(e) {
			$('img[usemap]').rwdImageMaps();
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
				
				$.ajax({
					url:BASE_REQUEST + '/api_Account/loginPost',
					data:{
						userlogin: userlogin,
						userpassword:userpassword,
					}, 
					success:function(result){
						if(result !=""){
							if(result == -1){
								window.location = BASE_REQUEST;
							}else if(result == 0){
								alert("Tài khoản của bạn đăng bị khóa hoặc chưa kích hoạt");
							}else if(result == 1){
								alert("Mật khẩu đăng nhập chưa đúng");
							}else if(result == 2){
								alert("Tên đăng nhập chưa đúng");
							}else if(result == 3){
								alert("Bạn phải nhập đầy đủ tên đăng nhập và mật khẩu");
							}else{
								alert("False");
							}
						}
						return false;
					}
				});
				
				return false;
			}
			this.login = login;

			function register(){
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
								alert("Tên đăng nhập đã tồn tại trên hệ thống");
							}else if(result == 0){
								alert("Email đã tồn tại trên hệ thống");
							}else if(result == 1){
								$("#registerForm").hide();
								$("#register_successful").show();
							}else if(result == 11){
								window.location = BASE_REQUEST;								
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

				var birthday = day+'/'+month+'/'+year;

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
							minlength: 6,
							password:true
						},
					},
					messages: {
						userlogin: {
							required: "Yêu cầu nhập tên đăng nhập",
							minlength: "",
						},
						userpassword: {
							required: 	"Yêu cầu nhập mật khẩu",
							minlength: 	"",
							password:	""
						},
					}
				});
				
				$("#registerForm").validate({
					rules: {
						name: {
							required: true
														
						},
						username: {
							required: true,
							minlength: 5,
							username:true
						   
						},
						password1: {
							required: true,
							minlength: 6,
							password:true
						},
						email: {
							required: true,
							email: true
						},
						birthday_day:{
							required: true,
							min:1,
							max:31
						},
						birthday_month:{
							required: true,
							min:1,
							max:12
						},
						birthday_year:{
							required: true,
							min:1905,
						},
						phone:{
							required: true,
							number:true,
						},
						captcha: "required"
					},
					messages: {
						name: {
							required: "Yêu cầu nhập họ tên của bạn"
							
						},
						username: {
							required: "Yêu cầu nhập tên đăng nhập",
							minlength: "Tên đăng nhập tối thiểu phải 6 ký tự",
							username:" Tên đăng nhập chưa đúng"
							
						},
						password1: {
							required: 	"Yêu cầu nhập mật khẩu đầy đủ",
							minlength: 	"Mật khẩu tối thiểu phải 6 ký tự ",
							password:	"Mật khẩu chưa phù hợp"
						},
						email: "Email chưa đúng định dạng",
						birthday_day:"",
						birthday_month:"",
						birthday_year:"",
						phone:"",
						captcha: ""
					}
				});
			});
		 /* jQuery(document).ajaxStart(function () {
			  //show ajax indicator
			ajaxindicatorstart('Xin vui lòng đợi trong giây lát','loginForm');
		  }).ajaxStop(function () {
			//hide ajax indicator
			ajaxindicatorstop('loginForm');
		  });
		  jQuery(document).ajaxStart(function () {
			  //show ajax indicator
			ajaxindicatorstart('Xin vui lòng đợi trong giây lát','registerForm');
		  }).ajaxStop(function () {
			//hide ajax indicator
			ajaxindicatorstop('registerForm');
		  });*/
	}
});