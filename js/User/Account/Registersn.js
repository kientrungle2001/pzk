PzkUserAccountRegistersn = PzkObj.pzkExt({
	
	init: function(){
		
		function myDistrict() {
		    var provinceId = $("#areacode").val();
		    $.ajax({
		        url: "/home/getDistrict",
		        type: "post",
		        data: {
		        	provinceId : provinceId
		        } ,
		        success: function (response) {
		           $("#district").html(response);
		           
		        }
			});										    
		}
		this.myDistrict = myDistrict;
		
		function MyService(){
			var serviceName= $("#servicePackage").val();
			
			$.ajax({
		        url: "/Home/changeService",
		        type: "post",
		        data: {
		        	serviceName : serviceName
		        } ,
		        success: function (response) {
		           $("#addService").html(response);
		           
		           
		        }
			});	
		}
		this.MyService = MyService;
		
		
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

		jQuery.validator.addMethod("username", function(value, element) {
		// Kiểm tra định dạng của chuỗi nhập vào bằng biểu thức chính quy
		return this.optional( element ) || /^[a-zA-Z0-9._]*$/.test( value );
		}, 'Tên đăng nhập không được chứa ký tự đặc biệt, không chứa khoảng trắng');


		$(document).ready(function () {
			
			$("#registerForm").validate({
				rules: {
					
					username: {
						required: true,
						username: true,
						minlength: 5
						
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
					
					phone:{
						required: true,
						number: true
					},
					captcha: {required : true},
					areacode:{required : true},
					district:{required : true},
					school:{required : true},
					selectclass:{required : true},
					classname:{required : true},
					chkagree:{required : true}
				},
				messages: {
					name :"Hãy điền họ tên của bạn ",
					username: {
						required: "Yêu cầu nhập tên đăng nhập",
						minlength: "Tên đăng nhập tối thiểu phải 6 ký tự"
						
						
					},
					password1: {
						required: 	"Yêu cầu nhập mật khẩu đầy đủ",
						minlength: 	"Mật khẩu tối thiểu phải 6 ký tự "
						
					},
					email: {
						required: "Yêu cầu nhập email",
						email: "Email chưa đúng định dạng"
					},
					
					phone:{
						required: 	"Yêu cầu nhập số điện thoại",
						number: "Phải nhập số"
					},
					captcha:{required:  "Yêu cầu nhập capcha"},
					areacode :{required:  "Chọn tỉnh/TP"},
					district :{required:  "Chọn Quận/huyện"},
					school :{required:  "Chọn Trường"},
					selectclass :{required:  "Chọn Lớp"},
					classname :{required:  "Nhập tên lớp"},
					chkagree : {required: "Bạn hãy đồng ý với các điều khoản sử dụng"}
				}
			});
		});
		
		function register(){
			var validator= $("#registerForm").validate();
			
			
			var error= validator.numberOfInvalids();
			if(error>0 || document.getElementById("chkagree").checked == false){
				return false;
			} else{			
			var name 		= $('#name').val();
			var username 	= $('#username').val();
			var email 		= $('#email').val();
			var sex			= $('#sex').val();
			var password1	= $('#password1').val();
			var birthday	= $('#birthday').val();
			var phone		= $('#phone').val();
			var captcha		= $('#captcha').val();
			var areacode		= $('#areacode').val();
			var classname		= $('#classname').val();

			var servicePackage		= $('#servicePackage').val();
			var district		= $('#district').val();
			var school		= $('#school').val();
			var schoolname		= $('#school option:selected').text();
			var districtname		= $('#district option:selected').text();
			var provincename		= $('#areacode option:selected').text();
			var schoolname		= $('#school option:selected').text();
			var selectclass		= $('#selectclass').val();


			$.ajax({
				url:BASE_REQUEST + '/Api_Account/registerPost',
				data:{
					name: 			name,
					username: 		username,
					email: 			email,
					sex: 			sex,
					password1: 		password1,
					birthday: 		birthday,
					phone: 			phone,
					captcha:		captcha,
					areacode:       areacode,
					classname: 		classname,
					servicePackage: servicePackage,
					district: 		district,
					school: 		school,
					schoolname: 	schoolname,
					districtname :  districtname, 
					provincename :  provincename, 
					selectclass:  	selectclass
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
		  }
			return false;
		}
		this.register = register;
	

	}
});