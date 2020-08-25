<?php 
	$userId = pzk_or(intval(pzk_request()->getSegment(3)), pzk_session()->getUserId()); 
	$class = pzk_session('lop');
	
?>

<div class='container'>
	
	<h2 class="text-center robotofont">Lịch sử học tập</h2>
  
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
		<a href="#homework" aria-controls="homework" role="tab" data-toggle="tab">Phiếu bài tập</a>
	</li>
    <li role="presentation">
		<a href="#compability" aria-controls="compability" role="tab" data-toggle="tab">Đề cuối tháng</a>
	</li>
    
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="homework">
		<div class="well item">
			<div class="col-xs-4">
				<label for="resultAchievement"> Chọn tuần để xem lịch sử học tập</label>
				<select class="form-control" id="historyWeek" name="viewWeek" onchange="window.location = '/Profile/onchangeHistoryWeek?historyWeek='+this.value;">
					<option>Chọn tuần</option>
					<?php for($i = 1; $i < 37; $i++){ ?>
						<option value="<?=$i;?>">Tuần <?=$i;?></option>
					<?php }?>
				</select>
			</div>	
		</div>	
		<script>
			$('#historyWeek').val(<?=pzk_session('historyWeek');?>);
		</script>
		<?php if(pzk_session('historyWeek')){ ?>
		<h3 class="text-center robotofont">Phiếu bài tập đã làm</h3>
		<?php 
			$homeworks = $data->getHomeWork($userId, $class, pzk_session('historyWeek'));
			//debug($homeworks);
			$testHomeworks = _db()->select('id, name')->fromTests()->whereHomework(1)->likeClasses('%,'.$class.',%')->result();
			
			$arrNameHomework = array();
			foreach($testHomeworks as $testHomework){
				$arrNameHomework[$testHomework['id']] =  $testHomework['name'];
			}
			
			if($homeworks){
				$i = 1;
		?>
		
			<div class="table-responsive">
				<table class="table table-hover table-bordered">
					<thead>
					<tr>
						<th>Stt</th>
						<th>Tên phiếu bài tập</th>
						<th>Tuần</th>
						<th>Điểm</th>
						<th>Thời gian làm bài</th>
						<th>Ngày</th>
						<th>Trạng thái</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach($homeworks as $homework): ?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><a href="/Profile/book/<?php echo @$homework['id']?>"><?php echo $arrNameHomework[$homework['testId']]; ?></a></td>
						<td><?php echo $homework['week'] ?></td>
						<td><?= $homework['totalMark'];?></td>
						
						<?php
						$time = $homework['duringTime'];
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
						<td><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>  <?php echo date('d/m/Y H:i:m A', strtotime($homework['startTime'])); ?></td>
						<td>
							<?php if($homework['status'] == 1){ ?>
								<a href="/Profile/book/<?php echo @$homework['id']?>"><div class="btn btn-primary">Đã chấm</div></a>
							<?php } else { ?>
								<a href="/Profile/book/<?php echo @$homework['id']?>"><div class="btn btn-danger">Chưa chấm</div></a>
							<?php } ?>
						</td>
					</tr>
					<?php $i++; ?>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<?php } else{ ?>
				<div class="alert alert-danger">Chưa có dữ liệu</div>
			<?php } ?>
			
		<?php } ?>
	</div>
	
	
	
    <div role="tabpanel" class="tab-pane" id="compability">
	
		<div class="well item">
			<div class="col-xs-4">
				<label for="historyMonth"> Chọn tháng để xem</label>
				<select class="form-control" id="historyMonth" name="viewWeek" onchange="window.location = '/Profile/onchangeHistoryMonth?historyMonth='+this.value;">
					<option>Chọn tháng</option>
					<?php for($i = 1; $i < 13; $i++){ ?>
						<option value="<?=$i;?>">Tháng <?=$i;?></option>
					<?php }?>
				</select>
			</div>	
		</div>	
		<script>
			$('#historyMonth').val(<?=pzk_session('historyMonth');?>);
		</script>
		<?php 
		if(pzk_session('historyMonth')){
			$compabilities = $data->getCompabilityMonth($userId, $class, pzk_session('historyMonth'));
			$nameParentTest = array();
			$parentCompabilities = $data->getParentCompabilities();
			foreach($parentCompabilities as $parentCompability){
				$nameParentTest[$parentCompability['id']] = $parentCompability['name'];
			}
			$i=1; 
		?>
		<h3 class="text-center robotofont">Đề cuối tháng</h3>
		<?php if($compabilities){ ?>
		<div class="table-responsive">
			<table class="table table-hover table-bordered">
				<thead>
				<tr>
					<th>#</th>
					<th>Đề khảo sát</th>
					<th>Loại đề</th>
					<th>Thời gian làm bài</th>
					<th>Ngày</th>
					<th>Trạng thái</th>
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
					<td>
					<?php if($compability['trytest'] == 2){ 
						if($compability['status'] == 1){ ?>
							<a href="/Profile/booktl/<?php echo @$compability['id']?>"><div class="btn btn-primary">Đã chấm</div></a>
						<?php } else { ?>
							<a href="/Profile/booktl/<?php echo @$compability['id']?>"><div class="btn btn-primary">Đã chấm</div></a>
						<?php } ?>
					<?php } ?>
					</td>
					<?php $i++;?>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>	
		<?php } else { ?>
			<div class="alert alert-danger">Chưa có dữ liệu</div>
		<?php } }?>	
		
	</div>
   
  </div>

</div>

