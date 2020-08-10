      <?php 
        
        $member=pzk_request()->getMember();
        $user_note=_db()->getEntity('communication.user_note'); 
        $notes=$user_note->loadNote($member);          
      ?>
      <?php foreach($notes as $note): ?>
      <?php 
        $countComment=$user_note->countComment($note->getId());
        $date= $user_note->formatDate($note->getDatenote());
      ?>
     <div class="<?php echo $note->get('id')?>">
      
      <div style="float:left;">
        
        <img src=" <?php echo BASE_URL.'/default/skin/nobel/ptnn/media/usernote.png' ?> " alt="">
      </div>
    <div class="prf_titlenote">
        <a href="/note/detailnote?member=<?php echo $member ?>&id=<?php echo $note->get('id')?>">{note.getTitlenote()}</a>
    </div>
    <div class="prf_clear1">
        <span class="titel_detail1">Bình luận: <?php echo $countComment ?>  |   Vào lúc: <?php echo @$date['1']?> Ngày <?php echo @$date['0']?> </span>
    </div>
    </div>
      <?php endforeach; ?>
    