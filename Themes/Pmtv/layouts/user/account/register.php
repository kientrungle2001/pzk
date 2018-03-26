


<script>
 
    $().ready(function() {
        
        // validate signup form on keyup and submit
        $("#formRegister").validate({
            rules: {
                
                username: {
                    required: true,
                    minlength: 5,
                    username:true
                   
                },
                name: {
                    required: true,
                    minlength: 5
                    
                },
                password1: {
                    required: true,
                    minlength: 6,
                    password:true
                },
                confirm_password: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password1"
                },
                email: {
                    required: true,
                    email: true
                },
                
                agree: "required",
                captcha: "required"
            },
            messages: {
                
                username: {
                    required: "Yêu cầu nhập tên đăng nhập",
                    minlength: "Tên đăng nhập tối thiểu phải 6 ký tự",
                    username:" Tên đăng nhập chưa đúng"
                    
                },
                password1: {
                    required: "Yêu cầu nhập mật khẩu đầy đủ",
                    minlength: "Mật khẩu tối thiểu phải 6 ký tự ",
                    password:"Yêu cầu nhập đúng mật khẩu"
                },
                confirm_password: {
                    required: "Yêu cầu nhập lại mật khẩu ở trên",
                    minlength: "Mật khẩu tối thiểu là 6 ký tự",
                    equalTo: "Yêu cầu nhập lại mật khẩu ở trên"
                },

                email: "Email chưa đúng định dạng",
                agree: " Bạn chưa đồng ý với điều khoản của NextNobels. Để đăng ký bạn phải chấp nhận các điều khoản",
                captcha: "Bạn hãy nhập mã bảo mật giống với hình bên cạnh"
            }
        });
    });
       

</script>

<div id="register"> 
                <div align="center" class="steps" style="">
                  <p > <strong >ĐĂNG KÝ THÀNH VIÊN</strong></p>
                </div>
                    
                    <form id="formRegister" name="formRegister" method="post" action="/Account/registerPost" > 
                        <fieldset  style="padding-bottom: 20px;padding-top: 20px;width:100%;"> 
                            <legend class="step">Thông tin tài khoản</legend>
                           
                               <div class="name">
                                    <label for="username">Tên đăng nhập *</label> 
                                    <label class="note" for="">(ít nhất 6 kí tự)<br>*Chỉ gồm chữ latin và số <br> Ví dụ: <strong>hoctiengviet</strong></label>
                               </div>                                 
                                <div  class="inputid">
                                    <input class="user" type="text" id="username" name="username" minlength="5"  value="" /> 
                                </div>
                                
                                <div class="name">
                                    <label for="password1">Mật khẩu*</label> 
                                    <label class="note" >(ít nhất 6 kí tự) <br>*Mật khẩu phải bao gồm cả chữ cái và chữ số, có ít nhất 1 chữ cái viết hoa, 1 chữ cái viết thường, 1 chữ số và không được chứa khoảng trắng</label> 
                                </div>
                                <div class="inputid">
                                    <input class="user" id="password1" name="password1"  type="password"  value="" /> 
                                </div>
                                
                                <div class="name">
                                <label for="confirm_password">Xác nhận lại mật khẩu* </label> 
                                <label class="note"><br>*Bạn hãy nhập lại mật khẩu ở trên</label>
                                </div>
                                <div class="inputid">
                                    <input class="user" id="confirm_password" name="confirm_password"  type="password"  value="" /> 
                                </div>
                                
                                <div class="name">
                                    <label for="email">Email</label> 
                                    <label class="note" for=""> <br>  *Bạn hãy nhập email của bạn</label>
                                </div>
                                <div class="inputid">
                                <input class="user" id="email" name="email" type="email" placeholder="info@gmail.com"  value="" /> 
                                </div>
                                <br>
                        </fieldset> 
                        <fieldset style="padding-bottom: 20px;padding-top: 20px;"> 
                            <legend class="step">Thông tin cá nhân</legend> 
     
                                <div class="profile">
                                    <label  for="name">Họ và Tên</label>
                                </div>
                                <div class="inputprofile">
                                    <input id="name" name="name" type="text" minlength="5"  autocomplete="OFF"/> 
                                </div>
                                <div class="profile">
                                    <label for="birthday">Ngày sinh</label> 
                                </div> 
                                <div class="inputprofile">
                                    <input id="birthday" name="birthday" type="date"  autocomplete="OFF" src=""/> 
                                </div>
                                <div class="profile">
                                    <label for="sex">Giới tính</label>
                                </div>
                                <div class="inputprofile">
                                    <select style="width:150px;height:24px;" id="sex" name="sex">
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                    </select>
                                </div>
                                <div class="profile">
                                    <label for="address">Địa chỉ</label>
                                </div>
                                <div class="inputprofile">
                                    <input id="address" name="address" type="text"   autocomplete="OFF" src=""/> 
                                </div>
                                <div class="profile">
                                    <label for="phone">Số điện thoại</label>
                                </div>
                                <div class="inputprofile">
                                    <input id="phone" name="phone" placeholder="eg: 0987876789" type="tel"  autocomplete="OFF" src=""/> 
                                </div>
                                <div class="profile">
                                    <label for="idpassport">Số CMT hoặc hộ chiếu</label> 
                                </div>
                                <div class="inputprofile">
                                    <input id="idpassport" name="idpassport"  type="text" autocomplete="OFF" src=""/> 
                                </div>
                                <div class="profile">
                                    <label for="iddate">Ngày cấp</label> 
                                </div>
                                <div class="inputprofile">
                                    <input id="iddate" name="iddate"  type="date" autocomplete="OFF" src=""/> 
                                </div>                                
                                <div class="profile">
                                    <label for="idplace">Nơi cấp</label> 
                                </div>
                                <div class="inputprofile">
                                    <input id="idplace" name="idplace"  type="text"  autocomplete="OFF" src=""/> 
                                </div>      
 
                        </fieldset>                       
                        
                        <fieldset class="" style="padding-bottom: 20px;padding-top: 20px;"> 
                            <legend class="step">Điều khoản sử dụng</legend> 
                            <div style="width:100%;height:auto;">
                                    <input style="float:left; height: 18px; width:18px; padding-left:0px;" type="checkbox" class="checkbox" id="agree" name="agree">    
                                    <label style="float:left;" for="agree">Tôi đồng ý với các điều khoản trên</label>
                            </div>        
                            <div style="width:100%;float:left;height:auto;">                                       
                                    <label style="width:150px;" for="captcha">Nhập mã bảo mật:</label>
                                    <img src="<?php echo "http://".$_SERVER["SERVER_NAME"]."/3rdparty/captcha/random_image.php";  ?> " /> 
                                    <input  type="captcha" name="captcha" id="captcha" value="">
                                        
                                    <p align="center"> <button id="registerButton" type="submit">Đăng Ký</button> <p>
                            </div>                                       
                                                      
                        </fieldset> 
                    </form> 
        
 </div> 
                