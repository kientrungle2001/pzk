<?php
$listStudents = $data->getStudents();
$className = $data->get('className');
$schoolYear = $data->get('schoolYear');
$class = $data->get('class');
?>
<div class="panel panel-default">
	  <div class="panel-heading">
		<form method="post" action="">
			<div class="row">
				<div class="col-md-2 col-xs-12">
					Khóa 
					<select id="schoolYear" class="form-control" name="schoolYear">
						<option value="0">Chọn tất cả</option>
						<option value="2016">2016-2017</option>
						<option value="2017">2017-2018</option>
					</select>
				</div>
				
				<div class="col-md-2 col-xs-12">
					Khối
					<select id="classes" class="form-control" name="class" >
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
					<input value="{className}" class="form-control" name="className" />
				</div>
				<div class="col-md-2 col-xs-12">
					<br/> 
					<input class="btn btn-primary" type="submit" value="Gửi" />
				</div>
			</div>		
		</form>
	  </div>
	  <div class="panel-body">
		<?php if($listStudents){ ?>
			<h2 class="text-center">Danh sách học sinh</h2>
			<table class="table table-bordered  table-hovered">
				<tr>
					<th>ID</th>
					<th>Tên đăng nhập</th>
					<th>Họ và tên</th>
					<th>Ngày sinh</th>
				</tr>
			{each $listStudents as $student}
				<tr>
					<td>{student[id]}</td>
					<td>{student[username]}</td>
					<td>{student[name]}</td>
					<td>{? echo date('d/m/Y', strtotime($student['birthday']))?}</td>
				</tr>
			{/each}
			</table>
		<?php } ?>	
	  </div>
</div>
<script>
	$('#schoolYear').val('{schoolYear}');
	$('#classes').val('{class}');
</script>	  
