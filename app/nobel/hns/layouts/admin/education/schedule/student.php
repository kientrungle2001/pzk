<?php
$student = $data->getStudent();
$classrooms = $data->getClassrooms();
$homeworks = $data->getHomeworks();
$tests = $data->getTests();
?>
<h2 class="text-center">{student[name]}</h2>
<div class="row">
<div class="col-md-6 col-md-offset-3">
<table class="table table-bordered">
	<tr class="bg-success">
		<th>ID</th>
		<th>Tên đăng nhập</th>
		<th>Ngày sinh</th>
		<th>Lớp</th>
	</tr>
	<tr>
		<td> {student[id]}</td>
		<td> {student[username]}</td>
		<td> {student[birthday]}</td>
		<td> {each $classrooms as $classroom}{classroom[schoolYear]} {classroom[gradeNum]}{classroom[className]}, {/each}</td>
	</tr>
</table>
</div>
</div>

<div class="row">
<div class="col-md-12">
<h3 class="text-center">Phiếu bài tập</h3>
<table class="table table-condense table-hovered">
<tr class="bg-success">
	<th>Phiếu bài tập</th>
	<th>Môn học</th>
	<th>Tuần</th>
	<th>Tháng</th>
	<th>Học kỳ</th>
	<th>Điểm Tự động</th>
	<th>Điểm Giáo viên chấm</th>
	<th>Tổng điểm</th>
	<th>Thời gian</th>
	<th>Trạng thái</th>
</tr>

{each $homeworks as $homework}
	<?php if (!$homework['homeworkStatus']): continue; endif; ?>
<tr class="<?php if($homework['status']):?>bg-success<?php else:?>bg-warning<?php endif;?>">
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
	{homework[autoMark]}
	</td>
	<td>
	{homework[teacherMark]}
	</td>
	<td>
	{homework[totalMark]}
	</td>
	<td>
	{homework[startTime]}
	</td>
	<td>
	<?php if($homework['status']):?>Đã chấm<?php else: ?>Chưa chấm<?php endif;?>
	</td>
</tr>
{/each}
</table>
</div>
<div class="col-md-12">
<h3 class="text-center">Bài kiểm tra</h3>
<table class="table table-condense table-hovered">
<tr class="bg-success">
	<th>Bài kiểm tra</th>
	<th>Môn học</th>
	<th>Tuần</th>
	<th>Tháng</th>
	<th>Học kỳ</th>
	<th>Điểm tự động</th>
	<th>Điểm giáo viên chấm</th>
	<th>Tổng điểm</th>
	<th>Thời gian</th>
	<th>Trạng thái</th>
</tr>

{each $tests as $test}
<tr class="<?php if($test['status']):?>bg-success<?php else:?>bg-warning<?php endif;?>">
	<td>
	{test[testName]} 
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
	<td>
	{test[autoMark]}
	</td>
	<td>
	{test[teacherMark]}
	</td>
	<td>
	{test[totalMark]}
	</td>
	<td>
	{test[startTime]}
	</td>
	<td>
	<?php if($test['status']):?>Đã chấm<?php else: ?>Chưa chấm<?php endif;?>
	</td>
</tr>
{/each}
</table>
</div>
</div>
<?php 
$indexedHomeworks = array();
foreach($homeworks as $homework):
	$indexedHomeworks[$homework['categoryId']][$homework['week']] = $homework;
endforeach;
?>

	<ul class="nav nav-tabs">
<?php $first = true;?>
    {each $classrooms as $classroom}
	<li <?php if($first):?>class="active"<?php $first = false; endif;?>><a data-toggle="tab" href="#classroom-{classroom[id]}">Niên khóa {classroom[schoolYear]} Lớp {classroom[gradeNum]}{classroom[className]}</a></li>
	{/each}
  </ul>

  <div class="tab-content">
<?php $first = true;?>
    {each $classrooms as $classroom}    
	<div id="classroom-{classroom[id]}" class="tab-pane fade <?php if($first):?>in active<?php $first = false; endif;?>">
      <h3 class="text-center">Niên khóa {classroom[schoolYear]} Lớp {classroom[gradeNum]}{classroom[className]}</h3>
      <?php	$subjects = $data->getSubjects($classroom['gradeNum']);	?>
	  <table class="table table-condense table-hovered">
		<tr>
		<td>&nbsp;</td>
		{each $subjects as $subject}
			<th>{subject[name]}</th>
		{/each}
		</tr>
		
		<?php for($week = 1; $week < 36; $week++):?>
		<tr>
		<th>Tuần {week}</th>
		{each $subjects as $subject}
			<td>
			<?php if(isset($indexedHomeworks[$subject['id']]) && isset($indexedHomeworks[$subject['id']][$week])):?>
			<?php $homework = $indexedHomeworks[$subject['id']][$week];?>
			<?php if($homework['status']):?>
				<strong class="text-success">{homework[totalMark]}</strong>
			<?php else: ?>
				<strong class="text-danger">Chưa chấm</strong>
			<?php endif;?>
			<?php else:?>
			<span class="text-warning">Chưa làm</span>
			<?php endif;?>
			</td>
		{/each}
		</tr>
		<?php endfor;?>
	  </table>
    </div>
	{/each}
  </div>