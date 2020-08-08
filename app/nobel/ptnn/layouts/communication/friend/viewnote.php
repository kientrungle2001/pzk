
<style>
 #profilefriend
 {
  width: 100%;
  height: 800px;
  
  float: left;
 } 
  #profilefriend_left
 {
  width: 30%;
  height: 800px;
  float: left;
  
 }
  #profilefriend_right
 {
  width: 70%;
  height: 800px;
  
  float: left;
 } 
 .prf_profile
 {
  width: 100%;
  float: left;
 background-color: #E6E6FA;
  height: 400px;
  margin-top: 10px;
 } 
 .prf_title
 {
  width: 100%;
  float: left;
  background-color: #008000;
  height: 30px;
  font-size: 10pt;
  text-align: center;
  color: #fff;
  margin: 10px 0;
 } 
.prf_content
 {
  
  width: 100%;
  float: left;
  height: 30px;
  
 }
 .prf_clear
 {
  padding-bottom: 20px;
 clear: both;
 color: #57970F;

 } 
 .prf_member
 {
  font-size: 13pt;
  text-align: center;
 
  margin-top: 10px;
 } 
.prf_avatar
 {
  margin-left: 70px;
  margin-right: 30px;
  margin-top: 10px;
  margin-bottom: 10px;
  min-height: 80px;
  max-height: 160px;
  width: 123px;

 }
 .prf_note
 {
  clear: both;
  height: auto;
  width: 100%;
 }
.prf_titlenote
{
  float: left;
margin-left: 5px;
font-weight: bold;
color: #0081a1;
font-size: 12px;
}
.pr_bt_viewmore_c { margin-left: 20px; height:21px; float:left; background: url("../3rdparty/uploads/img/btt.png") 0px -28px  repeat-x ; text-transform:uppercase; color:#757575; font-size:11px; font-family:Tahoma, sans-serif; font-weight:bold; padding:7px 6px 0 0; padding-top:8px; height:20px ;}
.pne_st1_r_file_bt {float:right; background:url("http://data.tienganh123.com/images/v2/pne_bt_file.jpg") repeat-x; /*padding:10px 15px 0 15px;*/ height:25px; font-weight:bold; border-radius:4px;margin-left: 4px; }
.pfr_avatar_wall
{

  clear: both;
  width: 30%;
  height: auto;float: left;
}
.prf_write_wall
{
  width: 100%;
  height:auto;
}
</style>


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
         <a href="/friend/detailnote?member=<?php echo $member ?>&id={note[id]}">{note[titlenote]}</a>
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
    <a href="/friend/addnote?member=<?php echo $member ?>"><input style="width:80px;" type="button" name="bttadd" value="Thêm mới"></a>
  </p>

</div>    
<div id="btt_viewnote">
  <p>
    
    <a href="/profile/user?member=<?php echo $member ?>"><input style="width:80px;" type="button" name="bttback" value="Quay lại"></a>
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
      url:'../friend/viewnotePage',
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
        url:'/friend/PostDelUserNote',
        success: function(msg){

          loadpage(currentpage);
        }
      });

      // End post du lieu

});
</script> 

  </div>