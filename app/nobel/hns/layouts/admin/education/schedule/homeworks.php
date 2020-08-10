<div class="container-fluid">
<?php
$classroom = $data->getClassroom();
$classrooms = $data->getClassrooms();
$homeworks = $data->getHomeworks();
?>
<h1 class="text-center">Lớp <?php echo @$classroom['gradeNum']?><?php echo @$classroom['className']?> Niên khóa <?php echo @$classroom['schoolYear']?></h1>
<div class="row">
<div class="col-md-4">
<h2>Tìm kiếm</h2>
<form id="searchForm" class="form form-inline" onsubmit="searchHomeworks(); return false;">
<table class="table table-condense table-hovered">
<tr>
<td><input type="text" name="username" class="form-control" /></td>
<td><button class="btn btn-primary">Tìm kiếm</button></td>
</tr>
</table>
</form>
<div id="searchResult">

</div>
</div>
<div class="col-md-8">
<h2 class="text-center">Danh sách Phiếu bài tập</h2>
<?php
$href = BASE_REQUEST . '/Admin_Schedule_Teacher/homeworks/' . $classroom['id'];
$addHref = BASE_REQUEST . '/Admin_Schedule_Teacher/addHomeworkToClassroom/' . $classroom['id'];
?>
<table class="table table-condense table-bordered">
	<tr class="bg-success">
		<th>#</th>
		<th>Tên Phiếu</th>
		<th>Môn học</th>
		<th>Tuần</th>
		<th>Tháng</th>
		<th>Học kỳ</th>
		<th colspan="2">Hành động</th>
	</tr>
<?php foreach($homeworks as $homework): ?>
<?php if(pzk_session()->getAdminLevel() == 'Teacher') : 
	if(strpos($homework['teacherIds'], ',' . pzk_session()->getAdminId() . ',') === false) 
		continue;
endif;?>
	<tr>
		<td><input class="homework_checkbox" type="checkbox" name="homeworks[]" value="<?php echo @$homework['id']?>" /></td>
		<td><a href="/Admin_Schedule_Teacher/homework/<?php echo @$homework['classroomId']?>/<?php echo @$homework['id']?>/<?php echo @$homework['homeworkId']?>"><?php echo @$homework['name']?></a></td>
		<td><?php echo @$homework['subject']?></td>
		<td><?php echo @$homework['week']?></td>
		<td><?php echo @$homework['month']?></td>
		<td><?php echo @$homework['semester']?></td>
		<td>
		<a class="btn btn-primary btn-xs" href="/Admin_Test/edit/<?php echo @$homework['homeworkId']?>?backHref=<?php echo urlencode($href);?>">Sửa</a>
		</td>
		<td>
		<button class="btn btn-danger btn-xs" onclick="removeHomeworkFromClassroom(<?php echo @$homework['id']?>); return false;">Xóa</button></td>
	</tr>
<?php endforeach; ?>
</table>

<form class="form form-inline">
	<?php 
	$addDefaultParams = 'homework=1&hidden_homework=1&hidden_trytest=1&hidden_compability=1&hidden_parent=1';
	$teacherParams = '';
	$teacherSubject = null;
	if(pzk_session()->getAdminLevel() == 'Teacher') {
		$teacherParams.= '&teacherIds=,' . pzk_session()->getAdminId() . ',&hidden_teacherIds=1';
		$subjects = _db()->select('*')
			->fromEducation_classroom_teacher()
			->whereTeacherId(pzk_session()->getAdminId())
			->whereClassroomId($classroom['id'])
			->orderBy('id desc')->result();
		if($numOfSubject = count($subjects)) {
			$teacherSubject = $subjects[0];
			$teacherParams.= '&subjectId=' . $subjects[0]['subjectId'] . '&hidden_subjectId=1';
			$teacherParams.= '&classes=,'.$classroom['gradeNum'].',&hidden_classes=1';
			$teacherParams.= '&status=1&hidden_status=1';
			$teacherParams.= '&time=45';
			$teacherParams.= '&quantity=12';
		}
	}
	$addTestParams = 'homework=0&hidden_homework=1&hidden_trytest=1&hidden_compability=1&hidden_parent=1';
	?>
	<a class="btn btn-primary" href="/Admin_Test/add?<?php echo $addDefaultParams ?><?php echo $teacherParams ?>&backHref=<?php echo urlencode($addHref);?>">Thêm Phiếu Bài tập</a>
	<a class="btn btn-success" href="/Admin_Test/add?<?php echo $addDefaultParams ?><?php echo $teacherParams ?>&backHref=<?php echo urlencode($addHref);?>">Thêm Đề kiểm tra</a>
	<div class="hidden">
	<select	id="classrooms" class="form-control">
		<option value="">Chọn lớp</option>
		<?php foreach($classrooms as $cr): ?>
		<option value="<?php echo @$cr['id']?>">Niên khóa <?php echo @$cr['schoolYear']?> - Lớp <?php echo @$cr['gradeNum']?><?php echo @$cr['className']?></option>
		<?php endforeach; ?>
	</select>
	<button class="btn btn-warning" onclick="addHomeworksToOtherClassroom(); return false;">Chuyển lớp</button>
	</div>
</form>
</div>
</div>
<script type="text/javascript">
function searchHomeworks() {
	var formData = $('#searchForm').serializeForm();
	$.ajax({
		url: '/Admin_Schedule_Teacher/searchHomework/<?php echo @$classroom['gradeNum']?><?php if($teacherSubject):?>/<?php echo @$teacherSubject['subjectId']?><?php endif;?>',
		data: formData,
		success: function(homeworks) {
			$('#searchResult').html(homeworks);
		}
	});
}

function addHomeworkToClassroom(homeworkId) {
	$.ajax({
		url: '/Admin_Schedule_Teacher/addHomework',
		data: {
			classroomId: <?php echo @$classroom['id']?>,
			homeworkId: homeworkId,
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

function removeHomeworkFromClassroom(id) {
	if(confirm('Bạn có chắc muốn xóa không?')) {
		$.ajax({
			url: '/Admin_Schedule_Teacher/removeHomework',
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

function addHomeworkToOtherClassroom(id, classroomId) {
	$.ajax({
		url: '/Admin_Schedule_Teacher/changeHomeworkClassroom',
		data: {
			classroomId: classroomId,
			id: id
		},
		type: 'POST',
		success: function(resp) {
			
		}
	});
	
}

function addHomeworksToOtherClassroom() {
	var classroomId = $('#classrooms').val();
	var homeworkIds = getSelectedHomeworkIds();
	if(!classroomId) {
		alert('Bạn cần chọn lớp cần chuyển đến');
		return false;
	}
	
	if(!homeworkIds.length) {
		alert('Bạn cần chọn học sinh cần chuyển lớp');
		return false;
	}
	if(confirm('Bạn có chắc muốn chuyển lớp cho những học sinh này?')) {
		homeworkIds.forEach(function(homeworkId) {
			addHomeworkToOtherClassroom(homeworkId, classroomId);
		});
		setTimeout(function() {
			window.location.reload();
		}, homeworkIds.length * 500);
	}
}

function getSelectedHomeworkIds() {
	var selecteds = $('.homework_checkbox:checked');
	var ids = [];
	selecteds.each(function(item){
		ids.push(item.value);
	});
	return ids;
}
</script>
</div>