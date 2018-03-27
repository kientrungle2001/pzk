   <style>
      label{
          float: left;
          width: 200px;
      }
      input {
          margin-bottom: 10px;
      }
    </style>
    <div style="border-width: 1px;border-style: solid; border-color: #FF7357;  width:80%; ">
    <div> 
    <p align="center"><strong> Thay đổi chữ ký</strong></p>
    </div> 
    <form method="post" action="/User/editsignPost" >   

     <br> 
      <label for="sign">Chữ ký hiện tại:</label><br>
      <lable style="float:left;"><?php echo $data->get('sign'); ?></lable>
      <br>    
      <label for="newsign">Chữ ký mới:</label>
      <textarea name="newsign" id="newsign"class="form-control" rows="3" value=""></textarea>
      <br>
    <label for="">&nbsp;</label>
      <button type="submit" class="sign-button">Cập nhật</button>
   
  </form>
  </div>

