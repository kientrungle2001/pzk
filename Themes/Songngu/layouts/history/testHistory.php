		<?php 
		
		$data->pageSize = $data->get('pageSize');
		$idResult = $data->get('idResult');
		$practice = $data->get('practice');
		$userId = $data->get('userId');
		$startDate = $data->get('startDate');
		$endDate = $data->get('endDate');
		
		$page = $data->get('page');
		if(!empty($page)) {
			$data->pageNum = $page;
		}else{
			$data->pageNum = 0;
		}

		$items = $data->getHistoryTestSn($userId, $practice, $startDate, $endDate);
		$countItems = $data->countHistoryTestSn($userId, $practice, $startDate, $endDate);
		$pages = ceil($countItems / $data->pageSize);
		if($items) {
			$i=1;
			?>
			
			<table class="table table-hover">
				<tr>
					<th>#</th>
					<th>Tên đăng nhập</th>
					<th>Đề</th>
					<th>Điểm</th>
					<th>Thời gian làm bài</th>
					<?php if($practice == 0) { ?>
					<th>Xếp hạng</th>
					<?php } ?>
					<th>Đánh giá</th>
					<th>Ngày</th>
				</tr>
				{each $items as $val}
				<tr>
					<td><?php echo $i+$data->pageNum*$data->pageSize; ?></td>
					<td>{val[username]}</td>
					<td>{val[name]}</td>
					<td>{val[mark]}</td>
					<?php
					$time = $val['duringTime'];

					$resultStrTime = time_duration($time);
					?>
					<td><span class="glyphicon glyphicon-time" aria-hidden="true"></span>  <?php  echo $resultStrTime; ?></td>
					<?php if($practice == 0) { ?>
					<td>{val[rank]}</td>
					<?php } ?>
					<td><?php echo reviewforTest($val['mark']); ?></td>
					<td><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>  <?php echo date('d/m/Y H:i:m A', strtotime($val['startTime'])); ?></td>
				</tr>
				<?php $i++; ?>
				{/each}
			</table>
			
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
												<a onclick="getPage({userId},{practice},0, '{startDate}', '{endDate}', '<?php echo $idResult; ?>')" aria-label="End">
													<span aria-hidden="true">Trang đầu</span>
												</a>
											<li>
												<a aria-label="Previous" onclick ="getPage({userId}, {practice}, '<?php echo $data->pageNum -1; ?>', '{startDate}', '{endDate}', '<?php echo $idResult; ?>')">
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
												<a  onclick = "getPage({userId}, {practice}, {page}, '{startDate}', '{endDate}', '<?php echo $idResult; ?>')">{? echo ($page + 1)?}</a>
											</li>
										<?php } ?>

										<?php if($data->pageNum < $pages-1) { ?>
										<li>
											<a onclick = "getPage({userId}, {practice}, '<?php echo $data->pageNum + 1; ?>', '{startDate}', '{endDate}', '<?php echo $idResult; ?>')" aria-label="Next">
												<span aria-hidden="true">&raquo;</span>
											</a>
											</li>
											<li>
											<a onclick =" getPage({userId}, {practice}, '<?php echo $pages-1; ?>', '{startDate}', '{endDate}', '<?php echo $idResult; ?>')" aria-label="end">
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