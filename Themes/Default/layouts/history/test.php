
<div class='container'>
	<hr>
	<h2 class="text-center robotofont">Lịch sử học tập</h2>
	
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a class="btn-success" href="#luyentap" aria-controls="luyentap" role="tab" data-toggle="tab">Luyện tập</a></li>
    <li role="presentation"><a class="btn-success" href="#deluyentap" aria-controls="deluyentap" role="tab" data-toggle="tab">Đề luyện tập</a></li>
    <li role="presentation"><a class="btn-danger" href="#dethi" aria-controls="dethi" role="tab" data-toggle="tab">Đề thi</a></li>
    
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="luyentap">

	<div>
			<h3 class="text-center robotofont">Bài luyện tập đã làm</h3>
		</div>
		<div id='resPractice' class="container">

		<?php
		$UserId = pzk_or(intval(pzk_request()->getSegment(3)), pzk_session()->get('userId'));
		
		$data->pageSize = 20;
		
		$page = intval(pzk_request('page'));
		if(!empty($page)) {
			$data->pageNum = $page;
		}else{
			$data->pageNum = 0;
		}

		$items = $data->getHistoryPratice($UserId);
		$countItems = $data->countHistoryPratice($UserId);
		$pages = ceil($countItems / $data->pageSize);
		if($items) {
			$i=1;
			?>
			<div class="table-responsived">
			<table class="table table-hover table-bordered">
				<thead>
				<tr>
					<th>#</th>
					<th>Danh mục</th>
					<th>Bài</th>
					<th>Điểm</th>
					<th>Ngôn ngữ</th>
					<th>Thời gian làm bài</th>
					<th>Ngày</th>
				</tr>
				</thead>
				<tbody>
				{each $items as $val}
				<tr>
					<td><?php echo $i+$data->pageNum*$data->pageSize; ?></td>
					<td>{val[namecate]}</td>
					<td><a href="/profile/book/{val[id]}"><?php if($val['exercise_number']) { echo 'Bài '.$val['exercise_number'];} ?></a></td>
					<td>{val[mark]}</td>
					<td>
					<?php 
					$lang = "en";
					if($val['lang']){
						$lang = $val['lang'];
					}
					echo $lang;
					?> 
					</td>
					<?php
					$time = $val['duringTime'];
					$resultStrTime = time_duration($time);
					?>
					<td><span class="glyphicon glyphicon-time" aria-hidden="true"></span>  <?php  echo $resultStrTime; ?></td>
					<td><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>  <?php echo date('d/m/Y H:i:s A', strtotime($val['startTime'])); ?></td>
				</tr>
				<?php $i++; ?>
				{/each}
				</tbody>
			</table>
			</div>
			<div class="panel-footer ">
				<form class="form-inline" role="form">

					<table style="margin: 0px;">
						<tr>
							
							<td>
								<?php if($pages > 1) { ?>
									<strong style="display: inline-block; vertical-align: middle;">Trang: </strong>

									<ul style="margin: 0px; vertical-align: middle;" class="pagination">
										<?php
										if($data->pageNum >= 1) { ?>
											<li>
												<a onclick="practice({UserId},0)" aria-label="End">
													<span aria-hidden="true">Trang đầu</span>
												</a>
											<li>
												<a aria-label="Previous" onclick="practice({UserId},'<?php echo $data->pageNum -1; ?>')">
													<span aria-hidden="true">&laquo;</span>
												</a>
											</li>
										<?php } ?>

										<?php
										for ($page = 0; $page < $pages; $page++) { ?>
											<?php
											if($pages > 10 && ($page < $data->pageNum - 5 || $page > $data->pageNum + 5))
												continue;
											if($page == $data->pageNum) {
												$active = 'active';
											} else {
												$active = '';
											}
											?>
											<li class="{active}">
												<a  onclick="practice({UserId}, {page})">{? echo ($page + 1)?}</a>
											</li>
										<?php } ?>

										<?php if($data->pageNum < $pages-1) { ?>
										<li>
											<a onclick="practice({UserId}, '<?php echo $data->pageNum + 1; ?>')" aria-label="Next">
												<span aria-hidden="true">&raquo;</span>
											</a>
											</li>
											<li>
											<a onclick="practice({UserId}, '<?php echo $pages-1; ?>')" aria-label="end">
												<span aria-hidden="true">Trang cuối</span>
											</a>
										</li>
										<?php } ?>
									</ul>
								<?php } ?>
							</td>
						</tr>
					</table>


				</form>

			</div>
		<?php
		}
		?>
		</div>
	
	</div>
    <div role="tabpanel" class="tab-pane" id="deluyentap">
	
		<div>
			<h3 class="text-center robotofont">Đề luyện tập đã làm</h3>
		</div>
		<div  id='resPractice' class="container">

		<?php
		$UserId = pzk_or(intval(pzk_request()->getSegment(3)), pzk_session()->get('userId'));
		
		$data->pageSize = 20;
		
		$page = intval(pzk_request('page'));
		if(!empty($page)) {
			$data->pageNum = $page;
		}else{
			$data->pageNum = 0;
		}

		$items = $data->getHistoryTest($UserId, 1);
		$countItems = $data->countHistoryTest($UserId, 1);
		$pages = ceil($countItems / $data->pageSize);
		if($items) {
			$i=1;
			?>
			<div class="table-responsived">
			<table class="table table-hover table-bordered">
				<thead>
				<tr>
					<th>#</th>
					<th>Đề</th>
					<th>Điểm</th>
					<th>Ngôn ngữ</th>
					<th>Thời gian làm bài</th>
					<th>Ngày</th>
				</tr>
				</thead>
				<tbody>
				{each $items as $val}
				<tr>
					<td><?php echo $i+$data->pageNum*$data->pageSize; ?></td>
					<td><a href="/profile/book/{val[id]}">{val[name]}</a></td>
					<td>{val[mark]}</td>
					<td>
					<?php 
					$lang = "en";
					if($val['lang']){
						$lang = $val['lang'];
					}
					echo $lang;
					?> 
					</td>
					<?php
					$time = $val['duringTime'];
					$resultStrTime = time_duration($time);
					?>
					<td><span class="glyphicon glyphicon-time" aria-hidden="true"></span>  <?php  echo $resultStrTime; ?></td>
					<td><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>  <?php echo date('d/m/Y H:i:s A', strtotime($val['startTime'])); ?></td>
				</tr>
				<?php $i++; ?>
				{/each}
				</tbody>
			</table>
			</div>
			
			<div class="panel-footer ">
				<form class="form-inline" role="form">

					<table style="margin: 0px;">
						<tr>
							
							<td>
								<?php if($pages > 1) { ?>
									<strong style="display: inline-block; vertical-align: middle;">Trang: </strong>

									<ul style="margin: 0px; vertical-align: middle;" class="pagination">
										<?php
										if($data->pageNum >= 1) { ?>
											<li>
												<a onclick='getPage({UserId},1,0, 'resPractice')' aria-label="End">
													<span aria-hidden="true">Trang đầu</span>
												</a>
											<li>
												<a aria-label="Previous" onclick ="getPage({UserId}, 1, '<?php echo $data->pageNum -1; ?>', 'resPractice')">
													<span aria-hidden="true">&laquo;</span>
												</a>
											</li>
										<?php } ?>

										<?php
										for ($page = 0; $page < $pages; $page++) { ?>
											<?php
											if($pages > 10 && ($page < $data->pageNum - 5 || $page > $data->pageNum + 5))
												continue;
											if($page == $data->pageNum) {
												$active = 'active';
											} else {
												$active = '';
											}
											?>
											<li class="{active}">
												<a  onclick = "getPage({UserId}, 1, {page}, 'resPractice')">{? echo ($page + 1)?}</a>
											</li>
										<?php } ?>

										<?php if($data->pageNum < $pages-1) { ?>
										<li>
											<a onclick = "getPage({UserId}, 1, '<?php echo $data->pageNum + 1; ?>','resPractice')" aria-label="Next">
												<span aria-hidden="true">&raquo;</span>
											</a>
											</li>
											<li>
											<a onclick =" getPage({UserId}, 1, '<?php echo $pages-1; ?>','resPractice')" aria-label="end">
												<span aria-hidden="true">Trang cuối</span>
											</a>
										</li>
										<?php } ?>
									</ul>
								<?php } ?>
							</td>
						</tr>
					</table>


				</form>

			</div>
		<?php
		}
		?>
		</div>

	
	
	</div>
    <div role="tabpanel" class="tab-pane" id="dethi">
		<div>
			<h3 class="text-center robotofont">Đề thi đã làm</h3>
		</div>
		<div id='resTest' class="container">

		<?php
		$UserId = pzk_or(intval(pzk_request()->getSegment(3)), pzk_session()->get('userId'));
		
		$data->pageSize = 20;
		
		$page = intval(pzk_request('page'));
		if(!empty($page)) {
			$data->pageNum = $page;
		}else{
			$data->pageNum = 0;
		}

		$items = $data->getHistoryTest($UserId, 0);
		$countItems = $data->countHistoryTest($UserId, 0);
		$pages = ceil($countItems / $data->pageSize);
		if($items) {
			$i=1;
			?>
			<div class="table-responsived">
			<table class="table table-hover table-bordered">
				<thead>
				<tr>
					<th>#</th>
					<th>Đề</th>
					<th>Điểm</th>
					<th>Xếp hạng</th>
					<th>Ngôn ngữ</th>
					<th>Thời gian làm bài</th>
					<th>Ngày</th>
				</tr>
				</thead>
				<tbody>
				{each $items as $val}
				<tr>
					<td><?php echo $i+$data->pageNum*$data->pageSize; ?></td>
					<td><a href="/profile/book/{val[id]}">{val[name]}</a></td>
					<td>{val[mark]}</td>
					<td>{val[rank]}</td>
					<td>
					<?php 
					$lang = "en";
					if($val['lang']){
						$lang = $val['lang'];
					}
					echo $lang;
					?> 
					</td>
					<?php
					$time = $val['duringTime'];
					$resultStrTime = time_duration($time);
					?>
					<td><span class="glyphicon glyphicon-time" aria-hidden="true"></span>  <?php  echo $resultStrTime; ?></td>
					<td><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>  <?php echo date('d/m/Y H:i:s A', strtotime($val['startTime'])); ?></td>
				</tr>
				<?php $i++; ?>
				{/each}
				</tbody>
			</table>
			</div>
			<div class="panel-footer ">
				<form class="form-inline" role="form">

					<table style="margin: 0px;">
						<tr>
							
							<td>
								<?php if($pages > 1) { ?>
									<strong style="display: inline-block; vertical-align: middle;">Trang: </strong>

									<ul style="margin: 0px; vertical-align: middle;" class="pagination">
										<?php
										if($data->pageNum >= 1) { ?>
											<li>
												<a onclick='getPage({UserId},0,0, 'resTest')' aria-label="End">
													<span aria-hidden="true">Trang đầu</span>
												</a>
											<li>
												<a aria-label="Previous" onclick ="getPage({UserId}, 0, '<?php echo $data->pageNum -1; ?>', 'resTest')">
													<span aria-hidden="true">&laquo;</span>
												</a>
											</li>
										<?php } ?>

										<?php
										for ($page = 0; $page < $pages; $page++) { ?>
											<?php
											if($pages > 10 && ($page < $data->pageNum - 5 || $page > $data->pageNum + 5))
												continue;
											if($page == $data->pageNum) {
												$active = 'active';
											} else {
												$active = '';
											}
											?>
											<li class="{active}">
												<a  onclick = "getPage({UserId}, 0, {page}, 'resTest')">{? echo ($page + 1)?}</a>
											</li>
										<?php } ?>

										<?php if($data->pageNum < $pages-1) { ?>
										<li>
											<a onclick = "getPage({UserId}, 0, '<?php echo $data->pageNum + 1; ?>','resTest')" aria-label="Next">
												<span aria-hidden="true">&raquo;</span>
											</a>
											</li>
											<li>
											<a onclick =" getPage({UserId}, 0, '<?php echo $pages-1; ?>','resTest')" aria-label="end">
												<span aria-hidden="true">Trang cuối</span>
											</a>
										</li>
										<?php } ?>
									</ul>
								<?php } ?>
							</td>
						</tr>
					</table>


				</form>

			</div>
		<?php
		}
		?>
		</div>

	</div>
    
  </div>

</div>

<script>
function getPage($userId, $practice, $page, $idResult) {
	$.ajax({
		type: "Post",
		data:{
			page:$page, userId: $userId, practice: $practice, idResult:$idResult
		},
		url:'<?=BASE_REQUEST?>/home/ajaxHistory',
		success: function(data){
			$('#'+$idResult).html(data);
		}
	});
}
function practice($userId, $page) {
	$.ajax({
		type: "Post",
		data:{
			page:$page, userId: $userId
		},
		url:'<?=BASE_REQUEST?>/home/ajaxPractice',
		success: function(data){
			$('#resPractice').html(data);
		}
	});
}
</script>

