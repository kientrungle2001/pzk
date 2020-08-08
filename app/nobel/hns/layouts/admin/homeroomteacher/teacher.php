<?php
$classroomIds = array();
$teacherClassroomIds = _db()->select('classroomId')->from('education_classroom_teacher')->whereTeacherId(pzk_session()->getAdminId())->result();
foreach($teacherClassroomIds as $teacherClassroomId) {
	$classroomIds[] = $teacherClassroomId['classroomId'];
}
/*if(pzk_session()->getAdminLevel() == 'Headmaster' || pzk_session()->getAdminLevel() == 'Administrator') {
	$classrooms = _db()->select('*')->from('education_classroom')->result();
} else {
	$classrooms = _db()->select('*')->from('education_classroom')->inId($classroomIds)->result();
}*/
$classrooms = '';
if(pzk_session()->getAdminLevel() == 'HomeroomTeacher' || pzk_session()->getAdminLevel() == 'Teacher' || pzk_session()->getAdminLevel() == 'Administrator') {

	$classrooms = _db()->select('*')->from('education_classroom')->whereHomeroomTeacherId(pzk_session()->getAdminId())->result();
}
$tree = array();
pzk_session()->setHomeroomTeacher(0);
if(isset($classrooms)){
	pzk_session()->setHomeroomTeacher(1);
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
}
?>
<style>
.padding-left-10 {
	padding-left: 10px;
}
#schoolMenu, #schoolMenu ul {
	list-style-type: none;
}

.school-class>ul {
	display: none;
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
<?php if(pzk_session()->getHomeroomTeacher() == '1' || pzk_session()->getHomeroomTeacher() == 1) :?>
<ul id="schoolMenu" class="nav">
	<?php foreach($tree as $schoolYear => $grades) :?>
	<li class="padding-left-10 school-year">
		<a href="#">Niên khóa {schoolYear}</a>
		<ul class="nav">
			<?php foreach($grades as $gradeNum => $classes) :?>
			<li class="padding-left-10 school-grade"><a href="#">Khối {gradeNum}</a>
			<ul class="nav">
				<?php foreach($classes as $className => $classroomId) :?>
				<li class="padding-left-10 school-class"><a href="#">Lớp {className}</a>
				<ul class="nav">
					<li class="padding-left-10 school-action"><a href="/Admin_Home_HomeroomTeacher/students/{classroomId}">Học sinh</a></li>
					<li class="padding-left-10 school-action"><a href="/Admin_Home_HomeroomTeacher/teachers/{classroomId}">Giáo viên</a></li>
					
					<li class="padding-left-10 school-action"><a href="/Admin_Home_HomeroomTeacher/point/{classroomId}">Kết quả học tập</a></li>
					
					
					
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
<?php endif; ?>
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