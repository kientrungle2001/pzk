<?php 
$homework = $data->getHomework();
$classrooms = $data->getSameGradeClassrooms();
$classroomsHasHomework = $data->getClassroomsHasHomework();
$classroomsHasHomeworkIds = array_map(function($classroom) {
	return $classroom['classroomId'];
}, $classroomsHasHomework);
$questions = $data->getQuestions();
?>
<h2 class="text-center">{homework[name]}</h2>
<table class="table table-bordered">
	<tr>
		<td><strong>Thời gian</strong></td>
		<td>{homework[time]} phút</td>
		<td><strong>Môn học</strong></td>
		<td>{homework[subject]}</td>
		<td><strong>Số câu</strong></td>
		<td>{homework[quantity]}</td>
	</tr>
	<tr>
		<td><strong>Tuần</strong></td>
		<td>{homework[week]}</td>
		<td><strong>Tháng</strong></td>
		<td>{homework[month]}</td>
		<td><strong>Học kỳ</strong></td>
		<td>{homework[semester]}</td>
	</tr>
</table>
<hr />
<h3 class="text-center">Các lớp học phiếu bài tập này</h3>
<table class="table table-condense table-hovered">
<tr>
{each $classrooms as $index => $classroom}
<td>
<input type="checkbox" class="classroom_homework" name="classroom_homework[]" value="{classroom[id]}" {if in_array($classroom['id'], $classroomsHasHomeworkIds)}checked{/if} />
	{classroom[schoolYear]} - {classroom[gradeNum]}{classroom[className]}
</td>
{if ($index+1) % 4 == 0}</tr><tr>{/if}
{/each}
</tr>
</table>
<div class="text-center">
	<button class="btn btn-primary" onclick="addHomeworkToClassrooms(); return false;">Lưu lại</button>
</div>
<hr />

<h3 class="text-center">Các câu hỏi</h3>
<table class="table table-condense table-hovered table-bordered">

{each $questions as $index => $question}
<tr>
<td><input type="checkbox" class="classroom_homework_question" name="classroom_homework_question[]" value="{question[id]}" /></td>
<td><a href="/Admin_Question2/detail/{question[id]}?backHref=<?php echo urlencode(BASE_REQUEST); ?>%2FAdmin_Schedule_Teacher%2Fhomework%2F{:rseg3}%2F{:rseg4}%2F{:rseg5}">Câu {? echo $index + 1; ?}{question[name_vn]}</a></td>
<td><a class="btn btn-primary btn-xs" href="/Admin_Question2/edit/{question[id]}?backHref=<?php echo urlencode(BASE_REQUEST); ?>%2FAdmin_Schedule_Teacher%2Fhomework%2F{:rseg3}%2F{:rseg4}%2F{:rseg5}">Sửa</a></td>
<td><a href="/Admin_Question2/del/{question[id]}?backHref=<?php echo urlencode(BASE_REQUEST); ?>%2FAdmin_Schedule_Teacher%2Fhomework%2F{:rseg3}%2F{:rseg4}%2F{:rseg5}">Xóa</a></td>
</tr>
{/each}

</table>
<a class="btn btn-primary" href="/Admin_Question2/add?testId=,{:rseg5},&backHref=<?php echo urlencode(BASE_REQUEST); ?>%2FAdmin_Schedule_Teacher%2Fhomework%2F{:rseg3}%2F{:rseg4}%2F{:rseg5}">Thêm câu hỏi</a>

<hr />

	<ul class="nav nav-tabs">
	{first = true}
    {each $classrooms as $classroom}
		{if !in_array($classroom['id'], $classroomsHasHomeworkIds)}
			{continue}
		{/if}
	<li {if $first}class="active"{first = false}{/if}><a data-toggle="tab" href="#classroom-{classroom[id]}">Niên khóa {classroom[schoolYear]} Lớp {classroom[gradeNum]}{classroom[className]}</a></li>
	{/each}
	</ul>

  <div class="tab-content">
  {first = true}
    {each $classrooms as $classroom}    
		{if !in_array($classroom['id'], $classroomsHasHomeworkIds)}
			{continue}
		{/if}
			{students = $data->getStudentsOfClassroom($classroom['id'])}
	<div id="classroom-{classroom[id]}" class="tab-pane fade {if $first}in active{first = false}{/if}">
      <h3 class="text-center">Niên khóa {classroom[schoolYear]} Lớp {classroom[gradeNum]}{classroom[className]}</h3>
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
		
		{each $students as $student}
		<tr>
			<th>{student[name]}</th>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		{/each}
	  </table>
    </div>
	{/each}
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