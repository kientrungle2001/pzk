PzkUserProfileAddinfor = PzkObj.pzkExt({
	
	init: function(){
		var that=this;
},
    set_birthday: function(){
        var that= this;
        var day     = $("#addday").val();
        var month   = $("#addmonth").val();
        var year    = $("#addyear").val();

        var birthday = day+'-'+month+'-'+year;
        $("#addbirthday").val(birthday);
        
    },
frmAddinfor: function(){
    var that= this;
   var errorusername = $('#addusername-error').text();
   var errorphone = $('#addphone-error').text();
   var erroremail = $('#addemail-error').text();
   if(errorusername!='' || errorphone!='' || erroremail!=''){
     return false;
   }else{
    that.set_birthday();
    var username = $('#addusername').val();
    var email = $('#addemail').val();
    var password = $('#addpassword').val();
    var phone = $('#addphone').val();
    var birthday = $('#addbirthday').val();
    
    var sex = $('#addsex').val();
    var address = $('#addaddress').val();
    var school = $('#addschool').val();
    var class1 = $('#addclass').val();
    var areacode = $('#addareacode').val();
    console.log();
    $.ajax({
      type: "Post",
      data:{
          username: username,
          password: password,
          email: email,
          phone: phone,
          birthday: birthday,
          sex: sex,
          address: address,
          school: school,
          class1: class1,
          areacode: areacode
      },
      url:'/profile/addinforPost',
      success: function(msg){
        if(msg==0){
          $('#mass_addinfor').html('<p align="center" style="color:red;"><strong><span class="glyphicon glyphicon-remove"></span> Tên đăng nhập đã tồn tại! Bạn vui lòng chọn tên đăng nhập khác.</strong></p>');
        }else if(msg==-1){
          $('#mass_addinfor').html('<p align="center" style="color:red;"><strong><span class="glyphicon glyphicon-remove"></span> Email đã tồn tại! Bạn vui lòng chọn email khác.</strong></p>');
        }else if(msg==1){
          $('#mass_addinfor').html('<p align="center" style="color:green;"><strong><span class="glyphicon glyphicon-ok"></span> Cập nhật thông tin thành công!</strong></p>');
        }
        
      }

    }); 
   
    
   }
  }
	
});