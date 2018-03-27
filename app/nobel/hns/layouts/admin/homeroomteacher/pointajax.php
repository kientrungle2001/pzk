
<?php
$showPoints = $data->ShowPoint();
$classroomId = $data->get('classroomId');
$schoolYear = $data->get('schoolYear');
$students = $data->getStudents();
// tao danh sach lop
$classStudents = array();
foreach ($students as $student) {
	$classStudents[$student['studentId']] = $student ;
}
/*var_dump($showPoints);die;*/
$quantityExercies = $showPoints['quantityExercies']; // so luong hs da lam bai tap
$dacham = $showPoints['dacham']; // so luong hs da duoc cham bai
$quantityNotExercies = $showPoints['quantityNotExercies']; ////so luong hs chua lam bai tap
$quantityStudents = $showPoints['quantityStudents'];
$kq = $showPoints['kq'];
$testMarkTotal = $showPoints['testMarkTotal'];
?>

<div class="panel">
  <!-- Default panel contents -->
  <div class="panel-heading"></div>
  <div class="panel-body">
  <ul class="list-group">
  	<li class="list-group-item list-group-item-warning"><H4> <strong>Sỹ số lớp:  {showPoints[quantityStudents]} học sinh </strong> </H4></li>
  	<li class="list-group-item list-group-item-info"><H4> <strong>Số lượng học sinh đã làm bài tập {showPoints[quantityExercies]} </strong></H4></li>
  	<li class="list-group-item list-group-item-success"><H4> <strong>Số bài đã chấm {showPoints[dacham]} </strong></H4>
  		<ul class="list-group">
			<li class="list-group-item ">Số học sinh đạt kết quả giỏi : {kq[gioi]} </li>
			<li class="list-group-item ">Số học sinh đạt kết quả khá : {kq[kha]}</li>
			<li class="list-group-item ">Số học sinh đạt kết quả trung bình :{kq[trungbinh]}</li>
			<li class="list-group-item ">Số học sinh đạt kết yếu  : {kq[yeu]}</li>
		</ul>
  	</li>
  	<li class="list-group-item list-group-item-danger"><H4> <strong>Số lượng học sinh chưa làm bài tập: {showPoints[quantityNotExercies]}</strong></H4></li>
  </ul>
    
  </div>
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">KẾT QUẢ HỌC TẬP</a></li>
  <li><a data-toggle="tab" href="#menu1">DANH SÁCH HỌC SINH ĐÃ LÀM BÀI</a></li>
  <li><a data-toggle="tab" href="#menu2">DANH SÁCH HỌC SINH CHƯA LÀM BÀI</a></li>
