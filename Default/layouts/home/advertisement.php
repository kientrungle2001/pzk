<?php if(pzk_request('softwareId') == 4):?>

<a style="position: fixed;right: 35px;border: 1px solid #5FB018;z-index: 999; background: #fff;border-radius: 10px;height: 272px;bottom: 0px;" id="dkts" href="http://s1.nextnobels.com/Online-Examination">
<img onclick="document.getElementById('dkts').style.display='none';return false;" src="<?=BASE_URL?>/default/images/close.png" style="position: absolute;top: -15px;right: -7px;cursor: pointer;">
<img width="300px" height="270px" style="border-radius: 9px" src="<?=BASE_URL?>/default/images/niceNobel.jpg">
</a>
<?php elseif(pzk_request('softwareId') == 1):?>
<a style="position: fixed;right: 35px;border: 1px solid #5FB018;z-index: 999; background: #fff;border-radius: 10px;height: 272px;bottom: 0px;" id="dkts" href="http://s1.nextnobels.com/Online-Examination">
<img onclick="document.getElementById('dkts').style.display='none';return false;" src="<?=BASE_URL?>/default/images/close.png" style="position: absolute;top: -15px;right: -7px;cursor: pointer;">
<img width="300px" height="270px" style="border-radius: 9px" src="<?=BASE_URL?>/default/images/niceS1.jpg">
</a>

<?php endif;?>