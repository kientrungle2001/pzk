<?php
$subjectId = intval($_REQUEST['subjectId']);
$level = intval($_REQUEST['level']);
require_once 'conn.php';
mysqli_set_charset($conn, 'utf8');
$subCategories = array();
$query = "select id, name, name_vn, name_en, parent, parents from categories where parents like '%,$subjectId,%' and document=0 and status=1 and display=1 and software=1 and classes like '%,5,%' order by ordering asc";
$rs = mysqli_query($conn, $query);
if($rs) {
	$questions = array();
	$query = "select id, categoryIds from questions where categoryIds like '%,$subjectId,%' and status=1 and deleted=0 and software=1 and (classes like '%,5,%' or classes='') order by ordering asc";
	while($row = mysqli_fetch_assoc($rs)) {
		$subCategories[] = $row;
	}
	$rs = mysqli_query($conn, $query);
	if($rs) {
		while($row = mysqli_fetch_assoc($rs)) {
			$questions[] = $row;
		}
		$result = array(
			'topics' => $subCategories,
			'questions' => $questions
		);
		echo base64_encode(json_encode($result));
	} else {
		echo mysqli_error($conn);
	}
} else {
	echo mysqli_error($conn);
}