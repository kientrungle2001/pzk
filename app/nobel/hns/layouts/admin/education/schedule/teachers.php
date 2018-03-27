<div class="container-fluid">
<?php
$classroom = $data->getClassroom();
$classrooms = $data->getClassrooms();
$teachers = $data->getTeachers();
$homeroomTeacher = $data->getHomeroomTeacher();
?>
<h1 class="text-center">Lớp {classroom[gradeNum]}{classroom[className]} Niên khóa {classroom[schoolYear]}</h1>
<h2 class="text-center"> Giáo viên chủ nhiệm:  </h2>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<table class="table table-bordered">
			<tr class="bg-success">
				<th>Họ và tên</th>
				<th>Tên đăng nhập</th>
				<th> Điện thoại</th>
			</tr>
			<tr>
				<td>{homeroomTeacher[fullName]}</td>
				<td>{homeroomTeacher[name]}</td>
				<td>{homeroomTeacher[phone]}</td>
			</tr>
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
	<tr class="bg-success">
		<th>#</th>
		<th>Tên đăng nhập</th>
		<th>Họ và tên</th>
		<th>Số điện thoại</th>
		<th>Môn học</th>
		<th>Chi tiết</th>
		<th colspan="2">Hành động</th>
	</tr>
{each $teachers as $teacher}
	<tr>
		<td><input class="teacher_checkbox" type="checkbox" name="teachers[]" value="{teacher[id]}" /></td>
		
		<td><a href="/Admin_Schedule_Teacher/teacher/{classroom[id]}/{teacher[id]}/{teacher[teacherId]}">{teacher[name]}</a></td>
		<td><a href="/Admin_Schedule_Teacher/teacher/{classroom[id]}/{teacher[id]}/{teacher[teacherId]}">{teacher[fullName]}</a></td>
		<td>{teacher[phone]}</td>
		<td>{teacher[subjectName]}</td>
		<td><a class="btn btn-primary btn-xs" href="/Admin_Schedule_Teacher/teacher/{classroom[id]}/{teacher[id]}/{teacher[teacherId]}">Chi tiết</a></td>
		<td><button class="btn btn-danger btn-xs" onclick="removeTeacherFromClassroom({teacher[id]}); return false;">Xóa</button>
		</td>
		<td>
			<button class="btn btn-success btn-xs" onclick="addHomeroomTeachersToClassroom({teacher[teacherId]}); return false;">Đặt làm GVCN</button>
		</td>
	</tr>
{/each}
</table>
<form class="form form-inline">
	<select	id="classrooms" class="form-control">
		<option value="">Chọn lớp</option>
		{each $classrooms as $cr}
		<option value="{cr[id]}">Niên khóa {cr[schoolYear]} - Lớp {cr[gradeNum]}{cr[className]}</option>
		{/each}
	</select>
	<button class="btn btn-warning" onclick="addTeachersToOtherClassroom(); return false;">Chuyển lớp</button>
	
</form>

</div>
</div>
<script type="text/javascript">
function searchTeachers() {
	var formData = $('#searchForm').serializeForm();
	$.ajax({
		url: '/Admin_Schedule_Teacher/searchTeacher',
		data: formData,
		success: function(teachers) {
			$('#searchResult').html(teachers);
		}
	});
}

function addTeacherToClassroom(teacherId) {
	var subjectId = $('#subject-for-teacher-' + teacherId).val();
	$.ajax({
		url: '/Admin_Schedule_Teacher/addTeacher',
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

function addHomeroomTeachersToClassroom(id) {
	
	$.ajax({
		url: '/Admin_Schedule_Teacher/changeHomeroomTeacher',
		data: {
			teacherId: id,
			classroomId: {classroom[id]}
		},
		type: 'POST',
		success: function(resp) {
			
			setTimeout(function() {
				window.location.reload();
			}, 500);
		}
	});
}

function removeTeacherFromClassroom(id) {
	if(confirm('Bạn có chắc muốn xóa không?')) {
		$.ajax({
			url: '/Admin_Schedule_Teacher/removeTeacher',
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
		url: '/Admin_Schedule_Teacher/changeTeacherClassroom',
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