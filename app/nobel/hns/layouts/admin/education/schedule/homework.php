<div class="container-fluid">
<?php
$classroom 	= 	$data->getClassroom();
$homeworks 	= 	$data->getClassroomHomeworks();
$students 	=	$data->getClassroomStudents();
$allHomeworks = $data->getHomeworks();
$questions 	=	$data->getAutoQuestions();
$totalDoneHomeworks 	=	count($homeworks);
?>
<h1 class="text-center">Lớp <?php echo @$classroom['gradeNum']?><?php echo @$classroom['className']?> Niên khóa <?php echo @$classroom['schoolYear']?></h1>
<div class="row">
<div class="col-md-3">
<h2>Phiếu bài tập</h2>
<table class="table table-bordered">
<?php foreach($allHomeworks as $homework): ?>
<?php if(pzk_session()->getAdminLevel() == 'Teacher') : 
	if(strpos($homework['teacherIds'], ',' . pzk_session()->getAdminId() . ',') === false) 
		continue;
endif;?>
	<tr>
		<td <?php if($homework['homeworkId'] == $data->getHomeworkId()):?>class="bg-success"<?php endif;?>><a href="/Admin_Schedule_Teacher/showHomework/<?php echo @$classroom['id']?>/<?php echo @$homework['homeworkId']?>"><?php echo @$homework['name']?></a></td>
	</tr>
<?php endforeach; ?>
</table>

<h2>Thống kê</h2>
<table class="table table-bordered">
	<tr>
		<td>Sĩ số</td>
		<td class="student-total">39</td>
	</tr>
	<tr class="bg-danger">
		<td>Chưa làm</td>
		<td class="student-notdone">39</td>
	</tr>
	<tr class="bg-success">
		<td>Đã làm</td>
		<td class="student-done">39</td>
	</tr>
	<tr class="bg-warning">
		<td>Chưa chấm</td>
		<td class="student-notmarked">39</td>
	</tr>
	<tr class="bg-primary">
		<td>Đã chấm</td>
		<td class="student-marked">39</td>
	</tr>
</table>

<h2>Câu hỏi</h2>
<table class="table table-bordered">
	<tr class="bg-success">
		<th colspan="3">Câu hỏi</th>
	</tr>
	<tr>
		<td class="bg-danger">Đúng</td>
		<td class="bg-danger">Sai</td>
		<td class="bg-danger">% Sai</td>
	</tr>
<?php foreach($questions as $index => $question): ?>
	<tr <?php if($index % 2): ?>class="bg-warning"<?php endif; ?>>
		<td colspan="3"><?php echo '<strong>Câu '.($index+1).': </strong>'.cut_words(strip_tags($question['name_vn']), 30); ?></td>
	</tr>
	<tr <?php if($index % 2): ?>class="bg-warning text-bold"<?php endif; ?>>
		<td>
		<?php 
		$studentIds = array_map(function($student){
			return $student['studentId'];
		}, $students);
		$countRight = $data->countRight($question['id'], $studentIds);
		$countWrong = $totalDoneHomeworks - $countRight;
		?>
		<?php echo $countRight ?>
		</td>
		<td><?php echo $countWrong ?></td>
		<?php $wrongPercent = ceil(($countWrong / $totalDoneHomeworks) * 100) ?>
		<td <?php if($wrongPercent >= 50): ?>style="background: red; color: white; font-weight: bold;"<?php endif; ?>><?php echo $wrongPercent ?>%</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="col-md-9">
<h2>Danh sách Bài tập về nhà <a href="/Admin_Schedule_Teacher/remarkAll/<?php echo @$classroom['id']?>/<?php echo $data->getHomeworkId()?>">Chấm lại tất</a></h2>
<table class="table table-bordered">
	<tr class="bg-success">
		<th>STT</th>
		<th>Tên đăng nhập</th>
		<th>Họ và tên</th>
		<th>Ngày nộp bài</th>
		<th>Tự động</th>
		<th>GV Chấm</th>
		<th>Tổng điểm</th>
		<th>Vào xem</th>
		<th>Chi tiết</th>
		<th>Trạng thái</th>
		<th>Chấm lại</th>
		
	</tr>
<?php 
$total = 0;
$done = 0;
$notdone = 0;
$marked = 0;
$notmarked = 0;
$dsDaLam = array();?>
<?php foreach($homeworks as $homework): ?>
	<?php
	if(in_array($homework['userId'], $dsDaLam) || !$homework['homeworkStatus']) {
		continue;
	}
	$total++;
	$done++;
	?>
	<tr class="<?php if($homework['status']): echo 'bg-success'; else: echo 'bg-warning'; endif;?>">
		<td><?php echo $total ?></td>
		<td><a href="/Admin_Book/details/<?php echo @$homework['id']?>" target="_blank"><?php echo @$homework['username']?></a></td>
		<td><a href="/Admin_Book/details/<?php echo @$homework['id']?>" target="_blank"><?php echo @$homework['name']?></a></td>
		<td><?php echo @$homework['created']?></td>
		<td><?php echo @$homework['autoMark']?></td>
		<td><?php echo @$homework['teacherMark']?></td>
		<td><?php echo @$homework['totalMark']?></td>
		<td><a style="width: 100%" class="btn btn-danger btn-xs" href="/Admin_Schedule_Teacher/gotoStudent/<?php echo @$homework['id']?>?userId=<?php echo @$homework['userId']?>" target="_blank"><span class="glyphicon glyphicon-eye-open"></span> Truy cập</a></td>
		<td>
		<?php if($homework['status']):?>
		<a style="width: 100%" class="btn btn-success btn-xs" href="/Admin_Book/details/<?php echo @$homework['id']?>" target="_blank"><span class="glyphicon glyphicon-eye-open"></span> Chi tiết</a>
		<?php else:?>
		<a style="width: 100%" class="btn btn-primary btn-xs" href="/Admin_Book/details/<?php echo @$homework['id']?>" target="_blank"><span class="glyphicon glyphicon-edit"></span> Chấm</a>
		<?php endif;?>
		</td>
		<td><?php if($homework['status']): $marked++;?><strong class="text-success">Đã chấm xong</strong><?php else:?><strong class="text-warning">Chưa chấm</strong><?php endif;?></td>
		<td>
		<a style="width: 100%" class="btn btn-primary btn-xs" href="/Admin_Schedule_Teacher/remark/<?php echo @$classroom['id']?>/<?php echo $data->getHomeworkId()?>/<?php echo @$homework['id']?>"><span class="glyphicon glyphicon-edit"></span> Chấm lại</a>
		</td>
	</tr>
	<?php 
	if(!in_array($homework['userId'], $dsDaLam)) {
		$dsDaLam[] = $homework['userId'];
	}
	?>
<?php endforeach; ?>

<?php foreach($students as $student): ?>
<?php 
if(in_array($student['studentId'], $dsDaLam)): 
	continue;
endif;
$total++;
?>
<tr class="bg-danger">
	<td><?php echo $total ?></td>
	<td><?php echo @$student['username']?></td>
	<td><?php echo @$student['name']?></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td><strong class="text-danger">Chưa làm</strong></td>
</tr>
<?php endforeach; ?>
</table>
</div>
</div>
</div>
<?php 
$notdone = $total - $done;
$notmarked = $done - $marked;
?>
<script type="text/javascript">
$('.student-total').text('<?php echo $total ?>');
$('.student-done').text('<?php echo $done ?>');
$('.student-notdone').text('<?php echo $notdone ?>');
$('.student-marked').text('<?php echo $marked ?>');
$('.student-notmarked').text('<?php echo $notmarked ?>');
</script>