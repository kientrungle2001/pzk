  <?php 
    $member=pzk_request()->getMember();

    $lesson_favorite_id=pzk_request()->getLesson_favoriteId_member();
    
    $listlessions=$data->viewListLesson($member,$lesson_favorite_id);

    $listlessions= array_reverse($listlessions);
    
   ?>
   {each $listlessions as $listlession} 
  <div class="list_lesson_row">
   
     <div class="lesson_name_row" style="width: 40%;">{listlession[lessonName]}</div>
     <div class="lesson_type_row" style="width: 40%;">{listlession[categoriesName]}</div>
     <div class="lesson_type_row" style="width: 20%;">{listlession[date]}</div>
    
  
  </div>
  {/each}
<?php 

  $count_arr= count($listlessions);
  

  if(!empty($listlessions))
  {
   
    $count_lesson_favoritemember= $data->countLessonFavorite($member,$listlessions[0]['id']);
    //var_dump($count_lesson_favoritemember);
   
    echo "<script>$('#count_lesson_favoritemember').html(".$count_lesson_favoritemember.");</script>";
    echo '<script>window.lesson_favoriteId_member='.$listlessions[0]['id'].';</script>';
  }
 ?> 
<script>
  var numberrow= parseInt('<?php echo @$count_arr ; ?>');
  var count_lesson_favoritemember=parseInt('<?php echo @$count_lesson_favoritemember ?>');
 
  $('#view_more_lesson_favoritemember').hide();
  if(numberrow < 6 || count_lesson_favoritemember<=0)
  {
    $('#view_more_lesson_favoritemember').hide();
  }else{
    $('#view_more_lesson_favoritemember').show();
  }    
  
</script>