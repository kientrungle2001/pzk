<div id="pay_card_moblie">
  <div class="layout_title"> NẠP THẺ ĐIỆN THOẠI</div>
  <div class="prf_clear"></div>
  <div class="note">
    - Giá trị thẻ nạp của bạn sẽ được chuyển đổi tương ứng thành đồng. <br>
    - Bạn có thể dùng số đồng trong tài khoản để mua các gói chấm. <br>
    
    - Không nên cho người khác mượn tài khoản để học để tránh sự cố xảy ra <br> <br>
    
  </div>
  <div class="pm_change">
  	<span class="pm_change1"> Giá trị quy đổi: </span>
  	<span class="pm_change2"> 10.000 VNĐ  </span><span>giá trị thẻ nạp sẽ đổi được</span>
  	<span class="pm_change3">10.000đ</span>
  </div>
  <div class="clear"></div>
  <div class="pay_card">
  <div id="pm_result_ok"></div>
  <div id="pm_result_fail"></div>
  <div class="paycard_nextnobels">
    
    <div class="pm_paycard_title">Nạp thẻ điện thoại</div>
    <div class="pm_paycard_content">
        <form id="paycardForm" class="login form-horizontal" onsubmit="return pzk_{data.id}.paycard();" method="post">
              <div class="form-group margin-top-10">
                
                <div class="col-xs-10 control-group margin-top-20" >
                  <div class="pm_label">
                    <label for="name">Chọn nhà mạng :</label> <span class="validate">(*)</span>
                  </div>
                  <div class="pm_text">
                    <select id="pm_typecard" class="form-control" name="pm_typecard" data-toggle="tooltip" data-placement="top" title="Lựa chọn nhà mạng">
                    <option value="VIETTEL" class="pd-5">VIETTEL</option>
                    <option value="VINA" class="pd-5">VINAPHONE</option>
                    <option value="MOBILE" class="pd-5">MOBILEPHONE</option>
                    <option value="GATE" class="pd-5">GATE</option>
                    <option value="VCOIN" class="pd-5">VCOIN</option>
                  </select>
                  </div>
                  
                </div>
                <div class="clearfix"></div>
                <div class="col-xs-10 control-group margin-top-10">
                  <div class="pm_label">
                   <label for="name">Mã số thẻ :</label> <span class="validate">(*)</span> 
                  </div>
                  <div class="pm_text">
                    <input type="text" class="form-control" id="pm_txt_pincard" name="pm_txt_pincard" placeholder="Mã thẻ">
                  </div>
                  
                </div>
                <div class="clearfix"></div>
                <div class="col-xs-10 control-group margin-top-10">
                  <div class="pm_label">
                    <label for="name">Số serial thẻ :</label> <span class="validate">(*)</span>
                  </div>                  
                  <div class="pm_text">
                    <input type="text" class="form-control" id="pm_txt_serialcard" name="pm_txt_serialcard" placeholder="Serial thẻ">
                  </div>                  
                </div>
                <div class="clearfix"></div>
                <div class="col-xs-10 margin-top-20" style="padding-left: 257px;">
                  <button type="submit" id="btt_paycard_mobile" class="btn btn-primary">Nạp thẻ</button>
                </div>
            </div>
  </form>
        
    </div>

  </div>
  </div>
</div>
