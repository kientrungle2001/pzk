<?php
$classroomId = $data->getClassroomId();
$subjectId = $data->getSubjectId();

$classroom = $data->getClassroom();

$topics = $data->getTopics();
$topics = treefy($topics);
$schedules = $data->getSchedules();
?>
<h1>Lớp {classroom[gradeNum]}{classroom[className]} năm {classroom[schoolYear]}</h1>
{each $topics as $topic}
<?php if($topic['type'] == 'subject') {continue;} ?>
<a href="#" onclick="return false;">
<?php echo str_repeat('&nbsp;', 4 * $topic['level']);?>{topic[name]}
</a>
<br />

<?php 
$numOfExercises = ceil($topic['exercises'] / 5);
for($i = 0; $i < $numOfExercises; $i++):
$exerciseNum = $i + 1;
?>
<?php echo str_repeat('&nbsp;', 4 * $topic['level']);?><a href="#" onclick="return false;" class="btn btn-default">
Bài <?php echo $exerciseNum; ?>
</a> <input type="datetime-local" id="expiredDate-{classroomId}-{subjectId}-{topic[id]}-{exerciseNum}" name="schedules[]" /> <button class="btn btn-primary" onclick="saveLectureSchedule({classroomId}, {subjectId}, {topic[id]}, {exerciseNum}); return false;">Lưu</button>

<br /><br />
<?php endfor;?>
<br />
{/each}

<script>
function saveLectureSchedule(classroomId, subjectId, topicId, exerciseNum) {
	var expiredDate = $('#expiredDate-' + classroomId + '-' + subjectId + '-' + topicId + '-' + exerciseNum).val();
	alert(expiredDate);
}
</script>