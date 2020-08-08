<?php 
	$user = pzk_user();
	$userId=pzk_session()->getUserId();
	$dateVip= $user->CheckDate('1',$userId);
	$wallets=$user->getWallets($userId);
	$countInvi= $user->countInvitation();
	$showMess= $user->showMessage();
	$letter= $user->showLetter();
?>
<div class="prffriend_right">
	<div class="message1">
		<div class="mess_card">
			<span class="black1">Bạn còn</span>
			<span class="orange1">{dateVip}</span>
			<span class="black1"> là tài khoản </span>
			<span class="orange1">VIP</span>
			<div class="black1">
				Bạn đang có 
				<span class="green">{wallets}
					<sup>đ</sup>
				</span>
				trong tài khoản
			</div>
		</div>
		<div class="ac_card">
			<a target="blank" href="/service/ordercard" class="datmuathe"></a>
			<a target="blank" href="/payment/payment" class="napthe"></a>
		</div>
	</div>
	<div class="message1">
		<div class="mess_card"><span class="orange1"><span class="glyphicon glyphicon-star"></span>Thông báo mới</span></div>
		<div style="float: right !important;width:30%;" class="mess_card"><a href="javascript: void(0)" onclick="pzk_{data.id}.delAll('{userId}');"><span  class="orange1">Xoá tất cả các thông báo</span></a></div>
	</div>
	<div class="clear"></div>
	<div class="mess_conten">
		<div class="mess_title black1">Yêu cầu kết bạn</div>
		<div class="clear"></div>
		<div class="mess">
			<a target="blank" href="/invitation/list" title=""><span class="orange1">Bạn có {countInvi} lời mời kết bạn</span></a>
			
		</div>
		<div id="loadMess">
		<?php 
			foreach ($letter as $item) {
				if(isset($showMess[$item['code']])){
					$showDetails= $user->showDetailMess($item['code']);
			

		?>
		<div class="clear"></div>
		<div id="mess{item[code]}">
			<div class="mess_title black1">{item[subject]}</div>
			<div  class="del_message">
				<a onclick="pzk_{data.id}.delOne('{userId}','{item[code]}');" href="javascript: void(0)">Xoá thông báo</a>
			</div>
			<div class="clear"></div>
			{each $showDetails as $showDetail}
			<?php 
				$showContent=$user->showContent($showDetail['messageType'],$showDetail['trophies'],$showDetail['amount'],$item['body'],$showDetail['userBookId'],$showDetail['serviceId']);	 ?>
			
			<div class="mess">{showContent}</div>
			{/each}
		</div>
		<?php 
				} 
			}	
		?>
		</div>
	</div>
</div>