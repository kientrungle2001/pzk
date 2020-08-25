	<?php 
		$lang = pzk_session('language');
		$language = pzk_global()->getLanguage();
	?>
<div class='achievement item'>
	<div class="container">
		<?php
		$week = date('W');
		$year = date('Y');
		
		if($week > 1){
			$weekActive = $week -1;
		}else{
			$weekActive = 52;
			$year = $year - 1;
		}
		
		$achievementByTrees = $data->getThreeAchievement($weekActive, $year, pzk_session('lop'), 'tree desc');
		
		
		
		
		?>
		<b class ='title-achievement item mgb15 text-center'><?=$language['halloffameweek'];?> <?php echo $weekActive; ?><br><span style='font-weight: normal;'>(<?php $date = startEndDateOfWeek($weekActive-1, $year, true);
		if(!$lang || $lang == 'vn'){
			echo $date['startdate'].' đến '. $date['enddate'];	
		}else{
			echo date('F d, Y', strtotime($date['startdate'])).' to '. date('F d, Y', strtotime($date['enddate']));
		}
		 ?>
		
		)</span></b> 
		<div class="item">
			<div class="col-md-3 col-xs-12"></div>
			<div class="col-md-3 col-xs-12">
			<?php if($achievementByTrees){ ?>
			
			<div class='child-box-achie item'>
				<img  style='float: left;' src="/Themes/Songngu3/skin/images/top1.png" />
				<b class="uppercase fs18"><?=$language['hardworking'];?>:</b></br>
				
			 </div>
			<?php $i =1; ?>
			<?php foreach($achievementByTrees as $achievementByTree): ?>
			 <div class='child-box-achie item'>
				<b class="stt2"><?= $i; ?>. </b>
				<span><b><?=$achievementByTree['name'];?></b>
				<p>(<?=$achievementByTree['username'];?>)</p>
				</span>
			 </div>
			 <?php $i ++;?>
			 <?php endforeach; ?>
			<?php } ?>
			
			
			
			</div>
			
			
			<div class="col-md-3 col-xs-12">
			<?php 
			$achievementByFlowers = $data->getThreeAchievement($weekActive, $year, pzk_session('lop'), 'flower desc');
			if($achievementByFlowers){
			?>
			
			<div class='child-box-achie item'>
				<img  style='float: left;' src="/Themes/Songngu3/skin/images/top2.png" />
				<b class="uppercase fs18"><?=$language['bestpractice'];?>:</b></br>
				
			 </div>
			
			<?php $i =1; ?>
			<?php foreach($achievementByFlowers as $achievementByFlower): ?>
				 <div class='child-box-achie item'>
					
					<b class="stt2"><?= $i; ?>. </b>
					<span>
					<b><?=$achievementByFlower['name'];?></b></br>
					<p>(<?=$achievementByFlower['username'];?>)</p>
					</span>
				 </div>
				 <?php $i ++;?>
			 <?php endforeach; ?>
			 <?php } ?>
			 </div>
			 
			 <div class="col-md-3 col-xs-12">
			<?php 
			$achievementByApples = $data->getThreeAchievement($weekActive, $year, pzk_session('lop'), 'apple desc');
			if($achievementByApples){
			?>
			
			<div class='child-box-achie item'>
				<img  style='float: left;' src="/Themes/Songngu3/skin/images/top3.png" />
				<b class="uppercase fs18"><?=$language['besttest'];?>:</b></br>
				
			 </div>
			<?php $i =1; ?>
			<?php foreach($achievementByApples as $achievementByApple): ?>
			 <div class='child-box-achie item'>
				<b class="stt2"><?= $i; ?>. </b>
				
				<b><?=$achievementByApple['name'];?></b>
				<p>(<?=$achievementByApple['username'];?>)</p>
			 </div>
			 <?php $i++; ?>
			 <?php endforeach; ?>
			<?php } ?>
			</div>
		</div>
		
		<div class="item">
			<div class="col-md-offset-3 "> 
				<a href='/home/achievement'>
				<?php if(!$lang || $lang == 'vn' ){ ?>
					<img class="mgb40 mgt10 mgl40" src="/Themes/Songngu3/skin/images/xemthem.png" />
				<?php } else { ?>
					<img class="mgb40 mgt10 mgl40" src="/Themes/Songngu3/skin/images/seemore.png" />
				<?php } ?>
				</a>
			</div>
		</div>
		 
	 </div>
  </div>

		

