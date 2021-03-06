<?php
$student = $data->getStudent();
$classrooms = $data->getClassrooms();
$homeworks = $data->getHomeworks();
$tests = $data->getTests();
$getPointTest= $data->getPointTestHomework();
$pointTests= array();
foreach ($getPointTest as $point) {
	if($point['testMark'] == '' || $point['testMark'] == 0 ){
		$pointTests[$point['testId']] = 'chưa nhập tổng điểm của đề' ;
	}else 	$pointTests[$point['testId']] = $point['testMark'];
}
$MarkInTest = 0;
?>
<h2 class="text-center"><?php echo @$student['name']?></h2>
<div class="row">
<div class="col-md-6 col-md-offset-3">
<table class="table table-bordered">
	<tr class="bg-success">
		<th>ID</th>
		<th>Tên đăng nhập</th>
		<th>Ngày sinh</th>
		<th>Điện thoại</th>
		<th>Lớp</th>
	</tr>
	<tr>
		<td> <?php echo @$student['id']?></td>
		<td> <?php echo @$student['username']?></td>
		<td> <?php echo @$student['birthday']?></td>
		<td> <?php echo @$student['phone']?></td>
		<td> <?php foreach($classrooms as $classroom): ?><?php echo @$classroom['schoolYear']?> <?php echo @$classroom['gradeNum']?><?php echo @$classroom['className']?>, <?php endforeach; ?></td>
	</tr>
</table>
</div>
</div>

<div class="row">
<div class="col-md-12">
<h3 class="text-center">Phiếu bài tập</h3>
<table class="table table-condense table-hovered">
<tr class="bg-success">
	<th>Phiếu bài tập</th>
	<th>Môn học</th>
	<th>Tuần</th>
	<th>Tháng</th>
	<th>Học kỳ</th>
	<th>Điểm Tự động</th>
	<th>Điểm Giáo viên chấm</th>
	<th>Tổng điểm</th>
	<th>Thời gian</th>
	<th>Trạng thái</th>
</tr>

<?php foreach($homeworks as $homework): ?>
	<?php if (!$homework['homeworkStatus']): continue; endif;
		if(isset($pointTests[$homework['testId']])){
			/*printf($pointTests[$homework['testId']]);*/
			$MarkInTest = $pointTests[$homework['testId']];
		}
	 ?>
<tr class="bg-warning">
	<td>
	<?php echo @$homework['homeworkName']?> 
	</td>
	<td>
	<?php echo @$homework['subject']?> 
	</td>
	<td>
	<?php echo @$homework['week']?> 
	</td>
	<td>
	<?php echo @$homework['month']?> 
	</td>
	<td>
	<?php echo @$homework['semester']?>
	</td>
	<td><strong class="text-success"><?php echo @$homework['autoMark']?></strong>
	
	</td>
	<td>
	<strong class="text-success"><?php echo @$homework['teacherMark']?></strong>
	</td>
	<td>
	<strong class="text-success"><?php echo @$homework['totalMark']?> / <?php echo $MarkInTest ?></strong>
	</td>
	<td>
	<?php echo @$homework['startTime']?>
	</td>
	<th>
	<?php if($homework['status']):?><span class="label label-success">Đã chấm</span><?php else: ?><span class="label label-warning">Chưa chấm</span><?php endif;?>
	</th>
</tr>
<?php endforeach; ?>
</table>
</div>
<div class="col-md-12">
<h3 class="text-center">Bài kiểm tra</h3>
<table class="table table-condense table-hovered">
<tr class="bg-success">
	<th>Bài kiểm tra</th>
	<th>Môn học</th>
	<th>Tuần</th>
	<th>Tháng</th>
	<th>Học kỳ</th>
	<th>Điểm tự động</th>
	<th>Điểm giáo viên chấm</th>
	<th>Tổng điểm</th>
	<th>Thời gian</th>
	<th>Trạng thái</th>
