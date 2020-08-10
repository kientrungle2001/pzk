<?php 
$homework = $data->getHomework();
$classrooms = $data->getSameGradeClassrooms();
$classroomsHasHomework = $data->getClassroomsHasHomework();
$classroomsHasHomeworkIds = array_map(function($classroom) {
	return $classroom['classroomId'];
}, $classroomsHasHomework);
$questions = $data->getQuestions();
?>
<h2 class="text-center"><?php echo @$homework['name']?></h2>
<table class="table table-bordered">
	<tr>
		<td><strong>Thời gian</strong></td>
		<td><?php echo @$homework['time']?> phút</td>
		<td><strong>Môn học</strong></td>
		<td><?php echo @$homework['subject']?></td>
		<td><strong>Số câu</strong></td>
		<td><?php echo @$homework['quantity']?></td>
	</tr>
	<tr>
		<td><strong>Tuần</strong></td>
		<td><?php echo @$homework['week']?></td>
		<td><strong>Tháng</strong></td>
		<td><?php echo @$homework['month']?></td>
		<td><strong>Học kỳ</strong></td>
		<td><?php echo @$homework['semester']?></td>
	</tr>
</table>
<hr />
<h3 class="text-center">Các lớp học phiếu bài tập này</h3>
<table class="table table-condense table-hovered">
<tr>
<?php foreach($classrooms as $index => $classroom): ?>
<td>
<input type="checkbox" class="classroom_homework" name="classroom_homework[]" value="<?php echo @$classroom['id']?>" <?php if(in_array($classroom['id'], $classroomsHasHomeworkIds)): ?>checked<?php endif; ?> />
	<?php echo @$classroom['schoolYear']?> - <?php echo @$classroom['gradeNum']?><?php echo @$classroom['className']?>
</td>
<?php if(($index+1) % 4 == 0): ?></tr><tr><?php endif; ?>
<?php endforeach; ?>
</tr>
</table>
<div class="text-center">
	<button class="btn btn-primary" onclick="addHomeworkToClassrooms(); return false;">Lưu lại</button>
</div>
<hr />

<h3 class="text-center">Các câu hỏi</h3>
<table class="table table-condense table-hovered table-bordered">

<?php foreach($questions as $index => $question): ?>
<tr>
<td><input type="checkbox" class="classroom_homework_question" name="classroom_homework_question[]" value="<?php echo @$question['id']?>" /></td>
<td><a href="/Admin_Question2/detail/<?php echo @$question['id']?>?backHref=<?php echo urlencode(BASE_REQUEST); ?>%2FAdmin_Schedule_Teacher%2Fhomework%2F{:rseg3}%2F{:rseg4}%2F{:rseg5}">Câu <?php  echo $index + 1; ?><?php echo @$question['name_vn']?></a></td>
<td><a class="btn btn-primary btn-xs" href="/Admin_Question2/edit/<?php echo @$question['id']?>?backHref=<?php echo urlencode(BASE_REQUEST); ?>%2FAdmin_Schedule_Teacher%2Fhomework%2F{:rseg3}%2F{:rseg4}%2F{:rseg5}">Sửa</a></td>
<td><a href="/Admin_Question2/del/<?php echo @$question['id']?>?backHref=<?php echo urlencode(BASE_REQUEST); ?>%2FAdmin_Schedule_Teacher%2Fhomework%2F{:rseg3}%2F{:rseg4}%2F{:rseg5}">Xóa</a></td>
</tr>
<?php endforeach; ?>

</table>
<a class="btn btn-primary" href="/Admin_Question2/add?testId=,{:rseg5},&backHref=<?php echo urlencode(BASE_REQUEST); ?>%2FAdmin_Schedule_Teacher%2Fhomework%2F{:rseg3}%2F{:rseg4}%2F{:rseg5}">Thêm câu hỏi</a>

<hr />

	<ul class="nav nav-tabs">
	{first = true}
    <?php foreach($classrooms as $classroom): ?>
		<?php if(!in_array($classroom['id'], $classroomsHasHomeworkIds)): ?>
			<?php continue; ?>
		<?php endif; ?>
	<li <?php if($first): ?>class="active"{first = false}<?php endif; ?>><a data-toggle="tab" href="#classroom-<?php echo @$classroom['id']?>">Niên khóa <?php echo @$classroom['schoolYear']?> Lớp <?php echo @$classroom['gradeNum']?><?php echo @$classroom['className']?></a></li>
	<?php endforeach; ?>
	</ul>

  <div class="tab-content">
  {first = true}
    <?php foreach($classrooms as $classroom): ?>    
		<?php if(!in_array($classroom['id'], $classroomsHasHomeworkIds)): ?>
			<?php continue; ?>
		<?php endif; ?>
			{students = $data->getStudentsOfClassroom($classroom['id'])}
	<div id="classroom-<?php echo @$classroom['id']?>" class="tab-pane fade <?php if($first): ?>in active{first = false}<?php endif; ?>">
      <h3 class="text-center">Niên khóa <?php echo @$classroom['schoolYear']?> Lớp <?php echo @$classroom['gradeNum']?><?php echo @$classroom['className']?></h3>
		{subjects = $data->getSubjects($classroom['gradeNum'])}
	  <table class="table table-condense table-hovered">
		<tr>
			<td>&nbsp;</td>
			<th>Ngày nộp bài</th>
			<th>Điểm trắc nghiệm</th>
			<th>Điểm tự luận</th>
			<th>Chi tiết</th>
			<th>Trạng thái</th>
		</tr>
		
		<?php foreach($students as $student): ?>
		<tr>
			<th><?php echo @$student['name']?></th>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<?php endforeach; ?>
	  </table>
    </div>
	<?php endforeach; ?>
  </div>
 <script>
 function addHomeworkToClassrooms() {
	 var classrooms = $('.classroom_homework:checked');
	 var classroomIds = [];
	 classrooms.each(function(index, elem) {
		 classroomIds.push(elem.value);
	 });
	 $.ajax({
		 url: '/Admin_Schedule_Teacher/addHomeworkToClassrooms/{:rseg3}/{:rseg4}/{:rseg5}',
		 type: 'post',
		 data: {
			 classroomIds: classroomIds
		 },
		 success: function(resp) {
			 window.location.reload();
		 }
	 });
 }
 </script>