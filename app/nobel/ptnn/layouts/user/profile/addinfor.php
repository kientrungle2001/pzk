<script language="javascript" src="../3rdparty/Validate/lib/jquery.js"></script>
<script src="../3rdparty/Validate/dist/jquery.validate.js"></script>
 <script>
 $(document).ready(function () {
         $("#formAddinfor").validate({
            rules: {
                
                addusername: {
                    required: true,
                    minlength: 5,
                    username:true
                   
                },
                
                addpassword: {
                    required: true,
                    minlength: 6
                    
                },
                addemail: {
                    required: true,
                    email: true
                },
                addday:{
                    required: true,
                    min:1,
                    max:31
                },
                addmonth:{
                    required: true,
                    min:1,
                    max:12
                },
                addyear:{
                    required: true,
                    min:1905,
                },
                addphone:{
                    required: true
                    
                }
            },
            messages: {
                
                addusername: {
                    required: "Yêu cầu nhập tên đăng nhập",
                    minlength: "Tên đăng nhập tối thiểu phải 6 ký tự",
                    username:" Tên đăng nhập chưa đúng"
                    
                },
                addpassword: {
                    required:   "Yêu cầu nhập mật khẩu đầy đủ",
                    minlength:  "Mật khẩu tối thiểu phải 6 ký tự "
                    
                },
                addemail: "Email chưa đúng định dạng",
                addday:"",
                addmonth:"",
                addyear:"",
                addphone:""
                
            }
        });
     });
