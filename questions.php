<?php
$subjectId = intval($_REQUEST['subjectId']);
$topicId = intval($_REQUEST['topicId']);
$exerciseNumber = intval($_REQUEST['exerciseNumber']);
$class = intval($_REQUEST['class']);
require_once 'conn.php';
$start = ($exerciseNumber-1) * 5;
mysqli_set_charset($conn, 'utf8');
$questions = array();
$query = "select * from questions where categoryIds like '%,$topicId,%' and status=1 and deleted=0 and classes like '%,$class,%' order by ordering asc limit $start, 5";
$rs = mysqli_query($conn, $query);
if($rs) {
	$questionIds = '-1';
	while($row = mysqli_fetch_assoc($rs)) {
		$questions[] = $row;
		$questionIds .= ','.$row['id'];
	}
	$answers = array();
	$query = "select * from answers_question_tn where question_id in ($questionIds) order by id asc";
	$rs = mysqli_query($conn, $query);
	if($rs) {
		while($row = mysqli_fetch_assoc($rs)) {
			$answers[] = $row;
		}
		$result = array(
			'questions' => $questions,
			'answers' => $answers
		);
		echo base64_encode(json_encode($result));
	} else {
		echo mysqli_error($conn);
	}
} else {
	echo mysqli_error($conn);
}