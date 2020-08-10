<div class="row">
  
    <div class="col-xs-12">
      <h4 class="text-uppercase">Thẻ cào Happy Way.</h4>
    </div>
    <div class="col-xs-12">
      <form id="paycardflsnForm"  onsubmit="return PostCard()" method="post">
            
            <div class="col-md-8  col-sm-8  col-xs-12">
              <label for="">Nhập mã thẻ:</label> <br>
              <input type="text" autocomplete="off" class="pm_paycard_input" id="flsncardId" name="flsncardId"  placeholder="Nhập mã thẻ">
            </div>
            <div class="clearfix"></div>
            <div class="col-md-8  col-sm-8  col-xs-12">
              <label for="">Nhập serial thẻ:</label> <br>
              <input type="text" autocomplete="off" class="pm_paycard_input" id="flsnserialcard" name="flsnserialcard"  placeholder="Nhập serial thẻ">
            </div>
            <div class="col-md-8 col-sm-8  col-xs-12">
                      <label for="captcha">Nhập mã bảo mật:</label>  <span class="validate">(*)</span>
                      <div class="row"> 
                        <div class="col-md-2 col-sm-2 col-xs-5 top3">
                          <img src="<?php echo "/3rdparty/captcha/random_image.php";  ?> "/>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-7">
                          <input  type="text" autocomplete="off" class="pm_paycard_input" id="captcha" style="width: 237px;" name="captcha" placeholder="Nhập mã bảo mật" value=""/>
                        </div>
                      </div>
            </div>
            <div class="clearfix"></div>
            <div id="resultOk"></div>
            <div class="clearfix"></div>
            <div class="top20 left20">
              <input type="submit"  class="btn btn-danger" value=" NẠP THẺ">
            </div>
      </form>
    </div>
<script>
  function PostCard()
  {
    var user= "<?php echo pzk_session('username'); ?>";
    if(user==''){
      alert('Bạn phải đăng nhập mới được nạp thẻ');
      return false;
    }
    pzk_<?php echo @$data->id?>.paycardflsn();
  }
</script>
</div>