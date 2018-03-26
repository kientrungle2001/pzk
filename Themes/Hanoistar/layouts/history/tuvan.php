<?php 
$userId = pzk_session('userId');
$tuvans = $data->getTuvan($userId);
$chucsn = $data->getChucSn($userId);
?>
<div class="container"> 
	<?php if($chucsn){ 
	
		$senderIds = array();
		foreach($chucsn as $chuc){
			$senderIds[] = $chuc['senderId'];
		}
		$userProcess = array();
		$userSenders = _db()->select('id, name')->from('user')->inId($senderIds)->result();
		foreach($userSenders as $sender){
			$userProcess[$sender['id']] = $sender['name'];
		}
	?>
		<hr/>
		<h2 class="text-center robotofont">Chúc mừng sinh nhật</h2>
		<div class="table-responsived">
			<table class="table table-hover table-bordered">
				<thead>
				<tr>
					<th>#</th>
					<th>Người gửi</th>
					<th>Nội dung</th>
					<th>Thời gian</th>
				</tr>
				</thead>
				<tbody>
				<?php $i =1;?>
				{each $chucsn as $val}
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $userProcess[$val['senderId']]; ?></td>
					<td>
					<?php echo $val['content']; ?></td>
					<td><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>  <?php echo date('d/m/Y H:i:s A', strtotime($val['created'])); ?></td>
				</tr>
				<?php $i++; ?>
				{/each}
				</tbody>
			</table>
			</div>
	<?php } ?>
	
	<?php if($tuvans){ ?>
	<hr/>
	<h2 class="text-center robotofont">Tư vấn tâm lí</h2>
	<div class="table-responsived">
			<table class="table table-hover table-bordered">
				<thead>
				<tr>
					<th>#</th>
					<th>Câu hỏi</th>
					<th>Loại câu hỏi</th>
					<th>Xem tư vấn</th>
					<th>Thời gian</th>
				</tr>
				</thead>
				<tbody>
				<?php $i =1;?>
				{each $tuvans as $val}
				<tr>
					<td><?php echo $i; ?></td>
					<td>{val[content]}</td>
					<td>
					<?php if($val['type'] == 'tamly') { echo 'Tâm lý'; }else { echo 'Học tập';} ?></td>
					<td>
					<?php if($val['status'] == 1){ ?>
					<!-- Large modal -->
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".xemtuvan-<?=$i;?>">Xem tư vấn</button>

					<div class="modal xemtuvan-<?=$i;?> fade" tabindex="-1" role="dialog">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Nội dung tư vấn</h4>
						  </div>
						  <div class="modal-body">
							<?=$val['tuvan'];?>
						  </div>
						  
						</div><!-- /.modal-content -->
					  </div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
					<?php } else { echo 'Chưa có tư vấn';} ?>
					</td>
					
					<td><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>  <?php echo date('d/m/Y H:i:s A', strtotime($val['created'])); ?></td>
				</tr>
				<?php $i++; ?>
				{/each}
				</tbody>
			</table>
			</div>
	<?php } ?>	
</div>