PzkUserProfileEdit = PzkObj.pzkExt({
	
	init: function(){
		var that=this;
		$(document).ready(function () {
			 $("#profile-edit-form").validate({
				rules: {
					editinfor_name: {
						required: true,
					},
					editinfor_phone:{
						required: true
					}
				},
				messages: {
					editinfor_name: {
						required: "Yêu cầu nhập họ tên",
					},
					editinfor_phone:"Yêu cầu nhập số điện thoại"
					
				}
			});
			$("#profile-edit-form").submit(function(){
				var errorname = $('#editinfor_name-error').text();
			   var errorphone = $('#editinfor_phone-error').text();
			   
			   if(errorname!='' || errorphone!='' ){
				 return false;
			   }else{
				that.set_birthday();
				var name = $('#editinfor_name').val();
				var phone = $('#editinfor_phone').val();
				var birthday = $('#editinfor_birthday').val();
				if(name=='' || phone=='' ){
				  return false;
				}else{
				var sex = $('#editinfor_sex').val();
				var address = $('#editinfor_address').val();
				var schoolname = $('#editinfor_school').val();
				var class1 = $('#editinfor_class').val();

				var areacode = $('#editinfor_areacode').val();
				$.ajax({
				  type: "post",
				  data:{
					  name: name,
					  phone: phone,
					  birthday: birthday,
					  sex: sex,
					  address: address,
					  schoolname: schoolname,
					  class1: class1,
					  areacode: areacode					  
				  },
				  url:'/profile/editPost',
				  success: function(msg){
					$('#mass_editinfor').html('<p align="center" style="color:green;"><strong><span class="glyphicon glyphicon-ok"></span> Cập nhật thông tin thành công!</strong></p>');
					if(that.onsuccess) {
						eval(that.onsuccess);
					}
				  }

				}); 
				}
				
			   }
				return false;
			});
		 });
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		});
	},
    set_birthday: function(){
        var that= this;
        var day     = $("#editinfor_day").val();
        var month   = $("#editinfor_month").val();
        var year    = $("#editinfor_year").val();

        var birthday = year+'-'+month+'-'+day;
        $("#editinfor_birthday").val(birthday);
        
    }
	
});