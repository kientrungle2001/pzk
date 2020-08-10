
<div class="profilefriend_right">
    <div class="prf_title">Chào mừng bạn đã ghé thăm góc học tập của tôi</div>
    <div class="prf_clear" style="width: 100%; height: 30px;"></div>

    <div class="prf_title" style="width:30%;">Ghi chép cá nhân </div>
    <div id="prf_viewnotepage" class="prf_note">
      <?php
        $member=pzk_request()->getMember();
        $user_note=_db()->getEntity('communication.user_note'); 
        $notes=$user_note->loadNote($member);      
        $pages= $user_note->arrPage($member);
      ?>
      <script>

      var id=[];
     
      </script>
      <?php foreach($notes as $note): ?>
      <?php 
        $countComment=$user_note->countComment($note->getId());
        $date= $user_note->formatDate($note->getDatenote());
       ?>
     <div class="<?php echo $note->get('id')?>">
       <script>
       var val='<?php echo $note->get('id')?>';
       id.push(val);
      </script>
      <div style="float:left;">
        <input style=" float:left;width:15px; height:15px;" type="checkbox" value="<?php echo $note->get('id')?>" name="ckbdel" >
        <img src=" <?php echo BASE_URL.'/default/skin/nobel/ptnn/media/usernote.png' ?>" alt="">
      </div>
      <div class="prf_titlenote">
         <a href="/note/detailnote?member=<?php echo $member ?>&id=<?php echo $note->get('id')?>">{note.getTitlenote()}</a>
      </div>
      <div style="float:right;"><a href="javascript:;" class="black" title="Xoá" onclick="pzk_<?php echo @$data->id?>.delNote1(<?php echo $note->get('id')?>);">[Xoá]</a></div>
      <div class="prf_clear1">
        <span class="titel_detail1">Bình luận: <?php echo $countComment ?>  |   Vào lúc: <?php echo @$date['1']?> Ngày <?php echo @$date['0']?> </span>
      </div>

      </div>
      <?php endforeach; ?>
       
      
   </div> 
          
    <div> Trang 
    <?php foreach($pages as $page): ?>
     <a href="#" id="span <?php echo $page ?>" onclick="pzk_<?php echo @$data->id?>.loadpage(<?php echo $page ?>,<?php echo $member ?>)"><?php echo $page ?></a>
    <?php endforeach; ?>
  
    </div>
 
  
<div id="btt_viewnote_add" class="margin-top-20">
  <p>
    <input style="width:50px;float:left;color:black;" type="button" class="pne_st1_r_file_bt"  name="bttdel" onclick="pzk_<?php echo @$data->id?>.delNote();" id="btt_note_del" value="Xóa">
    <a href="/note/addnote?member=<?php echo $member ?>"><input style="width:80px;float:left;color:black;" type="button" class="pne_st1_r_file_bt" name="bttadd" value="Thêm mới"></a>
    <a href="/profile/user?member=<?php echo $member ?>"><input style="width:80px;float:left;color:black;" type="button" class="pne_st1_r_file_bt" name="bttback" value="Quay lại"></a>
  </p>

</div>      

  </div>