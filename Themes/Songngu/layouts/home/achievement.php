<style>
.achie-bxh{
	margin: 20px 0px;
}
</style>
<?php $data->displayChildren('[position=public-header]') ?>
<?php $data->displayChildren('[position=top-menu]') ?>

<div class="container">
	<div class='text-center'>
		<p class='achie-bxh'>
		<img src="/Themes/Songngu/skin/media/cup2.png" />
		<b>
			BẢNG THÀNH TÍCH THEO TUẦN
		</b>
		</p>
		<?php 
			$week = (int) date('W');
			$year = (int) date('Y');
			if($week > 1){
				$crurrentWeek = $week-1;
			}else{
				$crurrentWeek = 52;
				$year = $year - 1;
			}
			
			$filterWeek = $crurrentWeek;
			$filterYear = $year;
			if(pzk_session('weekAchievement')){
				$filterWeek = pzk_session('weekAchievement');
			}
			
			
			if(pzk_session('yearAchievement')){
				$filterYear = pzk_session('yearAchievement');
			}
			
			$orderBy = 'tree desc';
			if(pzk_session('sortAchievement')){
				$orderBy = pzk_session('sortAchievement');
			}
			$data->set('week', $filterWeek);
			$data->set('year', $filterYear);
			$data->set('orderBy', $orderBy);
			
			$weekYear = $filterWeek.'-'.$filterYear;
			$achievement = $data->getAchievement(pzk_session('lop'));
		?>
		<div style="margin: 15px 0px;" class='item'>
			<div class='col-md-6 col-xs-12'>
			<b>Chọn xem bảng thành tích theo tuần: </b>
			</div>
			<div class='col-md-6 col-xs-12'>
			<select id='weekyear' class='form-control' onchange="window.location = '/home/filterAchievementByWeek?val='+this.value;">
				<?php 
				if($crurrentWeek < 52 && $year > 2016) { 
					$k = 52 - $crurrentWeek;
					for($week= 53-$k; $week <= 52; $week++){
						$yearvalue = $year - 1;
						?>
						<option value="<?php echo $week.'-'.$yearvalue;?>">Tuần <?php $date = startEndDateOfWeek($week-1, $year-1, 1); echo $week; echo ' ('.$date['startdate'].' đến '.$date['enddate'].')'; ?></option>
						<?php
						
					}
				} 
				?>
				<?php 
				$week = 1;
				if($year <= 2016){
					$week = 26;
				}
				for($week; $week <= $crurrentWeek; $week++){ ?>
				<option value="<?php echo $week.'-'.$year;?>">Tuần <?php $date = startEndDateOfWeek($week-1, $year, 1); echo $week; echo ' ('.$date['startdate'].' đến '.$date['enddate'].')'; ?></option>
				<?php } ?>
				<script>
					$('#weekyear').val('<?=$weekYear?>');
				</script>
			</select>
			</div>
		</div>
		<div style="margin-bottom: 15px;" class='item'>
			<div class='col-md-6 col-xs-12'>
			<b>Sắp xếp theo: </b>
			</div>
			<div class='col-md-6 col-xs-12'>
			<select id='hard' class='form-control'  onchange="window.location = '/home/sortAchievement?val='+this.value;">
				<option value='tree desc'>Mức độ chăm chỉ</option>
				<option value='flower desc'>Mức độ luyện tập hiệu quả</option>
				<option value='apple desc'>Kết quả làm bài thi</option>
			</select>
			<script>
				$('#hard').val('<?=$orderBy?>');
			</script>
			</div>
		</div>
		
	</div>
	
	
	 <div class='tiem'>
	
		<div>
			<?php 
			if($orderBy == 'tree desc'){
				$text = 'Đánh giá theo mức độ chăm chỉ';
			}elseif($orderBy == 'flower desc'){
				$text = 'Đánh giá theo mức độ luyện tập hiệu quả';
			}
			elseif($orderBy == 'apple desc'){
				$text = 'Đánh giá theo kết quả làm bài thi';
			}
			?>
			<h3 class="text-center robotofont"><?=$text;?></h3>
		</div>
		<?php if($achievement){ ?>
		<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
			<tr>
				<th>Xếp hạng</th>
				<th>Tên đăng nhập</th>
				
				<th><img style='width: 25px;' src='/Default/skin/nobel/test/Themes/Default/media/tree.png' />

				</th>
				<th><img style='width: 25px;' src='/Default/skin/nobel/test/Themes/Default/media/flower.png' /></th>
				<th><img style='width: 25px;' src='/Default/skin/nobel/test/Themes/Default/media/apple.png' /></th>
				<th>Tuần</th>
			</tr>
			</thead>
			<tbody>
			
				<?php 
				
					$i=1;
					foreach($achievement as $val){ ?>
						<tr>
							<td><?=$i?></td>
							<td><?php echo $val['username']; ?></td>
							<td><?php echo $val['tree']; ?></td>
							<td><?php echo $val['flower']; ?></td>
							<td><?php echo $val['apple']; ?></td>
							<td><?php $date = startEndDateOfWeek($filterWeek-1, $year, true); echo 'Tuần '.$filterWeek.'('.$date['startdate'].' đến '.$date['enddate'].')';?> </td>
						</tr>
						<?php
						$i++;
					}
				
				?>
			
			</tbody>
		</table>
		</div>
		<div class="alert alert-info">
		Xem kết quả học tập cụ thể của bạn 
		<?php if(pzk_session('username')){ ?>
		<a href="<?=BASE_URL;?>/profile/detail">Tại đây. </a> 
		<?php }else{ ?>
			<a onclick="return alert('Bạn phải đăng nhập mới xem được!')">Tại đây. </a> 
		<?php } ?>
		Nếu bạn chưa có tên trên bảng thành tích tuần này, bạn cần cố gắng để được xếp thứ hạng tuần sau! Chúc bạn thành công!<br><br>
		<b>* Chú ý :</b><br><br>
			<ul class="list-group">
				
					<li class='list-group-item list-group-item-info'>
						Thưởng cây (Đánh giá mức độ chăm chỉ của HS) : <br/>
						Dựa vào số câu luyện tập trong tuần học sinh đã làm. <br/>
						+ 50 đến 59 câu/1 tuần : Thưởng 1 cây <img style='width: 25px;' src="/Default/skin/nobel/test/Themes/Default/media/tree.png"><br/>
						+ 60 đến 70 câu/ 1 tuần: Thưởng 2 cây <img style='width: 25px;' src="/Default/skin/nobel/test/Themes/Default/media/tree.png"><br/>
						+ 70 đến 80 câu/ 1 tuần : Thưởng 3 cây <img style='width: 25px;' src="/Default/skin/nobel/test/Themes/Default/media/tree.png"><br/>
						+ Trên 80 câu: Làm thêm 10 câu thưởng thêm 1 cây <img style='width: 25px;' src="/Default/skin/nobel/test/Themes/Default/media/tree.png"><br/>
						Dựa vào phần trăm làm đúng phần game từ vựng <img style='width: 25px;' src="/Default/skin/nobel/test/Themes/Default/media/tree.png"><br/>
						+ 50 đến 69% làm đúng game từ vựng /1 tuần : Thưởng 1 cây <img style='width: 25px;' src="/Default/skin/nobel/test/Themes/Default/media/tree.png"><br/>
						+ 70 đến 79% làm đúng game từ vựng /1 tuần : Thưởng 2 cây <img style='width: 25px;' src="/Default/skin/nobel/test/Themes/Default/media/tree.png"><br/>
						+ 80 đến 100% làm đúng game từ vựng /1 tuần: Thưởng 3 cây <img style='width: 25px;' src="/Default/skin/nobel/test/Themes/Default/media/tree.png"><br/>
						
					</li>
					<li class='list-group-item list-group-item-info'>
					Thưởng hoa (Đánh giá mức độ luyện tập hiệu quả của HS): Dựa vào phần trăm số câu trả lời đúng trong các bài luyện tập mỗi tuần mà học sinh đã làm.<br/>
						+ 50 đến 69% câu trả lời đúng /1 tuần : Thưởng 1 bông hoa <img style="width: 25px;" src="/Default/skin/nobel/test/Themes/Default/media/flower.png"><br/>
						+ 70 đến 79% câu trả lời đúng/1 tuần : Thưởng 2 bông hoa <img style="width: 25px;" src="/Default/skin/nobel/test/Themes/Default/media/flower.png"><br/>
						+ 80 đến 100% câu trả lời đúng /1 tuần: Thưởng 3 bông hoa <img style="width: 25px;" src="/Default/skin/nobel/test/Themes/Default/media/flower.png"><br/>
					</li>
					<li class='list-group-item list-group-item-info'>
					Thưởng quả (Đánh giá kết quả làm đề luyện tập và đề kiểm tra toàn diện của HS): Dựa vào phần trăm số câu trả lới đúng ở các đề luyện tập và đề kiểm tra toàn diện trong tuần mà học sinh đã làm.<br/>
					+ 50 đến 69% câu trả lời đúng/ 1 tuần:  Thưởng 1 quả <img style="width: 25px;" src="/Default/skin/nobel/test/Themes/Default/media/apple.png"><br/>
					+ 70 đến 79%  câu trả lời đúng : Thưởng 2 quả <img style="width: 25px;" src="/Default/skin/nobel/test/Themes/Default/media/apple.png"><br/>
					+ 80 đến 100% câu trả lời đúng : Thưởng 3 quả <img style="width: 25px;" src="/Default/skin/nobel/test/Themes/Default/media/apple.png"><br/>
					</li>
				
			</ul>
		</div>
		<?php }else { ?>
			<div class='alert alert-danger'>Chưa có đánh giá nào!</div>
		<?php } ?>
	
	</div>
	
</div>