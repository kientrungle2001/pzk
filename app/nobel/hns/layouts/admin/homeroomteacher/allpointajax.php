
<?php
$showPoints = $data->ShowAllPoint();
$showsTudents = $data->getStudents();
$getPointTest= $data->getPointTestHomework();
$classroomId = $data->getClassroomId();
$pointTests= array();
foreach ($getPointTest as $point) {
	if($point['testMark'] == '' || $point['testMark'] == 0 ){
		$pointTests[$point['testId']] = 'chưa nhập tổng điểm của đề' ;
	}else 	$pointTests[$point['testId']] = $point['testMark'];
}
/*var_dump($getPointTest);die;*/
$subjects = $data->getSubjects();
/*$lengthSubj = count($subjects);
*/
?>

<div class="panel">
  <!-- Default panel contents -->
  <div class="panel-heading">KẾT QUẢ HỌC TẬP</div>
  <div class="panel-body">
    
  </div>


<div class="tab-content">
  <!-- DANH SACH DIEM CUA HS -->
	  <div id="home" class="tab-pane fade in active">
		<!-- Table -->
	  <table class="table table-bordered">

		<tr class="bg-success">
			<th>ID</th>
			<th>Tên đăng nhập</th>
			<th>Họ và tên</th>
			
			<?php foreach($subjects as $subject): ?>
			<?php if($subject['subjectName'] != 'Practice'): ?>
				<th>Điểm <?php echo @$subject['subjectName']?></th>
			<?php endif; ?>
			<?php endforeach; ?>
		</tr>
	<?php foreach($showsTudents as $showsTudent): ?>
	
		<tr>		
			<td><?php echo @$showsTudent['studentId']?></td>
			<td><a target="blank" href="/Admin_Home_HomeroomTeacher/student/<?php echo $classroomId ?>/<?php echo @$showsTudent['id']?>/<?php echo @$showsTudent['studentId']?>"><?php echo @$showsTudent['username']?></a></td>
			<td><?php echo @$showsTudent['name']?></td>
			<?php foreach($subjects as $subject): ?>
			<?php if($subject['subjectName'] != 'Practice'): ?>
			<td><?php 
				if(isset($showPoints[$subject['subjectId']][$showsTudent['studentId']]['homeworkStatus'])){
					
					if($showPoints[$subject['subjectId']][$showsTudent['studentId']]['status']== 1 && isset($pointTests[$showPoints[$subject['subjectId']][$showsTudent['studentId']]['testId']])){
						echo '<span class="label label-success">'. $showPoints[$subject['subjectId']][$showsTudent['studentId']]['totalMark'].'/'.$pointTests[$showPoints[$subject['subjectId']][$showsTudent['studentId']]['testId']] .'</span>';

					}else echo '<span class="label label-warning">Chưa chấm</span> ';
					
				}else echo '<span class="label label-danger">Chưa làm</span> ';
				
			?></td>
			<?php endif; ?>
			<?php endforeach; ?>	
			
			

		</tr>
	<?php endforeach; ?>

	  </table>

    
     
</div>	
  
</div>

