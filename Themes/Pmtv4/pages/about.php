<Block layout="home/content" page="lecture-page">
	<Block layout="cms/banner" />
	<Cms.Menu layout="cms/menu" parentMode="true" parentField="parent" parentId="0" />
	<Html.Container class="bgcolor-white">
		<Html.Row>
			<Html.Col size="12">
				<H1 class="text-center">Hướng dẫn mua sản phẩm</H1>
				<Div class="bottom-20">

				  <!-- Nav tabs -->
				  <Ul class="nav nav-tabs nav-justified nav-pills" role="tablist">
					<Li role="presentation" class="active"><A class="btn-success" href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Nộp tiền tại văn phòng</A></Li>
					<Li role="presentation"><A class="btn-success" href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Chuyển khoản ngân hàng</A></Li>
					<Li role="presentation"><A class="btn-success" href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">Thẻ cào điện thoại</A></Li>
					<Li role="presentation"><A class="btn-success" href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab">Thẻ cào Happy Way</A></Li>
					<Li role="presentation"><A class="btn-success" href="#tab6" aria-controls="tab6" role="tab" data-toggle="tab">Đặt mua thẻ cào</A></Li>
				  </Ul>

				  <!-- Tab panes -->
				  <Div class="tab-content table-bordered padding-20">
					<Div role="tabpanel" class="tab-pane active" id="tab1"><Ecommerce.Payment.Money position="money" layout="payment/money"/></Div>
					<Div role="tabpanel" class="tab-pane" id="tab2"><Ecommerce.Payment.Bank position="bank" layout="payment/bank"/></Div>
					<Div role="tabpanel" class="tab-pane" id="tab3"><Ecommerce.Payment.Paycard position="paycard" layout="payment/paycard"/>
					<Ecommerce.Service.Service position="service" layout="service/service"/>
					</Div>
					<Div role="tabpanel" class="tab-pane" id="tab4"><Ecommerce.Payment.Paycardflsn position="paycardflsn" layout="payment/paycardflsn"/>
					</Div>
					<Div role="tabpanel" class="tab-pane" id="tab6"><Ecommerce.Service.Ordercardsn position="ordercardflsn" layout="service/ordercardsn"/></Div>
				  </Div>

				</Div>
				
			</Html.Col>
		</Html.Row>
	</Html.Container>
</Block>