<Block id="about" layout="home/about">
	<Block layout="detail/songnguheader" position="public-header" />
	<Fulllook.Menu table="tests" cacheable="true" cacheParams="layout" layout="detail/topmenu"  position="top-menu" scriptable="false" />
	<Ecommerce.Payment.Money position="money" layout="ecommerce/payment/money"/>
	<Ecommerce.Payment.Bank position="bank" layout="ecommerce/payment/bank"/>
	<Ecommerce.Payment.Paycard position="paycard" layout="ecommerce/payment/paycard"/>
	<Ecommerce.Payment.Paycardflsn position="paycardflsn" layout="ecommerce/payment/paycardflsn"/>
	<Ecommerce.Service.Service position="service" layout="ecommerce/service/service"/>
	<Ecommerce.Service.Ordercardsn position="ordercardflsn" layout="ecommerce/service/ordercardsn"/>
</Block>