<style>
.achie-bxh{
	margin: 20px 0px;
}
</style>
<?php $data->displayChildren('[position=public-header]') ?>
<?php $data->displayChildren('[position=top-menu]') ?>

<div class="container">
	<div class='text-center'>
		<p class='achie-bxh'>
		<img src="/Themes/Songngu/skin/media/cup2.png" />
		<b>
			BẢNG THÀNH TÍCH THEO TUẦN
		</b>
		</p>
		<?php 
			$week = (int) date('W');
			$year = (int) date('Y');
			if($week > 1){
				$crurrentWeek = $week-1;
			}else{
				$crurrentWeek = 52;
				$year = $year - 1;
			}
			
			$filterWeek = $crurrentWeek;
			$filterYear = $year;
			if(pzk_session('weekAchievement')){
				$filterWeek = pzk_session('weekAchievement');
			}
			
			if(pzk_session('yearAchievement')){
				$filterYear = pzk_session('yearAchievement');
			}
			
			$orderBy = 'tree desc';
			if(pzk_session('sortAchievement')){
				$orderBy = pzk_session('sortAchievement');
			}
			$data->setweek($filterWeek);
			$data->setYear($filterYear);
			$data->setOrderBy($orderBy);
			
			$weekYear = $filterWeek.'-'.$filterYear;
			
		?>
		<div style="margin: 15px 0px;" class='item'>
			<div class='col-md-6 col-xs-12'>
			<b>Chọn xem bảng thành tích theo tuần: </b>
			</div>
			<div class='col-md-6 col-xs-12'>
			<select id='weekyear' class='form-control' onchange="window.location = '/home/filterAchievementByWeek?val='+this.value;">
				<?php 
				if($crurrentWeek < 52 && $year > 2016) { 
					$k = 52 - $crurrentWeek;
					for($week= 52-$k; $week <= 52; $week++){
						$yearvalue = $year - 1;
						?>
						<option value="<?php echo $week.'-'.$yearvalue;?>">Tuần <?php $date = startEndDateOfWeek($week-1, $year-1, 1); echo $week; echo ' ('.$date['startdate'].' đến '.$date['enddate'].')'; ?></option>
						<?php
						
					}
				} 
				?>
				<?php 
				$week = 1;
				if($year <= 2016){
					$week = 26;
				}
				for($week; $week <= $crurrentWeek; $week++){ ?>
				<option value="<?php echo $week.'-'.$year;?>">Tuần <?php $date = startEndDateOfWeek($week-1, $year, 1); echo $week; echo ' ('.$date['startdate'].' đến '.$date['enddate'].')'; ?></option>
				<?php } ?>
				<script>
					$('#weekyear').val('<?=$weekYear?>');
				</script>
			</select>
			</div>
		</div>
		<div style="margin-bottom: 15px;" class='item'>
			<div class='col-md-6 col-xs-12'>
			<b>Sắp xếp theo: </b>
			</div>
			<div class='col-md-6 col-xs-12'>
			<select id='hard' class='form-control'  onchange="window.location = '/home/sortAchievement?val='+this.value;">
				<option value='tree desc'>Mức độ chăm chỉ</option>
				<option value='flower desc'>Mức độ luyện tập hiệu quả</option>
				<option value='apple desc'>Kết quả làm bài thi</option>
			</select>
			<script>
				$('#hard').val('<?=$orderBy?>');
			</script>
			</div>
		</div>
		
		<?php 
			$cities = $data->getCities();
			$areacode = $data->getareacode();
			if(pzk_session('cityAchievement')){
				$areacode = pzk_session('cityAchievement');
			}
			
		?>
		
		<div class='well item'>	
			<div class='col-md-2 col-xs-12'>
			<label>Chọn tỉnh/thành phố: </label>
			<select id='cities' class='form-control'  onchange="return changeCity(this);">
				<option value="all">Chọn tỉnh/thành phố</option>
				<?php foreach($cities as $city){ ?>
				<option   value="<?=$city['id'];?>"><?=$city['name'];?></option>
				<?php } ?>
			</select>
			<script>
				$('#cities').val('<?=$areacode?>');
			</script>
			</div>
			
			
			
			<?php 
				$districts = $data->getAreaByParent($areacode);
				$districtActive = $data->getDistrict();
				if(pzk_session('districtAchievement')){
					$districtActive = pzk_session('districtAchievement');
				}
				
				
			?>
			<div class='col-md-2 col-xs-12'>
			<label>Chọn quận/huyện: </label>
			<select id='district' class='form-control'  onchange="return changeDistrict(this);">
				<option value='all'>Chọn quận/huyện</option>
				<?php foreach($districts as $district){ ?>
				<option   value="<?=$district['id'];?>"><?=$district['name'];?></option>
				<?php } ?>
			</select>
			<script>
				$('#district').val('<?= $districtActive; ?>');
			</script>
			</div>
			
			
			
			<?php 
				$schools = $data->getAreaByParent($districtActive);
				$schoolActive = $data->getSchool();
				if(pzk_session('schoolAchievement')){
					$schoolActive = pzk_session('schoolAchievement');
				}
				
			?>
			<div class='col-md-2 col-xs-12'>
			<label>Chọn trường: </label>
			<select id='school' class='form-control' onchange="return changeSchool(this);">
				<option value="all">Chọn trường</option>
				
				<?php foreach($schools as $school){ ?>
				<option   value="<?=$school['id'];?>"><?=$school['name'];?></option>
				<?php } ?>
			</select>
			<script>
				$('#school').val('<?= $schoolActive; ?>');
			</script>
			</div>
			
			
			<?php 
				$classActive = $data->getClass();
				if(pzk_session('classAchievement')){
					$classActive = pzk_session('classAchievement');
				}
			?>
			<div class='col-md-2 col-xs-12'>
			<label>Chọn khối: </label>
			<select onchange="return changeClass();" id='class' class='form-control' >
				<option value="all">Chọn khối</option>
				<?php for($i =3; $i<6; $i++) { ?>
				<option  value="<?=$i;?>">Lớp <?= $i; ?></option>
				<?php } ?>
				
			</select>
			<script>
				$('#class').val('<?= $classActive; ?>');
			</script>
			</div>
			
			<?php 
				if(pzk_session('classall') == 'all'){
					$classnameActive = '';
				}else{
					$classnameActive = $data->getClassname();
		
					if(pzk_session('classnameAchievement')){
						$classnameActive = pzk_session('classnameAchievement');
					}
				}
				
			?>
			<div class='col-md-2 col-xs-12'>
			<label for="testId">Tên lớp <span>(ví dụ: A1)</span></label>
			
			<input rel='0' value="<?php echo $classnameActive; ?>" id='classname' class='form-control' name='classname ' />
			
			</div>
			
			<br>
			<div onclick='return filterAchievement();' class="btn btn-success" >Lọc</div>
		
		</div>
		
	</div>
	
	
	 <div class='tiem'>
	
		<div>
			<?php 
			if($orderBy == 'tree desc'){
				$text = 'Đánh giá theo mức độ chăm chỉ';
			}elseif($orderBy == 'flower desc'){
				$text = 'Đánh giá theo mức độ luyện tập hiệu quả';
			}
			elseif($orderBy == 'apple desc'){
				$text = 'Đánh giá theo kết quả làm bài thi';
			}
			?>
			<h3 class="text-center robotofont"><?=$text;?></h3>
		</div>
		<?php 
		if(pzk_session('conditionAchievement')){
			$condition = pzk_session('conditionAchievement');
			if($condition == 'all'){
				$achievement = $data->getAchievemenAll();
			}else{
				$data->setConditionAchievement($condition);
				$achievement = $data->getAchievementByCondition();
			}
			
		}else{
			$data->setAreacode($areacode);
			$data->setDistrict($districtActive);
			$data->setSchool($schoolActive);
			$data->setClassId($classActive);
			$data->setClassName($classnameActive);
			$achievement = $data->getAchievementByClass();
		}
		
		if($achievement){ ?>
		<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
			<tr>
				<th>Xếp hạng</th>
				<th>Tên đăng nhập</th>
				
				<th><img style='width: 25px;' src='/Default/skin/nobel/test/Themes/Default/media/tree.png' />

				</th>
				<th><img style='width: 25px;' src='/Default/skin/nobel/test/Themes/Default/media/flower.png' /></th>
				<th><img style='width: 25px;' src='/Default/skin/nobel/test/Themes/Default/media/apple.png' /></th>
				<th>Tuần</th>
			</tr>
			</thead>
			<tbody>
			
				<?php 
				
					$i=1;
					foreach($achievement as $val){ ?>
						<tr>
							<td><?=$i?></td>
							<td><?php echo $val['username']; ?></td>
							<td><?php echo $val['tree']; ?></td>
							<td><?php echo $val['flower']; ?></td>
							<td><?php echo $val['apple']; ?></td>
							<td><?php $date = startEndDateOfWeek($filterWeek-1, $year, true); echo 'Tuần '.$filterWeek.'('.$date['startdate'].' đến '.$date['enddate'].')';?> </td>
						</tr>
						<?php
						$i++;
					}
				
				?>
			
			</tbody>
		</table>
		</div>
		<div class="alert alert-info">
		Xem kết quả học tập cụ thể của bạn 
		<?php if(pzk_session('username')){ ?>
		<a href="<?=BASE_URL;?>/profile/detail">Tại đây. </a> 
		<?php }else{ ?>
			<a onclick="return alert('Bạn phải đăng nhập mới xem được!')">Tại đây. </a> 
		<?php } ?>
		Nếu bạn chưa có tên trên bảng thành tích tuần này, bạn cần cố gắng để được xếp thứ hạng tuần sau! Chúc bạn thành công!<br><br>
		<b>* Chú ý :</b><br><br>
		<ul class="list-group">
				
					<li class='list-group-item list-group-item-info'>
						Thưởng cây (Đánh giá mức độ chăm chỉ của HS) : Dựa vào số câu luyện tập trong tuần học sinh đã làm. <br/>
						+ 50 đến 59 câu/1 tuần : Thưởng 1 cây.<br/>
						+ 60 đến 70 câu/ 1 tuần: Thưởng 2 cây.<br/>
						+ 70 đến 80 câu/ 1 tuần : Thưởng 3 cây.<br/>
						+ Trên 80 câu: Làm thêm 10 câu thưởng thêm 1 cây.<br/>
					</li>
					<li class='list-group-item list-group-item-info'>
					Thưởng hoa (Đánh giá mức độ luyện tập hiệu quả của HS): Dựa vào phần trăm số câu trả lời đúng trong các bài luyện tập mỗi tuần mà học sinh đã làm.<br/>
						+ 50 đến 69% câu trả lời đúng /1 tuần : Thưởng 1 bông hoa.<br/>
						+ 70 đến 79% câu trả lời đúng/1 tuần : Thưởng 2 bông hoa.<br/>
						+ 80 đến 100% câu trả lời đúng /1 tuần: Thưởng 3 bông hoa.<br/>
					</li>
					<li class='list-group-item list-group-item-info'>
					Thưởng hoa (Đánh giá kết quả làm đề luyện tập và đề kiểm tra toàn diện của HS): Dựa vào phần trăm số câu trả lới đúng ở các đề luyện tập và đề kiểm tra toàn diện trong tuần mà học sinh đã làm.<br/>
					+ 50 đến 69% câu trả lời đúng/ 1 tuần:  Thưởng 1 quả.<br/>
					+ 70 đến 79%  câu trả lời đúng : Thưởng 2 quả.<br/>
					+ 80 đến 100% câu trả lời đúng : Thưởng 3 quả.<br/>
					</li>
				
				</ul>
		</div>
		<?php }else { ?>
			<div class='alert alert-danger'>Chưa có đánh giá nào!</div>
		<?php } ?>
	
	</div>
	
