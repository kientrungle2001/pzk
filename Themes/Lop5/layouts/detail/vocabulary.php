<script type="text/javascript">
	pzk.load('/3rdparty/jquery/jquery-ui.js');
	pzk.load('/3rdparty/createjs-2015.11.26.min.js');
</script>
<?php
	$check = pzk_session('checkPayment');
	$cate = pzk_session('categoryIds');
	$subjectId  	= intval(pzk_request()->getSegment(3));
	if(pzk_session('subject')){
		$subjectId = pzk_session('subject');
	}
	$level 		= $data->getLevelDocument($subjectId, $check);
	
	$class= 5;
?>
<div class="dropdown hide_dropdown col-md-5 col-xs-12 mgleft <?php if($level == 0 ){ echo "hidden"; }?> mg0 pd0">
	<button class="btn btn-default fix_hover2 dropdown-toggle col-md-12 col-sm-12 col-xs-12 sharp" type="button" data-toggle="dropdown" data-bind="enable: !noResults()" aria-haspopup="true" aria-expanded="true"><span id="chontu" class="fontsize19">Từ vựng & Lý thuyết</span><img class="img-responsive imgwh hidden-xs hidden-sm pull-right" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/icon1.png" />
	</button>
	<ul class="dropdown-menu menu-hide col-md-12 col-sm-12 col-xs-12 list-group" style="top:40px; max-height:350px; overflow-y: scroll;">

		<?php 
		if($level == 1 or $level == '1' ){
			$vocabulary = $data->getItemsSN($subjectId, $check, $class); 
		 ?>
		{each $vocabulary as $item}
		<?php if(@$item['hidden']) continue; ?>
		<li class="list-group-item"><a href="" class="getdata2" onclick="showdoc({item[id]}); $('.fix_hover2').dropdown('toggle'); return false;" data-bind="disable: noResults()" data-check="<?php echo $check; ?>" data-cate="<?php echo $cate; ?>"><?php if(pzk_user_special()): ?>#{item[id]}<?php endif;?> - {item[tdn_title]}</a></li>
		{/each}
		<?php }elseif($level == 2 or $level == '2' ){ 
			$topics = $data->getChildSN($subjectId, $check, $class);
		?>
		<?php
			$vocabulary = $data->getItemsVocabularySN($subjectId, $check, $class);
		?>
		{each $vocabulary as $item}
		<?php if(@$item['hidden']) continue; ?>
		<li class="list-group-item"><a href="" onclick="showdoc({item[id]},{item[trial]}); $('.fix_hover2').dropdown('toggle'); return false;" data-bind="disable: noResults()" data-check="<?php echo $check; ?>" data-cate="<?php echo $cate; ?>"><?php if(pzk_user_special()): ?>#{item[id]}<?php endif;?> - {item[tdn_title]}</a></li>
		{/each}
		{each $topics as $topic}
		<?php if(!@$topic['hidden'] && (@$topic['displayAtSite'] == 0 || @$topic['displayAtSite'] == pzk_request('siteId') )):?>
		<li class="list-group-item" style="color:#d9534f">{topic[name]}</li>
		<?php endif; ?>
		<?php 
			$vocabulary = $data->getItemsVocabularySN($topic['id'], $check, $class); 
			
		?>
		{each $vocabulary as $item}
		<?php if(@$item['hidden']) continue; ?>
		<li class="list-group-item"><a href="" class="getdata2" onclick="showdoc({item[id]},{item[trial]}); $('.fix_hover2').dropdown('toggle'); return false;" data-bind="disable: noResults()" data-check="<?php echo $check; ?>" data-cate="<?php echo $cate; ?>"><?php if(pzk_user_special()): ?>#{item[id]}<?php endif;?> - {item[tdn_title]}</a></li>
		{/each}
		{/each}
		<?php } elseif($level == 3 or $level == '3'){ 
		$topics = $data->getChildSN($subjectId, $check, $class);
		?>
		<?php
			$vocabulary = $data->getItemsVocabularySN($subjectId, $check, $class);
		?>
		{each $vocabulary as $item}
		<?php if(@$item['hidden']) continue; ?>
		<li class="list-group-item"><a href="" onclick="showdoc({item[id]},{item[trial]}); $('.fix_hover2').dropdown('toggle'); return false;" data-bind="disable: noResults()" data-check="<?php echo $check; ?>" data-cate="<?php echo $cate; ?>"><?php if(pzk_user_special()): ?>#{item[id]}<?php endif;?> - {item[tdn_title]}</a></li>
		{/each}
		{each $topics as $topic}
			<?php if(!@$topic['hidden'] && (@$topic['displayAtSite'] == 0 || @$topic['displayAtSite'] == pzk_request('siteId') )):?>
			<li class="left10 list-group-item" style="color:#d9534f"><?php if(pzk_user_special()): ?>#{topic[id]}<?php endif;?> - {topic[name]}</li>
			<?php endif; ?>
			<?php $subTopics = $data->getChild($topic['id'], $check, $class);?>
			<?php if(count($subTopics)==0): ?>
			<?php 
				$vocabulary = $data->getItemsVocabularySN($topic['id'], $check, $class); 
			?>
			{each $vocabulary as $item}
			<?php if(@$item['hidden']) continue; ?>
			
			<li class="left20 list-group-item"><a style="padding-left: 50px;" href="" class="getdata2" onclick="showdoc({item[id]},{item[trial]}); $('.fix_hover2').dropdown('toggle'); return false;" data-bind="disable: noResults()" data-check="<?php echo $check; ?>" data-cate="<?php echo $cate; ?>"><?php if(pzk_user_special()): ?>#{item[id]}<?php endif;?> - {item[tdn_title]}</a></li>
			{/each}
			<?php else:?>
			{each $subTopics as $subTopic}
				<?php if(!@$subTopic['hidden'] && (@$subTopic['displayAtSite'] == 0 || @$subTopic['displayAtSite'] == pzk_request('siteId') )):?>
				<li class="left20 list-group-item" style="color:#d9534f"><?php if(pzk_user_special()): ?>#{subTopic[id]}<?php endif;?> - {subTopic[name]}</li>
				<?php endif; ?>
				<?php 
					$vocabulary = $data->getItemsVocabularySN($subTopic['id'], $check, $class); 
				?>
				{each $vocabulary as $item}
				<?php if(@$item['hidden']) continue; ?>
				<li class="left30 list-group-item"><a style="padding-left: 50px;" href="" class="getdata2" onclick="showdoc({item[id]},{item[trial]}); $('.fix_hover2').dropdown('toggle'); return false;" data-bind="disable: noResults()" data-check="<?php echo $check; ?>" data-cate="<?php echo $cate; ?>"><?php if(pzk_user_special()): ?>#{item[id]}<?php endif;?> - {item[tdn_title]}</a></li>
				{/each}
			{/each}
			<?php endif;?>
		{/each}	
		<?php } ?>
	</ul>
</div>

<script>
	function showdoc(id,trial){
		if (typeof CountDown != 'undefined') {

			CountDown.Pause();
		}
		var check = '{check}';
		var cate = '{cate}';
		if(check == 1 || trial == 1){
		$('.imgbg').css('background', 'white');
		$(".change").load(BASE_REQUEST + "/practice/vocabulary/"+{item[categoryId]}+"?class=&id="+id, function() {
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
	if(mobileAndTabletcheck() || mobilecheck()){
		$(".getdata2").click(function(){
			
			$('.menu-hide').hide();
		});
		$(".fix_hover2").click(function(){
			
			$('.menu-hide').show();
		});
		
	}
</script>