</ul>
<div class="tab-content">
	<!-- KET QUA CUA CA LOP -->
  <div id="home" class="tab-pane fade in active">
      <!-- Table -->
		<table class="table table-bordered">
	
			<?php
		// xoa cac phan tu tren ra khoi mang hs
		unset($showPoints['quantityExercies']);
		unset($showPoints['quantityNotExercies']);
		unset($showPoints['quantityStudents']);
		unset($showPoints['kq']);
		unset($showPoints['testMarkTotal']);
		
		?>
			<tr class="bg-success">
				<th>ID</th>
				<th>Tên đăng nhập</th>
				<th>Họ và tên</th>
				<th>Ngày nộp bài</th>
				<th>Điểm / Tổng điểm của bài</th>
				<th>Trạng thái</th>
			</tr>
		<?php $dsDaLam = array();?>
		{each $showPoints as $showPoint}
		<?php 
			if(in_array($showPoint['studentId'], $dsDaLam) || (!$showPoint['homeworkStatus'])) {
				continue;
			}
			 $classStudentId = $classStudents[$showPoint['studentId']]['id'];
		?>
			<tr class="<?php if($showPoint['status']): echo 'bg-success'; else: echo 'bg-warning'; endif;?>">
				<td>{showPoint[studentId]}</td>
				<td><a target="blank" href="/Admin_Home_HomeroomTeacher/student/{classroomId}/{classStudentId}/{showPoint[studentId]}">{showPoint[username]}</a></td>
				<td>{showPoint[name]}</td>
				<td><?php if($showPoint['homeworkStatus']):echo date('d/m/Y', strtotime($showPoint['created'])) ;endif;?></td>
					
				<td>
				<?php 
				if (isset($showPoint['status'])){
					echo $showPoint['totalMark']. '/'. $testMarkTotal ;	
				}
				
				?></td>
				
				<td><?php if($showPoint['status']):?><strong class="text-success">Đã chấm</strong><?php else:?><strong class="text-warning">Chưa chấm</strong><?php endif;?></td>
			</tr>
			<?php 
			if(!in_array($showPoint['studentId'], $dsDaLam)) {
				$dsDaLam[] = $showPoint['studentId'];
			}
			?>
		{/each}
		{each $students as $student}
		<?php 
		if(in_array($student['studentId'], $dsDaLam)): 
			continue;
		endif;
		
		?>
		<tr class="bg-danger">
			<td>{student[studentId]}</td>
			<td><a target="blank" href="/Admin_Home_HomeroomTeacher/student/{classroomId}/{student[id]}/{student[studentId]}">{student[username]}</a></td>
			<td>{student[name]}</td>
			<td></td>
			<td></td>
			
			<td><strong class="text-danger">Chưa làm</strong></td>
		</tr>
		{/each}
		</table>	
	
  </div>
  
  <!-- DANH SACH HS DA LAM BAI -->
  <div id="menu1" class="tab-pane fade">
    <table class="table table-bordered">
    	<tr class="bg-success">
				<th>ID</th>
				<th>Tên đăng nhập</th>
				<th>Họ và tên</th>
				<th>Ngày nộp bài</th>
				<th>Điểm</th>
				
				<th>Trạng thái</th>
			</tr>
		<?php $dsDaLam = array();?>
		{each $showPoints as $showPoint}
		<?php 
			if(in_array($showPoint['studentId'], $dsDaLam) || (!$showPoint['homeworkStatus'])) {
				continue;
			}
			$classStudentId = $classStudents[$showPoint['studentId']]['id'];
		?>
			<tr class="<?php if($showPoint['status']): echo 'bg-success'; else: echo 'bg-warning'; endif;?>">
				<td>{showPoint[studentId]}</td>
				<td><a target="blank" href="/Admin_Home_HomeroomTeacher/student/{classroomId}/{classStudentId}/{showPoint[studentId]}">{showPoint[username]}</a></td>
				<td>{showPoint[name]}</td>
				<td><?php if($showPoint['homeworkStatus']):echo date('d/m/Y', strtotime($showPoint['created'])) ;endif;?></td>
					
				<td>
				<?php 
				if (isset($showPoint['status'])){
					echo $showPoint['totalMark']. '/'. $testMarkTotal ;	
				}
				
				?></td>
				
				<td><?php if($showPoint['status']):?><strong class="text-success">Đã chấm</strong><?php else:?><strong class="text-warning">Chưa chấm</strong><?php endif;?></td>
			</tr>
			<?php 
			if(!in_array($showPoint['studentId'], $dsDaLam)) {
				$dsDaLam[] = $showPoint['studentId'];
			}
			?>
		{/each}
    </table>
  </div>
  
  
  <!-- DANH SACHS HS CHUA LAM BAI -->
  <div id="menu2" class="tab-pane fade">
    <table class="table table-bordered">
    	<tr class="bg-success">
				<th>ID</th>
				<th>Tên đăng nhập</th>
				<th>Họ và tên</th>
				<th>Ngày nộp bài</th>
				<th>Điểm</th>
				
				<th>Trạng thái</th>
		</tr>
		{each $students as $student}
		<?php 
		if(in_array($student['studentId'], $dsDaLam)): 
			continue;
		endif;?>
		<tr class="bg-danger">
			<td>{student[studentId]}</td>
			<td><a target="blank" href="/Admin_Home_HomeroomTeacher/student/{classroomId}/{student[id]}/{student[studentId]}">{student[username]}</a></td>
			<td>{student[name]}</td>
			<td></td>
			<td></td>
			
			<td></td>
			<td><strong class="text-danger">Chưa làm</strong></td>
		</tr>
		{/each}
	</table>
  </div>
</div>


</div>
<script type="text/javascript">
function getExerciesPoint() {
	
	
}
function getNotPoint() {
	var subjectId = $("#subjects").val();
	
	var selectweeks = $("#selectweeks").val();
	var weeks = '';
	var months ='';
	var semeters = '';

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
			classroomId: {classroomId},
			schoolYear: {schoolYear},
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
</script>
