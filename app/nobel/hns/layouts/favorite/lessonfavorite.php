<div id="lesson_favorite">
<div class="lesson_favorite_">
  <div class="fvr_title"><span class="glyphicon glyphicon-star"></span><span> Danh sách những bài học yêu thích</span></div>
  <div class="prf_clear"></div>
  <div style="margin:auto;text-align:center;"><img src="/3rdparty/uploads/img/circle.png" alt="" width="500px" height="30px"></div>
  <div class="clear" style="padding-bottom:10px;"></div>
  <div class="lesson_favorite_list">
  
   <div class="list_lesson_favorite">
   
     <div class="lesson_name">Tên bài học</div>
     <div class="lesson_type">Thể loại</div>
     <div class="lesson_type">Thời gian</div>
     <div class="lesson_del">Xóa</div>
  
   </div>
   <div id="add_more_favorite"></div>
   <div id="show_empty_favorite" class="show_empty"></div>
  <?php 
    $member=pzk_request()->getMember();

    $lesson_favorite_id=pzk_request()->getLesson_favoriteId();
    
    $listlessions=$data->viewListLesson($member,$lesson_favorite_id);

    $listlessions= array_reverse($listlessions);
    
   ?>
   <?php foreach($listlessions as $listlession): ?> 
  <div class="list_lesson_row">
   
     <div class="lesson_name_row"><?php echo @$listlession['lessonName']?></div>
     <div class="lesson_type_row"><?php echo @$listlession['categoriesName']?></div>
     <div class="lesson_type_row"><?php echo @$listlession['date']?></div>
     <?php $id=$listlession['id']; ?>
     <div class="lesson_del_row"><a href="/favorite/delLessionfavorite/<?=$id?>" class="<?php echo @$listlession['id']?>" onclick="return confirm('are you sure?')">Xóa</a></div>
  
  </div>
  <?php endforeach; ?>
  <div id="view_more_lesson_favorite">

      <a href="#" onclick="viewMore(); return false;"><span>Xem thêm <span id="count_lesson_favorite"></span> bài khác >></span></a>
    </div>
 </div>
 </div>
</div>
<?php 

  $count_arr= count($listlessions);
  

  if(!empty($listlessions))
  {
   
    $count_lesson_favorite= $data->countLessonFavorite($member,$listlessions[0]['id']);
    //var_dump($count_lesson_favorite);
   
    echo "<script>$('#count_lesson_favorite').html(".$count_lesson_favorite.");</script>";
    echo '<script>window.lesson_favoriteId='.$listlessions[0]['id'].';</script>';
  }else{
    echo "<script>$('#show_empty_favorite').html('<span>không có bài học nào</span>');</script>";
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
   function viewMore()
    {
      //alert('in');
      var member= '<?php echo $member; ?>';
      var lesson_favoriteId= window.lesson_favoriteId;
      $.ajax({
        url:'/favorite/viewlesson',
        data:{
          lesson_favoriteId:lesson_favoriteId,
          member: member
        },
        success: function(result)
        {
          //alert(result);
          $('#add_more_favorite').after(result);
        }
      });
      
    }
</script>