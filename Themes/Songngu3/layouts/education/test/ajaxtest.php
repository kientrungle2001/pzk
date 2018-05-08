<?php
	$language = pzk_global()->get('language');
$lang = pzk_session('language');
$check = pzk_session('checkPayment');
	$page = $data->get('page');
	$class = $data->get('class'); 	
?>
{? $items = $data->getTests($class, $page, 21); ?}
<?php $i =1; $j=1; ?>
{each $items as $item}
<?php $tests= $data->getTestByWeek($item['id'], 0, $check, $class); 
?>
	<div class="col-md-4 col-xs-12">
		<div class="bg-white">
			<h2 class="text-center <?php if($j % 2 == 0){ echo 'vang'; } else { echo 'xanh'; } ?> head-box"><img src="/Themes/Songngu3/skin/images/mu.png" /> &nbsp;{item[name]}</h2>
			<div class="box-body">
				{each $tests as $test}
					<div class="text-uppercase link-box testnumber text-center" onclick ="testnumber(this);return false;" data-test="{test[id]}" data-week="{item[id]}" data-trial="{item[trial]}" <?php if($lang == 'ev'){
										echo 'title="'.$test['name'].'"'; }?>>
						<a href="" class="text-color">
						<?php 
						if ($lang == 'en' || $lang == 'ev'){
							echo $test['name_en'];
						}else{
							echo $test['name'];
						} ?>
						</a>
					</div>
					<?php ?>
				{/each}
			</div>	
		</div>
	</div>
	<?php if($i % 3 == 0){ $j++; } ?>
<?php $i++; ?>	
{/each}