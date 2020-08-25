<?php
	$language = pzk_global()->getLanguage();
$lang = pzk_session('language');
$check = pzk_session('checkPayment');
	$page = $data->getPage();
	$class = $data->getClass(); 
	$items = $data->getTests($class, 1410, $page, 15);	
?>

<?php foreach($items as $item): ?>
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
				<?php foreach($tests as $test): ?>
					<div class="text-uppercase link-box testnumber text-center" onclick ="testnumber(this);return false;" data-test="<?php echo @$test['id']?>" data-week="<?php echo @$item['id']?>" data-trial="<?php echo @$item['trial']?>" <?php if($lang == 'ev'){
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
				<?php endforeach; ?>
			</div>	
		</div>
	</div>
	
<?php endforeach; ?>