<script type="text/javascript">
	pzk.load('/3rdparty/jquery/jquery-ui.js');
	pzk.load('/3rdparty/createjs-2015.11.26.min.js');
</script>
<?php
	$check = pzk_session('checkPayment');
	$cate = pzk_session('categoryIds');
	$subjectId  	= pzk_request()->getSegment(3);
	if(pzk_session('subject')){
		$subjectId = pzk_session('subject');
	}
	$level 		= $data->getLevelDocument($subjectId, $check);
	$language = pzk_global()->getLanguage();
	$lang = pzk_session('language');
	$class= pzk_session('lop');
?>

<div class="item <?php if($level == 0 ){ echo "hidden"; }?> mg0 pd0">

	<ul class="voca-menu item list-group">
		<?php 
		if($level == 1 or $level == '1' ){
			$vocabulary = $data->getItemsSN($subjectId, $check, $class); 
		 ?>
		<?php foreach($vocabulary as $item): ?>
		<li class="list-group-item hasa">
			<a onclick="return check_display(<?php echo @$item['trial']?>);" href="/Practice/showVocabulary/<?php echo $subjectId ?>?id=<?php echo $subjectId ?>&class=<?php echo $class ?>&documentId=<?php echo @$item['id']?>" class="getdata2" >
			<?php if(pzk_user_special()): ?>#<?php echo @$item['id']?> - <?php endif; ?>
			
			<?php 
				if ($lang == 'en' || $lang == 'ev'){
					if($item['en_title'] != ''){
						$voca_name = $item['en_title'];
					}else{
						$voca_name = $item['title'];
					}
					
				}else{
					$voca_name = $item['title'];
				}
			?>
			
			<?php echo $voca_name ?>
			</a>
		</li>
		<?php endforeach; ?>
		<?php }elseif($level == 2 or $level == '2' ){ 
			$topics = $data->getChildSN($subjectId, $check, $class);
		?>
		<?php
			$vocabulary = $data->getItemsVocabularySN($subjectId, $check, $class);
		?>
		<?php foreach($vocabulary as $item): ?>
		<li class="list-group-item hasa"><a onclick="return check_display(<?php echo @$item['trial']?>);" href="/Practice/showVocabulary/<?php echo $subjectId ?>?id=<?php echo $subjectId ?>&class=<?php echo $class ?>&documentId=<?php echo @$item['id']?>" >
		<?php if(pzk_user_special()): ?>#<?php echo @$item['id']?> - <?php endif; ?>
		
		<?php 
				if ($lang == 'en' || $lang == 'ev'){
					if($item['en_title'] != ''){
						$voca_name = $topic['en_title'];
					}else{
						$voca_name = $topic['title'];
					}
					
				}else{
					$voca_name = $topic['title'];
				}
			?>
		
		<?php echo $voca_name ?>
		</a></li>
		<?php endforeach; ?>
		<?php foreach($topics as $topic): ?>
		<li class="list-group-item" ><?php if(pzk_user_special()): ?>#<?php echo @$topic['id']?> - <?php endif; ?>
		
		<?php 
				if ($lang == 'en' || $lang == 'ev'){
					if($topic['name_en'] != ''){
						$topic_name = $topic['name_en'];
					}else{
						$topic_name = $topic['name'];
					}
					
				}else{
					$topic_name = $topic['name'];
				}
			?>
		
		<?php echo $topic_name ?>
		
		
		</li>
		<?php 
			$vocabulary = $data->getItemsVocabularySN($topic['id'], $check, $class); 
			
		?>
		<?php foreach($vocabulary as $item): ?>
		<li class="list-group-item hasa"><a onclick="return check_display(<?php echo @$item['trial']?>);" href="/Practice/showVocabulary/<?php echo $subjectId ?>?id=<?php echo $subjectId ?>&class=<?php echo $class ?>&documentId=<?php echo @$item['id']?>" class="getdata2" >
		<?php if(pzk_user_special()): ?>#<?php echo @$item['id']?> - <?php endif; ?>
		
		<?php 
				if ($lang == 'en' || $lang == 'ev'){
					if($item['en_title'] != ''){
						$voca_name = $item['en_title'];
					}else{
						$voca_name = $item['title'];
					}
					
				}else{
					$voca_name = $item['title'];
				}
			?>
		
		<?php echo $voca_name ?></a></li>
		<?php endforeach; ?>
		<?php endforeach; ?>
		<?php } elseif($level == 3 or $level == '3'){ 
		$topics = $data->getChildSN($subjectId, $check, $class);
		?>
		<?php
			$vocabulary = $data->getItemsVocabularySN($subjectId, $check, $class);
		?>
		<?php foreach($vocabulary as $item): ?>
		<li class="list-group-item hasa"><a onclick="return check_display(<?php echo @$item['trial']?>);" href="/Practice/showVocabulary/<?php echo $subjectId ?>?id=<?php echo $subjectId ?>&class=<?php echo $class ?>&documentId=<?php echo @$item['id']?>" >
			<?php if(pzk_user_special()): ?>#<?php echo @$item['id']?> - <?php endif; ?>
			
			<?php 
				if ($lang == 'en' || $lang == 'ev'){
					if($item['en_title'] != ''){
						$voca_name = $item['en_title'];
					}else{
						$voca_name = $item['title'];
					}
					
				}else{
					$voca_name = $item['title'];
				}
			?>
		
			<?php echo $voca_name ?>
			
		</a></li>
		<?php endforeach; ?>
		<?php foreach($topics as $topic): ?>
			<li class="list-group-item" ><?php if(pzk_user_special()): ?>#<?php echo @$topic['id']?> - <?php endif; ?>
			
			<?php 
				if ($lang == 'en' || $lang == 'ev'){
					if($topic['name_en'] != ''){
						$topic_name = $topic['name_en'];
					}else{
						$topic_name = $topic['name'];
					}
					
				}else{
					$topic_name = $topic['name'];
				}
			?>
		
			<?php echo $topic_name ?>
			
			</li>
			<?php $subTopics = $data->getChild($topic['id'], $check, $class);?>
			<?php if(count($subTopics)==0): ?>
			<?php 
				$vocabulary = $data->getItemsVocabularySN($topic['id'], $check, $class); 
			?>
			<?php foreach($vocabulary as $item): ?>
			<li class="list-group-item hasa">
				<a onclick="return check_display(<?php echo @$item['trial']?>);"  href="/Practice/showVocabulary/<?php echo $subjectId ?>?id=<?php echo $subjectId ?>&class=<?php echo $class ?>&documentId=<?php echo @$item['id']?>" class="getdata2"><?php if(pzk_user_special()): ?>#<?php echo @$item['id']?> - <?php endif; ?>
				<?php 
					if ($lang == 'en' || $lang == 'ev'){
						if($item['en_title'] != ''){
							$voca_name = $item['en_title'];
						}else{
							$voca_name = $item['title'];
						}
						
					}else{
						$voca_name = $item['title'];
					}
				?>
			
				<?php echo $voca_name ?>
				</a>
			</li>
			<?php endforeach; ?>
			<?php else:?>
			<?php foreach($subTopics as $subTopic): ?>
				<li class="list-group-item"><?php if(pzk_user_special()): ?>#<?php echo @$subTopic['id']?> - <?php endif; ?>
				
				<?php 
				if ($lang == 'en' || $lang == 'ev'){
					if($subTopic['name_en'] != ''){
						$subTopic_name = $subTopic['name_en'];
					}else{
						$subTopic_name = $subTopic['name'];
					}
					
				}else{
					$subTopic_name = $subTopic['name'];
				}
			?>
		
			<?php echo $subTopic_name ?>
				
				
				
				</li>
				<?php 
					$vocabulary = $data->getItemsVocabularySN($subTopic['id'], $check, $class); 
				?>
				<?php foreach($vocabulary as $item): ?>
				<li class="left30 list-group-item hasa"><a onclick="return check_display(<?php echo @$item['trial']?>);"  href="/Practice/showVocabulary/<?php echo $subjectId ?>?id=<?php echo $subjectId ?>&class=<?php echo $class ?>&documentId=<?php echo @$item['id']?>" class="getdata2" >
				<?php if(pzk_user_special()): ?>#<?php echo @$item['id']?> - <?php endif; ?>
				
				
				<?php 
					if ($lang == 'en' || $lang == 'ev'){
						if($item['en_title'] != ''){
							$voca_name = $item['en_title'];
						}else{
							$voca_name = $item['title'];
						}
						
					}else{
						$voca_name = $item['title'];
					}
				?>
			
				<?php echo $voca_name ?>
				
				</a></li>
				<?php endforeach; ?>
			<?php endforeach; ?>
			<?php endif;?>
		<?php endforeach; ?>	
		<?php } ?>
	</ul>
</div>

