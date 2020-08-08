
  <link rel="stylesheet" media="screen" href="screen.css">
  <style>
      label 
      {
        width:200px;
      }
      input[type="radio"] {
        
          margin-bottom: 10px;
          width: 17px;
      }
       #formPayment label.error 
    {

        display: inline;
        color: red;
        font-style: italic;
        font-size: 12px;
         font-weight: normal;

    }
      #ttNganluong {
    background: url("http://ptnn.vn/default/images/thecao/napthe.png") no-repeat scroll 0 0 transparent;
    border: 0 none;
    cursor: pointer;
    display: inline-block;
    height: 30px;
    
    text-indent: -3000px;
    vertical-align: middle;
    width: 122px;
}
    </style>

<?php 
// Nạp tiền qua cổng thanh toán Ngân Lượng
    require(BASE_DIR.'/3rdparty/nganluong/include/nganluong.microcheckout.class.php');
    require(BASE_DIR.'/3rdparty/nganluong/include/lib/nusoap.php');
    require(BASE_DIR.'/3rdparty/nganluong/config.php');
    $inputs = array(
    'receiver'    => RECEIVER,
    'order_code'  => 'username : '.pzk_session()->getUsername().'DH : '.date('His-dmY'),
    'return_url'  => 'http://ptnn.vn/user/payment',
    'cancel_url'  => 'http://ptnn.vn/user/payment',
    'language'    => 'vn'
    );
    $link_checkout = '';
    $obj = new NL_MicroCheckout(MERCHANT_ID, MERCHANT_PASS, URL_WS);
    $result = $obj->setExpressCheckoutDeposit($inputs);

    if ($result != false) 
    {
      if ($result['result_code'] == '00') 
      {
        $token_key = $result['token'];
        $link_checkout = $result['link_checkout'];
        $link_checkout = str_replace('micro_checkout.php?token=', 'index.php?portal=checkout&page=micro_checkout&token_code=', $link_checkout);
        $link_checkout .='&payment_option=nganluong';

      } 
      else 
      {
        die('Ma loi '.$result['result_code'].' ('.$result['result_description'].') ');
      }
    }
    else
    {
    die('Loi ket noi toi cong thanh toan ngan luong');
    }
 ?> 
</head>
    <div style="border-width: 1px;border-style: solid; border-color: #FF7357;  width:100%; ">
    <div> 
    <p align="center"><strong> Nạp Tiền</strong></p>
    </div> 
    <form method="post" id="formPayment" action="" >
     <br> 
     
      <label for="">Hình thức nạp tiền</label>
      <br>
      <input type="radio" id="payment_nganluong" name="payment_option" class="payment_option" value="nganluong" checked="checked">Nạp tiền qua cổng thanh toán Ngân Lượng<br>
     
      <input type="radio" id="payment_nextnobels" name="payment_option" class="payment_option" value="theocaonextnobels">Nạp tiền dùng thẻ của Nextnobels<br>
    
    <label for="">&nbsp;</label>

    
      <button type="button" name="btt_nganluong" id="btt_nganluong" >Nạp tiền</button>
      <button type="button" name="btn_payment" id="btn_payment" >Nạp tiền</button>
<script language="javascript" src="/3rdparty/nganluong/include/nganluong.apps.mcflow.js"></script>
<script language="javascript">

//var mc_flow = new NGANLUONG.apps.MCFlow({trigger:'btn_payment',url:'<?php echo @$link_checkout;?>'});
 var mc_flow = new NGANLUONG.apps.MCFlow({trigger:'btt_nganluong',url:'<?php echo @$link_checkout;?>'});
    $('#btn_payment').hide();
    $('input:radio[name=payment_option]').click(function()
    {
       //alert('hihi');
      //var mc_flow = new NGANLUONG.apps.MCFlow({trigger:'btn_payment',url:'<?php echo @$link_checkout;?>'});
      if($('input:radio[name=payment_option]:checked').val() != "nganluong")
      {

        $('#btn_payment').show();
         $('#btt_nganluong').hide();
       
      }
      else
      {
         $('#btn_payment').hide();
         $('#btt_nganluong').show();
        
      }
    }); 
    $('#btt_nganluong').click(function(){
      // gửi lên hệ thống
      $.ajax({url:'http://ptnn.vn/user/PostPaymentNL',data:{username: '<?php echo pzk_session()->getUsername(); ?>', code: '<?php echo $token_key;  ?>'}, success:function(resp){alert(resp);}});
      

    });
  
</script>
  </form>
<form name="napthe" action="/User/paycardPost" method="post">
<div  style="border: 1px solid #444444;  margin: 0 auto;  padding: 10px;  width:100%;">
<div style="color:#444444;margin-top:10px;font-size:14px" align="center">
  Nạp thẻ cào điện thoại
</div>

<table align="center">
  
  <tr>
      <td colspan="3">
          <table>
              <tr>
          <td style="padding-left:0px;padding-top:5px" align="right" ><img  src="http://ptnn.vn/default/images/thecao/mobifone.jpg" /></td>
                    <td style="padding-left:10px;padding-top:5px"><img  src="http://ptnn.vn/default/images/thecao/vinaphone.jpg" /></td>
                     <td style="padding-top:5px;padding-left:5px" align="left"><img  src="http://ptnn.vn/default/images/thecao/viettel.jpg" width="100" height="35" /></td>
                     <td style="padding-top:5px;padding-left:5px" align="left"><img width="100" height="35" src="http://ptnn.vn/default/images/thecao/vtc.jpg"></td>
                     <td style="padding-top:5px;padding-left:5px" align="left"><img width="100" height="35" src="http://ptnn.vn/default/images/thecao/gate.jpg"></td>
                </tr>
                <tr>
          <td align="center" style="padding-bottom:0px;">
                        <input type="radio" name="typecard" checked="true" value="VMS" id="92"  />
                    </td>
                    <td align="center" style="padding-bottom:0px;padding-left:5px">
                        <input type="radio"  name="typecard" value="VNP" id="93" />
                    </td>
                     <td align="center" style="padding-bottom:0px;padding-right:0px">
                        <input type="radio"  name="typecard" value="VIETTEL" id="107" />
                    </td>
                    <td align="center" style="padding-right:10px">
            <input type="radio" id="121" value="VCOIN" name="typecard">
          </td>
          
                    <td align="center" style="padding-bottom:0px;padding-right:0px">
                         <input type="radio" id="120" value="GATE" name="typecard">
                    </td>
          
                </tr>
            </table>
        </td>
    </tr>
    
    <tr>
        <td align="right" style="padding-bottom:10px">Số Seri :</td>
        <td colspan="2"><input type="text" id="txtSeri" name="txtSeri" style="height:25px;width:200px" /></td>
    </tr>
     <tr>
        <td align="right">Mã số thẻ : </td>
        <td colspan="2">
          <input type="text" id="txtPin" name="txtPin" style="height:25px;width:200px" />
            
        </td>
    </tr>
   
  <tr>
        <td colspan="3" align="center" style="padding-top:10px;padding-right:20px;">
        <input type="submit" id="ttNganluong" name="NLNapThe" value="Nạp Thẻ"  /> 
     </td>
    </tr> 
</table>

</div>
</form>
  </div>

