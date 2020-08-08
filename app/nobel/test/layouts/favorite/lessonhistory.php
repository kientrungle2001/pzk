<div id="lesson_history">
<div class="lesson_favorite_">
  <div class="fvr_title"><span class="glyphicon glyphicon-star"></span><span> Lịch sử học tập</span></div>
  <div class="prf_clear"></div>
 <div style="margin:auto;text-align:center;"><img src="/3rdparty/uploads/img/circle.png" alt="" width="500px" height="30px"></div>
  <div class="clear" style="padding-bottom:10px;"></div>
  <div class="lesson_favorite_list">
   <div class="list_lesson_favorite">
   
     <div class="lesson_history_name">Tên bài học</div>
     <div class="lesson_history_type">Thể loại</div>
     <div class="lesson_history_type">Thời gian</div>
     
  
   </div>
   <div id="add_more_history"></div>
   <div id="show_empty_history" class="show_empty"></div>
  <?php 
    $member=pzk_request()->getMember();
    $lesson_historyId = pzk_request()->getLesson_historyId();
    $listlessions = $data->viewListLesson($member, $lesson_historyId);
     $listlessions = array_reverse($listlessions);
   ?>
   {each $listlessions as $listlession} 
  <div class="list_lesson_row">
   
     <div class="lesson_history_name_row"><a href="/favorite/detailLesson?member={member}&lesson={listlession[id]}">Bài {listlession[id]}</a></div>
     <div class="lesson_history_type_row"><a href="/favorite/detailLesson?member={member}&lesson={listlession[id]}">{listlession[name]}</a></div>
     <div class="lesson_history_type_row"><?php echo date('d-m-y : H:i:s', strtotime($listlession['startTime'])); ?></div>
     
  
  </div>
  {/each}
  <div id="view_more_history">

      <a href="#" onclick="viewMore(); return false;"><span>Xem thêm <span id="count_lesson_history"></span> bài khác >></span></a>
    </div>
  </div>

 </div>
 </div>
 <?php 

  $count_arr= count($listlessions);
  

  if(!empty($listlessions))
  {
   
    $countLesson= $data->countLesson($member,$listlessions[0]['id']);
    //var_dump($count_lesson_favorite);
   
    echo "<script>$('#count_lesson_history').html(".$countLesson.");</script>";
    echo '<script>window.lesson_historyId='.$listlessions[0]['id'].';</script>';
  }else{
    echo "<script>$('#show_empty_history').html('<span>không có bài học nào</span>');</script>";
  }
 ?> 
<script>
  var numberrow= parseInt('<?php echo @$count_arr ; ?>');
  var countLesson=parseInt('<?php echo @$countLesson ?>');
  $('#view_more_history').hide();
  if(numberrow < 6 || countLesson<=0)
  {
    $('#view_more_history').hide();
  }else{
    $('#view_more_history').show();
  }    
   function viewMore()
    {
      //alert('in');
      var member= '<?php echo $member; ?>';
      var lesson_historyId= window.lesson_historyId;
      $.ajax({
        url:'/favorite/viewhistory',
        data:{
          lesson_historyId:lesson_historyId,
          member: member,
        },
        success: function(result)
        {
          //alert(result);
          $('#add_more_history').after(result);
        }
      });
      
    }
</script>
 