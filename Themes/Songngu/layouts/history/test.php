<?php 
	$userId = pzk_or(pzk_request()->getSegment(3), pzk_session()->get('userId')); 
	$createdDay = pzk_session('created');
	//$createdDay = "2016-08-08";
	$tam = explode("-", $createdDay);
	$createdYear = $tam[0];
	
	if($createdYear <= 2016){
		$createdYear = 2016;
	}
	
	$currentDay  = date(DATEFORMAT, time());
	$currentYear = date("Y", time());
	
	$mountYear = $currentYear - $createdYear;
	
	$date = new DateTime($createdDay);
	$createdWeek = (int) $date->format("W");

	$date = new DateTime($currentDay);
	$curentWeek = (int) $date->format("W");
	
	if($createdYear <= 2016 && $createdWeek < 26){
		//lay tu tuan 26
		$createdWeek = 26;
	}
	
	$firstWeek = date("Y-m-d", strtotime('this week', time()));
	
	$weekHistory = $curentWeek-1;
	if(pzk_session('weekHistory')) {
		$weekHistory = pzk_session('weekHistory');
	}
	
	$yearHistory = $currentYear;
	if(pzk_session('yearHistory')) {
		$yearHistory = pzk_session('yearHistory');
	}
	$currentHistory = $weekHistory.'-'.$yearHistory;
	
	$dateTodate = startEndDateOfWeek($weekHistory, $yearHistory);
	
	$startDate = $dateTodate['startdate'];
	$endDate = $dateTodate['enddate'];
	
?>

