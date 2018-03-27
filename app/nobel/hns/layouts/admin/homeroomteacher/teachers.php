<div class="container-fluid">
<?php
$classroom = $data->getClassroom();
$classrooms = $data->getClassrooms();
$teachers = $data->getTeachers();
$homeroomTeacher = $data->getHomeroomTeacher();
?>
<h1 class="text-center">Lớp {classroom[gradeNum]}{classroom[className]} Niên khóa {classroom[schoolYear]}</h1>
<div class="row">
	<div class="col-md-6">
		<table class="table table-bordered">
			<tbody>
			<tr class="bg-info">
				<th colspan="3"><H4> <strong>Giáo viên chủ nhiệm:  </strong> </H4></th>
			</tr>
			<tr class="bg-success">
				<th>Họ và tên</th>
				<th>Tên đăng nhập</th>
				<th> Điện thoại</th>
			</tr>
			<tr>
				<td><strong> {homeroomTeacher[fullName]}</strong></td>
				<td><strong>{homeroomTeacher[name]}</strong></td>
				<td><strong>{homeroomTeacher[phone]} </strong></td>
			</tr>
			</tbody>
		</table>
</div>
</div>
<div class="row">
<div class="col-md-4">
	<h2>Tìm kiếm giáo viên</h2>
	<form id="searchForm" class="form form-inline" onsubmit="searchTeachers(); return false;">
	<table class="table table-condense table-hovered">
	<tr>
	<td>
	<input type="text" name="username" class="form-control" />
	</td>
	<td class="text-right">
	<button class="btn btn-primary">Tìm kiếm</button>
	</td>
	</tr>
	</table>
	</form>
	<div id="searchResult">

	</div>
</div>
<div class="col-md-8">
<h2 class="text-center">Danh sách giáo viên</h2>
<table class="table table-bordered">
	<tbody>
	<tr class="bg-info">
		<th>#</th>
		<th>Môn học</th>
		<th>Tên đăng nhập</th>
		<th>Họ và tên</th>
		<th>Số điện thoại</th>
				
		
	</tr>
{each $teachers as $teacher}
	<tr>
		<td><input class="teacher_checkbox" type="checkbox" name="teachers[]" value="{teacher[id]}" /></td>
		<td>{teacher[subjectName]}</td>
		<td>{teacher[name]}</td>
		<td>{teacher[fullName]}</td>
		<td>{teacher[phone]}</td>
		
	</tr>
{/each}
	</tbody>
</table>


</div>
</div>
<script type="text/javascript">
function searchTeachers() {
	var formData = $('#searchForm').serializeForm();
	$.ajax({
		url: '/Admin_HomeroomTeacher_Teacher/searchTeacher',
		data: formData,
		success: function(teachers) {
			$('#searchResult').html(teachers);
		}
	});
}

function addTeacherToClassroom(teacherId) {
	var subjectId = $('#subject-for-teacher-' + teacherId).val();
	$.ajax({
		url: '/Admin_HomeroomTeacher_Teacher/addTeacher',
		data: {
			classroomId: {classroom[id]},
			teacherId: teacherId,
			subjectId: subjectId
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



function removeTeacherFromClassroom(id) {
	if(confirm('Bạn có chắc muốn xóa không?')) {
		$.ajax({
			url: '/Admin_HomeroomTeacher_Teacher/removeTeacher',
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


function addTeacherToOtherClassroom(id, classroomId) {
	$.ajax({
		url: '/Admin_HomeroomTeacher_Teacher/changeTeacherClassroom',
		data: {
			classroomId: classroomId,
			id: id
		},
		type: 'POST',
		success: function(resp) {
			
		}
	});
	
}
function addTeachersToOtherClassroom() {
	var classroomId = $('#classrooms').val();
	var teacherIds = getSelectedTeacherIds();
	if(!classroomId) {
		alert('Bạn cần chọn lớp cần chuyển đến');
		return false;
	}
	
	if(!teacherIds.length) {
		alert('Bạn cần chọn học sinh cần chuyển lớp');
		return false;
	}
	if(confirm('Bạn có chắc muốn chuyển lớp cho những học sinh này?')) {
		teacherIds.forEach(function(teacherId) {
			addTeacherToOtherClassroom(teacherId, classroomId);
		});
		setTimeout(function() {
			window.location.reload();
		}, teacherIds.length * 500);
	}
}

function getSelectedTeacherIds() {
	var selecteds = $('.teacher_checkbox:checked');
	var ids = [];
	selecteds.each(function(item){
		ids.push(item.value);
	});
	return ids;
}
</script>
</div>