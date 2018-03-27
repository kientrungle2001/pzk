PzkCommunicationInvitationInvitation = PzkObj.pzkExt({
	
	init: function(){

	},
	sendInvitation: function(member){
	var invitation = $('#txtinvi').val();    
    $.ajax({
      url:'/user/invitationPost',
      data: {
        invitation: invitation,
        member: member
        
      },
      success: function(result)
      {
        if(result=="ok")
        {
          $('#result_ok').show();
          $('#result_ok').html('<span class="glyphicon glyphicon-ok"></span><span>Bạn đang gửi yêu cầu kết bạn thành công</span>');
          $('#result_fail').hide();
        }
        else{
          $('#result_fail').show();
          $('#result_fail').html('<span  class="glyphicon glyphicon-remove"></span><span>Bạn đã gửi yêu cầu kết bạn, xin vui lòng chờ phản hồi</span>');
          $('#result_ok').hide();
        }
        
      }
    });
	}
});