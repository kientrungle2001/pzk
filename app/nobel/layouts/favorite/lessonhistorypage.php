 <?php 
    $member=pzk_request()->getMember();
    $lesson_historyId=pzk_request()->getLesson_historyId();
    $listlessions=$data->viewListLesson($member,$lesson_historyId);
     $listlessions= array_reverse($listlessions);
    $tam = $lesson_historyId % 6;
   ?>
   <?php foreach($listlessions as $listlession): ?> 
  <div class="list_lesson_row">
   
     <div class="lesson_history_name_row"><a href="/favorite/detailLesson?member=<?php echo $member ?>&lesson=<?php echo @$listlession['id']?>">Bài <?php echo @$listlession['id']?></a></div>
     <div class="lesson_history_type_row"><a href="/favorite/detailLesson?member=<?php echo $member ?>&lesson=<?php echo @$listlession['id']?>"><?php echo @$listlession['name']?></a></div>
     <div class="lesson_history_type_row"><?php echo @$listlession['date']?></div>
     
  
  </div>
  <?php endforeach; ?>
 <?php 

  $count_arr= count($listlessions);
  

  if(!empty($listlessions))
  {
   
    $countLesson= $data->countLesson($member,$listlessions[0]['id']);
    //var_dump($count_lesson_favorite);
   
    echo "<script>$('#count_lesson_history').html(".$countLesson.");</script>";
    echo '<script>window.lesson_historyId='.$listlessions[0]['id'].';</script>';
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
   
</script>