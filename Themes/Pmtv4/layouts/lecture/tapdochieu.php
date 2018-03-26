<?php 
$data->orderBy 		= 	'ordering asc';
$items 				= 	$data->getItems(); 
$items 				= 	buildTree($items);
$root 				= 	$items[0];
$children 			= 	$root['children'];
$term1 				= 	$children[0];
$term2 				= 	$children[1];
$isTerm2 			= 	false;
if($term2['id'] == $data->get('menuId')) {
	$term 				= 	$term2;
	$isTerm2			= 	true;
} else {
	$term 				= 	$term1;
}

$chunks 			=	array_chunk($term['children'], 20);
$basicChildren1		=	$chunks[0];
$advanceChildren1	=	@$chunks[1];
if($isTerm2) {
	$index				=	19;
} else {
	$index				=	1;
}

?>
<div class="lecture-region {root[alias]}">
	<div class="lecture-bird-2 hidden-xs"></div>
	<div class="container">
		<h1 class="text-center color4-bold">{root[name]}</h1>
		<div class="text-center visible-xs">
		<a href="/{term1[alias]}"><h2 class="tab1 bgcolor1-bold color-white  font-large padding-10">Học kỳ 1</h2></a>
					<a href="/{term2[alias]}"><h2 class="tab2 bgcolor1-bold color-white font-large padding-10">Học kỳ 2</h2></a>
		</div>
		<div class="row columns-lecture">
			<div class="col-xs-12">
				
				<div class="lecture-index">
					<a href="/{term1[alias]}"><h2 class="tab1 bgcolor1-bold">Học kỳ 1</h2></a>
					<a href="/{term2[alias]}"><h2 class="tab2 bgcolor1-bold">Học kỳ 2</h2></a>
					<div class="row top-15">
						<div class="col-md-1 hidden-xs hidden-sm">&nbsp;</div>
						<div class="col-md-10 col-xs-12 col-sm-12">
							<center><h3 class="lecture-section-heading"><?php if($isTerm2):?>Tuần từ 19 - 28<?php else:?>Tuần từ 1 - 10<?php endif;?></h3></center>
							<div class="row">
								{? 
								$basicChildren1Count = count($basicChildren1);
								$pageSize = ceil($basicChildren1Count / 2);
								for ($i = 0; $i < $pageSize; $i++): 
								$item1 = $basicChildren1[$i*2];
								$item2 = @$basicChildren1[$i*2+1];
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
						</div>
						<div class="col-md-1 hidden-xs hidden-sm">&nbsp;</div>
					</div>
					<div class="row top-15" style="margin-top: 0;">
						<div class="col-md-1 hidden-xs hidden-sm">&nbsp;</div>
						<div class="col-md-10 col-xs-12 col-sm-12">
							<center><h3 class="lecture-section-heading"><?php if($isTerm2):?>Tuần từ 29 - 35<?php else:?>Tuần từ 11 - 18<?php endif;?></h3></center>
							<div class="row">
								{? 
								$advanceChildren1Count = count($advanceChildren1);
								$pageSize = ceil($advanceChildren1Count / 2);
								for ($i = 0; $i < $pageSize; $i++): 
								$item1 = $advanceChildren1[$i*2];
								$item2 = @$advanceChildren1[$i*2+1];
								?}
								<div class="col-xs-12 col-md-4">
									<div class="lecture-item blcolor4-bold num{index}">
										<div class="lecture-title color4-bold"><a href="/{item1[alias]}">{item1[name]}</a></div>
										<div class="lecture-detail"><a href="/{item1[alias]}">HD trả lời câu hỏi SGK</a></div>
										<div class="lecture-practice"><a href="/{item1[alias]}#practice-section">Bài tập luyện tập</a></div>
									</div>
									{? if($item2): ?}
									<div class="lecture-item blcolor4-bold">
										<div class="lecture-title color4-bold"><a href="/{item2[alias]}">{item2[name]}</a></div>
										<div class="lecture-detail"><a href="/{item2[alias]}">HD trả lời câu hỏi SGK</a></div>
										<div class="lecture-practice"><a href="/{item2[alias]}#practice-section">Bài tập luyện tập</a></div>
									</div>
									{? endif; ?}
								</div>
								{? 	$index++; ?}
								{? endfor; ?}
							</div>
						</div>
						<div class="col-md-1 hidden-xs hidden-sm">&nbsp;</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
</div>