
<link rel="stylesheet" href="<?php echo BASE_URL ?>/default/skin/nobel/ptnn/css/style.css">
<div style=" border-width: 1px;border-style: solid; border-color: #FF7357;  width:100%; " id="editinfor"> 
                <div align="center" id="steps" style=" padding-bottom: 10px;border-width: 1px;border-style: solid; border-color: #FF7357;  background-color: #fff;  width:100%;">
<style>
    label 
    {
        width: 250px;
    }
</style>
                  <p > <strong >THÔNG TIN CÁ NHÂN</strong></p>
                </div>
                    
                    <form id="formEditinfor" name="formEditinfor" method="post"action="/User/editinforPost" > 
                                                  
                                <br>
                                <label for="name">Họ và Tên</label> 
                                <input id="name" name="name" type="text" value=" <?php echo $data->getName();?>" autocomplete="OFF"/> 
                                <br>
                                <label for="birthday">Ngày sinh</label> 
                                <input id="birthday" name="birthday" type="date" value="<?php echo $data->getBirthday();?>" autocomplete="OFF" src=""/> 
                                <br>
                                <label for="address">Địa chỉ</label> 
                                <input id="address" name="address" type="text" value="<?php echo $data->getAddress();?>"autocomplete="OFF" src=""/> 
                                <br>
                                <label for="phone">Số điện thoại</label> 
                                <input id="phone" name="phone" value=" <?php echo $data->getPhone();?>" type="tel" autocomplete="OFF" src=""/> 
                                <br>

                                <label for="idpassport">Số CMT hoặc hộ chiếu</label> 
                                <input id="idpassport" name="idpassport"  type="text"value="<?php echo $data->getIdpassport();?>" autocomplete="OFF" src=""/> 
                                <br>
                                <label for="iddate">Ngày cấp</label> 
                                <input id="iddate" name="iddate"  type="date"value="<?php echo $data->getIddate();?>" autocomplete="OFF" src=""/> 
                                <br>
                                <label for="idplace">Nơi cấp</label> 
                                <input id="idplace" name="idplace"  type="text"value="<?php echo $data->getIdplace();?>" autocomplete="OFF" src=""/> 
                                <br> 
                                <label for=""></label>
                                <button id="EditinforButton" type="submit">Cập nhật</button> 
                       
                    </form> 
        
 </div> 
                