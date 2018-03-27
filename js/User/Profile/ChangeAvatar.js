PzkUserProfileChangeAvatar = PzkObj.pzkExt({
	
	init: function(){
		var that = this;
		$(document).ready(function (e) {
		$('#frm_upload_avatar').on('submit',(function(e) {
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				type:'POST',
				url: $(this).attr('action'),
				data:formData,
				cache:false,
				contentType: false,
				processData: false,
				success:function(data){
					if(data=='Thay đổi thành công'){
					  $('.show-message').html('<span class="text-success"><span class="glyphicon glyphicon-ok"></span><strong> <span>Bạn đã thay đổi avatar thành công</span></strong></span>');
					}else{
					  $('.show-message').html('<span class="text-danger"><span class="glyphicon glyphicon-remove"></span><strong> <span>'+data+'</span></strong></span>');
					}
					if(that.onsuccess){
						eval(that.onsuccess);
					}
				}
			});
		}));
		});
	}
  
});