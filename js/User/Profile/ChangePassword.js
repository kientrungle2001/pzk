PzkUserProfileChangePassword = PzkObj.pzkExt({
	
	init: function(){
		var that=this;
	  $(document).ready(function()  {
	   $("#formEditPass").validate( {
		  rules:  {
			oldpassword:  {
			  required: true,
			  minlength: 6
			},
			newpassword:  {
			  required: true,
			  minlength: 6
			},
			confirmpassword:  {
			  required: true,
			  equalTo: "#newpassword"
			}
		  },
		  messages: {
			  oldpassword:  {
				 required: "Mật khẩu cũ không được bỏ trống",
				 minlength: "Mật khẩu tối thiểu 6 ký tự"
			  },
			  newpassword:  {
				 required: "Mật khẩu mới không được bỏ trống",
				 minlength: "Mật khẩu tối thiểu là 6 ký tự"
			  },
			  confirmpassword:  {
			  	required: "Nhập lại mật khẩu mới",
				equalTo: "Xác nhận mật khẩu phải trùng với mật khẩu mới"
			  }
			}
		});
		$("#formEditPass").submit(function(){
			return that.changePassword();
		});
	  });
	   
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		});
	},

	changePassword: function(){
	  var that= this;
	   var oldpasserr = $('#oldpassword-error').text();
	   var newpasserr = $('#newpassword-error').text();
	   var confpasserr = $('#confirmpassword-error').text();
	   if(oldpasserr!='' || newpasserr!='' || confpasserr!=''){
		 return false;
	   }else{
		var oldpass = $('#oldpassword').val();
		var newpass = $('#newpassword').val();
		var confpass = $('#confirmpassword').val();
		
		$.ajax({
		  type: "Post",
		  data:{
			  oldpass: oldpass,
			  newpass: newpass,
			  confpass: confpass
		  },
		  url:'/profile/changePasswordPost',
		  success: function(msg){
			if(that.onsuccess) {
				eval(that.onsuccess);
			}
			if(msg==0){
			  $('#mass_editpass').html('<p  style="color:red;"><strong><span class="glyphicon glyphicon-remove"></span> Mật khẩu cũ chưa chính xác!</strong></p>');
			}else if(msg==1){
			  $('#mass_editpass').html('<p style="color:green;"><strong><span class="glyphicon glyphicon-ok"></span> Bạn đã thay đổi mật khẩu! Hãy sử dụng mật khẩu mới hoặc liên hệ với chúng tôi nếu bạn quên mật khẩu!.</strong></p>');
			}
		  }

		}); 
		}
		
		return false;
	  }
	
});