</tr>

<?php foreach($tests as $test): ?>
<?php 
	if(isset($pointTests[$test['testId']])){
			$MarkInTest = $pointTests[$test['testId']];
		}
?>
<tr class="<?php if($test['status']):?>bg-success<?php else:?>bg-warning<?php endif;?>">
	<td>
	<?php echo @$test['testName']?> 
	</td>
	<td>
	<?php echo @$test['subject']?> 
	</td>
	<td>
	<?php echo @$test['week']?> 
	</td>
	<td>
	<?php echo @$test['month']?> 
	</td>
	<td>
	<?php echo @$test['semester']?>
	</td>
	<td>
	<strong class="text-success"><?php echo @$test['autoMark']?></strong>
	</td>
	<td>
	<strong class="text-success"><?php echo @$test['teacherMark']?></strong>
	</td>
	<td>
	<strong class="text-success"><?php echo @$test['totalMark']?>/ <?php echo $MarkInTest ?></strong>
	</td>
	<td>
	<?php echo @$test['startTime']?>
	</td>
	<td>
	<?php if($test['status']):?><span class="label label-success">Đã chấm</span><?php else: ?><span class="label label-warning">Chưa chấm</span><?php endif;?>
	</td>
</tr>
<?php endforeach; ?>
</table>
</div>
</div>
<?php 
$indexedHomeworks = array();
foreach($homeworks as $homework):
	$indexedHomeworks[$homework['categoryId']][$homework['week']] = $homework;
endforeach;
?>

	<ul class="nav nav-tabs">
<?php $first = true;?>
    <?php foreach($classrooms as $classroom): ?>
	<li <?php if($first):?>class="active"<?php $first = false; endif;?>><a data-toggle="tab" href="#classroom-<?php echo @$classroom['id']?>">Niên khóa <?php echo @$classroom['schoolYear']?> Lớp <?php echo @$classroom['gradeNum']?><?php echo @$classroom['className']?></a></li>
	<?php endforeach; ?>
  </ul>

  <div class="tab-content">
<?php $first = true;?>
    <?php foreach($classrooms as $classroom): ?>    
	<div id="classroom-<?php echo @$classroom['id']?>" class="tab-pane fade <?php if($first):?>in active<?php $first = false; endif;?>">
      <h3 class="text-center">Niên khóa <?php echo @$classroom['schoolYear']?> Lớp <?php echo @$classroom['gradeNum']?><?php echo @$classroom['className']?></h3>
      <?php	$subjects = $data->getSubjects($classroom['gradeNum']);	?>
	  <table class="table table-condense table-hovered">
		<tr>
		<td>&nbsp;</td>
		<?php foreach($subjects as $subject): ?>
			<th><?php echo @$subject['name']?></th>
		<?php endforeach; ?>
		</tr>
		
		<?php for($week = 1; $week < 36; $week++):?>
		<tr>
		<th>Tuần <?php echo $week ?></th>
		<?php foreach($subjects as $subject): ?>
			<td>
			<?php if(isset($indexedHomeworks[$subject['id']]) && isset($indexedHomeworks[$subject['id']][$week])):?>
			<?php $homework = $indexedHomeworks[$subject['id']][$week];?>
			<?php 
				if(isset($pointTests[$homework['testId']])):
					$MarkInTest = $pointTests[$homework['testId']];
				endif;	?>
			<?php if($homework['status']):	?>
				<strong class="text-success"><?php echo @$homework['totalMark']?> / <?php echo $MarkInTest ?></strong>
			<?php else: ?>
				<strong class="text-danger">Chưa chấm</strong>
			<?php endif;?>
			<?php else:?>
			<span class="text-warning">Chưa làm</span>
			<?php endif;?>
			</td>
		<?php endforeach; ?>
		</tr>
		<?php endfor;?>
	  </table>
    </div>
	<?php endforeach; ?>
  </div>