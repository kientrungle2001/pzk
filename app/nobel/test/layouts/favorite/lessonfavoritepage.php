  <?php 
    $member=pzk_request()->getMember();
    $lesson_favorite_id=pzk_request()->getLesson_favoriteId();

    $listlessions=$data->viewListLesson($member,$lesson_favorite_id);

    $listlessions= array_reverse($listlessions);
  
   ?>
   {each $listlessions as $listlession} 
  <div class="list_lesson_row">
   
     <div class="lesson_name_row">{listlession[lessonName]}</div>
     <div class="lesson_type_row">{listlession[categoriesName]}</div>
     <div class="lesson_type_row">{listlession[date]}</div>
     <?php $id=$listlession['id']; ?>
     <div class="lesson_del_row"><a href="/favorite/delLessionfavorite/<?=$id?>" class="{listlession[id]}" onclick="return confirm('are you sure?')">Xóa</a></div>
  
  </div>
  {/each}
  <?php 

  $count_arr= count($listlessions);
  

  if(!empty($listlessions))
  {
   
    $count_lesson_favorite= $data->countLessonFavorite($member,$listlessions[0]['id']);
    //var_dump($count_lesson_favorite);
   
    echo "<script>$('#count_lesson_favorite').html(".$count_lesson_favorite.");</script>";
    echo '<script>window.lesson_favoriteId='.$listlessions[0]['id'].';</script>';
  }
 ?> 
<script>
  var numberrow= parseInt('<?php echo @$count_arr ; ?>');
  var count_lesson_favorite=parseInt('<?php echo @$count_lesson_favorite ?>');
 
  $('#view_more_lesson_favorite').hide();
  if(numberrow < 6 || count_lesson_favorite<=0)
  {
    $('#view_more_lesson_favorite').hide();
  }else{
    $('#view_more_lesson_favorite').show();
  }    
</script>