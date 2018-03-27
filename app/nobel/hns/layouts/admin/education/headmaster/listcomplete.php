<?php 
$schoolYear = pzk_or($data->get('schoolYear'), pzk_request()->get('schoolYear'));
$grade = pzk_or($data->get('grade'), pzk_request()->get('grade'));
$nameOfClass = pzk_or($data->get('nameOfClass'), pzk_request()->get('nameOfClass'));
$classroom = _db()->select('*')->fromEducation_classroom()->whereSchoolYear($schoolYear)->whereGradeNum($grade)->whereClassName($nameOfClass)->result_one();
$allClasses = _db()->select('name')->fromEducation_class()->orderBy('name asc')->result();
$data->set('classroomId', $classroom['id']);

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
					<select id="grade" class="form-control" name="grade" >
						<option value="">Chọn tất cả</option>
					<?php 
							for($i=1; $i <= 9; $i++){
						?>
						<option value="<?=$i;?>">Khối <?=$i;?></option>	
						<?php } ?>
					
					</select>
				</div>
				<div class="col-md-2 col-xs-12">	
					Lớp
					<select id="nameOfClass" class="form-control" name="nameOfClass" >
						<option>Chọn lớp</option>
						{each $allClasses as $item}
							<option value="{item[name]}" >{item[name]}</option>
						{/each}
					</select>
				</div>
				
				
				
				<div class="col-md-2 col-xs-12">
					<br/> 
					<input class="btn btn-primary" type="submit" value="Gửi" />
				</div>
			</div>		
		</form>
	  </div>
	  <div class="panel-body">
			<?php
				$totalStudents = $data->countStudents();
				if($classroom){
			?>
		  
			<div id="classroom-{classroom[id]}" class="tab-pane">
			  <h3 class="text-center">Niên khóa {classroom[schoolYear]} Lớp {classroom[gradeNum]}{classroom[className]}</h3>
			  <?php	$subjects = $data->getSubjects($classroom['gradeNum']);	?>
			  <table class="table table-condense table-hovered">
				<tr>
				<td>&nbsp;</td>
				{each $subjects as $subject}
					<th>{subject[name]}</th>
				{/each}
				</tr>
				
				<?php 
					$pageNum = 5;
					$curentPage = 0;
					$totalPage = ceil(36/$pageNum);
					if(pzk_request()->get('page')){
						$curentPage = pzk_request()->get('page');
					}
					$tam = $curentPage*$pageNum;
					$max = ($curentPage*$pageNum+$pageNum);
					if($max > 36){
						$max = 36;
					}
					for($tam;  $tam < $max; $tam++){ 
						$week = $tam + 1;
				?>
				<tr>
				<th>Tuần {week}</th>
				{each $subjects as $subject}
					<td>
					<?php
					$totalDone = $data->countStudentHomework($schoolYear, $grade, $nameOfClass, $week, $subject['id']);
					$totalMarked = $data->countStudentHomeworkMarked($schoolYear, $grade, $nameOfClass, $week, $subject['id']);
					echo '<span class="btn btn-xs btn-danger">'. $totalDone.'</span> <span class="btn btn-xs btn-success">'.$totalMarked.'</span> <span class="btn btn-xs btn-warning">'.$totalStudents.'</span>';
					?>
					</td>
				{/each}
				</tr>
				<?php } ?>
			  </table>
			  
			  <nav aria-label="Page navigation">
				  <ul class="pagination">
					<?php for($i = 0; $i < $totalPage; $i++){ ?>
					<li class="<?php if($i == $curentPage) { echo 'active';} ?>"><a href="/Admin_Home_Headmaster/complete?schoolYear=<?=$schoolYear;?>&grade=<?=$grade;?>&nameOfClass=<?=$nameOfClass?>&page=<?=$i;?>"><?=$i+1?></a></li>
					
					<?php } ?>
				  </ul>
			  </nav>
			  
			  <div>
				<strong>Chú giải:</strong> <span class="btn btn-xs btn-danger">&nbsp;</span> Số học sinh đã làm, <span class="btn btn-xs btn-success">&nbsp;</span> Số bài đã chấm, <span class="btn btn-xs btn-warning">&nbsp;</span> Tổng số bài
			  </div>
			</div>
			<?php } ?>
	  </div>
</div>	  

<script type="text/javascript">
	
	$('#schoolYear').val({schoolYear});
	$('#grade').val({grade});
	$('#nameOfClass').val('<?=$nameOfClass;?>');
	
</script>
