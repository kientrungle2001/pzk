   <style>
    
    </style>
    <div id="editsign">
    <div class="layout_title">  THAY ĐỔI CHỮ KÝ </div>
    <div class="clear"></div> 
    <div>
    <form method="post" action="/Profile/editsignPost" >   
    
     <br>
      <div class="col-xs-10 margin-top-10">
        <label for="sign">Chữ ký hiện tại :</label>
        <lable style="float:left;"><?php echo $data->getSign(); ?></lable>
      </div> 
      <div class="clearfix" style="padding-bottom:10px;"></div>
      <div class="col-xs-10 margin-top-10">
        <label for="sign">Chữ ký mới :</label>
        <textarea name="newsign" id="newsign"class="form-control" placeholder="Nhập chữ ký mới" rows="3" value=""></textarea>
      </div>  
      <div class="clearfix" style="padding-bottom:10px;"></div>
      <div class="col-xs-2 margin-top-33 " style="margin-top: 10px;" >
        <button type="submit"  class="btn btn-primary">Cập Nhật</button>
      </div>
    
  </form>
  </div>
  </div>

