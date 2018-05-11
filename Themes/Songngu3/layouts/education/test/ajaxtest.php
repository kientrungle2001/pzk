<?php
	$language = pzk_global()->get('language');
$lang = pzk_session('language');
$check = pzk_session('checkPayment');
	$page = $data->get('page');
	$class = $data->get('class'); 	
?>
{? $items = $data->getTests($class, $page, 15); ?}

{each $items as $item}
<?php $tests= $data->getTestByWeek($item['id'], 0, $check, $class); 
$pattern = '/(\(.+\))/i';
$replacement = '';
?>
	<div class="col-md-4 col-xs-12">
		<div class="bg-white">
			<h2 class="text-center xanh head-box"><img src="/Themes/Songngu3/skin/images/nguyetque.png" /> &nbsp;
			<?php
				
				if ($lang == 'en' || $lang == 'ev'){
					$tam = explode('-', $item['name_en']);
					echo $tam[0];
				}else{
					$tam = explode('-', $item['name']);
					echo $tam[0];
				}
				 
			?>
			</h2>
			<div class="box-body">
			<?php $i =1;  ?>
				{each $tests as $test}
					<div class="text-uppercase link-box testnumber text-center" onclick ="testnumber(this);return false;" data-test="{test[id]}" data-week="{item[id]}" data-trial="{item[trial]}" <?php if($lang == 'ev'){
										echo 'title="'.$test['name'].'"'; }?>>
						<a href="" class="text-color">
						<?php 
						if ($lang == 'en' || $lang == 'ev'){
							echo 'Tổ Hợp '.$i.': '.preg_replace($pattern, $replacement, $test['name_en']);
						}else{
							echo 'Tổ Hợp '.$i.': '.preg_replace($pattern, $replacement, $test['name']);
						} ?>
						</a>
					</div>
					<?php ?>
					<?php $i++; ?>
				{/each}
			</div>	
		</div>
	</div>
	
{/each}