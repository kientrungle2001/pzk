<?php

/*$dataTest = $data->getDataTest();*/
/*$dataWeeks = $data->getWeekTest(354);*/
$practice= pzk_request('practice');
$check= pzk_session('checkPayment');
?>
<div class="container">
		<p class="t-weight text-center btn-custom8 textcl">Bảng xếp hạng</p>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12 top10 bot20">
            
                <div class="dropdown col-md-8 col-sm-8 col-xs-12 mgleft pd0 mg0">
                    <button class="btn fix_hover btn-default col-md-12 col-sm-12 col-xs-12 sharp" type="button"><span id="chonde" class="fontsize19">Chọn Đề</span><img class="img-responsive imgwh hidden-xs hidden-sm pull-right" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/icon1.png" /></span>
                    </button>
                        <ul class="dropdown-menu col-md-12 col-sm-12 col-xs-12" style="top:40px; max-height:350px; overflow-y: scroll;">
                        <?php 
                            $weeks = $data->getWeekTest(ROOT_WEEK_CATEGORY_ID, $practice, $check);
                            
                         ?>
                        <?php foreach($weeks as $week ): ?>
                        
                        <li class="left20" style="color:#d9534f"><h5><strong><?php echo @$week['name']?></strong></h5>
                           
                        <?php 
                            $tests = $data->getTestSN($week['id'], $practice, $check);
                            if($practice== 1 || $practice == '1'){  ?>
                                <?php foreach($tests as $test ): ?>
                                <?php 
                                    if($test['name_sn']){
                                        $testName = $test['name_sn'];
                                    }else $testName = $test['name'];
                                ?>
                                    <li style="padding-left: 40px;">
                                        
                                        <a onclick="document.getElementById('chonde').innerHTML = '<?php echo $testName ?>';"  data-de="<?php echo $testName ?>" class="getdata" href="/Home/showRating?week=<?php echo @$week['id']?>&practice=1&examination=<?php echo @$test['id']?>" data-type="group"><?php echo $testName ?></a>
                                        
                                    </li>
                                <?php endforeach; ?>
                        <?php
                            }else{
                         ?>                     
                            <?php foreach($tests as $test ): ?>
                            <?php 
                                    if($test['name_sn']){
                                        $testName = $test['name_sn'];
                                    }else $testName = $test['name'];
                            ?>
                            <li style="padding-left: 40px;">
                                
                                <a onclick="id = <?php echo @$week['id']?>;document.getElementById('chonde').innerHTML = '<?php echo $testName ?>';"  data-de="<?php echo $testName ?>" class="getdata" href="/Home/showRating?week=<?php echo @$week['id']?>&practice=0&examination=<?php echo @$test['id']?>" data-type="group"><?php echo $testName ?></a>
                                
                            </li>
                            <?php endforeach; ?>
                            <?php } ?>
                           
                        </li>
                        <?php endforeach; ?>
                        </ul>
                </div>
                <div class="col-xs-12 col-md-4 col-sm-2 bd pull-right mgleft">
                    <div class="row text-center">
                        <div class="col-md-3 hidden-xs hidden-sm">
                            <img  src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/dongho.png"  class=" wh40 img-responsive"/>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <h4 class="robotofont"><strong>45:00</strong></h4>
                        </div>
                    </div>
                </div>
            
        </div>
    </div>
	
	<div class='item text-center'>
		<img class='item' src='/Default/skin/nobel/test/Themes/Default/media/final.jpg' />
	</div>

</div>

