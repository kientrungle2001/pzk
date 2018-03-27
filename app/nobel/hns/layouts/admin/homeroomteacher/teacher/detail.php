<?php
$teacher = $data->getTeacher();
$classroom = $data->getClassrooms();

$homeworks = $data->getHomeworks();
debug($homeworks); die;
$tests = $data->getTests();
$studentHomeworks = $data->getStudentHomeworks();
?>
<h2 class="text-center">{teacher[fullName]}</h2>
<p class="text-left"><strong>Tên đăng nhập</strong>: {teacher[name]}</p>
<p class="text-left"><strong>Số điện thoại</strong>: {teacher[phone]}</p>
<p class="text-left"><strong>Lớp</strong>: <br />{classroom[schoolYear]} {classroom[gradeNum]}{classroom[className]} - Môn {classroom[subject]}<br /></p>
<hr />
<h3 class="text-center">Phiếu bài tập</h3>
<table class="table table-condense table-hovered">
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
<table class="table table-condense table-hovered">
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
<table class="table table-condense table-hovered">
<tr class="bg-danger">
	<th>Tên đăng nhập</th>
	<th>Họ và tên</th>
	<th>Phiếu bài tập</th>
	<th>Môn học</th>
	<th>Tuần</th>
	<th>Tháng</th>
	<th>Học kỳ</th>
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