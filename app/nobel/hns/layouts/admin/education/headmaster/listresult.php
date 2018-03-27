<?php 
$schoolYear = $data->get('schoolYear');
$week = $data->get('week');
$grade = $data->get('grade');
$nameOfClass = $data->get('nameOfClass');
$subject = $data->get('subject');
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
					Tuần
					<select id="week" class="form-control" name="week">
						<option value="0">Chọn tất cả</option>
						<?php 
							for($i=1; $i <= 36; $i++){
						?>
						<option value="<?=$i;?>">Tuần <?=$i;?></option>	
						<?php } ?>
					</select>
				</div>
				<div class="col-md-2 col-xs-12">
					Khối
					<select id="grade"  onchange="chonkhoi(this);" class="form-control" name="grade" >
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
						<option value="0">Chọn lớp</option>
						{each $allClasses as $item}
							<option value="{item[name]}">{item[name]}</option>
						{/each}
					</select>
				</div>
				
				<div class="col-md-2 col-xs-12">		
					Môn
					<div id="subject">
						<?php
							if($grade){
								$subjects = _db()->select('*')->from('categories')->whereType('subject')->likeClasses('%,'.$grade. ',%')->result();
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
		<?php
		if($schoolYear && $week && $grade){
			$totalPracticeByCategory = $data->getTotalPracticeByCategoryId();
			$allSubjects = $data->getSubject();
			$goodStudent = $data->getGoodSudent();
			$quiteStudent = $data->getQuiteSudent();
			$tbStudent = $data->getTbSudent();
			$yeuStudent = $data->getYeuSudent();
			//debug($allSubjects);
			//debug($totalPracticeByCategory);
			if($totalPracticeByCategory){
				echo '<table class="table table-bordered  table-hovered">';
					foreach($totalPracticeByCategory as $cateId => $all){
						echo '<tr>';
							echo '<td>';
								echo $allSubjects[$cateId];
							echo '</td>';
							echo '<td>';
								$centGood = $centQuite = $centTb = 0;
								if(isset($goodStudent[$cateId])){
									$centGood = $goodStudent[$cateId]/$all;
									$centGood = round($centGood, 2) * 100;
									echo '<div class="alert alert-success" role="alert">Số học sinh làm đúng trên 80%: '.$goodStudent[$cateId].'('.$centGood.'%)</div>';
								}
								if(isset($quiteStudent[$cateId])){
									$centQuite = $quiteStudent[$cateId]/$all;
									$centQuite = round($centQuite, 2) * 100;
									echo '<div class="alert alert-info" role="alert">Số học sinh làm đúng từ 70% đến 80%: '.$quiteStudent[$cateId].'('.$centQuite.'%)</div>';
								}
								if(isset($tbStudent[$cateId])){
									$centTb = $tbStudent[$cateId]/$all;
									$centTb = round($centTb, 2) * 100;
									echo '<div class="alert alert-warning" role="alert">Số học sinh làm đúng từ 50% đến 60%: '.$tbStudent[$cateId].'('.$centTb.'%)</div>';
								}
								if(isset($yeuStudent[$cateId])){
									$centYeu = 100 - ($centGood + $centQuite + $centTb);
									echo '<div class="alert alert-danger" role="alert">Số học sinh làm đúng dưới 50%: '.$yeuStudent[$cateId].'('.$centYeu.'%)</div>';
								}
							echo '</td>';
						echo '</tr>';
					}
				echo '</table>';
			}else{
				echo '<div class="alert alert-danger">Chưa có dữ liệu</div>';
			}
		}
		?>
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
	$('#schoolYear').val({schoolYear});
	$('#week').val({week});
	$('#grade').val({grade});
	$('#subject').val({subject});
	$('#nameOfClass').val('<?=$nameOfClass;?>');
</script>
