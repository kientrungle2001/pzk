

<link href="<?php echo BASE_URL.'/Default/skin/nobel/test/css/tooltip.css'; ?>" rel="stylesheet" type="text/css" />
<script src="<?php echo BASE_URL; ?>/js/cms/tooltip.js" type="text/javascript"></script>
<div class="menuright">
   <div class="ensupport">      
      <div class="rg_img">
      <a href="<?php echo pzk_config('support_vn_link')?>">
        <img  src="/Default/skin/nobel/media/2.png" width="250" height="380" alt="">
      </a>
      </div>
      <div class="rg_btt3">
        <button type="submit" class="rg_button3" onmouseover="tooltip.pop(this, '#demo2_tip', {sticky:true})">Hỗ trợ kỹ thuật</button>

      </div>
      <div style="display:none;">
            <div id="demo2_tip">
                <span class="title_tooltip">LIÊN HỆ TRỰC TIẾP VỚI CHÚNG TÔI</span> <br>
                <span class="img_tooltip" ><img src="<?php echo BASE_URL.'/Default/skin/nobel/test/media/icon-mobile.gif'; ?>" alt=""></span>
        <span class="txt_tooltip">Hotline 1: 0965.90.91.95</span><br>
        <span class="img_tooltip" ><img src="<?php echo BASE_URL.'/Default/skin/nobel/test/media/icon-mobile.gif'; ?>" alt=""></span>
                <span class="txt_tooltip">Hotline 2: {? echo pzk_config('vn_hotline')?}</span><br>
                <span class="img_tooltip" ><img src="<?php echo BASE_URL.'/Default/skin/nobel/test/media/Email.gif'; ?>" alt=""></span>
                <span class="txt_tooltip">Email: {? echo pzk_config('vn_email')?}</span>
                <br>
                <span class="img_tooltip"><a title="Hỗ trợ Skype " href="skype:{? echo pzk_config('vn_skype')?}?chat"><img src="<?php echo BASE_URL.'/Default/skin/nobel/test/media/icon-skype.gif'; ?>" alt=""></a>
                <a href="ymsgr:sendIM?{? echo pzk_config('vn_yahoo')?}" title="Hỗ trợ Yahoo"><img src="<?php echo BASE_URL.'/Default/skin/nobel/test/media/icon-ym.gif'; ?>" alt=""> </a> 
                </span>
                <span class="txt_tooltip">Chat với hỗ trợ kỹ thuật</span>
            </div>
        </div>
      <div class="rg_margin"></div>
      <div class="rg_btt4">

        <a style="position: relative;" href="<?=BASE_REQUEST?>/payment/bank2/2"><button type="submit" class="rg_button4 showpay">Mua sản phẩm</button></a>
        <div id="showtt">Sản phẩm sắp ra mắt trong thời gian tới</div>

      </div>

  </div>
</div>

<script>
    $('.showpay').mouseover(function(){
        $('#showtt').fadeIn();
    });
    $('.showpay').mouseout(function(){
        $('#showtt').fadeOut();
    });

</script>
<!--[if lte IE 8]> <style>.txt_img2{filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(
    src='/Default/skin/nobel/media/22.jpg',
    sizingMethod='scale');} </style><![endif]-->
