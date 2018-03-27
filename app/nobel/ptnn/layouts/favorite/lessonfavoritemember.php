<div id="lesson_favorite_member">
<div class="lesson_favorite_">
  <div class="fvr_title"><span class="glyphicon glyphicon-star"></span><span> Danh sách những bài học yêu thích</span></div>
  <div class="prf_clear"></div>
  <div style="margin:auto;text-align:center;"><img src="<?php echo BASE_URL.'/default/skin/test/media/circle.png'; ?>" alt="" width="500px" height="30px"></div>
  <div class="clear" style="padding-bottom:10px;"></div>
  <div class="lesson_favorite_list">
  
   <div class="list_lesson_favorite">
   
     <div class="lesson_name" style="width: 40%;">Tên bài học</div>
     <div class="lesson_type" style="width: 40%;">Thể loại</div>
     <div class="lesson_type" style="width: 20%;">Thời gian</div>
     
   </div>
   <div id="add_more_favoritemember"></div>
   <div id="show_empty_favorite_mb" class="show_empty"></div>
  <?php 
    $member=pzk_request('member');

    $lesson_favorite_id=pzk_request('lesson_favoriteId_member');
    
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
  <div id="view_more_lesson_favoritemember">

      <a href="#" onclick="viewMore(); return false;"><span>Xem thêm <span id="count_lesson_favoritemember"></span> bài khác >></span></a>
    </div>
 </div>
 </div>
</div>
<?php 

  $count_arr= count($listlessions);
  

  if(!empty($listlessions))
  {
   
    $count_lesson_favoritemember= $data->countLessonFavorite($member,$listlessions[0]['id']);
   
    echo "<script>$('#count_lesson_favoritemember').html(".$count_lesson_favoritemember.");</script>";
    echo '<script>window.lesson_favoriteId_member='.$listlessions[0]['id'].';</script>';
  }else{
    echo "<script>$('#show_empty_favorite_mb').html('<span>không có bài học nào</span>');</script>";
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
   function viewMore()
    {
      //alert('in');
      var member= '<?php echo $member; ?>';
      var lesson_favoriteId_member= window.lesson_favoriteId_member;
      $.ajax({
        url:'/favorite/viewlessonmember',
        data:{
          lesson_favoriteId_member:lesson_favoriteId_member,
          member: member
        },
        success: function(result)
        {
          //alert(result);
          $('#add_more_favoritemember').after(result);
        }
      });
      
    }
</script>