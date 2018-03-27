<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Test ket noi ngan luong</title>
</head>
<body>
<table border="1" cellpadding="10" cellspacing="0" width="600">
	<tr><td colspan="2"><h1>Lựa chọn quy trình test</h1></td></tr>
	<tr>
		<td width="300"><a href="cart.php"><strong>Test quy trình thanh toán giỏ hàng</strong></a></td>
		<td><a href="deposit.php"><strong>Test quy trình nạp tiền</strong></a></td>
	</tr>
	
	
</table>
<input type='submit' id="btn_payment" value='Đặt mua hàng' name='submit' class='btn btn-warning btn-large purchase'/>
<script language="javascript" src="http://mobishop.vn/wp-content/plugins/wp-e-commerce/wpsc-theme/include/nganluong.apps.mcflow.js"></script>
		<script language="javascript">
			var mc_flow = new NGANLUONG.apps.MCFlow({trigger:'btn_payment',url:'https://www.nganluong.vn/micro_checkout.php?token=1150475-c7cd2fe0f2bab8e5b678861c92384d83'});
		</script>
<div class="center">
	<script language="javascript">
	(function() {
		// Localize jQuery variable
		var jQuery;

		/******** Load jQuery if not present *********/
		if (window.jQuery === undefined || window.jQuery.fn.jquery !== '1.4.2') {
			var script_tag = document.createElement('script');
			script_tag.setAttribute("type","text/javascript");
			script_tag.setAttribute("src",
				"http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js");
			if (script_tag.readyState) {
			  script_tag.onreadystatechange = function () { // For old versions of IE
				  if (this.readyState == 'complete' || this.readyState == 'loaded') {
					  scriptLoadHandler();
				  }
			  };
			} else { // Other browsers
			  script_tag.onload = scriptLoadHandler;
			}
			// Try to find the head, otherwise default to the documentElement
			(document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
		} else {
			// The jQuery version on the window is the one we want to use
			jQuery = window.jQuery;
			main();
		}

		/******** Called once jQuery has loaded ******/
		function scriptLoadHandler() {
			// Restore $ and window.jQuery to their previous values and store the
			// new jQuery in our local jQuery variable
			jQuery = window.jQuery.noConflict(true);
			// Call our main function
			main(); 
		}

		/******** Our main function ********/
		function main() { 
			jQuery(document).ready(function($) { 
			/******* Load CSS *******/
				var css_link = $("<link>", { 
					rel: "stylesheet", 
					type: "text/css", 
					href: "http://media.ichodientuvn.com/webskins/skins/global_new/styles/print.css" 
				});
				css_link.appendTo('head');          

				/******* Load HTML *******/
				var jsonp_url = "http://al.smeuh.org/cgi-bin/webwidget_tutorial.py?callback=?";
				$.getJSON(jsonp_url, function(data) {
				  $('#example-widget-container').html("This data comes from another server: " + data.html);
				});
			});
		}

		})(); // We call our anonymous function immediately
	</script>
	
	<div id="example-widget-container"></div>
	
	
	<?PHP
	$md5 = '15899'.'diendc@peacesoft.net'.'CND2BQ70000002917'.'17000'.'vnd'.'15983-5c4095b85d4d92378d3562b1521550d5'.'773fd05f98';
	echo md5($md5);
	echo '<br/>';
	echo md5('CardCharge');
	
	$request='&title=title';
	$request .='&price=1000000';
	$request .='&quantity=1';
	$request .='&shipping=0';
	$request .='&receiver=hoantx@nganluong.vn';
	$request .='&product_id=product_id';
	$request .='&product_name=Tên sản phẩm';
	$request .='&return_url=htpp://nganluong.vn';
	$url='http://beta.nganluong.vn/?portal=checkout&page=checkout_express'.$request;
    	
	?>
	<h3>Yêu cầu nạp tiền</h3>
	<script type="text/javascript" src="tinybox.js"></script>
	<input class="button" type="button" value="Thanh toán" onclick="TINY.box.show({iframe:'<?php echo $url?>',close:0,boxid:'frameless',width:810,height:550,fixed:true,maskid:'bluemask',maskopacity:40})" />

	
	<style>
		.tbox {position:absolute; display:none; padding:14px 17px; z-index:900}
		
		.tmask {position:absolute; display:none; top:0px; left:0px; height:100%; width:100%; background:#000; z-index:800}
		.tclose {position:absolute; top:0px; right:0px; width:30px; height:30px; cursor:pointer; background:url(images/close.png) no-repeat}
		.tclose:hover {background-position:0 -30px}
	</style>
	
</body>
</html>