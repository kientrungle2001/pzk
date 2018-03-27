PzkUserProfileAddinforgoogle = PzkObj.pzkExt({
	
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
frmAddinforG: function(){
    var that= this;
   var errorusername = $('#addusername-error').text();
   var errorphone = $('#addphone-error').text();
   if(errorusername!='' || errorphone!=''){
     return false;
   }else{
    that.set_birthday();
    var username = $('#addusername').val();
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
          phone: phone,
          birthday: birthday,
          sex: sex,
          address: address,
          school: school,
          class1: class1,
          areacode: areacode
      },
      url:'/profile/googlePost',
      success: function(msg){
        if(msg==0){
          $('#mass_addinforG').html('<p align="center" style="color:red;"><strong><span class="glyphicon glyphicon-remove"></span> Tên đăng nhập đã tồn tại! Bạn vui lòng chọn tên đăng nhập khác.</strong></p>');
        }else if(msg==1){
          $('#mass_addinforG').html('<p align="center" style="color:green;"><strong><span class="glyphicon glyphicon-ok"></span> Cập nhật thông tin thành công!</strong></p>');
        }
        
      }

    }); 
   
    
   }
  }
	
});