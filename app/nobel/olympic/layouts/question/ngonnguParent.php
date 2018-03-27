<?php
$category = $data->get('category');

$category_id = $data->get('categoryId');
?>
<div class="left-content">
	<div class="guide">
	<?php
	$obj = pzk_obj ( 'education.question.video' );
	$obj->display ();
	?>
	</div>
	
	<div class="style_home"> 
		<?php if($category_id == '96'):?>
		<img width="100%" src="<?=BASE_URL?>/default/skin/nobel/ptnn/media/type_word.jpg" style="position: absolute"/>	
		<div class="img-circle"><a class="type_sub sub1 text-center" href="<?=BASE_URL.'/'.$category['child'][0]['alias']?>" title="<?=$category['child'][0]['name']?>"> Chọn từ đúng </a></div>
		<div class="img-circle"><a class="type_sub sub2 text-center" href="<?=BASE_URL.'/'.$category['child'][1]['alias']?>" title="<?=$category['child'][0]['name']?>"> Chữa lỗi sai</a></div>
		<div class="img-circle"><a class="type_sub sub3 text-center" href="<?=BASE_URL.'/'.$category['child'][2]['alias']?>" title="<?=$category['child'][0]['name']?>"> Dùng từ linh hoạt</a></div>
		<div class="img-circle"><a class="type_sub sub4 text-center" href="<?=BASE_URL.'/'.$category['child'][3]['alias']?>" title="<?=$category['child'][0]['name']?>"> Dùng từ đồng nghĩa trái nghĩa</a></div>
		<div class="img-circle"><a class="type_sub sub5 text-center" href="<?=BASE_URL.'/'.$category['child'][4]['alias']?>" title="<?=$category['child'][0]['name']?>"> Chọn từ hay</a></div>
		<div class="img-circle"><a class="type_sub sub6 text-center" href="<?=BASE_URL.'/'.$category['child'][5]['alias']?>" title="<?=$category['child'][0]['name']?>"> Thay từ gạch chân</a></div>
		<div class="img-circle"><a class="type_sub sub7 text-center" href="<?=BASE_URL.'/'.$category['child'][6]['alias']?>" title="<?=$category['child'][0]['name']?>"> Từ điển vốn từ</a></div>
		<div class="img-circle"><a class="type_sub sub8 text-center" href="<?=BASE_URL.'/'.$category['child'][7]['alias']?>" title="<?=$category['child'][0]['name']?>"> Học tập từ các nhà văn</a></div>
		<?php endif;?>
	</div>
</div>