<?php
$teacher 			= $data->getTeacher();
$classrooms 		= $data->getClassrooms();
$homeworks 			= $data->getHomeworks();
$tests 				= $data->getTests();
$studentHomeworks 	= $data->getStudentHomeworks();
?>
<h2 class="text-center"><?php echo @$teacher['fullName']?></h2>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<table class="table table-bordered">
			<tr class="bg-success">
				<th>Tên đăng nhập</th>
				<th>Số điện thoại</th>
				<th>Lớp</th>
			</tr>
			<tr>
				<td><?php echo @$teacher['name']?></td>
				<td><?php echo @$teacher['phone']?></td>
				<td><?php foreach($classrooms as $classroom): ?> - <?php echo @$classroom['schoolYear']?> <?php echo @$classroom['gradeNum']?><?php echo @$classroom['className']?> - Môn <?php echo @$classroom['subject']?><br /> <?php endforeach; ?></td>
			</tr>
		</table>
	</div>
</div>

<h3 class="text-center">Phiếu bài tập</h3>
<table class="table table-condense table-bordered">
<tr class="bg-danger">
	<th>Phiếu bài tập</th>
	<th>Môn học</th>
	<th>Tuần</th>
	<th>Tháng</th>
	<th>Học kỳ</th>
</tr>

<?php foreach($homeworks as $homework): ?>
<tr class="<?php if($homework['status']):?>bg-success<?php else:?>bg-warning<?php endif;?>">
	<td>
	<?php echo @$homework['name']?> 
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
</tr>
<?php endforeach; ?>
</table>

<hr />
<h3 class="text-center">Bài kiểm tra</h3>
<table class="table table-condense table-bordered">
<tr class="bg-danger">
	<th>Bài kiểm tra</th>
	<th>Môn học</th>
	<th>Tuần</th>
	<th>Tháng</th>
	<th>Học kỳ</th>
</tr>

<?php foreach($tests as $test): ?>
<tr class="<?php if($test['status']):?>bg-success<?php else:?>bg-warning<?php endif;?>">
	<td>
	<?php echo @$test['name']?> 
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
</tr>
<?php endforeach; ?>
</table>

<hr />
<h3 class="text-center">Bài tập về nhà</h3>
<table class="table table-condense table-bordered">
<tr class="bg-danger">
	<th>Tên đăng nhập</th>
	<th>Họ và tên</th>
	<th>Phiếu bài tập</th>
	<th>Môn học</th>
	<th>W</th>
	<th>M</th>
	<th>S</th>
	<th>Thời gian</th>
	<th>Điểm</th>
	<th>Trạng thái</th>
</tr>

<?php foreach($studentHomeworks as $homework): ?>
<tr class="<?php if($homework['status']):?>bg-success<?php else:?>bg-warning<?php endif;?>">
	<td>
	<?php echo @$homework['username']?> 
	</td>
	<td>
	<?php echo @$homework['fullName']?> 
	</td>
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
	<td>
	<?php echo @$homework['startTime']?>
	</td>
	<td>
	<?php echo @$homework['mark']?>
	</td>
	<td>
	<?php if($homework['status']):?><span class="btn btn-success btn-xs">Đã chấm</span><?php else: ?><span class="btn btn-warning btn-xs">Chưa chấm</span><?php endif;?>
	</td>
</tr>
<?php endforeach; ?>
</table>