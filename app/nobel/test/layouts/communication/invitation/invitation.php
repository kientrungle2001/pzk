   
  <div id="user_invitation">
    <div class="layout_title">KẾT BẠN</div>
    <div class="clear"></div>
    <div class="form_invitation">
      <form method="post" action="" >   
    <?php 
          //$request=pzk_element('request');
          $member=pzk_request('member');
          $user= $data->loadUserName($member);
    ?>
     <div class="note" >
     <span>Bạn đang gửi yêu cầu kết bạn đến </span><a href="/profile/profileusercontent?member=<?php echo $member ?>"><?php echo $user['name']; ?></a> 
     </div >
     <div id="result_invitation_ok"></div> 
     <div id="result_invitation_fail"></div> 
    
      <br>    
      <div class="title_invitation">Lời nhắn:</div>
      <div class="txtarea_invi"><textarea name="invitation" id="txtarea_invitation"  rows="4" cols="50"></textarea></div>
      
      <div class="btt_invi">
       
      <input type="button" onclick="sendInvitation()" class="btt_paycard" value="Gửi">  
      </div>
    </form>
    </div>
  </div>
<script>
  
  function sendInvitation()
  {
    var invitation = $('#txtarea_invitation').val();
    
    var member='<?php echo $member; ?>';
    
    $.ajax({
      url:'/user/invitationPost',
      data: {
        invitation: invitation,
        member: member
        
      },
      success: function(result)
      {
        alert(result);
        if(result=="ok")
        {
          
          $('#result_invitation_ok').append('<span class="glyphicon glyphicon-ok"></span><span>Bạn đang gửi yêu cầu kết bạn thành công</span>');
         
        }
        else{
         
          $('#result_invitation_fail').append('<span  class="glyphicon glyphicon-remove"></span><span>Bạn đã gửi yêu cầu kết bạn, xin vui lòng chờ phản hồi</span>');
          
        }
        
      }
    });
  }
</script>


