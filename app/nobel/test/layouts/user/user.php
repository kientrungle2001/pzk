
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
  <li> <?php echo "Xin chào: ". $data->getName();     ?>
  <ul>
 
    <li><a href="/payment/bank">Mua tài khoản</a></li>
     <li><a href="/user/logout">Thoát</a></li>
  </ul>
  </li>
</ul>
  
</div>


<?php }  ?>

</div>