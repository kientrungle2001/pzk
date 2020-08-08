<?php
$classroomId = $data->getClassroomId();
$subjectId = $data->getSubjectId();

$classroom = $data->getClassroom();

$topics = $data->getTopics();
$topics = treefy($topics);
$schedules = $data->getSchedules();
$teacherScheduleId = $data->getTeacherScheduleId();
?>
<h1>Lớp {classroom[gradeNum]}{classroom[className]} năm {classroom[schoolYear]}</h1>
{each $topics as $topic}
<?php if($topic['type'] == 'subject') {continue;} ?>
<a href="#" onclick="return false;">
<?php echo str_repeat('&nbsp;', 4 * $topic['level']);?>{topic[name]}
</a>
<br />
<div class="row">
<div class="col-xs-12 col-md-6">
<h3><?php echo str_repeat('&nbsp;', 4 * $topic['level']);?>Bài tập trắc nghiệm</h3>
<?php 
$numOfExercises = ceil($topic['exercises'] / 5);
for($i = 0; $i < $numOfExercises; $i++):
$exerciseNum = $i + 1;
?>
<?php echo str_repeat('&nbsp;', 4 * $topic['level']);?><a href="#" onclick="return false;" class="btn btn-default">
Bài <?php echo $exerciseNum; ?>
</a> <input type="datetime-local" id="expiredDate-{teacherScheduleId}-{topic[id]}-1-{exerciseNum}" name="schedules[]" /> <button class="btn btn-primary" onclick="saveLectureSchedule({teacherScheduleId}, {topic[id]}, 1, {exerciseNum});">Lưu</button>

<br />
<?php endfor;?>
<br />
</div>
<div class="col-xs-12 col-md-6">
<?php
$numOfExercises = ceil($topic['tuluanExercises'] / 5);
if($numOfExercises) {
?>
<h3><?php echo str_repeat('&nbsp;', 4 * $topic['level']);?>Bài tập tự luận</h3>
<?php 

for($i = 0; $i < $numOfExercises; $i++):
$exerciseNum = $i + 1;
?>
<?php echo str_repeat('&nbsp;', 4 * $topic['level']);?><a href="#" onclick="return false;" class="btn btn-default">
Bài <?php echo $exerciseNum; ?>
</a> <input type="datetime-local" id="expiredDate-{teacherScheduleId}-{topic[id]}-4-{exerciseNum}" name="schedules[]" /> <button class="btn btn-primary" onclick="saveLectureSchedule({teacherScheduleId}, {topic[id]}, 4, {exerciseNum});">Lưu</button>

<br />
<?php endfor;?>
<br />
<?php } ?>
</div>
</div>
{/each}

<script>
function saveLectureSchedule(teacherScheduleId, topicId, questionType, exerciseNum) {
	var expiredDate = $('#expiredDate-' + teacherScheduleId + '-' + topicId + '-' + questionType + '-' + exerciseNum).val();
	
	expiredDate = expiredDate.replace('T', ' ')+':00';
	$.ajax({
		url: '/Admin_Schedule_Teacher/saveLectureSchedule',
		data: {
			teacherScheduleId: teacherScheduleId,
			topicId: topicId,
			exerciseNum: exerciseNum,
			expiredDate: expiredDate,
			type: questionType
		},
		dataType: 'POST',
		success: function(resp) {
			alert('Đã cập nhật ngày: ' + expiredDate);
		}
	});
}
var schedules = <?php echo json_encode($schedules);?>;
schedules.forEach(function(schedule) {
	$('#expiredDate-'+schedule.teacherScheduleId + '-' + schedule.topicId + '-' + schedule.type + '-' + schedule.exerciseNum).val(schedule.expiredDate.replace(' ', 'T').replace(/:00$/, ''));
});
</script>