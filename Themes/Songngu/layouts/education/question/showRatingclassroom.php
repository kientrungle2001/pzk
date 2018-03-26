<?php

$dataTest = $data->get('dataTest');
$setting = pzk_controller();

/*$testId = pzk_session('userBookTestId');*/
$testId= pzk_request('examination');

$weekId= pzk_request('week');
$practice = pzk_request('practice');
$weekName = $data->getWeekById($weekId);
$pageSize = pzk_session('ratingPageSize');

if($testId) {
    $data->conditions .= " and testId = '$testId'".pzk_session('condirating');

    $testDetail= $data->getTestById($testId);
}
if($testId) {
    
    if($pageSize) {
        $data->pageSize = $pageSize;
    }else{
        $data->pageSize = 20;
    }
    $page = pzk_request('page');

    if(!empty($page)) {
        $data->pageNum = $page;
    }else{
        $data->pageNum = 0;
    }

    $items = $data->getItems();
    $countItems = $data->getCountItems();

    $pages = ceil($countItems / $data->pageSize);

}else{
    $items = '';
}
$practice = pzk_request('practice');
$check= pzk_session('checkPayment'); 
//data
?>
{children [position=public-header]}
{children [position=top-menu]}
<div class="container">
		<p class="t-weight text-center btn-custom8 textcl">Bảng xếp hạng</p>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12 top10 bot20">
            
                <div class="dropdown col-md-8 col-sm-8 col-xs-12 mgleft pd0 mg0">
                    <button class="btn fix_hover btn-default col-md-12 col-sm-12 col-xs-12 sharp" type="button"><span id="chonde" class="fontsize19">{testDetail[name_sn]}</span><img class="img-responsive imgwh hidden-xs hidden-sm pull-right" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/icon1.png" /></span>
                    </button>
                        <ul class="dropdown-menu col-md-12 col-sm-12 col-xs-12" style="top:40px; max-height:350px; overflow-y: scroll;">
                        <?php 
                            $weeks = $data->getWeekTest(ROOT_WEEK_CATEGORY_ID, $practice, $check);
                            
                         ?>
                        {each $weeks as $week }
                        
                        <li class="left20" style="color:#d9534f"><h5><strong>{week[name]}</strong></h5>
                           
                        <?php 
                            $tests = $data->getTestSN($week['id'], $practice, $check);
                            if($practice== 1 || $practice == '1'){  ?>
                                {each $tests as $test }
                                <?php 
                                    if($test['name_sn']){
                                        $testName = $test['name_sn'];
                                    }else $testName = $test['name'];
                                ?>
                                    <li style="padding-left: 40px;"<?php if(pzk_request('week') == $week['id'] && pzk_request('examination') == $test['id']) echo'class="active"'; ?>>
                                        
                                        <a onclick="document.getElementById('chonde').innerHTML = '{testName}';"  data-de="{testName}" class="getdata" href="/Home/showRating?week={week[id]}&practice=1&examination={test[id]}" data-type="group">{testName}</a>
                                        
                                    </li>
                                {/each}
                        <?php
                            }else{
                         ?>                     
                            {each $tests as $test }
                            <?php 
                                if($test['name_sn']){
                                    $testName = $test['name_sn'];
                                }else $testName = $test['name'];
                            ?>
                            <li style="padding-left: 40px;"<?php if(pzk_request('week') == $week['id'] && pzk_request('examination') == $test['id']) echo'class="active"'; ?>>
                                
                                <a onclick="id = {week[id]};document.getElementById('chonde').innerHTML = '{testName}';"  data-de="{testName}" class="getdata" href="/Home/showRating?week={week[id]}&practice=0&examination={test[id]}" data-type="group">{testName}</a>
                                
                            </li>
                            {/each}
                            <?php } ?>
                            
                        </li>
                        {/each}
                        </ul>
                </div>
                <div class="col-xs-12 col-md-4 col-sm-2  pull-right mgleft">
                    <div class="row text-center">
                        
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <button style="background-color: #EF7D01;" id="allresultRating" class="btn btn-primary" name="allresultRating" onclick="allResult();" type="button"><span class="glyphicon glyphicon-ok"></span> Xếp hạng toàn quốc</button>
                        </div>
                    </div>
                </div>
            
        </div>
    </div>
    <div class="row">
    <form action="" onsubmit="$('#resultRating').click(); return false;">
        <div class="col-md-2  co-xs-12">
            <label for="testId">Chọn Tỉnh/Tp</label>
            <select style="margin-left: 4px;height: 35px;"  class="form-control input-sm" id="provinceId" name="provinceId" onchange="myDistrict();" >
                <option value="" >Chọn Tỉnh/Tp</option>
                <?php 
                    $areacode=_db()->getEntity('User.Account.User');
                    $areas= $areacode->loadProvince();
                ?>
                {each $areas as $area}
                <option value="<?php echo $area['id']; ?>"><?php   echo $area['name']; ?></option>
                {/each}
                <script type="text/javascript">
                    $('#provinceId').val("<?php echo pzk_session('provinceId') ?>");
                </script>
            </select>
        </div>
        <div class="col-md-2 co-xs-12">
            <label for="testId">Chọn Quận/Huyện</label>
            <select id="district" onchange="mySchool()" class="form-control sharp" title="Chọn Quận/Huyện" name="district" aria-label="Quận/ Huyện" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
           
                <?php 
                    $loadDistrict = _db()->getEntity('User.Account.User');
                    $districts = $loadDistrict->getAreaByParent(pzk_session('provinceId'));
                 ?>
                {each $districts as $district}
                    <option value="{district[id]}" >{district[name]}</option>
                {/each}
                <script type="text/javascript">
                    $('#district').val("<?php echo pzk_session('districtId') ?>");
                </script>    
            </select>
        </div>
        <div class="col-md-2 co-xs-12">
            <label for="testId">Chọn Trường</label>
            <select id="school" class="form-control sharp" title="Chọn Trường" name="school" aria-label="Trường" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
            <?php 
                $mySchools = _db()->getEntity('User.Account.User');
                $myItems = $mySchools->getAreaByParent(pzk_session('districtId'));
             ?>
            {each $myItems as $myItem}
                <option value="{myItem[id]}" >{myItem[name]}</option>
            {/each}
            <script type="text/javascript">
                $('#school').val("<?php echo pzk_session('schoolId') ?>");
            </script>    
            </select>
        </div>
        <div class="col-md-2 co-xs-12">
            <label for="testId">Chọn Khối Lớp</label>
            <select style="height: 35px;"  class="form-control input-sm" id="classId" name="classId" >
                <option value="" >Chọn Lớp</option>
                <option value="5" >Lớp 5</option>
                <option value="4" >Lớp 4</option>
                <option value="3" >Lớp 3</option>
                <script type="text/javascript">
                    $('#classId').val("<?php echo pzk_session('classId') ?>");
                </script>
            </select>
        </div>
        <div class="col-md-2 co-xs-12">
            <label for="testId">Tên lớp <span>(ví dụ: A1)</span></label>
            <input type="text" class="form-control sharp" id="classname" name="classname" placeholder="Nhập tên lớp" data-toggle="tooltip" data-placement="top" title="">
            <script type="text/javascript">
                $('#classname').val("<?php echo pzk_session('classnameId') ?>");
            </script>
        </div>
        <div class="col-md-2 co-xs-12">
			<label for="resultRating" style="opacity: 0;">Submit</span></label>
			<button id="resultRating" class="btn btn-primary form-control" name="resultRating" type="button"><span class="glyphicon glyphicon-search"> </span>
					Xem kết quả          </button>
		</div>
    </div>
    
    </form>
        
