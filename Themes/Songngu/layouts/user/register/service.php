<?php 
	$serviceName= $data->get('serviceName');
	if($serviceName == 'classroom'){
 ?>
<div class="col-md-4 col-md-offset-2  top10 ">
		<label for="name">Quận/Huyện</label> <span class="validate">(*)</span>							    		
	<select id="district" onchange="mySchool()" class="form-control sharp" title="Chọn Quận/Huyện" name="district" aria-label="Quận/ Huyện" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
		
	</select>
</div>
<div class="col-md-4 top10 ">
		<label for="name">Chọn Trường</label> <span class="validate">(*)</span>
	<select id="school" class="form-control sharp" title="Chọn Trường" name="school" aria-label="Trường" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
		
	</select>
</div>
<div class="clearfix "></div>
<div class="col-md-4 col-md-offset-2 top10 ">
		<label for="name">Chọn Khối Lớp</label> <span class="validate">(*)</span>
	<select id="selectclass" class="form-control sharp" title="Chọn Lớp" name="selectclass" aria-label="Lớp" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
		<option value="" disabled="disabled" checked>Chọn khối lớp</option>
		<option value="5">Lớp 5</option>
		<option value="4">Lớp 4</option>
		<option value="3">Lớp 3</option>
		<option value="2">Lớp 2</option>
		<option value="1">Lớp 1</option>
	</select>
</div>
<div class="col-md-4  top10 ">
		<label for="classname">Tên lớp (ví dụ: A1) :</label> <span class="validate">(*)</span>
	<input type="text" class="form-control sharp" id="classname" name="classname" placeholder="Tên lớp" data-toggle="tooltip" data-placement="top" title="Tên lớp">
</div>
<script>$("#register_captcha").addClass('col-md-offset-2');</script>
<?php }else{ ?>
<div class="col-md-4 col-md-offset-2 top10 ">
		<label for="name">Chọn Khối Lớp</label> <span class="validate">(*)</span>
	<select id="selectclass" class="form-control sharp" title="Chọn Lớp" name="selectclass" aria-label="Lớp" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
		<option value="" checked>Chọn khối lớp</option>
		<option value="5" >Lớp 5</option>
		<option value="4">Lớp 4</option>
		<option value="3">Lớp 3</option>
		<option value="2">Lớp 2</option>
		<option value="1">Lớp 1</option>
	</select>
</div>
<script>$("#register_captcha").removeClass('col-md-offset-2');</script>
<?php } ?>
<script>
	function mySchool() {
		    var districtId = $("#district").val();
		    $.ajax({
		        url: "/home/getSchool",
		        type: "post",
		        data: {
		        	districtId : districtId
		        } ,
		        success: function (response) {
		           $("#school").html(response);
		           
		        }
			});										    
		}
</script>