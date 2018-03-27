<div class="container-fluid">
<?php
$classroom = $data->getClassroom();
$classrooms = $data->getClassrooms();
$homeworks = $data->getHomeworks();
?>
<h1 class="text-center">Lớp {classroom[gradeNum]}{classroom[className]} Niên khóa {classroom[schoolYear]}</h1>
<div class="row">
<div class="col-md-3">
<h2>Phiếu bài tập</h2>
<table class="table table-bordered">
{each $homeworks as $homework}
<?php if(pzk_session('adminLevel') == 'Teacher') : 
	if(strpos($homework['teacherIds'], ',' . pzk_session('adminId') . ',') === false) 
		continue;
endif;?>
	<tr>
		<td><a href="/Admin_Schedule_Teacher/showHomework/{classroom[id]}/{homework[homeworkId]}">{homework[name]}</a></td>
	</tr>
{/each}
</table>
</div>
</div>
</div>