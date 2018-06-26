<?php
$subjectId 			= intval($_REQUEST['subjectId']);
$documentLevel 		= intval($_REQUEST['documentLevel']);

require_once 'conn.php';
$subCategories 		= array();
$query 				= "select id, name, name_vn, name_en, parent, parents from categories where parents like '%,$subjectId,%' and document=1 and status=1 and classes like '%,5,%' order by ordering asc";
$rs 				= mysqli_query($conn, $query);
if($rs) {
	$categoryIds 	= '-1';
	while($row = mysqli_fetch_assoc($rs)) {
		$subCategories[] 	= $row;
		$categoryIds 		.= ','.$row['id'];
	}
	$documents 		= array();
	$query 			= "select id, title, en_title, categoryId, categoryIds from document where ((categoryId in ($categoryIds)) or (categoryIds like '%,$subjectId,%')) and type='vocabulary' and status=1 and classes like '%,5,%' order by ordering asc";
	$rs = mysqli_query($conn, $query);
	if($rs) {
		while($row = mysqli_fetch_assoc($rs)) {
			$documents[] = $row;
		}
		$result = array(
			'topics' => $subCategories,
			'documents' => $documents
		);
		echo base64_encode(json_encode($result));
	} else {
		echo mysqli_error($conn);
	}
} else {
	echo mysqli_error($conn);
}