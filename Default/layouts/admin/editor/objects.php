<?php 
$package = trim(pzk_request('package'), '/');
if($package) {
	$objects = glob('objects/' . trim($package, '/') . '/*.*');
	$dirs = dir_dirs('objects/' . trim($package, '/'));
	$upPackage = trim(preg_replace('/[^\/]*$/', '', $package), '/');
}else {
	$objects = glob('objects/*.*');
	$dirs = dir_dirs('objects');
}

?>
<strong><?php echo $package ?></strong>
<table class="table">
<?php if($package): ?>
	<tr><td><a href="/Admin_Editor?package=<?php echo $upPackage ?>">..</a></td></tr>
<?php endif; ?>
<?php foreach($dirs as $dir): ?>
<tr><td>
<?php if($package): ?>
	<a href="/Admin_Editor?package=<?php echo $package ?>/<?php echo $dir ?>"><?php echo $dir ?></a><br />
<?php else: ?>
	<a href="/Admin_Editor?package=<?php echo $dir ?>"><?php echo $dir ?></a><br />
<?php endif; ?>
</td></tr>
<?php endforeach; ?>
</table>
<table class="table">
<?php foreach($objects as $object): ?>
	<?php preg_match('/objects\/(.*)\.php/', $object, $match);
	$parts = explode('/', $match[1]);
	$fileName = array_pop($parts);
	?>
	<tr>
	<td style="color: green;"><?php echo $fileName ?></td>
	<td><a href="/Admin_Editor/edit?object=<?php echo @$match['1']?>&type=object"><img src="/default/images/icon/object.gif" style="width: 24px; height: 24px;" /></a></td>
	<td><a href="/Admin_Editor/edit?object=<?php echo @$match['1']?>&type=layout"><img src="/default/images/icon/layout.png" style="width: 24px; height: 24px;" /></a></td>
	<td><a href="/Admin_Editor/edit?object=<?php echo @$match['1']?>&type=js"><img src="/default/images/icon/js.png" style="width: 24px; height: 24px;" /></a></td>
	<td><a href="/Admin_Editor/edit?object=<?php echo @$match['1']?>&type=css"><img src="/default/images/icon/css.png" style="width: 24px; height: 24px;" /></a></td>
	</tr>
<?php endforeach; ?>
<tr>
	<td colspan="5">
	<?php if($package): ?>
	<a href="/Admin_Editor/add?package=<?php echo $package ?>">Tạo mới</a><br />
	<?php else: ?>
		<a href="/Admin_Editor/add?package=">Tạo mới</a><br />
	<?php endif; ?>
	</td>
</tr>
</table>