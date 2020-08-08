<?php
$classroomIds = array();
$teacherClassroomIds = _db()->select('classroomId')->from('education_classroom_teacher')->whereTeacherId(pzk_session('adminId'))->result();
$classroomId = $data->getClassroomId();
$activeClassroom = null;
if($classroomId) {
	$activeClassroom = _db()->select('*')->from('education_classroom')->whereId($classroomId)->result_one();
}
foreach($teacherClassroomIds as $teacherClassroomId) {
	$classroomIds[] = $teacherClassroomId['classroomId'];
}
if(pzk_session('adminLevel') == 'Headmaster' || pzk_session('adminLevel') == 'Administrator') {
	$classrooms = _db()->select('*')->from('education_classroom')->orderBy('schoolYear desc, gradeNum desc, className asc')->result();
} else {
	$classrooms = _db()->select('*')->from('education_classroom')->inId($classroomIds)->orderBy('schoolYear desc, gradeNum desc, className asc')->result();
}

$tree = array();
foreach($classrooms as $classroom) {
	if(!isset($tree[$classroom['schoolYear']])) {
		$tree[$classroom['schoolYear']] = array();
	}
	if(!isset($tree[$classroom['schoolYear']][$classroom['gradeNum']])) {
		$tree[$classroom['schoolYear']][$classroom['gradeNum']] = array();
	}
	if(!isset($tree[$classroom['schoolYear']][$classroom['gradeNum']][$classroom['className']])) {
		$tree[$classroom['schoolYear']][$classroom['gradeNum']][$classroom['className']] = $classroom['id'];
	}
}
?>
<style>
.padding-left-10 {
	padding-left: 10px;
}
#schoolMenu, #schoolMenu ul {
	list-style-type: none;
}

.nav li.active > a {
	background: #aca;
}

</style>
<div class="row">
<div class="col-md-2">
<div class="panel-group" id="accordion">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
					<span class="glyphicon glyphicon-folder-close"></span> Menu Quản trị</a>
			</h4>
		</div>
		<div id="collapseOne" class="panel-collapse collapse in">
			<div class="panel-body">

<ul id="schoolMenu" class="nav">
	<?php foreach($tree as $schoolYear => $grades) :?>
	<li class="padding-left-10 school-year">
		<a href="#" class="bg-danger">Niên khóa {schoolYear}</a>
		<ul class="nav">
			<?php foreach($grades as $gradeNum => $classes) :?>
			<li class="padding-left-10 school-grade"><a href="#" class="bg-warning">Khối {gradeNum}</a>
			<ul class="nav">
				<?php foreach($classes as $className => $classroomId) :?>
				<li class="padding-left-10 school-class <?php if($activeClassroom && $activeClassroom['schoolYear'] == $schoolYear && $activeClassroom['gradeNum'] == $gradeNum && $activeClassroom['className'] == $className):?>active<?php endif;?>"><a href="#" class="bg-success">Lớp {className}</a>
				<ul class="nav">
					<li class="padding-left-10 school-action"><a href="/Admin_Schedule_Teacher/students/{classroomId}">Học sinh</a></li>
					<?php if(pzk_session('adminLevel') !== 'Teacher'):?>
					<li class="padding-left-10 school-action"><a href="/Admin_Schedule_Teacher/teachers/{classroomId}">Giáo viên</a></li>
					<?php endif; ?>
					<li class="padding-left-10 school-action"><a href="/Admin_Schedule_Teacher/homeworks/{classroomId}">Phiếu bài tập</a></li>
					<li class="padding-left-10 school-action"><a href="/Admin_Schedule_Teacher/books/{classroomId}">Bài làm</a></li>
				</ul>
				</li>
				
				<?php endforeach; ?>
			</ul>
			</li>
			<?php endforeach; ?>
		</ul>
	</li>
	<?php endforeach; ?>
</ul>

			</div>
		</div>
	</div>
</div>
</div>
<div class="col-md-10">
<div class="panel-group" id="accordion">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
					<span class="glyphicon glyphicon-folder-close"></span> Nội dung</a>
			</h4>
		</div>
		<div id="collapseOne" class="panel-collapse collapse in">
			<div class="panel-body">
				<div id="contentDetail">
				{children all}
				</div>
			</div>
		</div>
	</div>
</div>			
</div>
</div>
<script>
$('.school-grade>a,.school-class>a,.school-year>a').click(function() {
	var $ul = $(this).next();
	$ul.slideToggle();
});
</script>