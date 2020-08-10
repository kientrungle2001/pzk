<?php 
	$class = $data->getClass();
	$className = $data->getNameOfClass();
	$subject = $data->getSubject();
	$schoolYear = $data->getSchoolYear();
?>
<div class="container-fluid">
	<div class="well">
		<h2 class="text-center">TRANG QUẢN LÍ GIÁO VIÊN</h2>
		<div class="row">
			<div class="col-xs-12 col-md-6 text-center">
				<a class="btn btn-primary" href="/Admin_Home_Headmaster/student">
				<span class="glyphicon glyphicon-eye-open"></span> Quản lí học sinh
				</a>
			</div>
			<div class="col-xs-12 col-md-6 text-center">
				<a class="btn btn-primary" href="/Admin_Home_Headmaster/teacher">
				<span class="glyphicon glyphicon-eye-open"></span> Quản lí giáo viên</a>
			</div>
		</div>
	</div>	
	
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-md-2">
			<div class="panel panel-default">
				  <div class="panel-heading">Chọn nội dung</div>
				  <div class="panel-body">
						<div class="list-group">
						  
						  <a href="/Admin_Home_Headmaster/workComplete" class="list-group-item <?php if(pzk_request()->getAction() == 'workComplete'){ echo 'active';} ?>">Mức độ hoàn thành công việc</a>
						  <a href="/Admin_Home_Headmaster/listTeacher" class="list-group-item <?php if(pzk_request()->getAction() == 'listTeacher'){ echo 'active';} ?>">Danh sách giáo viên</a>
					
						</div>
				  </div>
			</div>
		</div>
		<div class="col-xs-12 col-md-10">
			<div class="panel panel-default">
			  <div class="panel-heading">
				<form method="post" action="">
					<div class="row">
						<div class="col-md-3 col-xs-12">
							Khóa 
							<select id="schoolYear" class="form-control" name="schoolYear">
								<option value="0">Chọn tất cả</option>
								<option value="2016">2016-2017</option>
								<option value="2017">2017-2018</option>
							</select>
						</div>
						<div class="col-md-3 col-xs-12">
							Khối
							<select id="grade"  onchange="chonkhoi(this);" class="form-control" name="class" >
								<option value="0">Chọn tất cả</option>
							<?php 
									for($i=1; $i <= 9; $i++){
								?>
								<option value="<?=$i;?>">Khối <?=$i;?></option>	
								<?php } ?>
							
							</select>
						</div>
						<div class="col-md-2 col-xs-12">	
							Lớp
							<input value="<?php echo $className ?>" class="form-control" name="className" />
						</div>
						
						<div class="col-md-2 col-xs-12">		
							Môn
							<div id="subject">
								<?php
									if($class){
										$subjects = _db()->select('*')->from('categories')->whereType('subject')->likeClasses('%,'.$class. ',%')->result();
										if($subjects){
											echo '<select id="subjects" class="form-control" name="subject">';
											echo '<option value="0">Chọn tất cả</option>';
											foreach($subjects as $val){
												$selected = '';
												if($val['id'] == $subject){
													$selected = 'selected';
												}
												echo '<option '.$selected.' value="'.$val['id'].'">'.$val['name'].'</option>';
											}
											echo '</select>';
										}	
									}
								?>
							</div>
						</div>
						
						<div class="col-md-2 col-xs-12">
							<br/> 
							<input class="btn btn-primary" type="submit" value="Gửi" />
						</div>
					</div>		
				</form>
			  </div>
			  <div class="panel-body">
				<?php $data->displayChildren('all') ?>
			  </div>
		</div>
			
		</div>
	</div>	
</div>


<script type="text/javascript">
	function chonkhoi(that){
		var grade = $(that).val();
		if(grade){
			$.ajax({
			  method: "POST",
			  url: "/Admin_Home_Headmaster/getSubject",
			  data: {grade: grade}
			})
			.done(function(data) {
				$('#subject').html(data);
			});
		}
	}
	$('#schoolYear').val('<?php echo $schoolYear ?>');
	$('#grade').val('<?php echo $class ?>');
	$('#subject').val('<?php echo $subject ?>');
</script>