</div>

<div class="container  panel-default">
    <div class=" panel-heading">
        
    </div>
	<?php
	if($items) {
		$i=1;
		?>
	<div class="table-responsive">
    <table class="table table-hover">
        <thead>
			<tr>
				<th>Xếp hạng</th>
				<th>Tên đăng nhập</th>
                <th>Tuần</th>
				<th>Đề</th>
				<th>Điểm</th>
				<th>Thời gian làm bài</th>
				<th>Ngày</th>
			</tr>
		</thead>
		<tbody>
        {each $items as $val}
        <tr>
            <td><?php echo $i+ $data->pageNum*$data->pageSize; ?></td>
            <td><a href="/home/listTest/{val[userId]}?practice={practice}">{val[username]}</a></td>
            <td>{weekName}</td>
            <td>{val[name_sn]}</td>

            <td>{val[mark]}</td>
            <?php
                $time = $val['duringTime'];
                $time = secondsToTime($time);
                $hour = $time['h'];
                $min = $time['m'];
                $sec = $time['s'];

                $resultStrTime = '';

                if(!empty($hour)) {
                    $resultStrTime .= $hour.' giờ ';
                }

                if(!empty($min)) {
                    $resultStrTime .= $min.' phút ';
                }

                if(!empty($sec)) {
                    $resultStrTime .= $sec.' giây ';
                }
            ?>
            <td><span class="glyphicon glyphicon-time" aria-hidden="true"></span>  <?php  echo $resultStrTime; ?></td>
            <td><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>  <?php echo date('d/m/Y H:m:i A', strtotime($val['startTime'])); ?></td>
        </tr>
        <?php $i++; ?>
        {/each}
		</tbody>
    </table>
	</div>
	
	<div class="panel-footer ">
        <form class="form-inline" role="form">
		
            <table style="margin: 0px;">
                <tr>
                    <td>
                        <?php if($pages > 1) { ?>
                            <strong style="display: inline-block; vertical-align: middle;">Trang: </strong>

                            <ul style="margin: 0px; vertical-align: middle;" class="pagination">
                                <?php
                                if($data->pageNum >= 1) { ?>
                                    <li>
                                        <a href="{url} /Home/showRating?week={weekId}&practice={practice}&examination={testId}&page=0" aria-label="End">
                                            <span aria-hidden="true">Trang đầu</span>
                                        </a>
                                    <li>
                                        <a aria-label="Previous" href="{url} /Home/showRating?week={weekId}&practice={practice}&examination={testId}&page=<?php echo $data->pageNum -1; ?>">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php } ?>

                                <?php
                                for ($page = 0; $page < $pages; $page++) { ?>
                                    <?php
                                    if($pages > 10 && ($page < $data->pageNum - 5 || $page > $data->pageNum + 5))
                                        continue;
                                    if($page == $data->pageNum) {
                                        $active = 'active';
                                    } else {
                                        $active = '';
                                    }
                                    ?>
                                    <li class="{active}">
                                        <a  href="{url} /Home/showRating?week={weekId}&practice={practice}&examination={testId}&page={page}">{? echo ($page + 1)?}</a>
                                    </li>
                                <?php } ?>

                                <?php if($data->pageNum < $pages-1) { ?>
                                    <li>
                                        <a href="{url} /Home/showRating?week={weekId}&practice={practice}&examination={testId}&page=<?php echo $data->pageNum + 1; ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{url} /Home/showRating?week={weekId}&practice={practice}&examination={testId}&page=<?php echo $pages-1; ?>" aria-label="end">
                                            <span aria-hidden="true">Trang cuối</span>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </td>
                </tr>
            </table>
        </form>
    </div>
<?php
}else {
	?>
	<div class='item text-center'>
        <h4>Không tìm được kết quả thoả mãn</h4>
		<!-- <img class='item' src='/Default/skin/nobel/test/Themes/Default/media/final.jpg' /> -->
	</div>
	<?php
}
?>
</div>
<script>
    function myDistrict() {
        var provinceId = $("#provinceId").val();
        $.ajax({
            url: "/home/getDistrict",
            type: "post",
            data: {
                provinceId : provinceId
            } ,
            success: function (response) {
                
               $("#district").html(response);
               
            }
        });                                         
    }
    function mySchool() {
        var districtId = $("#district").val();
        $.ajax({
            url: "/home/getSchool",
            type: "post",
            data: {
                districtId : districtId
            } ,
            success: function (response) {
               $("#school").html(response);
               
            }
        });                                         
    }
    $('#resultRating').click(function(){
        var provinceId = $("#provinceId").val();
        var districtId = $("#district").val();
        var schoolId = $("#school").val();
        var classId = $("#classId").val();
        var classname = $("#classname").val();
        $.ajax({
            url: '/home/getRating',
            type: 'post',
            data: {
                provinceId : provinceId,
                districtId : districtId,
                schoolId   : schoolId,
                classId    : classId,
                classname  : classname
            },
            success : function(respone){
                window.location.reload();
               /*alert(respone)                ;*/
            }
        });

    });
    $('#allresultRating').click(function(){        
        $.ajax({
            url: '/home/getallRating',
            type: 'post',
            data: {
            },
            success : function(respone){
                window.location.reload();
               /*alert(respone)                ;*/
            }
        });

    });
</script>

