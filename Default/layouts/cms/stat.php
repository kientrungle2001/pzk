<link rel="stylesheet" href="/default/skin/test/css/stat.css">
<?php 
$ip = getRealIPAddress();
$userId = pzk_session('userId');
?>

<strong>
<ul class="stat_ul">
	<?php if(pzk_config('stat_show_member')): 
		$member= $data->getMember();
	?>
		<li>Số thành viên đăng ký:<span class="stat_li"> {member}</span></li>
	<?php endif; ?>
	<?php if(pzk_config('stat_show_total')): 
		$total=$data->getTotal();
		?>
		<li>Tổng số lượt truy cập:<span class="stat_li"> {total}</span></li>
	<?php endif; ?>
	<?php if(pzk_config('stat_show_today')): 
		$todayvisit = $data->getDay($ip,$userId);
	?>
		<li>Đã truy cập hôm nay:<span class="stat_li"> {todayvisit}</span></li>
	<?php endif; ?>
	<?php if(pzk_config('stat_show_yesterday')): 
		$lastday = $data->getLastday();
	?>
		<li>Đã truy cập hôm qua:<span class="stat_li"> {lastday}</span></li>
	<?php endif; ?>
	<?php if(pzk_config('stat_show_month')): 
		$monthvisit = $data->getMonth();
	?>
		<li>Đã truy cập trong tháng:<span class="stat_li"> {monthvisit}</span></li>
	<?php endif; ?>
	<?php if(pzk_config('stat_show_lastmonth')): 
		$lastmonth = $data->getLastmonth();
	?>
		<li>Đã truy cập tháng trước:<span class="stat_li">{lastmonth}</span></li>
	<?php endif; ?>
	<?php if(pzk_config('stat_show_online')): 
		$onlinemember = $data->getOnline($ip);
		//$names= $data->get('name');
		//$showonlines=$data->getShowonline();
	?>
		<li>Thành viên đang online:<span class="stat_li">{onlinemember}</span></li>
	<?php endif; ?>
</ul>
</strong>