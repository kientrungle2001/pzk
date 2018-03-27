<?php
$teacher 			= $data->getTeacher();
$classrooms 		= $data->getClassrooms();
$homeworks 			= $data->getHomeworks();
$tests 				= $data->getTests();
$studentHomeworks 	= $data->getStudentHomeworks();
?>
<h2 class="text-center">{teacher[fullName]}</h2>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<table class="table table-bordered">
			<tr class="bg-success">
				<th>Tên đăng nhập</th>
				<th>Số điện thoại</th>
				<th>Lớp</th>
			</tr>
			<tr>
				<td>{teacher[name]}</td>
				<td>{teacher[phone]}</td>
				<td>{each $classrooms as $classroom} - {classroom[schoolYear]} {classroom[gradeNum]}{classroom[className]} - Môn {classroom[subject]}<br /> {/each}</td>
			</tr>
		</table>
	</div>
</div>

<h3 class="text-center">Phiếu bài tập</h3>
<table class="table table-condense table-bordered">
<tr class="bg-danger">
	<th>Phiếu bài tập</th>
	<th>Môn học</th>
	<th>Tuần</th>
	<th>Tháng</th>
	<th>Học kỳ</th>
</tr>

{each $homeworks as $homework}
<tr class="<?php if($homework['status']):?>bg-success<?php else:?>bg-warning<?php endif;?>">
	<td>
	{homework[name]} 
	</td>
	<td>
	{homework[subject]} 
	</td>
	<td>
	{homework[week]} 
	</td>
	<td>
	{homework[month]} 
	</td>
	<td>
	{homework[semester]}
	</td>
</tr>
{/each}
</table>

<hr />
<h3 class="text-center">Bài kiểm tra</h3>
<table class="table table-condense table-bordered">
<tr class="bg-danger">
	<th>Bài kiểm tra</th>
	<th>Môn học</th>
	<th>Tuần</th>
	<th>Tháng</th>
	<th>Học kỳ</th>
</tr>

{each $tests as $test}
<tr class="<?php if($test['status']):?>bg-success<?php else:?>bg-warning<?php endif;?>">
	<td>
	{test[name]} 
	</td>
	<td>
	{test[subject]} 
	</td>
	<td>
	{test[week]} 
	</td>
	<td>
	{test[month]} 
	</td>
	<td>
	{test[semester]}
	</td>
</tr>
{/each}
</table>

<hr />
<h3 class="text-center">Bài tập về nhà</h3>
<table class="table table-condense table-bordered">
<tr class="bg-danger">
	<th>Tên đăng nhập</th>
	<th>Họ và tên</th>
	<th>Phiếu bài tập</th>
	<th>Môn học</th>
	<th>W</th>
	<th>M</th>
	<th>S</th>
	<th>Thời gian</th>
	<th>Điểm</th>
	<th>Trạng thái</th>
</tr>

{each $studentHomeworks as $homework}
<tr class="<?php if($homework['status']):?>bg-success<?php else:?>bg-warning<?php endif;?>">
	<td>
	{homework[username]} 
	</td>
	<td>
	{homework[fullName]} 
	</td>
	<td>
	{homework[homeworkName]} 
	</td>
	<td>
	{homework[subject]} 
	</td>
	<td>
	{homework[week]} 
	</td>
	<td>
	{homework[month]} 
	</td>
	<td>
	{homework[semester]}
	</td>
	<td>
	{homework[startTime]}
	</td>
	<td>
	{homework[mark]}
	</td>
	<td>
	<?php if($homework['status']):?><span class="btn btn-success btn-xs">Đã chấm</span><?php else: ?><span class="btn btn-warning btn-xs">Chưa chấm</span><?php endif;?>
	</td>
</tr>
{/each}
</table>