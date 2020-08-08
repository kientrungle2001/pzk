      <?php 
        
        $member=pzk_request()->getMember();
        $user_note=_db()->getEntity('communication.user_note'); 
        $notes=$user_note->loadNote($member);          
      ?>
      {each $notes as $note}
      <?php 
        $countComment=$user_note->countComment($note->getId());
        $date= $user_note->formatDate($note->getDatenote());
      ?>
     <div class="{note.get('id')}">
      
      <div style="float:left;">
        
        <img src=" <?php echo BASE_URL.'/default/skin/nobel/ptnn/media/usernote.png' ?> " alt="">
      </div>
    <div class="prf_titlenote">
        <a href="/note/detailnote?member={member}&id={note.get('id')}">{note.getTitlenote()}</a>
    </div>
    <div class="prf_clear1">
        <span class="titel_detail1">Bình luận: {countComment}  |   Vào lúc: {date[1]} Ngày {date[0]} </span>
    </div>
    </div>
      {/each}
    