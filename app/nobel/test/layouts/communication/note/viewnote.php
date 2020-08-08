
<div id="profilefriend_right">
    <div class="prf_title">Chào mừng bạn đã ghé thăm góc học tập của tôi</div>
    <div class="prf_clear" style="width: 100%; height: 30px;"></div>

    <div class="prf_title" style="width:30%;">Ghi chép cá nhân </div>
    <div id="prf_viewnotepage" class="prf_note">
      <?php 

        $request=pzk_request();
        $member=$request->getMember();
        $countnote= $data->countNote($member);
        // số bản ghi
        $rownote= $countnote['count'];
        // Số bản ghi/ trang
        $num_record= 10;
        $num_page=ceil($rownote/$num_record);

      
        $notes=$data->viewNote($member);

      ?>
      <script>
     
      var id=[];
     
      </script>
      {each $notes as $note}

     <div class="{note[id]}">
       <script>
       var val='{note[id]}';
       id.push(val);
      </script>
      <div style="float:left;">
        <input style=" float:left;width:15px; height:15px;" type="checkbox" value="{note[id]}" name="ckbdel" >
        <img src="/3rdparty/uploads/img/usernote.png" alt="">
      </div>
    <div class="prf_titlenote">
         <a href="/note/detailnote?member=<?php echo $member ?>&id={note[id]}">{note[titlenote]}</a>
      </div>

      <div class="prf_clear"> </div>
       
      </div>
      {/each}
       
      
           
    <div> Trang 
    <?php 
      for($i=1; $i<=$num_page;$i++){


     ?>
      
     <a href="#" id="span <?php echo $i; ?>" onclick="loadpage(<?php echo $i; ?>)"><?php echo $i; ?></a>
    
    <?php } ?>
    </div>
 </div>
    
<div id="btt_viewnote_add">
  <p>
    <input style="width:50px;" type="button" name="bttdel" id="btt_note_del" value="Xóa">
    <a href="/note/addnote?member=<?php echo $member ?>"><input style="width:80px;" type="button" name="bttadd" value="Thêm mới"></a>
  </p>

</div>    
<div id="btt_viewnote">
  <p>
    
    <a href="/profile/profileusercontent?member=<?php echo $member ?>"><input style="width:80px;" type="button" name="bttback" value="Quay lại"></a>
  </p>

</div>     
<script>
// Kiểm tra member=session(userId)
var member= "<?php echo pzk_request()->getMember(); ?>";
var sessionID= "<?php echo pzk_session()->getUserId(); ?>";
if(member != sessionID){
    $('input[name=ckbdel]').hide();
    $('#btt_viewnote_add').hide();
    $('#btt_viewnote').show();
}else{
    $('input[name=ckbdel]').show();
    $('#btt_viewnote_add').show();
    $('#btt_viewnote').hide();
}
// phan trang
  function loadpage(page)
  {
    currentpage= page;
    $.ajax({
      type: "Post",
      data:{
        member: "<?php echo $member ?>",
        page: page

      },
      url:'../note/viewnotePage',
      success: function(msg){
        $('#prf_viewnotepage').html(msg);
        
      }

    });
  }

//end phan trang
  $('#btt_note_del').click(function()
  {
   var check_array=[];
   var checkeds = $('input[name=ckbdel]:checked');
   $.each(checkeds, function( index, checked ) {
    //alert( index + ": " + value );

      check_array.push(checked.value);
      //$('.'+value).remove();
    
  });
   //alert(check_array);

    //Post du lieu
      $.ajax({
        type: "POST",
        data: {del:check_array},
        url:'/note/PostDelUserNote',
        success: function(msg){
          if(currentpage=""){
            currentpage=1;
          }
          loadpage(currentpage);
        }
      });

      // End post du lieu

});
</script> 

  </div>