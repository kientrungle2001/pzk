   
  <div id="user_invitation">
    <div class="layout_title">KẾT BẠN</div>
    <div class="clear"></div>
    <div class="form_invitation">
      <form method="post" action="" >   
    <?php 
          $member=pzk_request()->getMember();
          $user= $data->loadUserName($member);
    ?>
     <div class="note" >
     <span class="title">Bạn đã gửi yêu cầu kết bạn đến </span><a href="/profile/user?member={member}">{user}</a> 
     </div >
     <div class="show_ok" id="result_ok"></div> 
     <div class="show_error" id="result_fail"></div>     
      <br>    
      <div class="title_invitation">Lời nhắn:</div>
      <div class="form-group">
  		<textarea class="form-control" name="invitation" rows="5" id="txtinvi"></textarea>
	  </div>      
      <div class="btt_invi">       
      <input type="button" style="width: 50px;float: left;" onclick="pzk_{data.id}.sendInvitation('{member}')" class="pne_st1_r_file_bt" value="Gửi">  
      </div>
    </form>
    </div>
  </div>


