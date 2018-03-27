<?php
$teachers = $data->getTeachers();
?>
<ul class="list-group">
{each $teachers as $teacher}
<li class="list-group-item"><a href="/Admin_Schedule_Teacher/subject/{teacher[id]}?teacherScheduleId={teacher[id]}&teacherId={teacher[teacherId]}&subjectId={teacher[subjectId]}&classroomId={teacher[classroomId]}"><h2>Môn {teacher[subject]} - Giáo viên: {teacher[name]}</h2></a></li>
{/each}
</ul>