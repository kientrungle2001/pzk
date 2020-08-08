      <?php 
        $request=pzk_request();
        $member=$request->getMember();
        //$_REQUEST['showSQL']=1;
        $notes=$data->viewNote($member);
        
        $countnote= $data->countNote($member);
        // số bản ghi
        $rownote= $countnote['count'];
        // Số bản ghi/ trang
        $num_record= 10;
        $num_page=ceil($rownote/$num_record);


        $notes=$data->viewNote($member);
      ?>
     
      {each $notes as $note}

     <div class="{note[id]}">
      
      <div style="float:left;">
        <input style=" float:left;width:15px; height:15px;" type="checkbox" value="{note[id]}" name="ckbdel" >
        <img src="/default/skin/test/media/usernote.png" alt="">
      </div>
    <div class="prf_titlenote">
        <a href="/profile/detailnote?member=<?php echo $member ?>&id={note[id]}">{note[titlenote]}</a>
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
<script>
// Kiểm tra member=session(userId)
var member= "<?php echo pzk_request()->getMember(); ?>";
var sessionID= "<?php echo pzk_session('userId'); ?>";
if(member != sessionID){
    $('input[name=ckbdel]').hide();
  
}else{
    $('input[name=ckbdel]').show();
  
}
</script>
 </div>