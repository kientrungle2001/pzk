
<div class="profilefriend_right">
    <div class="prf_title">Chào mừng bạn đã ghé thăm góc học tập của tôi</div>
    <div class="prf_clear" style="width: 100%; height: 30px;"></div>

    <div class="prf_title" style="width:30%;">Ghi chép cá nhân </div>
    <div id="prf_viewnotepage1" class="prf_note">
      <?php
        $member=pzk_request()->getMember();
        $user_note=_db()->getEntity('communication.user_note'); 
        $notes=$user_note->loadNote($member);      
        $pages= $user_note->arrPage($member);
      ?>
      
      {each $notes as $note}
      <?php 
        $countComment=$user_note->countComment($note->getId());
        $date= $user_note->formatDate($note->getDatenote());
       ?>
     <div class="{note.get('id')}">
      
      <div style="float:left;">
        
        <img src=" <?php echo BASE_URL.'/default/skin/nobel/ptnn/media/usernote.png' ?>" alt="">
      </div>
    <div class="prf_titlenote">
         <a href="/note/detailnote?member={member}&id={note.get('id')}">{note.getTitlenote()}</a>
    </div>
    <div class="prf_clear1">
        <span class="titel_detail1">Bình luận: {countComment}  |   Vào lúc: {date[1]} Ngày {date[0]} </span>
    </div>
  </div>
      {/each}
   </div>        
    <div> Trang 
    {each $pages as $page}
     <a href="#" id="span {page}" onclick="pzk_{data.id}.loadpage1({page},{member})">{page}</a>
    {/each}
  
    </div>
<div clas="prf_clear1">    
    <a href="/profile/user?member={member}"><input style="width:80px;float:left;color:black;" type="button" class="pne_st1_r_file_bt" name="bttback" value="Quay lại"></a>
</div>     
 

  </div>