<div class='container'>
	<hr>
	<h2 class="text-center robotofont">Đánh giá học tập</h2>
	<div class="well">
		<label for="resultAchievement"> Chọn Xem đánh giá học tập theo các tuần trong năm</label>
		<div class="row">
		<div class="col-md-4 col-sm-6 col-xs-12">
		<select class="form-control" id="resultAchievement" name="viewWeek" onchange="window.location = '/home/resultAchievementByWeek?val='+this.value;">
			<?php 
				$week = (int) date('W');
				$year = (int) date('Y');
				if($week > 1){
					$crurrentWeek = $week-1;
					
				}else{
					$crurrentWeek = 52;
					$year = $year - 1;
				}
			
				$filterWeek = $crurrentWeek;
				$filterYear = $year;
				if(pzk_session('resWeekAchievement')){
					$filterWeek = pzk_session('resWeekAchievement');
				}
				
				
				if(pzk_session('resYearAchievement')){
					$filterYear = pzk_session('resYearAchievement');
				}	
				
				$weekYear = $filterWeek.'-'.$filterYear;
				
				if($crurrentWeek < 52 && $year > 2016) { 
					$k = 52 - $crurrentWeek;
					for($week= 53-$k; $week <= 52; $week++){
						$yearvalue = $year - 1;
						?>
						<option value="<?php echo $week.'-'.$yearvalue;?>">Tuần <?php $date = startEndDateOfWeek($week-1, $year-1, 1); echo $week; echo ' ('.$date['startdate'].' đến '.$date['enddate'].')'; ?></option>
						<?php
						
					}
				} 
				?>
				<?php 
				$week = 1;
				if($year <= 2016){
					$week = 26;
				}
				for($week; $week <= $crurrentWeek; $week++){ 
				?>
				<option value="<?php echo $week.'-'.$year;?>">Tuần <?php $date = startEndDateOfWeek($week-1, $year, 1); echo $week; echo ' ('.$date['startdate'].' đến '.$date['enddate'].')'; ?></option>
				<?php } ?>
			
		</select>
		<script type="text/javascript">
				$('#resultAchievement').val('<?php echo $weekYear; ?>');
			</script>
		</div>
		</div>
	</div>
	<?php $achievement = $data->getOneAchievementByUserId($userId, $filterWeek, $year);
	if($achievement){
	?>
	<div class="table-responsive">
	<table class="table table-hover table-bordered">
			<thead>
			<tr>
				
				<th>Tên đăng nhập</th>
				
				<th><img style='width: 25px;' src='/Default/skin/nobel/test/Themes/Default/media/tree.png' />

				</th>
				<th><img style='width: 25px;' src='/Default/skin/nobel/test/Themes/Default/media/flower.png' /></th>
				<th><img style='width: 25px;' src='/Default/skin/nobel/test/Themes/Default/media/apple.png' /></th>
				<th>Tuần</th>
			</tr>
			</thead>
			<tbody>
			
			<tr>
				<td><?php echo $achievement['username']; ?></td>
				<td><?php echo $achievement['tree']; ?></td>
				<td><?php echo $achievement['flower']; ?></td>
				<td><?php echo $achievement['apple']; ?></td>
				<td><?php $date = startEndDateOfWeek($filterWeek-1, $year, true); echo 'Tuần '.$filterWeek.'('.$date['startdate'].' đến '.$date['enddate'].')';?> </td>
			</tr>
			<tr>
				<th>Xếp hạng toàn quốc</th>
				
				<th>
				<?php 
					echo $data->getRateAchievement($achievement['id'], $filterWeek, $year, 'tree'); 
				?>
				</th>
				<th><?php echo $data->getRateAchievement($achievement['id'], $filterWeek, $year, 'flower'); ?></th>
				<th><?php echo $data->getRateAchievement($achievement['id'], $filterWeek, $year, 'apple'); ?></th>
				<th></th>
			</tr>
			<?php 
			//session user
			$areacode = pzk_session('areacode');
			$district = pzk_session('district');
			$school = pzk_session('school');
			$class = pzk_session('class');
			$className = pzk_session('classname');
			$checkUser = pzk_session('checkUser');
			$servicePackage = pzk_session('servicePackage');
			if($checkUser == 1 && $servicePackage == 'classroom'){
			?>
			<tr>
				<th>Xếp hạng tỉnh/thành phố</th>
				<th><?php echo $data->getRateAchievementByCity($achievement['id'], $filterWeek, $year, 'tree', $areacode); ?></th>
				<th><?php echo $data->getRateAchievementByCity($achievement['id'], $filterWeek, $year, 'flower', $areacode); ?></th>
				<th><?php echo $data->getRateAchievementByCity($achievement['id'], $filterWeek, $year, 'apple', $areacode); ?></th>
				<th></th>
			</tr>
			<tr>
				<th>Xếp hạng quận/huyện</th>
				<th><?php echo $data->getRateAchievementByDistrict($achievement['id'], $filterWeek, $year, 'tree', $areacode, $district); ?></th>
				<th><?php echo $data->getRateAchievementByDistrict($achievement['id'], $filterWeek, $year, 'flower', $areacode, $district); ?></th>
				<th><?php echo $data->getRateAchievementByDistrict($achievement['id'], $filterWeek, $year, 'apple', $areacode, $district); ?></th>
				<th></th>
			</tr>
			<tr>
				<th>Xếp hạng trường</th>
				<th><?php echo $data->getRateAchievementBySchool($achievement['id'], $filterWeek, $year, 'tree', $areacode, $district, $school, $class); ?></th>
				<th><?php echo $data->getRateAchievementBySchool($achievement['id'], $filterWeek, $year, 'flower', $areacode, $district, $school, $class); ?></th>
				<th><?php echo $data->getRateAchievementBySchool($achievement['id'], $filterWeek, $year, 'apple', $areacode, $district, $school, $class); ?></th>
				<th></th>
			</tr>
			<tr>
				<th>Xếp hạng lớp</th>
				<th><?php echo $data->getRateAchievementByClassname($achievement['id'], $filterWeek, $year, 'tree', $areacode, $district, $school, $class, $className); ?></th>
				<th><?php echo $data->getRateAchievementByClassname($achievement['id'], $filterWeek, $year, 'flower', $areacode, $district, $school, $class, $className); ?></th>
				<th><?php echo $data->getRateAchievementByClassname($achievement['id'], $filterWeek, $year, 'apple', $areacode, $district, $school, $class, $className); ?></th>
				<th></th>
			</tr>
			
			<?php 
			}
			?>		
			
			</tbody>
		</table>
		</div>
		<?php }else { ?>
			<div class='alert alert-danger'>Chưa có đánh giá nào!</div>
		<?php } ?>
		
		<div class="panel panel-primary"> 
			<div class="panel-heading"> 
			<a data-toggle="collapse" href="#mark">
			<h3 style='color: white;' class="panel-title">
			Cách tính thưởng <span class="caret"></span></h3>
			</div> 
			 </a>
			<div id="mark" class="panel-collapse panel-body collapse " >
				<ul class="list-group">
				
					<li class='list-group-item list-group-item-info'>
						Thưởng cây (Đánh giá mức độ chăm chỉ của HS) : <br/>
						Dựa vào số câu luyện tập trong tuần học sinh đã làm. <br/>
						+ 50 đến 59 câu/1 tuần : Thưởng 1 cây <img style='width: 25px;' src="/Default/skin/nobel/test/Themes/Default/media/tree.png"><br/>
						+ 60 đến 70 câu/ 1 tuần: Thưởng 2 cây <img style='width: 25px;' src="/Default/skin/nobel/test/Themes/Default/media/tree.png"><br/>
						+ 70 đến 80 câu/ 1 tuần : Thưởng 3 cây <img style='width: 25px;' src="/Default/skin/nobel/test/Themes/Default/media/tree.png"><br/>
						+ Trên 80 câu: Làm thêm 10 câu thưởng thêm 1 cây <img style='width: 25px;' src="/Default/skin/nobel/test/Themes/Default/media/tree.png"><br/>
						Dựa vào phần trăm làm đúng phần game từ vựng <img style='width: 25px;' src="/Default/skin/nobel/test/Themes/Default/media/tree.png"><br/>
						+ 50 đến 69% làm đúng game từ vựng /1 tuần : Thưởng 1 cây <img style='width: 25px;' src="/Default/skin/nobel/test/Themes/Default/media/tree.png"><br/>
						+ 70 đến 79% làm đúng game từ vựng /1 tuần : Thưởng 2 cây <img style='width: 25px;' src="/Default/skin/nobel/test/Themes/Default/media/tree.png"><br/>
						+ 80 đến 100% làm đúng game từ vựng /1 tuần: Thưởng 3 cây <img style='width: 25px;' src="/Default/skin/nobel/test/Themes/Default/media/tree.png"><br/>
						
					</li>
					<li class='list-group-item list-group-item-info'>
					Thưởng hoa (Đánh giá mức độ luyện tập hiệu quả của HS): Dựa vào phần trăm số câu trả lời đúng trong các bài luyện tập mỗi tuần mà học sinh đã làm.<br/>
						+ 50 đến 69% câu trả lời đúng /1 tuần : Thưởng 1 bông hoa <img style="width: 25px;" src="/Default/skin/nobel/test/Themes/Default/media/flower.png"><br/>
						+ 70 đến 79% câu trả lời đúng/1 tuần : Thưởng 2 bông hoa <img style="width: 25px;" src="/Default/skin/nobel/test/Themes/Default/media/flower.png"><br/>
						+ 80 đến 100% câu trả lời đúng /1 tuần: Thưởng 3 bông hoa <img style="width: 25px;" src="/Default/skin/nobel/test/Themes/Default/media/flower.png"><br/>
					</li>
					<li class='list-group-item list-group-item-info'>
					Thưởng quả (Đánh giá kết quả làm đề luyện tập và đề kiểm tra toàn diện của HS): Dựa vào phần trăm số câu trả lới đúng ở các đề luyện tập và đề kiểm tra toàn diện trong tuần mà học sinh đã làm.<br/>
					+ 50 đến 69% câu trả lời đúng/ 1 tuần:  Thưởng 1 quả <img style="width: 25px;" src="/Default/skin/nobel/test/Themes/Default/media/apple.png"><br/>
					+ 70 đến 79%  câu trả lời đúng : Thưởng 2 quả <img style="width: 25px;" src="/Default/skin/nobel/test/Themes/Default/media/apple.png"><br/>
					+ 80 đến 100% câu trả lời đúng : Thưởng 3 quả <img style="width: 25px;" src="/Default/skin/nobel/test/Themes/Default/media/apple.png"><br/>
					</li>
				
				</ul>
			</div> 
		</div>
	
	
	<hr>
	<h2 class="text-center robotofont">Lịch sử học tập</h2>
	
  	<div class="well">
		<label for="viewWeek"> Chọn Xem lịch sử theo tuần học của bạn</label>
		<div class="row">
		<div class="col-md-4 col-sm-6 col-xs-12">
		<select class="form-control input-sm " id="viewWeek" name="viewWeek" onchange="window.location = '/Home/filterDataByWeek?val='+this.value;">
			
			<?php 
			$year = (int) date('Y');
			$curentWeek = (int) date('W');
			
			$maxWeek =  $mountYear*52 + $curentWeek;
			$j = 1;
			$k = $curentWeek;
			$h =0;
			$tam = $maxWeek - $createdWeek;
			if($tam < 52){
				$tong = $tam + 2;
			}else{
				$tong = 53;
			}
			for($i = $maxWeek; $i >= $createdWeek; $i --) { 
			$year = $currentYear - $h;
			
			if($k == 0){
				$k = 53;
			}
			if($k == 1){
				$h++;
			}
			?>
			<option value="<?php $tuan =  $k-1; echo $tuan.'-'.$year; ?>">Tuần 
			<?php $date = startEndDateOfWeek($k-1, $year, 1); echo $tong - $j; echo ' ('.$date['startdate'].' đến '.$date['enddate'].')'; ?></option>
			<?php
				if($j == 52){
					break;
				}
			$k--;
			$j ++;
			} 
			?>
		</select>
		<script type="text/javascript">
				$('#viewWeek').val('<?php echo $currentHistory; ?>');
			</script>
		</div>
		</div>
	</div>
	
	
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a class="btn-success" href="#luyentap" aria-controls="luyentap" role="tab" data-toggle="tab">Luyện tập</a></li>
    <li role="presentation"><a class="btn-success" href="#deluyentap" aria-controls="deluyentap" role="tab" data-toggle="tab">Đề luyện tập</a></li>
    <li role="presentation"><a class="btn-danger" href="#dethi" aria-controls="dethi" role="tab" data-toggle="tab">Đề thi</a></li>
	 <li role="presentation"><a class="btn-success" href="#compability" aria-controls="compability" role="tab" data-toggle="tab">Đề khảo sát</a></li>
	 <li role="presentation"><a class="btn-info" href="#tuvung" aria-controls="tuvung" role="tab" data-toggle="tab">Từ vựng</a></li>
    
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="luyentap">

		<div>
			<h3 class="text-center robotofont">Bài luyện tập đã làm</h3>
		</div>
		
		<div class="panel panel-primary"> 
			<div class="panel-heading"> 
			<a data-toggle="collapse" href="#soluong">
			<h3 style='color: white;' class="panel-title">
			Số câu luyện tập đã làm tuần này của bạn <span class="caret"></span></h3>
			</div> 
			 </a>
			<div id="soluong" class="panel-collapse panel-body collapse in">
				<ul class="list-group">
				<?php 
				
				$numberQuestions = $data->countQuestionPraticeByWeek($userId, $startDate, $endDate);
				if($numberQuestions) {
					echo lessonToComment($numberQuestions);
					
				}else{
					echo "<li class='list-group-item list-group-item-danger'>Tuần này bạn vẫn chưa làm bài tập nào.</li>";
				}
				
				?>
				</ul>
			</div> 
		</div>
		<?php 
			
			if($numberQuestions) { 
			
		?>
		<div class="panel panel-info"> 
			<div class="panel-heading"> 
			<a data-toggle="collapse" href="#danhgia">
			<h3 class="panel-title ">
			Đánh giá kết quả luyện tập tuần này của bạn  <span class="caret"></span>
			</h3> 
			</a>
			</div> 
			<div id="danhgia" class="panel-collapse panel-body collapse">
				<ul class="list-group">
				<?php 
					$questionTrue = $data->getTrueQuestionPraticeByWeek($userId, $startDate, $endDate);
					echo trueQuestionToComment($questionTrue);
				
				?>
				</ul>
			</div> 
		</div>
		<?php } ?>
		
		<?php if($numberQuestions) { ?>
		<div class="panel panel-success"> 
			<div class="panel-heading">
			<a data-toggle="collapse" href="#mucdo">
				<h3 class="panel-title">
				Mức độ quan tâm đến môn học tuần này của bạn <span class="caret"></span>
				</h3> 
			</a>
			</div> 

			<div id="mucdo" class="panel-collapse panel-body collapse">
				<ul class="list-group">
				<?php 
				
				
					$categories = $data->categoryPraticeByWeek($userId, $startDate, $endDate);
					$totalLesson = $data->TotalPraticeByWeek($userId, $startDate, $endDate);
					
					$resultCate = array();
					foreach($categories as $key => $cat){
						$resultCate[$key] = ceil(count($cat)*100/$totalLesson);
					}
					$allCategory = $data->getAllCategories();
					echo cateToComment($resultCate, $allCategory);
				
				?>
				</ul>
			</div> 
		</div>
		<?php } ?>
		
		
		<div id='resPractices' class="item">
			
		<?php
		
		
		$data->pageSize = 20;
		
		$page = pzk_request('page');
		if(!empty($page)) {
			$data->pageNum = $page;
		}else{
			$data->pageNum = 0;
		}

		$items = $data->getHistoryPraticeSn($userId, $startDate, $endDate);
		/*var_dump($items);die;*/
		$countItems = $data->countHistoryPraticeSn($userId, $startDate, $endDate);
		$pages = ceil($countItems / $data->pageSize);
		if($items) {
			$i=1;
			?>
			<div class="table-responsive">
			<table class="table table-hover table-bordered">
				<thead>
				<tr>
					<th>#</th>
					<th>Danh mục</th>
					<th>Chủ đề</th>
					<th>Bài</th>
					<th>Điểm</th>
					<th>Ngôn ngữ</th>
					<th>Thời gian làm bài</th>
					<th>Ngày</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach($items as $val): ?>
				<tr>
					<td><?php echo $i+$data->pageNum*$data->pageSize; ?></td>
					<td><?php echo @$val['namecatevn']?></td>
					<td><?php if($val['topic']) { echo $val['topicname'];} ?></td>
					<td><a href="/profile/book/<?php echo @$val['id']?>"><?php if($val['exercise_number']) { echo 'Bài '.$val['exercise_number'];} ?></a></td>
					<td><?php echo @$val['mark']?></td>
					<td>
					
					<?php 
					$lang = "en";
					if($val['lang']){
						$lang = $val['lang'];
					}
					echo $lang;
					?> 
					</td>
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
					<td><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>  <?php echo date('d/m/Y H:i:m A', strtotime($val['startTime'])); ?></td>
				</tr>
				<?php $i++; ?>
				<?php endforeach; ?>
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
												<a onclick="practice(<?php echo $userId ?>, 0, '<?php echo $startDate ?>', '<?php echo $endDate ?>')" aria-label="End">
													<span aria-hidden="true">Trang đầu</span>
												</a>
											<li>
												<a aria-label="Previous" onclick="practice(<?php echo $userId ?>,'<?php echo $data->pageNum -1; ?>', '<?php echo $startDate ?>', '<?php echo $endDate ?>')">
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
											<li class="<?php echo $active ?>">
												<a  onclick="practice(<?php echo $userId ?>, <?php echo $page ?>, '<?php echo $startDate ?>', '<?php echo $endDate ?>')"><?php  echo ($page + 1)?></a>
											</li>
										<?php } ?>

										<?php if($data->pageNum < $pages-1) { ?>
										<li>
											<a onclick="practice(<?php echo $userId ?>, '<?php echo $data->pageNum + 1; ?>', '<?php echo $startDate ?>', '<?php echo $endDate ?>')" aria-label="Next">
												<span aria-hidden="true">&raquo;</span>
											</a>
											</li>
											<li>
											<a onclick="practice(<?php echo $userId ?>, '<?php echo $pages-1; ?>', '<?php echo $startDate ?>', '<?php echo $endDate ?>')" aria-label="end">
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
		}
		?>
		</div>
	
	</div>
    <div role="tabpanel" class="tab-pane" id="deluyentap">
	
		<div>
			<h3 class="text-center robotofont">Đề luyện tập đã làm</h3>
		</div>
		
		<?php if(!$data->getTestByWeek($userId, 1, $startDate, $endDate)) { ?>
			<div class="panel panel-info"> 
				<div class="panel-heading"> 
				<h3 class="panel-title">Đánh giá kết quả làm đề luyện tập tuần này của bạn</h3> 
				</div> 
				<div class="panel-body">
					<ul class="list-group">
						
						<li class='list-group-item list-group-item-danger'>Tuần này bạn chưa làm đề nào.Bạn cần làm đề luyện tập để ôn tập và kiểm tra kết quả học tập</li>
						
					</ul>
				</div>	
			</div>
		<?php }else {
			$numberTest = $data->getTestByWeek($userId, 1, $startDate, $endDate);
			$centTrueTest = $data->getQuestionTrueByTestAndWeek($userId, 1, $startDate, $endDate);
			?>
			<div class="panel panel-info"> 
				<div class="panel-heading"> 
				<h3 class="panel-title">Đánh giá kết quả làm đề luyện tập tuần này của bạn</h3> 
				</div> 
				<div class="panel-body">
					<ul class="list-group">
						<li class='list-group-item list-group-item-success'>Tuần này bạn đã làm <?= $numberTest; ?> đề.</li>
						<?php
						echo trueTestToComment($centTrueTest, $numberTest);
						?>
						
					</ul>
				</div>	
			</div>

			
			<?php
		} ?>
		
		<div  id='resPractice' class="item">

		<?php
		
		
		$data->pageSize = 20;
		
		$page = pzk_request('page');
		if(!empty($page)) {
			$data->pageNum = $page;
		}else{
			$data->pageNum = 0;
		}

		$items = $data->getHistoryTestSn($userId, 1, $startDate, $endDate);

		$countItems = $data->countHistoryTestSn($userId, 1, $startDate, $endDate);
		$pages = ceil($countItems / $data->pageSize);
		if($items) {
			$i=1;
			?>
			<div class="table-responsive">
			<table class="table table-hover table-bordered">
				<thead>
				<tr>
					<th>#</th>
					<th>Tuần</th>
					<th>Đề</th>
					<th>Điểm</th>
					<th>Ngôn ngữ</th>
					<th>Thời gian làm bài</th>
					<th>Đánh giá</th>
					<th>Ngày</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach($items as $val): ?>
				<tr>
					<td><?php echo $i+$data->pageNum*$data->pageSize; ?></td>
					<td><?php if($val['categoryId']) echo $val['cateName']; ?></td>
					<td><a href="/Profile/book/<?php echo @$val['id']?>"><?php echo @$val['name']?></a></td>
					<td><?php echo @$val['mark']?></td>
					<td>
					<?php 
					$lang = "en";
					if($val['lang']){
						$lang = $val['lang'];
					}
					echo $lang;
					?> 
					</td>
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
					<td><?php echo reviewforTest($val['mark']); ?></td>
					<td><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>  <?php echo date('d/m/Y H:i:m A', strtotime($val['startTime'])); ?></td>
				</tr>
				<?php $i++; ?>
				<?php endforeach; ?>
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
												<a onclick="getPage(<?php echo $userId ?>,1,0, '<?php echo $startDate ?>', '<?php echo $endDate ?>', 'resPractice')" aria-label="End">
													<span aria-hidden="true">Trang đầu</span>
												</a>
											<li>
												<a aria-label="Previous" onclick ="getPage(<?php echo $userId ?>, 1, '<?php echo $data->pageNum -1; ?>', '<?php echo $startDate ?>', '<?php echo $endDate ?>', 'resPractice')">
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
											<li class="<?php echo $active ?>">
												<a  onclick = "getPage(<?php echo $userId ?>, 1, <?php echo $page ?>, '<?php echo $startDate ?>', '<?php echo $endDate ?>', 'resPractice')"><?php  echo ($page + 1)?></a>
											</li>
										<?php } ?>

										<?php if($data->pageNum < $pages-1) { ?>
										<li>
											<a onclick = "getPage(<?php echo $userId ?>, 1, '<?php echo $data->pageNum + 1; ?>', '<?php echo $startDate ?>', '<?php echo $endDate ?>', 'resPractice')" aria-label="Next">
												<span aria-hidden="true">&raquo;</span>
											</a>
											</li>
											<li>
											<a onclick =" getPage(<?php echo $userId ?>, 1, '<?php echo $pages-1; ?>', '<?php echo $startDate ?>', '<?php echo $endDate ?>', 'resPractice')" aria-label="end">
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
		}
		?>
		</div>

	
	
	</div>
    <div role="tabpanel" class="tab-pane" id="dethi">
		<div>
			<h3 class="text-center robotofont">Đề thi đã làm</h3>
		</div>
		<?php if(!$data->getTestByWeek($userId, 0, $startDate, $endDate)) { ?>
		<div class="panel panel-info"> 
			<div class="panel-heading"> 
			<h3 class="panel-title">Đánh giá kết quả làm đề thi tuần này của bạn</h3> 
			</div> 
			<div class="panel-body">
				<ul class="list-group">
					
					<li class='list-group-item list-group-item-danger'>Tuần này bạn chưa làm đề nào.Bạn cần làm đề thi để ôn tập và kiểm tra kết quả học tập</li>
					
				</ul>
			</div>	
		</div>
		<?php }else {
			$numberTest = $data->getTestByWeek($userId, 0, $startDate, $endDate);
			$centTrueTest = $data->getQuestionTrueByTestAndWeek($userId, 0, $startDate, $endDate);
			?>
			<div class="panel panel-info"> 
				<div class="panel-heading"> 
				<h3 class="panel-title">Đánh giá kết quả làm đề thi tuần này của bạn</h3> 
				</div> 
				<div class="panel-body">
					<ul class="list-group">
						<li class='list-group-item list-group-item-success'>Tuần này bạn đã làm <?= $numberTest; ?> đề.</li>
						<?php
						echo trueTestToComment($centTrueTest, $numberTest);
						?>
						
					</ul>
				</div>	
			</div>

			
			<?php
		} ?>
		<div id='resTest' class="item">

		<?php
		
		$data->pageSize = 20;
		
		$page = pzk_request('page');
		if(!empty($page)) {
			$data->pageNum = $page;
		}else{
			$data->pageNum = 0;
		}

		$items = $data->getHistoryTestSn($userId, 0, $startDate, $endDate);
		
		$countItems = $data->countHistoryTestSn($userId, 0, $startDate, $endDate);
		$pages = ceil($countItems / $data->pageSize);
		if($items) {
			$i=1;
			?>
			<div class="table-responsive">
			<table class="table table-hover table-bordered">
				<thead>
				<tr>
					<th>#</th>
					<th>Tuần</th>
					<th>Đề</th>
					<th>Điểm</th>
					<th>Xếp hạng</th>
					<th>Ngôn ngữ</th>
					<th>Thời gian làm bài</th>
					<th>Đánh giá</th>
					<th>Ngày</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach($items as $val): ?>
				<tr>
					<td><?php echo $i+$data->pageNum*$data->pageSize; ?></td>
					<td><?php if($val['categoryId']) echo $val['cateName']; ?></td>
					<td><a href="/Profile/book/<?php echo @$val['id']?>"><?php echo @$val['name']?></a></td>
					<td><?php echo @$val['mark']?></td>
					
					<td><?php echo @$val['rank']?></td>
					<td>
					<?php 
					$lang = "en";
					if($val['lang']){
						$lang = $val['lang'];
					}
					echo $lang;
					?> 
					</td>
					
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
					<td><?php echo reviewforTest($val['mark']); ?></td>
					<td><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>  <?php echo date('d/m/Y H:i:m A', strtotime($val['startTime'])); ?></td>
				</tr>
				<?php $i++; ?>
				<?php endforeach; ?>
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
												<a onclick="getPage(<?php echo $userId ?>,0,0, '<?php echo $startDate ?>', '<?php echo $endDate ?>', 'resTest')" aria-label="End">
													<span aria-hidden="true">Trang đầu</span>
												</a>
											<li>
												<a aria-label="Previous" onclick ="getPage(<?php echo $userId ?>, 0, '<?php echo $data->pageNum -1; ?>', '<?php echo $startDate ?>', '<?php echo $endDate ?>', 'resTest')">
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
											<li class="<?php echo $active ?>">
												<a  onclick = "getPage(<?php echo $userId ?>, 0, <?php echo $page ?>, '<?php echo $startDate ?>', '<?php echo $endDate ?>', 'resTest')"><?php  echo ($page + 1)?></a>
											</li>
										<?php } ?>

										<?php if($data->pageNum < $pages-1) { ?>
										<li>
											<a onclick = "getPage(<?php echo $userId ?>, 0, '<?php echo $data->pageNum + 1; ?>', '<?php echo $startDate ?>', '<?php echo $endDate ?>', 'resTest')" aria-label="Next">
												<span aria-hidden="true">&raquo;</span>
											</a>
											</li>
											<li>
											<a onclick =" getPage(<?php echo $userId ?>, 0, '<?php echo $pages-1; ?>', '<?php echo $startDate ?>', '<?php echo $endDate ?>', 'resTest')" aria-label="end">
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
		}
		?>
		</div>

	</div>
	<?php 
	$compabilities = $data->getCompabilities($userId, $startDate, $endDate);
	$nameParentTest = array();
	$parentCompabilities = $data->getParentCompabilities();
	foreach($parentCompabilities as $parentCompability){
		$nameParentTest[$parentCompability['id']] = $parentCompability['name'];
	}
	$i=1; 
	?>
	<!--de khảo sát-->
	<div role="tabpanel" class="tab-pane" id="compability">
		<div>
			<h3 class="text-center robotofont">Đề khảo sát</h3>
		</div>
		<div class="table-responsive">
			<table class="table table-hover table-bordered">
				<thead>
				<tr>
					<th>#</th>
					<th>Đề khảo sát</th>
					<th>Loại đề</th>
					<th>Thời gian làm bài</th>
					<th>Ngày</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach($compabilities as $compability): ?>
					<tr>
					<td><?php echo $i ?></td>
					<td><?php echo $nameParentTest[$compability['parentTest']]; ?></td>
					<td>
					<?php 
					if($compability['trytest'] == 1){ 
					?>
					<a href="/Profile/book/<?php echo @$compability['id']?>" >Đề trắc nghiệm</a>
					<?php
					 
					} else { 
					?>
						<a href="/Profile/booktl/<?php echo @$compability['id']?>">Đề tự luận</a>
				
					<?php } ?>
					
					</td>
					<?php
					$time = $compability['duringTime'];
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
					<td><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>  <?php echo date('d/m/Y H:i:m A', strtotime($compability['startTime'])); ?></td>
					<?php $i++;?>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>		
	</div>	
	
	<div role="tabpanel" class="tab-pane" id="tuvung">
		<div>
			<h3 class="text-center robotofont">Đánh giá học từ vựng</h3>
		</div>
		
		<div class="panel panel-info"> 
			<div class="panel-heading"> 
			<h3 class="panel-title">Đánh giá kết quả học từ vựng của bạn</h3> 
			</div> 
			<div class="panel-body">
				<ul class="list-group">
					<?php
						$centTrueWord = $data->getCentWordTrueByWeek($userId, $startDate, $endDate);
						if(!$centTrueWord){
					?>
					<li class='list-group-item list-group-item-danger'>Tuần này bạn chưa học từ vựng. Bạn cần học từ vựng để làm bài luyện tập và kiểm tra tốt hơn!</li>
					<?php }else{ 
						echo centTrueWordToComment($centTrueWord);
						//xu huong game
						$category50 = $data->getGameByCate(50);
						$category51 = $data->getGameByCate(51);
						$category52 = $data->getGameByCate(52);
						$category53 = $data->getGameByCate(53);
						$category54 = $data->getGameByCate(54);
						$category59 = $data->getGameByCate(59);
						$category87 = $data->getGameByCate(87);
						$category88 = $data->getGameByCate(88);
						$category157 = $data->getGameByCate(157);
						$category164 = $data->getGameByCate(164);
						
						$allcate = $category50 + $category51 + $category52 + $category53 + $category54 + $category59 + $category87 + $category87 + $category88 + $category157 + $category164;
						
						
						reviewGameByCate($category50, $allcate, 'địa');	
						reviewGameByCate($category51, $allcate, 'toán');	
						reviewGameByCate($category52, $allcate, 'khoa học');	
						reviewGameByCate($category53, $allcate, 'sử');	
						reviewGameByCate($category54, $allcate, 'ngôn ngữ và giao tiếp');	
						reviewGameByCate($category59, $allcate, 'hiểu biết xã hội');	
						reviewGameByCate($category87, $allcate, 'kĩ năng nghe');	
						reviewGameByCate($category88, $allcate, 'kĩ năng quan sát');	
						reviewGameByCate($category157, $allcate, 'văn');	
						reviewGameByCate($category164, $allcate, 'tiếng anh');	
						
						
					 } ?>
					
				</ul>
			</div>	
		</div>
	</div>	
    
  </div>

</div>

<script>
function getPage($userId, $practice, $page, $startDate, $endDate, $idResult) {
	$.ajax({
		type: "Post",
		data:{
			page:$page, userId: $userId, practice: $practice, startDate: $startDate, endDate: $endDate, idResult:$idResult
		},
		url:'<?=BASE_REQUEST?>/home/ajaxHistory',
		success: function(data){
			$('#'+$idResult).html(data);
		}
	});
}
function practice($userId, $page, $startDate, $endDate) {
	$.ajax({
		type: "Post",
		data:{
			page:$page, userId: $userId, startDate: $startDate, endDate: $endDate
		},
		url:'<?=BASE_REQUEST?>/home/ajaxPractice',
		success: function(data){
			$('#resPractices').html(data);
		}
	});
}
</script>

