<div class="container">
<?php
$classroom = $data->getClassroom();
$classrooms = $data->getClassrooms();
$students = $data->getStudents();
?>
<h1 class="text-center">Kết quả học tập của lớp {classroom[gradeNum]}{classroom[className]} Niên khóa {classroom[schoolYear]}</h1>
<div class="row">
	<form class="form form-inline">
		<select	id="classrooms" class="form-control">
			<option value="">Chọn Môn</option>
			{each $classrooms as $cr}
			<option value="{cr[id]}">Niên khóa {cr[schoolYear]} - Lớp {cr[gradeNum]}{cr[className]}</option>
			{/each}
		</select>
		<button class="btn btn-warning" onclick="addStudentsToOtherClassroom(); return false;">Chuyển lớp</button>
	</form>
</div>
<div class="row">
<div class="col-md-9">

<table class="table table-condense table-hovered">
	<tr>		
		<th>ID</th>
		<th>Tên đăng nhập</th>
		<th>Họ và tên</th>
		<th>Ngày sinh</th>
		
	</tr>
{each $students as $student}
	<tr>
		
		<td>{student[studentId]}</td>
		<td>{student[username]}</td>
		<td>{student[name]}</td>
		<td>{? echo date('d/m/Y', strtotime($student['birthday']))?}</td>
		
	</tr>
{/each}
</table>

</div>
</div>
<script type="text/javascript">
function searchStudents() {
	var formData = $('#searchForm').serializeForm();
	$.ajax({
		url: '/Admin_Schedule_Teacher/searchStudent',
		data: formData,
		success: function(students) {
			$('#searchResult').html(students);
		}
	});
}

function addStudentToClassroom(studentId) {
	$.ajax({
		url: '/Admin_Schedule_Teacher/addStudent',
		data: {
			classroomId: {classroom[id]},
			studentId: studentId
		},
		type: 'POST',
		success: function(resp) {
			if(resp == '1') {
				// ok
				window.location.reload();
			} else {
				// not ok
				alert('Đã có trong danh sách lớp');
			}
		}
	});
}

function removeStudentFromClassroom(id) {
	if(confirm('Bạn có chắc muốn xóa không?')) {
		$.ajax({
			url: '/Admin_Schedule_Teacher/removeStudent',
			data: {
				id: id
			},
			type: 'POST',
			success: function(resp) {
				if(resp == '1') {
					// ok
					window.location.reload();
				} else {
					// not ok
					alert('Không có trong danh sách lớp');
				}
			}
		});
	}
}

function addStudentToOtherClassroom(id, classroomId) {
	$.ajax({
		url: '/Admin_Schedule_Teacher/changeStudentClassroom',
		data: {
			classroomId: classroomId,
			id: id
		},
		type: 'POST',
		success: function(resp) {
			
		}
	});
	
}

function addStudentsToOtherClassroom() {
	var classroomId = $('#classrooms').val();
	var studentIds = getSelectedStudentIds();
	if(!classroomId) {
		alert('Bạn cần chọn lớp cần chuyển đến');
		return false;
	}
	
	if(!studentIds.length) {
		alert('Bạn cần chọn học sinh cần chuyển lớp');
		return false;
	}
	if(confirm('Bạn có chắc muốn chuyển lớp cho những học sinh này?')) {
		studentIds.forEach(function(studentId) {
			addStudentToOtherClassroom(studentId, classroomId);
		});
		setTimeout(function() {
			window.location.reload();
		}, studentIds.length * 500);
	}
}

function getSelectedStudentIds() {
	var selecteds = $('.student_checkbox:checked');
	var ids = [];
	selecteds.each(function(item){
		ids.push(item.value);
	});
	return ids;
}
</script>
</div>