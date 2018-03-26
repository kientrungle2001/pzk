<Block id="pay_sn" layout="home/payment">
	<Block layout="detail/songnguheader" position="public-header" />
	<Fulllook.Menu table="tests" cacheable="true" cacheParams="layout" layout="detail/topmenu"  position="top-menu" scriptable="false" />
	<Ecommerce.Payment.Paycardflsn position="paycardflsn" layout="ecommerce/payment/paycardflsn"/>
	<Ecommerce.Service.Ordercardsn position="ordercardflsn" layout="ecommerce/service/ordercardsn"/>
</Block>