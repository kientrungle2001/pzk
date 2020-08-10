<?php if($data->getDisplayMembers()): 
	$members = $data->getMembers();
?>
	Thành viên: 
	<?php foreach($members as $member): ?>
		<span><?php echo @$member['username']?></span> | 
	<?php endforeach; ?>
<?php else: ?>
<?php
	$room = $data->getRoom();
	$members = $data->getMembers();
?>
<h1><?php echo @$room['name']?></h1>
<p id="room_members">
	Thành viên: 
	<?php foreach($members as $member): ?>
		<span><?php echo @$member['username']?></span> | 
	<?php endforeach; ?>
</p>
<?php endif; ?>