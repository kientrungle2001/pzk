<?php 
	
	$camp = $data->getCamp();
    $contest = $data->getContest();
	$contestDateresult = array();
	if($contest){
		foreach($contest as $val){
			$contestDateresult[$val['id']] = $val['showResultDate'];
		}
	}
	
	$dataContest = $data->getDataContest();
	
    if(pzk_request('page')){
        $currentpage = intval(pzk_request('page'));
    }else $currentpage =0;
	
	if(isset($contestDateresult[$camp])) {
		$datefinish = $contestDateresult[$camp];
	} else {
		$datefinish	= '1970/01/01 00:00:00';
	}
 ?>

<?php 
	$endDate = $dataContest['showResultDate'];
	if(time() < strtotime($endDate) && !pzk_request(showDebug)): ?>
<div class="container boder nomg contentheight">
    <div class="row t-weight text-center btn-custom8 textcl">
       Bảng xếp hạng sẽ được công bố vào ngày: <?php echo date('d/m/Y', strtotime($endDate)); ?> lúc <?php echo date('H:i:s', strtotime($endDate)); ?>
    </div> 
</div>	
	<?php		 
	else:
?>
<div class="container boder nomg contentheight">
    <div class="row t-weight text-center btn-custom8 textcl">
       Bảng xếp hạng
    </div> 
    <div class="row  panel-default">
        <div class=" panel-heading">
            <form role="search" action="">
                <div class="row">
                    <div class="col-xs-2">
                        <label for="camp"> Chọn đợt thi</label>
                        <select style="margin-left: 4px;"  class="form-control input-sm" id="camp" name="testId" onchange="window.location = '/contest/rating?camp='+this.value" >
                            <option value="" >Chọn lần thi thử</option>
							<?php foreach($contest  as $val) { ?>
                            <option value="<?php echo @$val['id']?>" > <?php echo @$val['name']?></option>
							<?php } ?>
                           
                        </select>
                        <script type="text/javascript">
                            $('#camp').val('<?php echo $camp ?>');
                        </script>
                    </div>
                </div>
            </form>
        </div>
        <?php 
            if($camp){
                $pageSize= $data->getPageSize();
                
                $user= _db()->getEntity('Userbook.Usercontest');
                $users= $user->getRatingUserTest($camp,$currentpage,$pageSize);
                $rank= $currentpage * $pageSize;
        ?>
        <table class="table table-hover">
            <tr>
                <th>Xếp hạng</th>
                <th>Tên đăng nhập</th>
                <th>Điểm trắc nghiệm</th>
                <th>Điểm tự luận</th>
                <th>Tổng điểm</th>
                <th>Thời gian làm bài</th>
                
            </tr>
            <?php foreach($users as $item): ?>
            <?php 
                $rank++;
                $username= $item['username'];
                $duringTime= $user->loadTime($item['duringTime']);
               
            ?>
            <tr>
                <td><?php echo $rank ?></td>
                <td><?php echo $username ?></td>
                <td><?php $markTn = $item['mark'] *2; echo $markTn; ?></td>
                <td><?php echo @$item['teacherMark']?></td>
                <td><?php echo @$item['totalMark']?></td>
                <td><span class="glyphicon glyphicon-time" aria-hidden="true"></span><?php echo $duringTime ?></td>
                
            </tr>
            <?php endforeach; ?>
        </table>
        
    </div>
    <!--phan trang-->
    <?php 
        
            $page=0; 
            $pageNum= $user->showPage($pageSize,$camp);
            
    ?>
    <div class="row panel-footer">
    <form class="form-inline" role="form">
        <table style="margin: 0px;">
            <tr>
                <td style="width: 135px;"> <strong>Số mục: </strong>
                    <select id="pageSize" name="pageSize" class="form-control input-sm" placeholder="Số mục / trang" onchange="window.location='<?php echo BASE_REQUEST . '/contest/changePageSize' ?>?camp=<?php echo $camp ?>&pageSize=' + this.value;">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="25">25</option>
                    </select>
                    <script type="text/javascript">
                        $('#pageSize').val('<?php echo $pageSize ?>');
                    </script>
                </td>
                <td>
                    <?php if($pageNum > 0){ ?>
                    <strong style="display: inline-block; vertical-align: middle;">Trang: </strong>
                    <?php } ?>
                    <ul style="margin: 0px; vertical-align: middle;" class="pagination">
                        <?php 
                            for($page=0; $page< $pageNum; $page ++){
                                if($currentpage== $page){
                                    $active='active';
                                }else $active='';
                         ?>
                        <li class="<?php echo $active ?>">
                        <a  href="<?php echo BASE_REQUEST ?> /contest/rating?camp=<?php echo $camp ?>&page=<?php echo $page ?>"><?php  echo ($page + 1)?></a>
                        </li>
                        <?php } ?>
                    </ul>
                </td>
            </tr>
        </table>
    </form>
    <?php }else { ?> 
        <div class="item text-center">Bạn hãy chọn lần thi để xem bảng xếp hạng</div>
        <?php } ?> 
    </div>
    <!--end phan trang-->
   
</div>
<?php endif;?>