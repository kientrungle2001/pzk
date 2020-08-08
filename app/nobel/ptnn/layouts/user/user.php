
<style>
  .menu
{
  width:100%; 
  height:30px; 
  line-height:30px;
  margin:0 auto;
}
.menu li
{
  
  display:inline-block;
  width:100%;
}
.menu li ul
{
  position:absolute; 
  display:none;
}
.menu li:hover > ul
{
  display:block;
}
.menu a
{
  display:block; 
  color:black;
  background:#ffff00;
}
.menu ul ul,
.menu li:hover > a,
.menu a:hover
{
  opacity:.8;
}

</style>
<div id="user" style="padding-right: 50px;padding-button: 50px;">
<?php
    if(pzk_session('login')){

    $data->loadData();
    
   ?>

<div class="menu">
<ul>
  <li> <a href="/user/profileusercontent?member=<?php echo  pzk_session('username');  ?>"><?php echo "Xin chào: ". $data->getName();     ?></a>
  <ul>
    <li><a href="#">Tài khoản hiện có :<?php if( $data->getAmount()==0) echo 0; else echo $data->getAmount(); ?>vnđ</a></li>
    <li><a href="/user/profileusercontent?member=<?php echo  pzk_session('username');  ?>">Vào trang cá nhân</a></li>
    <li><a href="/user/payment">Nạp tiền</a></li>
     <li><a href="/user/logout">Thoát</a></li>
  </ul>
  </li>
</ul>
  
</div>


<?php } else{ ?>

<form method="post" action="/User/loginPost" >
  
    <input style="width: 120px;" type="text" name="userlogin" size="10px" id="userlogin"placeholder="Username" value="">
    <input style="width: 120px;"type="password" name="userpassword"placeholder="Password" id="userpassword" value="">
    <button type="submit" class="login-button" id="usersubmit">Đăng nhập</button>
    <a href="/user/register">Đăng ký</a>
  
</form>
  <?php } ?>
  </div>