 <style>

 </style>
 <div style="clear:both;"></div>
 
 <div id="userfriendlist" style="height: 100px;">
      <?php 
        $request=pzk_request();
        $member=$request->getMember();
        // Đếm số bản ghi
        $countrow=_db()->useCB()->select('count(*) as countfriend')->from('friend')->where(array('username',$member))->result_one();
    
        $totalrow= $countrow['countfriend'];
        $row_per_page= 9;
        
        if($totalrow > $row_per_page)
        {
          $page=ceil($totalrow / $row_per_page);
        }
        else $page=1;
       
        if(isset($_GET['start']) && (int)$_GET['start']) 
         $start=$_GET['start']; //dòng bắt đầu từ nơi ta muốn lấy 
        else $start=0;
        $sql="select * from `friend` where username='".$member."' order by id asc limit ".$start.",".$row_per_page ;
        $friend= _db()->query($sql); 
        //$friend = _db()->select('user.*, friend.*')->from('user')->join('friend', 'user.username = friend.username', 'left')->result();
        //$friend=_db()->useCB()->select('friend.*')->from('friend')->where(array('username',$member))->result();
        if($friend){

        foreach ($friend as $items) { 
            
      ?>
      <div>
        <div class="div1">
          <div style="float:left;width:50%;">

            <img src="<?php  echo BASE_URL."/3rdparty/uploads/img/noavatar.gif"; ?>" width="125px" height="125px">
          </div>
          <div style="float:left;width:50%;">
            <a href="/user/profilefriend?member=<?php echo $items['userfriend']; ?>"><?php echo $items['userfriend']; ?></a>
            <p><a href="/user/denyfriend?userfriend=<?php echo $items['userfriend']; ?>"><img src="<?php echo BASE_URL.'/3rdparty/uploads/img/huyketban.png' ; ?>" alt="Bạn bè"></a> </p>
          </div>
        </div>
        
      </div>
        <?php 
        }
      }
        ?>
    <?php 
//bắt đầu phân trang 
$page_cr=ceil($start/$row_per_page)+1; 
echo "Trang " ;
for($i=1;$i<=$page;$i++) 
{ 
 if ($page_cr!=$i){
  echo "<a href='/user/friendlist?start=".$row_per_page*($i-1)."'>$i&nbsp;</a>"; 
  }
 else echo $i." "; 

} 
?> 
 </div>
