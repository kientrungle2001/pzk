
PzkUserAccountRegistermobile = PzkObj.pzkExt({
	
	init: function(){
		function register(){
			alert(1);
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
			if(username == '' || password1 == ''){
				alert('Bạn hãy điền đầy đủ thông tin');
				return false;
			} 
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