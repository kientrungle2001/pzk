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
		<li class="list-group-item hasa"><a href="" class="getdata2" onclick="showdoc(<?php echo @$item['id']?>,<?php echo @$item['trial']?>); $('.fix_hover2').dropdown('toggle'); return false;" data-bind="disable: noResults()" data-check="<?php echo $check; ?>" data-cate="<?php echo $cate; ?>"><?php if(pzk_user_special()): ?>#<?php echo @$item['id']?> - <?php endif; ?>
		
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
		<?php }elseif($level == 2 or $level == '2' ){ 
			$topics = $data->getChildSN($subjectId, $check, $class);
		?>
		<?php
			$vocabulary = $data->getItemsVocabularySN($subjectId, $check, $class);
		?>
		<?php foreach($vocabulary as $item): ?>
		<li class="list-group-item hasa"><a href="" onclick="showdoc(<?php echo @$item['id']?>,<?php echo @$item['trial']?>); $('.fix_hover2').dropdown('toggle'); return false;" data-bind="disable: noResults()" data-check="<?php echo $check; ?>" data-cate="<?php echo $cate; ?>"><?php if(pzk_user_special()): ?>#<?php echo @$item['id']?> - <?php endif; ?>
		
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
		<?php 
			$vocabulary = $data->getItemsVocabularySN($topic['id'], $check, $class); 
			
		?>
		<?php foreach($vocabulary as $item): ?>
		<li class="list-group-item hasa"><a href="" class="getdata2" onclick="showdoc(<?php echo @$item['id']?>,<?php echo @$item['trial']?>); $('.fix_hover2').dropdown('toggle'); return false;" data-bind="disable: noResults()" data-check="<?php echo $check; ?>" data-cate="<?php echo $cate; ?>"><?php if(pzk_user_special()): ?>#<?php echo @$item['id']?> - <?php endif; ?>
		
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
		<?php } elseif($level == 3 or $level == '3'){ 
		$topics = $data->getChildSN($subjectId, $check, $class);
		?>
		<?php
			$vocabulary = $data->getItemsVocabularySN($subjectId, $check, $class);
		?>
		<?php foreach($vocabulary as $item): ?>
		<li class="list-group-item hasa"><a href="" onclick="showdoc(<?php echo @$item['id']?>,<?php echo @$item['trial']?>); $('.fix_hover2').dropdown('toggle'); return false;" data-bind="disable: noResults()" data-check="<?php echo $check; ?>" data-cate="<?php echo $cate; ?>"><?php if(pzk_user_special()): ?>#<?php echo @$item['id']?> - <?php endif; ?>
		
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
			<li class="list-group-item hasa"><a href="" class="getdata2" onclick="showdoc(<?php echo @$item['id']?>,<?php echo @$item['trial']?>); $('.fix_hover2').dropdown('toggle'); return false;" data-bind="disable: noResults()" data-check="<?php echo $check; ?>" data-cate="<?php echo $cate; ?>"><?php if(pzk_user_special()): ?>#<?php echo @$item['id']?> - <?php endif; ?>
			
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
				<li class="list-group-item hasa"><a href="" class="getdata2" onclick="showdoc(<?php echo @$item['id']?>,<?php echo @$item['trial']?>); $('.fix_hover2').dropdown('toggle'); return false;" data-bind="disable: noResults()" data-check="<?php echo $check; ?>" data-cate="<?php echo $cate; ?>"><?php if(pzk_user_special()): ?>#<?php echo @$item['id']?> - <?php endif; ?>
				
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

<script>
	$('.fix_hover2').hover(function(){
		$('.fix_hover2').next().css('visibility', 'visible');
	});
	function showdoc(id,trial){
		$('.fix_hover2').next().css('visibility', 'hidden');
		if (typeof CountDown != 'undefined') {
			CountDown.Pause();
		}
		var check = '<?php echo $check ?>';
		var cate = '<?php echo $cate ?>';
		if(check == 1 || trial == 1){
		$('.imgbg').css('background', 'white');
		$(".change").load(BASE_REQUEST + "/Practice/vocabulary/"+<?php echo @$item['categoryId']?>+"?class=&id="+id, function() {
			//mobilecheck(), mobileAndTabletcheck()
			MathJax.Hub.Queue(["Typeset",MathJax.Hub], "mathvoca");
			$('.change table').addClass('tableitem').addClass('table').addClass('table-bordered');
			$('.change table').each(function(index, tbl){
				var $tbl = $(tbl);
				if($tbl.find('thead').length == 0) {
					// get first row
					var firstRow = $tbl.find('tr:first');
					// then append to thead
					var thead = $('<thead></thead>');
					thead.append(firstRow);
					// prepend to tbl
					$tbl.prepend(thead);
					firstRow.children('td').replaceWith(function(i, html) {
						return '<th>' + $(html).text() + '</th>';
					});
				}
			});
			tableitemize();
			$('table.tableitem tr td').each(function(){
				$(this).width('auto');
				$(this).eq(0).css('min-width', '130px');
				$(this).eq(1).css('min-width', '130px');
				$(this).eq(2).css('min-width', '130px');
				
				$(this).eq(3).css('max-width', '500px');
			});
			$('table.tableitem tr td img').addClass('img-responsive');
		});
		}else{
				alert('Bạn cần mua tài khoản để được sử dụng nội dung này !');
		}
	}
	<?php if( $documentId = pzk_request()->getDocumentId()){ 
	$document = _db()->selectAll()->fromDocument()->whereId($documentId)->result_one();
	?>
		$(function() {
			showdoc(<?php echo $documentId ?>, <?php echo @$document['trial']?>);
		});
		
	<?php }?>
	if(mobileAndTabletcheck() || mobilecheck()){
		$(".getdata2").click(function(){
			
			$('.menu-hide').hide();
		});
		$(".fix_hover2").click(function(){
			
			$('.menu-hide').show();
		});
		
	}
</script>