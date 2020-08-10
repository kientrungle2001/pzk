<div class="container-fluid">
<?php
$classroom = $data->getClassroom();
$classrooms = $data->getClassrooms();
$homeworks = $data->getHomeworks();
?>
<h1 class="text-center">Lớp <?php echo @$classroom['gradeNum']?><?php echo @$classroom['className']?> Niên khóa <?php echo @$classroom['schoolYear']?></h1>
<div class="row">
<div class="col-md-3">
<h2>Phiếu bài tập</h2>
<table class="table table-bordered">
<?php foreach($homeworks as $homework): ?>
<?php if(pzk_session()->getAdminLevel() == 'Teacher') : 
	if(strpos($homework['teacherIds'], ',' . pzk_session()->getAdminId() . ',') === false) 
		continue;
endif;?>
	<tr>
		<td><a href="/Admin_Schedule_Teacher/showHomework/<?php echo @$classroom['id']?>/<?php echo @$homework['homeworkId']?>"><?php echo @$homework['name']?></a></td>
	</tr>
<?php endforeach; ?>
</table>
</div>
</div>
</div>