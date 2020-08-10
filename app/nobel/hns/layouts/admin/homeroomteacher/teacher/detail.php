<?php
$teacher = $data->getTeacher();
$classroom = $data->getClassrooms();

$homeworks = $data->getHomeworks();
debug($homeworks); die;
$tests = $data->getTests();
$studentHomeworks = $data->getStudentHomeworks();
?>
<h2 class="text-center"><?php echo @$teacher['fullName']?></h2>
<p class="text-left"><strong>Tên đăng nhập</strong>: <?php echo @$teacher['name']?></p>
<p class="text-left"><strong>Số điện thoại</strong>: <?php echo @$teacher['phone']?></p>
<p class="text-left"><strong>Lớp</strong>: <br /><?php echo @$classroom['schoolYear']?> <?php echo @$classroom['gradeNum']?><?php echo @$classroom['className']?> - Môn <?php echo @$classroom['subject']?><br /></p>
<hr />
<h3 class="text-center">Phiếu bài tập</h3>
<table class="table table-condense table-hovered">
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
<table class="table table-condense table-hovered">
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
<table class="table table-condense table-hovered">
<tr class="bg-danger">
	<th>Tên đăng nhập</th>
	<th>Họ và tên</th>
	<th>Phiếu bài tập</th>
	<th>Môn học</th>
	<th>Tuần</th>
	<th>Tháng</th>
	<th>Học kỳ</th>
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