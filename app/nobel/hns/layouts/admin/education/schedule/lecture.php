<?php
$classroomId = $data->getClassroomId();
$classroom = $data->getClassroom();
$subjects = $data->getSubjects();
?>
Lên lịch giảng dạy cho Lớp <?php echo @$classroom['gradeNum']?><?php echo @$classroom['className']?> năm học <?php echo @$classroom['schoolYear']?> 
<select name="subjectId" onchange="load_topics(this.value)">
<option value="">Chọn môn học</option>
<?php foreach($subjects as $subject): ?>
<option value="<?php echo @$subject['id']?>"><?php echo @$subject['name']?></option>
<?php endforeach; ?>
</select>
<br />
<div id="topics"></div>
<script>
	function load_topics(subjectId) {
		if(subjectId !== '') {
			$.ajax({
				url: '/Admin_Schedule_Lecture/topics/<?php echo $classroomId ?>/' + subjectId,
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