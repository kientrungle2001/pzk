<?php
$teachers = $data->getTeachers();
?>
<ul class="list-group">
<?php foreach($teachers as $teacher): ?>
<li class="list-group-item"><a href="/Admin_Schedule_Teacher/subject/<?php echo @$teacher['id']?>?teacherScheduleId=<?php echo @$teacher['id']?>&teacherId=<?php echo @$teacher['teacherId']?>&subjectId=<?php echo @$teacher['subjectId']?>&classroomId=<?php echo @$teacher['classroomId']?>"><h2>Môn <?php echo @$teacher['subject']?> - Giáo viên: <?php echo @$teacher['name']?></h2></a></li>
<?php endforeach; ?>
</ul>