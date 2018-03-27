<div class="bank_area">

	<div class="content">
		
			<h3 class="ptnn-color-title text-center" >HƯỚNG DẪN MUA PHẦN MỀM FULL LOOK</h3>	
			<p><span class="ptnn-color-title font-title-20"> Bước 1 :</span> Bạn đăng ký tài khoản đăng nhập của mình <a id="nextnobelsLogin" href="javascript:void(0)" class="login_required" rel="/payment/bank" data-toggle="modal" data-target=".bs-example-modal-lg"><span style="color: red;" class="glyphicon glyphicon-star"></span><span style="color: red;">TẠI ĐÂY</span></a> </p>
	      	<p><span class="ptnn-color-title font-title-20"> Bước 2 :</span> Bạn có thể mua phần mềm theo 2 cách : </p>
			<ul class="pd-left-10 method-payment">
				
			   	<li class="pd-left-10">	
			    	<h5> 1. Thanh toán bằng chuyển khoản ngân hàng :</h5>
			    	<h5><i class="ptnn-color-title"> Chú ý: </i></h5>
			     	<ul class="pd-left-20">
					    <li>  {? echo pzk_config('note1')?} </li>
					    <li>  {? echo pzk_config('note2')?} </li>
					    <li>  {? echo pzk_config('note3')?} </li>
				    </ul> 
			    	<div class="bank-transfer">
			            <span class="bank_icon bank_vietcombank"></span>
			            <ul>
			            	<li><span class="bank-name ptnn-color-title">Ngân hàng {? echo pzk_config('bank_name2')?}</span> </li>
			                <li><label>Số tài khoản: </label>  <b>{? echo pzk_config('bank_number2')?}</b> </li>
			                <li><label>Chủ tài khoản: </label>  <span style="text-transform: uppercase;">{? echo pzk_config('bank_user2')?}</span>  </li>
			                <li><label>Chi nhánh: </label> <b>{? echo pzk_config('bank_place2')?}</b> </li>
			            </ul>
			        </div>
			        <div class="bank-transfer">
			            <span class="bank_icon bank_viettinbank"></span>
			            <ul>  
			            	<li> <span class="bank-name ptnn-color-title">Ngân hàng {? echo pzk_config('bank_name5')?}</span></li>
			            	<li> <label>Số tài khoản: </label> <b>{? echo pzk_config('bank_number5')?}</b></li>
			                <li> <label>Chủ tài khoản: </label><span style="text-transform: uppercase;">{? echo pzk_config('bank_user5')?}</span></li>
			               	<li> <label>Chi nhánh: </label> <b>{? echo pzk_config('bank_place5')?}</b> </li>
			            </ul>
			        </div>
			    	<div class="bank-transfer">
			           	<span class="bank_icon bank_agribank"></span>
			            <ul>
			            	<li><span class="bank-name ptnn-color-title">Ngân hàng {? echo pzk_config('bank_name1')?}</span> </li>
			                <li><label>Số tài khoản: </label> <b>{? echo pzk_config('bank_number1')?}</b> </li>
			                <li><label>Chủ tài khoản: </label> <span style="text-transform: uppercase;">{? echo pzk_config('bank_user1')?}</span> </li>
			                <li><label>Chi nhánh: </label> <b>{? echo pzk_config('bank_place1')?}</b> </li>
			            </ul>
			        </div>
			        <div class="bank-transfer"> 
			        	<span class="bank_icon bank_mb"></span>
			            <ul>
			            	<li><span class="bank-name ptnn-color-title">Ngân hàng {? echo pzk_config('bank_name3')?}</span> </li>
			                <li><label>Số tài khoản: </label> <b>{? echo pzk_config('bank_number3')?}</b> </li>
			                <li><label>Chủ tài khoản: </label> <span style="text-transform: uppercase;">{? echo pzk_config('bank_user3')?}</span> </li>
			                <li><label>Chi nhánh: </label><b>{? echo pzk_config('bank_place3')?}</b> </li>
			            </ul>
			        </div>
			        <div class="bank-transfer">
			            <span class="bank_icon bank_bidv"></span>
			           	<ul>
			           		<li> <span class="bank-name ptnn-color-title"> Ngân hàng{? echo pzk_config('bank_name4')?}</span></li>
			                <li> <label>Số tài khoản: </label> <b>{? echo pzk_config('bank_number4')?}</b> </li>
			                <li> <label>Chủ tài khoản: </label><span style="text-transform: uppercase;">{? echo pzk_config('bank_user4')?}</span></li>
			                <li> <label>Chi nhánh: </label> <b>{? echo pzk_config('bank_place4')?}</b></li>
			            </ul>
					</div> 
			        <div class="bank-transfer">
			        	<span class="bank_icon bank_dongabank"></span>
			            <ul>  
			            	<li> <span class="bank-name ptnn-color-title">Ngân hàng {? echo pzk_config('bank_name6')?}</span></li>
			                <li> <label>Số tài khoản: </label> <b>{? echo pzk_config('bank_number6')?}</b></li>
			                <li> <label>Chủ tài khoản: </label> <span style="text-transform: uppercase;">{? echo pzk_config('bank_user6')?}</span></li>
			                <li> <label>Chi nhánh: </label> <b>{? echo pzk_config('bank_place6')?}</b></li>
				       	</ul>
				  	</div>
				</li>
				<li class="pd-left-10">
			      	<h5> 2. Thanh toán tại văn phòng Nextnobels :</h5>
			      	<ul class="pd-left-10 method-payment">
				      	<li><i>({? echo pzk_config('name_office')?})</i></li> 
				      	<li><b>Địa chỉ : </b> {? echo pzk_config('address_office')?} </li> 
				      	<li><b>Số điện thoại : </b>{? echo pzk_config('phone_office')?}</li>
				      	<li><b>Ghi chú : </b>{? echo pzk_config('note_office')?}</li>
					</ul> 
			   	</li>
	     	</ul>
	     	
	</div>
</div>


  
  