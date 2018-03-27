
  
  <div class="bank_area">
     <div class="row">
    <h2 class="title-practice" >HƯỚNG DẪN MUA PHẦN MỀM FULL LOOK</h2>
  </div>

    <div class="pm_change">
      <span class="txt_bank_title" style="color: green;" > Bước 1. Bạn đăng ký tài khoản đăng nhập của mình <a id="nextnobelsLogin" href="javascript:void(0)" class="login_required" rel="/payment/bank" data-toggle="modal" data-target=".bs-example-modal-lg"><span style="color: red;" class="glyphicon glyphicon-star"></span><span style="color: red;">TẠI ĐÂY</span></a> </span> <br>
      <span class="txt_bank_title" style="color: green;" > Bước 2. Bạn có thể mua phần mềm theo 2 cách : </span> <br>
      <br>
      <span class="txt_bank_title" > 1. Nộp tiền trực tiếp tại văn phòng </span> <br>
      <span class="pm_change_detail" style="color: green; font-weight: bold;">({? echo pzk_config('name_office')?})</span>
       <br> <br>

      <span class="pm_change1">Địa chỉ : </span>
      <span class="pm_change_detail">{? echo pzk_config('address_office')?}</span>
      <br>

      <span class="pm_change1">Số điện thoại : </span>
      <span class="pm_change_detail">{? echo pzk_config('phone_office')?}</span>
      <br>

      <span class="pm_change1">Ghi chú : </span>
      <span class="pm_change_detail">{? echo pzk_config('note_office')?}</span>
      <br>
    </div>
    <div class="pm_change">
    <span class="txt_bank_title"> 2. Chuyển khoản ngân hàng</span> <br>
    <span class="pm_change_detail">(Nội dung chuyển khoản:{? echo pzk_config('bank_content1')?} )</span>
    </div>
    <div class="panel panel-default" >
    <div class="panel-heading" style="background: #bff9f7;">
        <h2 style="color: #0066b3; font-family:UTM Neo Sans Intel; text-align: center; font-weight: bold; font-size: 20px; margin: 4px 0px 10px 0px;">Danh sách các Ngân hàng</h2>
    </div>
    <table class="table table-hover" >
        
        <tr>
            <th>
                <div class="imgbank"><img src="/default/skin/test/media/bank/Agribank.jpg" width="136" height="75" alt=" {? echo pzk_config('bank_name1')?}"></div>
            </th>
            <th>
                <br>
                <span class="">Số tài khoản: </span>
                <span class="pm_change_detail">{? echo pzk_config('bank_number1')?}</span>
                <br>
                <span class="">Chủ tài khoản: </span>
                <span class="pm_change_detail">{? echo pzk_config('bank_user1')?}</span>
                <br>
                <span class="">Ngân hàng: </span>
                <span class="pm_change_detail">{? echo pzk_config('bank_name1')?}</span>
                <br>
                <span class="">Chi nhánh: </span>
                <span class="pm_change_detail">{? echo pzk_config('bank_place1')?}</span>
                <br>
            </th>
            
            
        </tr>
        <tr>
            <th>
                <div class="imgbank"><img src="/default/skin/test/media/bank/Vietcombank.jpg" width="136" height="75" alt=" {? echo pzk_config('bank_name1')?}"></div>
            </th>
            <th>
                <br>
                <span class="">Số tài khoản: </span>
                <span class="pm_change_detail">{? echo pzk_config('bank_number2')?}</span>
                <br>
                <span class="">Chủ tài khoản: </span>
                <span class="pm_change_detail">{? echo pzk_config('bank_user2')?}</span>
                <br>
                <span class="">Ngân hàng: </span>
                <span class="pm_change_detail">{? echo pzk_config('bank_name2')?}</span>
                <br>
                <span class="">Chi nhánh: </span>
                <span class="pm_change_detail">{? echo pzk_config('bank_place2')?}</span>
                <br>
            </th>
            
            
        </tr>
        <tr>
            <th>
                <div class="imgbank"><img src="/default/skin/test/media/bank/MBbanks.jpg" width="136" height="75" alt=" {? echo pzk_config('bank_name1')?}"></div>
            </th>
            <th>
                <br>
                <span class="">Số tài khoản: </span>
                <span class="pm_change_detail">{? echo pzk_config('bank_number3')?}</span>
                <br>
                <span class="">Chủ tài khoản: </span>
                <span class="pm_change_detail">{? echo pzk_config('bank_user3')?}</span>
                <br>
                <span class="">Ngân hàng: </span>
                <span class="pm_change_detail">{? echo pzk_config('bank_name3')?}</span>
                <br>
                <span class="">Chi nhánh: </span>
                <span class="pm_change_detail">{? echo pzk_config('bank_place3')?}</span>
                <br>
            </th>
        </tr>
        <tr>
            <th>
                <div class="imgbank"><img src="/default/skin/test/media/bank/BIDV.jpg" width="136" height="75" alt=" {? echo pzk_config('bank_name1')?}"></div>
            </th>
            <th>
                <br>
                <span class="">Số tài khoản: </span>
                <span class="pm_change_detail">{? echo pzk_config('bank_number4')?}</span>
                <br>
                <span class="">Chủ tài khoản: </span>
                <span class="pm_change_detail">{? echo pzk_config('bank_user4')?}</span>
                <br>
                <span class="">Ngân hàng: </span>
                <span class="pm_change_detail">{? echo pzk_config('bank_name4')?}</span>
                <br>
                <span class="">Chi nhánh: </span>
                <span class="pm_change_detail">{? echo pzk_config('bank_place4')?}</span>
                <br>
            </th>

        </tr>
        <tr>
            <th>
                <div class="imgbank"><img src="/default/skin/test/media/bank/vietinbank.jpg" width="136" height="75" alt=" {? echo pzk_config('bank_name1')?}"></div>
            </th>
            <th>
                <br>
                <span class="">Số tài khoản: </span>
                <span class="pm_change_detail">{? echo pzk_config('bank_number5')?}</span>
                <br>
                <span class="">Chủ tài khoản: </span>
                <span class="pm_change_detail">{? echo pzk_config('bank_user5')?}</span>
                <br>
                <span class="">Ngân hàng: </span>
                <span class="pm_change_detail">{? echo pzk_config('bank_name5')?}</span>
                <br>
                <span class="">Chi nhánh: </span>
                <span class="pm_change_detail">{? echo pzk_config('bank_place5')?}</span>
                <br>
            </th>
        </tr>
        <tr>
            <th>
                <div class="imgbank"><img src="/default/skin/test/media/bank/DongAbank.jpg" width="136" height="75" alt=" {? echo pzk_config('bank_name1')?}"></div>
            </th>
            <th>
                <br>
                <span class="">Số tài khoản: </span>
                <span class="pm_change_detail">{? echo pzk_config('bank_number6')?}</span>
                <br>
                <span class="">Chủ tài khoản: </span>
                <span class="pm_change_detail">{? echo pzk_config('bank_user6')?}</span>
                <br>
                <span class="">Ngân hàng: </span>
                <span class="pm_change_detail">{? echo pzk_config('bank_name6')?}</span>
                <br>
                <span class="">Chi nhánh: </span>
                <span class="pm_change_detail">{? echo pzk_config('bank_place6')?}</span>
                <br>
            </th>
        </tr>
    </table>

    
  </div>
  <div class="pm_change">
    <span class="txt_bank_title" style="color: green;" >Bước 3. Ghi chú</span> <br>
    <span class="" style="color: green;">1. </span>
    <span class="pm_change_detail">{? echo pzk_config('note1')?} </span> <br>
    <span class="" style="color: green;">2. </span>
    <span class="pm_change_detail">{? echo pzk_config('note2')?} </span> <br>
    <span class="" style="color: green;">3. </span>
    <span class="pm_change_detail">{? echo pzk_config('note3')?} </span>
  </div>
  
  </div>


  
  