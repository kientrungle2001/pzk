<?php if($data->getDisplayMembers()): 
	$members = $data->getMembers();
?>
	Thành viên: 
	{each $members as $member}
		<span>{member[username]}</span> | 
	{/each}
<?php else: ?>
<?php
	$room = $data->getRoom();
	$members = $data->getMembers();
?>
<h1>{room[name]}</h1>
<p id="room_members">
	Thành viên: 
	{each $members as $member}
		<span>{member[username]}</span> | 
	{/each}
</p>
<?php endif; ?>