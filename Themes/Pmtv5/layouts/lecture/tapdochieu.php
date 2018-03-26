<?php 
$items 				= 	$data->getItems(); 
$items 				= 	buildTree($items);
$root 				= 	$items[0];
$children 			= 	$root['children'];
$term1 				= 	$children[0];
$term2 				= 	$children[1];
if($term2['id'] == $data->get('menuId')) {
	$term 				= 	$term2;
} else {
	$term 				= 	$term1;
}
$lessons			=	$term['children'];
$chunks 			=	array_chunk($term['children'], 20);
$basicChildren1		=	$chunks[0];
$advanceChildren1	=	$chunks[1];
$index				=	1;
?>
<div class="lecture-region {root[alias]}">
	<div class="lecture-bird-2 hidden-xs"></div>
	<div class="container">
		<h1 class="text-center">{root[name]}</h1>
		<div class="row columns-lecture">
			<div class="col-xs-12">
				
				<div class="lecture-index">
					<h2 class="tab1 bgcolor4-bold hidden-xs"><a href="/{term1[alias]}">Học kỳ 1</a></h2>
					<h2 class="tab2 bgcolor4-bold hidden-xs"><a href="/{term2[alias]}">Học kỳ 2</a></h2>
					<div class="row top-15" style="margin-top: 100px;">
						<div class="col-md-1 hidden-xs hidden-sm">&nbsp;</div>
						<div class="col-md-9 col-xs-12 col-sm-12">
							<div class="row">
								{? 
								$lessonsCount = count($lessons);
								$pageSize = ceil($lessonsCount / 2);
								for ($i = 0; $i < $pageSize; $i++): 
								$item1 = $lessons[$i*2];
								$item2 = @$lessons[$i*2+1];
								?}
								
								<?php if($item1['id'] == 557):?>
									<div class="col-xs-12 col-md-8">
									&nbsp;
									</div>
								<?php endif;?>
								<div class="col-xs-12 col-md-4">
									<div class="lecture-item blcolor4-bold num{index}">
										<div class="lecture-title color4-bold"><a href="/{item1[alias]}">{item1[name]}</a></div>
										<div class="lecture-detail"><a href="/{item1[alias]}">HD đọc</a></div>
										<div class="lecture-practice"><a href="/{item1[alias]}?show_content=true">HD trả lời câu hỏi SGK</a></div>
										<div class="lecture-practice"><a href="/{item1[alias]}#practice-section">Bài tập luyện tập</a></div>
									</div>
									{? if($item2 && $item2['id'] != 558): ?}
									
									<div class="lecture-item blcolor4-bold">
										<div class="lecture-title color4-bold"><a href="/{item2[alias]}">{item2[name]}</a></div>
										<div class="lecture-detail"><a href="/{item2[alias]}">HD đọc</a></div>
										<div class="lecture-practice"><a href="/{item2[alias]}?show_content=true">HD trả lời câu hỏi SGK</a></div>
										<div class="lecture-practice"><a href="/{item2[alias]}#practice-section">Bài tập luyện tập</a></div>
									</div>
									{? endif; ?}
								</div>
								{? 	$index++; ?}
								{? endfor; ?}
							</div>
							<br /><br /><br /><br />
							<div class="lecture-girl-cartoon lecture-girl2-cartoon hidden-xs"></div>
						</div>
						<div class="col-md-1 hidden-xs hidden-sm">&nbsp;</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
</div>