</script>
<div  class="addinfor"> 
                <div  class="layout_title">BỔ XUNG THÔNG TIN CÁ NHÂN</div>
                <div class="clear"></div>  
                <div class="message_note" style="padding-top:10px; padding-bottom: 10px;">
                    Bạn đang đăng nhập bằng tài khoản Facebook. <br> 
                    Sau khi bổ xung thông tin cá nhân chúng tôi sẽ cung cấp Tài khoản đăng nhập và mật khẩu vào email của bạn <br>
                    Lần sau bạn có thể sử dụng tên đăng nhập và mật khẩu này để đăng nhập trực tiếp vào NextNobels
                </div>
                <div class="clear"></div>    
                   
                    <form id="formAddinfor" class="register form-horizontal margin-top-20" method="post" onsubmit="pzk_{data.id}.frmAddinfor(); return false; ">
                            <div class="form-group margin-top-10">
                                
                                <div class="col-xs-4 margin-top-10">
                                    <label for="username">Tên đăng nhập (*) :</label>
                                    <input type="text" class="form-control" id="addusername" name="addusername" placeholder="Tên đăng nhập" data-toggle="tooltip" data-placement="top" title="Tên đăng nhập tối thiểu phải 6 ký tự, không có ký tự đặc biệt">
                                </div>
                                <div class="col-xs-4 margin-top-10">
                                    <label for="email">Email (*) :</label>
                                    <input type="text" class="form-control" id="addemail" style="width: 315px;" name="addemail" placeholder="Email" data-toggle="tooltip" data-placement="top" title="Email của bạn">
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-xs-4 col-xs-offset-2 margin-top-10" style="margin-left:0px !important;">
                                    <label for="password1">Mật khẩu (*):</label>
                                    <input type="password" class="form-control" id="addpassword" name="addpassword" placeholder="Mật khẩu" data-toggle="tooltip" data-placement="top" title="Mật khẩu phải có ít nhất 6 ký tự"/>
                                </div>
                                
                                <div class="col-xs-2 margin-top-10">
                                    <label for="phone">Điện thoại (*) :</label>
                                    <input type="text" class="form-control" id="addphone" style="width: 165px;" name="addphone" placeholder="Điện thoại" data-toggle="tooltip" data-placement="top" title="Điện thoại phải là số">
                                </div>
                                <div class="col-xs-2 margin-top-10" style="margin-left: 35px;">
                                    <label for="sex">Giới tính</label>
                                    <select  class="form-control" id="addsex" name="addsex" data-toggle="tooltip" data-placement="top" title="Lựa chọn giới tính">
                                        <option value="1" class="pd-5">Nam</option>
                                        <option value="0" class="pd-5">Nữ</option>
                                    </select>
                                </div>
                                <div class="clearfix" style="padding-bottom:10px;"></div>
                                <div class="col-xs-4 margin-top-10">
                                    <label for="username">Địa chỉ :</label>
                                    <input type="text" class="form-control" id="addaddress" name="addaddress" placeholder="Địa chỉ" data-toggle="tooltip" data-placement="top" title=" Địa chỉ của bạn" >
                                </div>
                                
                                 <div class="col-xs-8 margin-top-10">
                                    <label for="username">Ngày sinh (*) :</label>
                                    <div class="clear"></div>
                                    <div class="col-xs-2" style="padding-left: 0px; padding-right: 0px; margin: auto">
                                        <select id="addday" class="form-control" title="Ngày" style="width: 83px;" name="birthday_day" aria-label="Ngày" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                                         <?php for($d = 1; $d <=31; $d++):?>
                                          <?php if($d < 10){ ?>
                                          <option value="<?php echo '0'.$d;?>"><?php echo '0'.$d;?></option>
                                          <?php }else{ ?>
                                          <option value="<?=$d;?>"><?=$d;?></option>
                                          <?php } ?>
                                        <?php endfor;?>
                                      </select>
                                    </div>
                                    <div class="col-xs-2" style="padding-left: 0px; padding-right: 10px;">
                                      <select id="addmonth" class="form-control col-xs-4" style="padding-left:5px;width: 104px;" title="Tháng" name="birthday_month" aria-label="Tháng" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                                        
                                          <?php for($m = 1; $m <= 12; $m++):?>
                                          <?php if($m< 10){ ?>
                                            <option value="<?php echo '0'.$m;?>"><?php echo 'Tháng '.$m?></option>
                                          <?php }else{ ?>
                                            <option value="<?=$m;?>">Tháng <?=$m?></option>
                                          <?php } ?>
                                        <?php endfor;?>
                                      </select>
                                    </div>
                                    <div class="col-xs-2" style="padding-left: 20px; padding-right: 0px; ">
                                      <select id="addyear" class="form-control col-xs-4" title="Năm" name="birthday_year" style="width: 100px;" aria-label="Năm" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                    
                                        <?php
                                        $y = date("Y");
                                        for($i = $y; $i > 1905; $i--):?>
                                        <option value="<?=$i;?>"><?=$i;?></option>
                                        <?php endfor;?>
                                      </select>
                                    </div>
                                    <input type="hidden" id="addbirthday" class="birthday" name="birthday" value=""/>
                                </div>    
                                
                                <div class="clearfix"></div>
                                <div class="col-xs-4 margin-top-10">
                                    <label for="school">Trường :</label>
                                    <input type="text" class="form-control" id="addschool" name="addschool"  placeholder="Trường học" data-toggle="tooltip" data-placement="top" title="Trường học">
                                </div>                            
                               
                                <div class="col-xs-2 margin-top-10">
                                    <label for="class">Lớp học :</label>
                                    <input type="text" class="form-control" id="addclass" name="addclass"  placeholder="Lớp học" data-toggle="tooltip" data-placement="top" title="Lớp học">
                                </div> 
                                <?php 
                                
                                  $areacode=_db()->getEntity('User.Account.User');                  
        
                                  $areas= $areacode->loadArea();
                                  
                                ?>
                                <div class="col-xs-3 margin-top-10">
                                    <label for="area">Tỉnh/TP :</label>
                                    <select  class="form-control" id="addareacode" style="width: 164px;" title="Tỉnh/ Thành phố" name="addareacode" aria-label="Tỉnh/tp" data-toggle="tooltip" data-placement="top" title="Tỉnh/ Thành phố" >
                                       
                                                
                                                {each $areas as $area}
                                                <option value="<?php echo $area['id']; ?>"><?php   echo $area['name']; ?></option>
                                                {/each}
                                            
                                    </select>
                                </div>
                                <div id="mass_addinfor" class="col-xs-8 margin-top-10">
                                    
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-xs-2 margin-top-33 " style="margin-top: 10px;" >
                                    <button type="submit" id="addButton" onclick="return pzk_{data.id}.set_birthday()" class="btn btn-primary">Cập Nhật</button>
                                </div>
                            </div>
                        </form>
                        
 </div> 
<script>

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>                