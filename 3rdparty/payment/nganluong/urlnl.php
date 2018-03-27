<?php 
require('nganluong.php');
$nl= new NL_Checkout();
$return_url="http://google.com.vn";
$receiver="kieunghia.luckystar@gmail.com";
$transaction_info="";
$order_code="hd01";
$price=20000;
$url= $nl->buildCheckoutUrl($return_url, $receiver, $transaction_info, $order_code, $price);
echo($url);
 ?>