</div>
<script>
	function changeCity(that) {
		provinceId = $(that).val();
		$('#school').find('option[value!="all"]').remove();
		$('#class').find('option[value!="all"]').remove();
		$('#classname').val('');
		$("#classname").attr( "rel", "all" );
		$.ajax({
            url: "/home/getDistrict2",
            type: "post",
            data: {
                provinceId : provinceId
            } ,
            success: function (response) {
                
               $("#district").html(response);
               
            }
        });     
	};
	
	
    
    function changeDistrict(that) {
        var districtId = $(that).val();
		$('#classname').val('');
		$('#class').find('option[value!="all"]').remove();
		$("#classname").attr( "rel", "all" );
        $.ajax({
            url: "/home/getSchool2",
            type: "post",
            data: {
                districtId : districtId
            } ,
            success: function (response) {
               $("#school").html(response);
               
            }
        });                                         
    };
	
	function changeSchool(that) {
        var school = $(that).val();
		$('#classname').val('');
		$("#classname").attr( "rel", "all" );
		size = $('#class option').size(); 
		if(size < 2) {
			selectValues = { "5": "Lớp 5", "4": "Lớp 4", "3": "Lớp 3" };
			$.each(selectValues, function(key, value) {   
				 $('#class')
					 .append($("<option></option>")
								.attr("value",key)
								.text(value)); 
			});      
		}			
    };
	function changeClass() {
		$('#classname').val('');
		$("#classname").attr( "rel", "all" );
	}
	
	$(document).ready(function(){
		$("#classname").keypress(function() {
		
			$("#classname").attr( "rel", "0" );
		
		});
		
		$("#classname").blur(function(){
			var valclassname = $(this).val();
			if(valclassname === ''){
				$("#classname").attr( "rel", "all" );
			}
			
		});
	});
	
	
   function filterAchievement(){
        var city = $("#cities").val();
        var district = $("#district").val();
        var school = $("#school").val();
        var classId = $("#class").val();
        var classname = $("#classname").val();
		var classall = $("#classname").attr("rel");
        $.ajax({
            url: '/home/setAreacode',
            type: 'post',
            data: {
                city : city,
                district : district,
                school   : school,
                classId    : classId,
                classname  : classname,
				classall: classall,
            },
            success : function(respone){
                window.location.reload();
               /*alert(respone)                ;*/
            }
        });

    };
   
</script>