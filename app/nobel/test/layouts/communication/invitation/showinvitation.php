   <style>

      input {
          margin-bottom: 10px;
      }
    </style>
    <div style="border-width: 1px;border-style: solid; border-color: #FF7357;  width:80%; ">
    <div> 
    <p align="center"><strong> Kết bạn</strong></p>
    </div> 
     <?php if($data->getMessage()=='ok')   
     {
      ?>

     <br> 
      <label for="invitation">Bạn đã gửi một yêu cầu kết bạn đến  <a href="#"> <?php echo $data->get('username'); ?></a></label><br>
    
      <br>  
    <?php }else { ?>  
      <br> 
      <label for="invitation">Bạn đã yêu cầu kết bạn đến  <a href="#"> <?php echo $data->get('username'); ?></a><br>
      Xin vui lòng chờ xác nhận của <?php echo $data->get('username'); ?></label><br>
    
      <br> 
      <?php } ?>
  </div>

