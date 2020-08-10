<div class="container">
<?php
$classroom = $data->getClassroom();
$classrooms = $data->getClassrooms();
$students = $data->getStudents();
$subjects = $data->getSubject($classroom['gradeNum']);

//var_dump($subjects);die;
?>
<div class="panel">
  <!-- Default panel contents -->
  <div class="panel-heading"><h2 class="text-center">Kết quả học tập của lớp <?php echo @$classroom['gradeNum']?><?php echo @$classroom['className']?> Niên khóa <?php echo @$classroom['schoolYear']?></h2></div>
  <div class="panel-body">
    <div id="viewstudents" class="row">
	<form class="form form-inline">
		<select	id="subjects" class="form-control">
			<option value="">Chọn Môn</option>
			<option value="all">Tất cả các môn</option>
			<?php foreach($subjects as $subject): ?>
			<?php if($subject['subjectName'] != 'Practice'): ?>
				<option value="<?php echo @$subject['subjectId']?>"><?php echo @$subject['subjectName']?></option>
			<?php endif; ?>
			<?php endforeach; ?>
		</select>
		<select	id="selectweeks" class="form-control" >Lọc theo
			<option value="">Lọc theo</option>
			
			<option value="week">Lọc theo Tuần</option>
			<option value="month">Lọc theo Tháng</option>
			<option value="semester">Lọc theo Học kỳ</option>
			
		</select>
		<select	id="weeks" class="form-control">Chọn tuần học
			<option value="">Chọn tuần</option>
			<?php for ($i= 1; $i<=36; $i++){ ?>
			<option value="<?php echo $i ?>">Tuần <?php echo $i ?></option>
			<?php } ?>			
		</select>
		<select	id="months" class="form-control">Chọn tháng
			<option value="">Chọn tháng</option>
			<?php for ($i= 1; $i<=12; $i++){ ?>
			<option value="<?php echo $i ?>">Tháng <?php echo $i ?></option>
			<?php } ?>			
		</select>
		<select	id="semesters" class="form-control">Chọn học kỳ
			<option value="">Chọn học kỳ</option>
			<option value="1">Học kỳ 1</option>
			<option value="2">Học kỳ 2</option>					
		</select>
		<button class="btn btn-warning" onclick="getPoint(); return false;">Xem kết quả</button>
	</form>
</div>
  </div>
</div>
<div id="viewpoints"></div>
<div class="row">
<div class="col-md-9" >
<div id="viewpointss">
<table class="table table-bordered">
	<tr class="bg-success">
		<th>ID</th>
		<th>Tên đăng nhập</th>
		<th>Họ và tên</th>
		<th>Ngày sinh</th>
		
	</tr>
	<tbody>
		
	
<?php foreach($students as $student): ?>
	<tr class="bg-warning">
		
		<td><?php echo @$student['studentId']?></td>
		<td><?php echo @$student['username']?></td>
		<td><?php echo @$student['name']?></td>
		<td><?php  echo date('d/m/Y', strtotime($student['birthday']))?></td>
		
	</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
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
$("#months").hide();
$("#semesters").hide();
$("#weeks").hide();
	$("#selectweeks").click(function(){
		var value =$("#selectweeks").val();
		if(value=='') return false;

		if(value== 'week'){
			$("#weeks").show();
			$("#months").hide();
			$("#semesters").hide();
			return true;
		}else if(value=='month'){
			$("#weeks").hide();
			$("#months").show();
			$("#semesters").hide();
			return true;
		}else if(value=='semester'){
			$("#weeks").hide();
			$("#months").hide();
			$("#semesters").show();
			return true;
		}
	});
	

function addStudentToClassroom(studentId) {
	$.ajax({
		url: '/Admin_Schedule_Teacher/addStudent',
		data: {
			classroomId: <?php echo @$classroom['id']?>,
			studentId: studentId
		},
		type: 'POST',
		success: function(resp) {
			if(resp) {
			$("#viewstudents").hide();
			$("#viewpoints").html(resp);	
			
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

function getPoint() {
	var subjectId = $("#subjects").val();
	
	var selectweeks = $("#selectweeks").val();
	var weeks = '';
	var months ='';
	var semesters = '';

	// neu khong chon mon thi mac dinh laf lay diem trung binh cac mon
	// neu moi vao thi mac dinh chon tuan hien tai cua nam hocj

	if(!selectweeks) {
		alert('Bạn cần chọn điều kiện lọc theo : tuần học, tháng, hay học kỳ');
		return false;
	}
	// neu chon week echo ra tuan hien tai
	if(selectweeks == 'week'){
		weeks= $("#weeks").val();

	}else if( selectweeks == 'month'){
		months= $("#months").val();
	}else if(selectweeks == 'semester'){
		semesters= $("#semesters").val();
	}
	$.ajax({
		url: '/Admin_Home_HomeroomTeacher/getPoint',
		data: {
			classes: <?php echo @$classroom['gradeNum']?>,
			classroomId: <?php echo @$classroom['id']?>,
			schoolYear: <?php echo @$classroom['schoolYear']?>,
			subjectId: subjectId,
			weeks: weeks,
			months: months,
			semesters: semesters
		},
		type: 'POST',
		success: function(resp) {
			if(resp) {
				
				//$("#viewstudents").hide();
				$("#viewpointss").html(resp);	
		
			} else {
				// not ok
				alert('Đã có trong danh sách lớp');
			}
		}
	});
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