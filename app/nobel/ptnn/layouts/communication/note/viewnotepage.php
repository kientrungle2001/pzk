      <?php 
        
        $member=pzk_request()->getMember();
        $user_note=_db()->getEntity('communication.user_note'); 
        $notes=$user_note->loadNote($member);      
        $pages= $user_note->arrPage($member);      
      ?>
      <?php foreach($notes as $note): ?>
      <?php 
        $countComment=$user_note->countComment($note->getId());
        $date= $user_note->formatDate($note->getDatenote());
       ?>
     <div class="<?php echo $note->getId()?>">
      
      <div style="float:left;">
        <input style=" float:left;width:15px; height:15px;" type="checkbox" value="<?php echo $note->getId()?>" name="ckbdel" >
        <img src=" <?php echo BASE_URL.'/default/skin/nobel/ptnn/media/usernote.png' ?> " alt="">
      </div>
      <div class="prf_titlenote">
        <a href="/note/detailnote?member=<?php echo $member ?>&id=<?php echo $note->getId()?>">{note.getTitlenote()}</a>
      </div>
      <div style="float:right;"><a href="javascript:;" class="black" title="Xoá" onclick="pzk_<?php echo @$data->id?>.delNote1(<?php echo $note->getId()?>);">[Xoá]</a></div>
      <div class="prf_clear1">
        <span class="titel_detail1">Bình luận: <?php echo $countComment ?>  |   Vào lúc: <?php echo @$date['1']?> Ngày <?php echo @$date['0']?> </span>
      </div>
      </div>
      <?php endforeach; ?>
    