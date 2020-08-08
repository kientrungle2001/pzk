<?php
$classroomId = $data->getClassroomId();
$classroom = $data->getClassroom();
$subjects = $data->getSubjects();
?>
Lên lịch giảng dạy cho Lớp {classroom[gradeNum]}{classroom[className]} năm học {classroom[schoolYear]} 
<select name="subjectId" onchange="load_topics(this.value)">
<option value="">Chọn môn học</option>
{each $subjects as $subject}
<option value="{subject[id]}">{subject[name]}</option>
{/each}
</select>
<br />
<div id="topics"></div>
<script>
	function load_topics(subjectId) {
		if(subjectId !== '') {
			$.ajax({
				url: '/Admin_Schedule_Lecture/topics/{classroomId}/' + subjectId,
				// dataType: 'json',
				success: function(topics) {
					$('#topics').html(topics);
					/*
					var topicTree = buildBottomTree(topics);
					var flatTree = treefy(topicTree, 0);
					flatTree.forEach(function(topic) {
						
						$('#topics').append('<a href="#" onclick="return false;">'+ '&nbsp;'.repeat(4 * topic.treeLevel) +topic.name+'</a><br/>');
					});*/
				}
				
			});
		}
	}
</script>