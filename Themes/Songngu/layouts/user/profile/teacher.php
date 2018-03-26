<link href="../3rdparty/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="../3rdparty/datetimepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="../3rdparty/datetimepicker/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>

{children [position=public-header]}
{children [position=top-menu]}

<?php 
	$sessionCate = pzk_session('cateSelect');
	/*$categoryIds = ',50,51,52,53,54,59,87,88,157,164,48,49,';*/
	$categoryIds = pzk_session('adminCategoryIds');
	$categoryIds = trim($categoryIds, ',');	
	$categoryIds = explode(',', $categoryIds);
	$class = pzk_session('adminClass');
 ?>
<div class="container panel-default">
	<div class=" panel-heading">
    	<div class="row">
            <div class="col-md-2 co-xs-12">
                <label for="categoryId"> Chọn môn học</label>
                <select style="margin-left: 4px;"  class="form-control input-sm" id="cateSelect" name="cateSelect" onchange="window.location = '/profile/onchangeCateId?categoryId='+this.value+'&cateName='+ $('#cateSelect option:selected').text();" >
                    <option value="" >Chọn môn</option>
                    {each $categoryIds as $item}
                    <?php 
                    	if($item == 50 || $item == '50') $itemName ='Địa Lý';
                    	if($item == 51 || $item == '51') $itemName ='Toán';
                    	if($item == 52 || $item == '52') $itemName ='Khoa Học';
                    	if($item == 53 || $item == '53') $itemName ='Lịch Sử';
                    	if($item == 54 || $item == '54') $itemName ='Ngôn Ngữ & Giao Tiếp';
                    	if($item == 59 || $item == '59') $itemName ='Hiểu Biết Xã Hội';
                    	if($item == 87 || $item == '87') $itemName ='Kỹ Năng Nghe';
                    	if($item == 88 || $item == '88') $itemName ='Kỹ Năng Quan Sát';
                    	if($item == 157 || $item == '157') $itemName ='Văn Học';
                    	if($item == 164 || $item == '164') $itemName ='Tiếng Anh';
                    	if($item == ROOT_TEST_CATEGORY_ID) $itemName ='Kiểm Tra Toàn Diện';
                    	if($item == ROOT_PRATEST_CATEGORY_ID ) $itemName ='Đề Luyện Tập';
                     ?>
                    <option value="{item}">{itemName}</option>
                    {/each}
                    <script type="text/javascript">
                        $('#cateSelect').val({sessionCate});
                        var catename = $("#cateSelect option:selected").text();
                        
                    </script>
                </select>
            </div>
        </div>

	</div> 	
</div>
<?php 	
	$subject = pzk_session('cateSelect');
	if($subject){
		$schedule = _db()->getEntity('User.Account.Teacher');
		$teacherSchedule = $schedule->viewSchedule($subject);
		//var_dump($teacherSchedule);die;
		$schedules = array();
		foreach ($teacherSchedule as $schedule) {
			$schedules[$schedule['subject']][$schedule['topic']][$schedule['exercise_number']] = $schedule;
		}
		
	}	
 ?>
<div class="container panel-default">
  <div class=" panel-heading">
	<div class="row"> 
		<h3 class="text-center text-uppercase">
			<strong>
				<?php if(pzk_session('cateSelect')=='') echo 'Hãy chọn môn học';
		 		else echo 'Môn '.pzk_session('cateSelectName');
		 		?>
			</strong>
		</h3>
		
	</div>
  </div>
 
  <div class="panel-body ">
	<div class="row">
		<li class="list-group-item" style="height: 40px;font-weight: 700;background-color: antiquewhite;">
			<div class="col-md-4 col-sm-4">Tên bài</div>
			<div class="col-md-4 col-sm-4">Thời gian</div>
			<div class="col-md-2 col-sm-2">Trạng thái</div>
			<div class="col-md-2 col-sm-2">Cập nhật</div>
		</li>
		
	</div>

	<div class="row">
		
	<?php if($subject == 87 || $subject == 88) {
			$dataCategoryCurrent =  $data->getLesson($subject,$class);
		foreach($dataCategoryCurrent as $k =>  $value):?>
			<?php $schedule = @$schedules[$subject][0][$value['id']]; ?>
			<li class="list-group-item" >
				<div class="row">
					<div class='col-md-4 col-sm-4'>{value[name]} 
						 <input type="hidden" id="schedule{subject}0{value[id]}" value="{schedule[id]}">
					</div>
					<div class='col-md-4 col-sm-4'>
			            
			            <div class="form-group">
			                <div class='input-group date' id='datetimepicker{value[id]}'>
			                    <input type='text' class="form-control" value="{schedule[openDate]}" />
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
			            </div>
						    <script type="text/javascript">
						    	$(function () {
					                $('#datetimepicker{value[id]}').datetimepicker({
								        format: "dd/mm/yyyy - HH:ii P",
								        showMeridian: true,
								        autoclose: true,
								        todayBtn: true
								    });
					            });
					            
					        </script>
						
			        </div>
			        <div class='col-md-2 col-sm-2'>  
			            <select name="status{value[id]}" id="status{value[id]}" style="height:30px;">
			            	<option value="0">Chưa kích hoạt</option>
			            	<option value="1">Kích hoạt</option>
			            	<script>
			            	$('#status{value[id]}').val('{schedule[status]}');
			            	</script>
			            </select> 	
			        </div>
			        <div class='col-md-2 col-sm-2'> 
			        	<button type="button" name="submit{value[id]}" id="submit{value[id]}" class="btn btn-success">Cập nhật</button>    	
			        </div>
				</div>
				<script>
				$('#submit{value[id]}').click(function(){
					var status = $('#status{value[id]}').val();
					var subject = '{subject}';
					var lessonId = '{value[id]}';
					var topicId = 0;
					var scheduleId = $('#schedule{subject}0{value[id]}').val();
					//var formatted = document.getElementById('datetimepicker{value[id]}').value;
					var date = $("#datetimepicker{value[id]}").datetimepicker("getDate");
					var openDate = date.getFullYear()  + '-'+ (date.getMonth() + 1) + '-' + date.getDate() + ' ' + date.getHours() +':' + date.getMinutes() + ':00' ;
					
					
					$.ajax({
				        url:'/profile/updateSchedule',
				        data: {
				          subject 	: subject,
						  status	: status,
						  lessonId 	: lessonId,
						  topicId 	: topicId,
						  date 		: openDate,
						  scheduleId : scheduleId
				        },
				        success: function(result)
				        {
				          	var res	= result.split('/');
				          	if(res[0] == 1){
				          	    $('#schedule{subject}0{value[id]}').val(res[1]);
				          	    alert('thành công');
				          	} else alert('thất bại');
				        }
		        	});

							
						});
				</script>
			
			</li>
		<?php endforeach;
		}else if($subject == ROOT_TEST_CATEGORY_ID || $subject == ROOT_PRATEST_CATEGORY_ID) {
			if($subject == ROOT_PRATEST_CATEGORY_ID) {
				$practice = 1;
			}else $practice = 0;
			
			?>
				
			    			<?php 
			    				$weeks = $data->getWeekTest($class, ROOT_WEEK_CATEGORY_ID,$practice);

			    			 ?>
			    			{each $weeks as $week }
			    			
			    			<li class="left20" style="color:#d9534f;"><h5><strong>{week[name]}</strong></h5>
								
							<?php 
								$tests = $data->getTestSN($class, $week['id'], $practice);
								
								 ?>
									{each $tests as $test }
									<?php 
										$schedule = @$schedules[$subject][$week['id']][$test['id']];
		                                if($test['name_sn']){
		                                    $testName = $test['name_sn'];
		                                }else $testName = $test['name'];
		                            ?>
		                            <li class="list-group-item" >
										<div class="row">
											<div class='col-md-4 col-sm-4'>{testName}
												<input type="hidden" id="schedule{subject}{week[id]}{test[id]}" value="{schedule[id]}">
											</div>
											<div class='col-md-4 col-sm-4'>
									            
									            <div class="form-group">
									                <div class='input-group date' id='datetimepicker{week[id]}{test[id]}'>
									                    <input type='text' class="form-control" value="{schedule[openDate]}" />
									                    <span class="input-group-addon">
									                        <span class="glyphicon glyphicon-calendar"></span>
									                    </span>
									                </div>
									            </div>
												    <script type="text/javascript">
												    	$(function () {
											                $('#datetimepicker{week[id]}{test[id]}').datetimepicker({
														        format: "dd/mm/yyyy - HH:ii P",
														        showMeridian: true,
														        autoclose: true,
														        todayBtn: true
														    });
											            });
											            
											        </script>
												
									        </div>
									        <div class='col-md-2 col-sm-2'>  
									            <select name="status{week[id]}{test[id]}" id="status{week[id]}{test[id]}" style="height:30px;">
									            	<option value="0">Chưa kích hoạt</option>
									            	<option value="1">Kích hoạt</option>
									            	<script>
										            	$('#status{week[id]}{test[id]}').val({schedule[status]});
										            </script> 
									            </select>
									            	
									        </div>
									        <div class='col-md-2 col-sm-2'> 
									        	<button type="button" name="submit{week[id]}{test[id]}" id="submit{week[id]}{test[id]}" class="btn btn-success">Cập nhật</button>    	
									        </div>
										</div>
									<script>
									$('#submit{week[id]}{test[id]}').click(function(){
										var status = $('#status{week[id]}{test[id]}').val();
										var subject = '{subject}';
										var topicId = '{week[id]}';
										var lessonId = '{test[id]}';
										var scheduleId = $('#schedule{subject}{week[id]}{test[id]}').val();
										//var formatted = document.getElementById('datetimepicker{value[id]}').value;
										var date = $("#datetimepicker{week[id]}{test[id]}").datetimepicker("getDate");
										var openDate = date.getFullYear()  + '-'+ (date.getMonth() + 1) + '-' + date.getDate() + ' ' + date.getHours() +':' + date.getMinutes() + ':00' ;
										
										
										$.ajax({
									        url:'/profile/updateSchedule',
									        data: {
									          subject 	: subject,
											  status	: status,
											  lessonId 	: lessonId,
											  topicId 	: topicId,
											  date 		: openDate,
											  scheduleId : scheduleId
									        },
									        success: function(result)
									        {
									        	var res	= result.split('/');
									          	if(res[0] == 1){
												    $('#schedule{subject}{week[id]}{test[id]}').val(res[1]);
												    alert('thành công');
												} else alert('thất bại');
									        }
							        	});

												
									});
									</script>
								
								</li>	
									{/each}
								
								
							</li>
							{/each}
			

					
				




	<?php	}else { ?>
		
	<?php
		$level = $data -> getLevel($class, $subject);
		if($level== '1'){
			/*$catetype = $data -> getCatetype($subject);*/
			$practices = $data->getPracticesSN($class,$subject);
				for($i = 1; $i <= $practices; $i++){ 
					$schedule = @$schedules[$subject][0][$i];
				?>
					<li class="list-group-item" >
						<div class="row">
							<div class='col-md-4 col-sm-4'><?php echo 'Bài '.$i;?>
							<input type="hidden" id="schedule{subject}0{i}" value="{schedule[id]}">
							</div>
							<div class='col-md-4 col-sm-4'>
					            
					            <div class="form-group">
					                <div class='input-group date' id='datetimepicker{i}'>
					                    <input type='text' class="form-control" value="{schedule[openDate]}" />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
					            </div>
								    <script type="text/javascript">
								    	$(function () {
							                $('#datetimepicker{i}').datetimepicker({
										        format: "dd/mm/yyyy - HH:ii P",
										        showMeridian: true,
										        autoclose: true,
										        todayBtn: true
										    });
							            });
							            
							        </script>
								
					        </div>
					        <div class='col-md-2 col-sm-2'>  
					            <select name="status{i}" id="status{i}" style="height:30px;">
					            	<option value="0">Chưa kích hoạt</option>
					            	<option value="1">Kích hoạt</option>
					            	<script>
					            		$('#status{i}').val('{schedule[status]}');
					            	</script>
					            </select> 	
					        </div>
					        <div class='col-md-2 col-sm-2'> 
					        	<button type="button" name="submit{i}" id="submit{i}" class="btn btn-success">Cập nhật</button>    	
					        </div>
						</div>
						<script>
						$('#submit{i}').click(function(){
							var status = $('#status{i}').val();
							var subject = '{subject}';
							var lessonId = '{i}';
							var topicId = 0;
							var scheduleId = $('#schedule{subject}0{i}').val();
							//var formatted = document.getElementById('datetimepicker{value[id]}').value;
							var date = $("#datetimepicker{i}").datetimepicker("getDate");
							var openDate = date.getFullYear()  + '-'+ (date.getMonth() + 1) + '-' + date.getDate() + ' ' + date.getHours() +':' + date.getMinutes() + ':00' ;
							
							
							$.ajax({
						        url:'/profile/updateSchedule',
						        data: {
						          subject 	: subject,
						          topicId 	: topicId,
								  status	: status,
								  lessonId 	: lessonId,
								  date 		: openDate,
								  scheduleId : scheduleId
						        },
						        success: function(result)
						        {
						          	var res	= result.split('/');
						          	if(res[0] == 1){
									    $('#schedule{subject}0{i}').val(res[1]);
									    alert('thành công');
									} else alert('thất bại');
						        }
				        	});

									
								});
						</script>
					
					</li>
					
				<?php } //end for
		}elseif($level== '2'){
			$topics= $data->getTopicsSN($class, $subject);
				foreach ($topics as $topic) {
					echo '<li class="left20" style="color:#d9534f"><h5><strong>'.$topic['name'].$topic['id'].'</strong></h5>';
					$practices = $data->getPracticesSN($class,$topic['id']);
					for($i = 1; $i <= $practices; $i++){  
						$schedule = @$schedules[$subject][$topic['id']][$i];
						?>
						<li class="list-group-item" >
						<div class="row">
							<div class='col-md-4 col-sm-4'><?php echo 'Bài '.$i;?>
								<input type="hidden" id="schedule{subject}{topic[id]}{i}" value="{schedule[id]}">
							</div>
							<div class='col-md-4 col-sm-4'>
					            
					            <div class="form-group">
					                <div class='input-group date' id='datetimepicker{topic[id]}{i}'>
					                    <input type='text' class="form-control" value="{schedule[openDate]}" />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
					            </div>
								    <script type="text/javascript">
								    	$(function () {
							                $('#datetimepicker{topic[id]}{i}').datetimepicker({
										        format: "dd/mm/yyyy - HH:ii P",
										        showMeridian: true,
										        autoclose: true,
										        todayBtn: true
										    });
							            });
							            
							        </script>
								
					        </div>
					        <div class='col-md-2 col-sm-2'>  
					            <select name="status{topic[id]}{i}" id="status{topic[id]}{i}" style="height:30px;">
					            	<option value="0">Chưa kích hoạt</option>
					            	<option value="1">Kích hoạt</option>
					            	<script>
						            	$('#status{topic[id]}{i}').val({schedule[status]});
						            </script> 
					            </select>
					            	
					        </div>
					        <div class='col-md-2 col-sm-2'> 
					        	<button type="button" name="submit{topic[id]}{i}" id="submit{topic[id]}{i}" class="btn btn-success">Cập nhật</button>    	
					        </div>
						</div>
						<script>
						$('#submit{topic[id]}{i}').click(function(){
							var status = $('#status{topic[id]}{i}').val();
							var subject = '{subject}';
							var topicId = '{topic[id]}';
							var lessonId = '{i}';
							var scheduleId = $('#schedule{subject}{topic[id]}{i}').val();
							//var formatted = document.getElementById('datetimepicker{value[id]}').value;
							var date = $("#datetimepicker{topic[id]}{i}").datetimepicker("getDate");
							var openDate = date.getFullYear()  + '-'+ (date.getMonth() + 1) + '-' + date.getDate() + ' ' + date.getHours() +':' + date.getMinutes() + ':00' ;
							
							
							$.ajax({
						        url:'/profile/updateSchedule',
						        data: {
						          subject 	: subject,
								  status	: status,
								  lessonId 	: lessonId,
								  topicId 	: topicId,
								  date 		: openDate,
								  scheduleId : scheduleId
						        },
						        success: function(result)
						        {
						          	var res	= result.split('/');
						          	if(res[0] == 1){
									    $('#schedule{subject}{topic[id]}{i}').val(res[1]);
									    alert('thành công');
									} else alert('thất bại'); 
						        }
				        	});

									
								});
						</script>
					
					</li>
					<?php } //end for
				} //end foreach

		}elseif($level== '3'){
			$sections= $data->getTopicsSN($class, $subject);
			foreach ($sections as $section) {
				echo '<li class="left10'.(@$section['trial'] ? ' trial-3-level-1': '').'" style="color:#2696c4"><h5><strong>'.$section['name'].'</strong></h5>';
				$topicChilds= $data->getTopicsSN($class, $section['id']);
				if(count($topicChilds) == 0) {
					$practices = $data->getPracticesSN($class,$section['id']);
					for($i = 1; $i <= $practices; $i++){
					$schedule = @$schedules[$subject][$section['id']][$i];
					  ?>
						<li class="list-group-item" >
						<div class="row">
							<div class='col-md-4 col-sm-4'><?php echo 'Bài '.$i;?>
								<input type="hidden" id="schedule{subject}{section[id]}{i}" value="{schedule[id]}">
							</div>
							<div class='col-md-4 col-sm-4'>
					            
					            <div class="form-group">
					                <div class='input-group date' id='datetimepicker{section[id]}{i}' >
					                    <input type='text' class="form-control" value="{schedule[openDate]}" />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
					            </div>
								    <script type="text/javascript">
								    	$(function () {
							                $('#datetimepicker{section[id]}{i}').datetimepicker({
										        format: "dd/mm/yyyy - HH:ii P",
										        showMeridian: true,
										        autoclose: true,
										        todayBtn: true
										    });
							            });
							            
							        </script>
								
					        </div>
					        <div class='col-md-2 col-sm-2'>  
					            <select name="status{section[id]}{i}" id="status{section[id]}{i}" style="height:30px;">
					            	<option value="0">Chưa kích hoạt</option>
					            	<option value="1">Kích hoạt</option>

					            </select> 	
					            <script>
					            $('#status{section[id]}{i}').val('{schedule[status]}');
					            </script>
					        </div>
					        <div class='col-md-2 col-sm-2'> 
					        	<button type="button" name="submit{section[id]}{i}" id="submit{section[id]}{i}" class="btn btn-success">Cập nhật</button>    	
					        </div>
						</div>
						<script>
						$('#submit{section[id]}{i}').click(function(){
							var status = $('#status{section[id]}{i}').val();
							var subject = '{subject}';
							var topicId = '{section[id]}';
							var lessonId = '{i}';
							var scheduleId = $('#schedule{subject}{section[id]}{i}').val();
							//var formatted = document.getElementById('datetimepicker{value[id]}').value;
							var date = $("#datetimepicker{section[id]}{i}").datetimepicker("getDate");
							var openDate = date.getFullYear()  + '-'+ (date.getMonth() + 1) + '-' + date.getDate() + ' ' + date.getHours() +':' + date.getMinutes() + ':00' ;
							
							
							$.ajax({
						        url:'/profile/updateSchedule',
						        data: {
						          subject 	: subject,
								  status	: status,
								  lessonId 	: lessonId,
								  topicId 	: topicId,
								  date 		: openDate,
								  scheduleId : scheduleId
						        },
						        success: function(result)
						        {
						          	var res	= result.split('/');
						          	if(res[0] == 1){
									    $('#schedule{subject}{section[id]}{i}').val(res[1]);
									    alert('thành công');
									} else alert('thất bại');
						        }
				        	});

									
								});
						</script>
					
					</li>
					<?php 
					}
				} else {										
					foreach ($topicChilds as $topic) {
						echo '<li class="left20'.(@$topic['trial'] ? ' trial-3-level-2': '').'" style="color:#d9534f"><strong>'.$topic['name'].'</strong>';
						$practices = $data->getPracticesSN($class,$topic['id']);
						for($i = 1; $i <= $practices; $i++){  
							$schedule = @$schedules[$subject][$topic['id']][$i];
						?>
							<li class="list-group-item" >
						<div class="row">
							<div class='col-md-4 col-sm-4'><?php echo 'Bài '.$i;?>
							<input type="hidden" id="schedule{subject}{topic[id]}{i}" value="{schedule[id]}">
							</div>
							<div class='col-md-4 col-sm-4'>
					            
					            <div class="form-group">
					                <div class='input-group date' id='datetimepicker{topic[id]}{i}'>
					                    <input type='text' class="form-control" value="{schedule[openDate]}" />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
					            </div>
								    <script type="text/javascript">
								    	$(function () {
							                $('#datetimepicker{topic[id]}{i}').datetimepicker({
										        format: "dd/mm/yyyy - HH:ii P",
										        showMeridian: true,
										        autoclose: true,
										        todayBtn: true
										    });
							            });
							            
							        </script>
								
					        </div>
					        <div class='col-md-2 col-sm-2'>  
					            <select name="status{topic[id]}{i}" id="status{topic[id]}{i}" style="height:30px;">
					            	<option value="0">Chưa kích hoạt</option>
					            	<option value="1">Kích hoạt</option>
					            </select> 
					            <script>
					            	$('#status{topic[id]}{i}').val('{schedule[status]}');
					            </script>	
					        </div>
					        <div class='col-md-2 col-sm-2'> 
					        	<button type="button" name="submit{topic[id]}{i}" id="submit{topic[id]}{i}" class="btn btn-success">Cập nhật</button>    	
					        </div>
						</div>
						<script>
						$('#submit{topic[id]}{i}').click(function(){
							var status = $('#status{topic[id]}{i}').val();
							var subject = '{subject}';
							var topicId = '{topic[id]}';
							var lessonId = '{i}';
							var scheduleId = $('#schedule{subject}{topic[id]}{i}').val();
							//var formatted = document.getElementById('datetimepicker{value[id]}').value;
							var date = $("#datetimepicker{topic[id]}{i}").datetimepicker("getDate");
							var openDate = date.getFullYear()  + '-'+ (date.getMonth() + 1) + '-' + date.getDate() + ' ' + date.getHours() +':' + date.getMinutes() + ':00' ;
							
							
							$.ajax({
						        url:'/profile/updateSchedule',
						        data: {
						          subject 	: subject,
								  status	: status,
								  lessonId 	: lessonId,
								  topicId 	: topicId,
								  date 		: openDate,
								  scheduleId : scheduleId
						        },
						        success: function(result)
						        {
						          	var res	= result.split('/');
						          	if(res[0] == 1){
									    $('#schedule{subject}{topic[id]}{i}').val(res[1]);
									    alert('thành công');
									} else alert('thất bại');
						        }
				        	});

									
								});
						</script>
					
					</li>
						<?php 
						} 
					}
				}
			}

		}elseif($level == '4'){
			$sections1= $data->getTopicsSN($class, $subject);
			foreach ($sections1 as $section1) {
				echo '<li class="left10'.(@$section1['trial'] ? ' trial-4-level-1': '').'" style="color:#B6D452"><h5><strong>'.$section1['name'].'</strong></h5>';
				$sections2= $data->getTopicsSN($class, $section1['id']);
				if(count($sections2) == 0) {
					$practices = $data->getPracticesSN($class,$section1['id']);
					for($i = 1; $i <= $practices; $i++){
						$schedule = @$schedules[$subject][$section1['id']][$i];
				   ?>
						<li class="list-group-item" >
						<div class="row">
							<div class='col-md-4 col-sm-4'><?php echo 'Bài '.$i;?>
								<input type="hidden" id="schedule{subject}{section1[id]}{i}" value="{schedule[id]}">
							</div>
							<div class='col-md-4 col-sm-4'>
					            
					            <div class="form-group">
					                <div class='input-group date' id='datetimepicker{section1[id]}{i}'>
					                    <input type='text' class="form-control" value="{schedule[openDate]}" />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
					            </div>
								    <script type="text/javascript">
								    	$(function () {
							                $('#datetimepicker{section1[id]}{i}').datetimepicker({
										        format: "dd/mm/yyyy - HH:ii P",
										        showMeridian: true,
										        autoclose: true,
										        todayBtn: true
										    });
							            });
							            
							        </script>
								
					        </div>
					        <div class='col-md-2 col-sm-2'>  
					            <select name="status{section1[id]}{i}" id="status{section1[id]}{i}" style="height:30px;">
					            	<option value="0">Chưa kích hoạt</option>
					            	<option value="1">Kích hoạt</option>
					            <script>
					            	$('#status{section1[id]}{i}').val('{schedule[status]}');
					            </script>
					            </select> 	
					        </div>
					        <div class='col-md-2 col-sm-2'> 
					        	<button type="button" name="submit{section1[id]}{i}" id="submit{section1[id]}{i}" class="btn btn-success">Cập nhật</button>    	
					        </div>
						</div>
						<script>
						$('#submit{section1[id]}{i}').click(function(){
							var status = $('#status{section1[id]}{i}').val();
							var subject = '{subject}';
							var topicId = '{section1[id]}';
							var lessonId = '{i}';
							var scheduleId = $('#schedule{subject}{section1[id]}{i}').val();
							//var formatted = document.getElementById('datetimepicker{value[id]}').value;
							var date = $("#datetimepicker{section1[id]}{i}").datetimepicker("getDate");
							var openDate = date.getFullYear()  + '-'+ (date.getMonth() + 1) + '-' + date.getDate() + ' ' + date.getHours() +':' + date.getMinutes() + ':00' ;
							
							
							$.ajax({
						        url:'/profile/updateSchedule',
						        data: {
						          subject 	: subject,
								  status	: status,
								  lessonId 	: lessonId,
								  topicId 	: topicId,
								  date 		: openDate,
								  scheduleId : scheduleId
						        },
						        success: function(result)
						        {
						          	var res	= result.split('/');
						          	if(res[0] == 1){
									    $('#schedule{subject}{section1[id]}{i}').val(res[1]);
									    alert('thành công');
									} else alert('thất bại');
						        }
				        	});

									
								});
						</script>
					
					</li>
					<?php 
					}
				} else {
					foreach ($sections2 as $section2) {
						echo '<li class="left20'.(@$section2['trial'] ? ' trial-4-level-2': '').'" style="color:#2696c4"><h5><strong>'.$section2['name'].'</strong></h5>';
						$topicChilds= $data->getTopicsSN($class, $section2['id']);
						if(count($topicChilds) == 0) {
							$practices = $data->getPracticesSN($class,$section2['id']);
							for($i = 1; $i <= $practices; $i++){ 
								$schedule = @$schedules[$subject][$section2['id']][$i];
							?>
								<li class="list-group-item" >
						<div class="row">
							<div class='col-md-4 col-sm-4'><?php echo 'Bài '.$i;?>
								<input type="hidden" id="schedule{subject}{section2[id]}{i}" value="{schedule[id]}">
							</div>
							<div class='col-md-4 col-sm-4'>
					            
					            <div class="form-group">
					                <div class='input-group date' id='datetimepicker{section2[id]}{i}'>
					                    <input type='text' class="form-control" value="{schedule[openDate]}" />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
					            </div>
								    <script type="text/javascript">
								    	$(function () {
							                $('#datetimepicker{section2[id]}{i}').datetimepicker({
										        format: "dd/mm/yyyy - HH:ii P",
										        showMeridian: true,
										        autoclose: true,
										        todayBtn: true
										    });
							            });
							            
							        </script>
								
					        </div>
					        <div class='col-md-2 col-sm-2'>  
					            <select name="status{section2[id]}{i}" id="status{section2[id]}{i}" style="height:30px;">
					            	<option value="0">Chưa kích hoạt</option>
					            	<option value="1">Kích hoạt</option>
					            <script>
					            	$('#status{section2[id]}{i}').val('{schedule[status]}');
					            </script>
					            </select> 	
					        </div>
					        <div class='col-md-2 col-sm-2'> 
					        	<button type="button" name="submit{section2[id]}{i}" id="submit{section2[id]}{i}" class="btn btn-success">Cập nhật</button>    	
					        </div>
						</div>
						<script>
						$('#submit{section2[id]}{i}').click(function(){
							var status = $('#status{section2[id]}{i}').val();
							var subject = '{subject}';
							var topicId = '{section2[id]}';
							var lessonId = '{i}';
							var scheduleId = $('#schedule{subject}{section2[id]}{i}').val();
							//var formatted = document.getElementById('datetimepicker{value[id]}').value;
							var date = $("#datetimepicker{section2[id]}{i}").datetimepicker("getDate");
							var openDate = date.getFullYear()  + '-'+ (date.getMonth() + 1) + '-' + date.getDate() + ' ' + date.getHours() +':' + date.getMinutes() + ':00' ;
							
							
							$.ajax({
						        url:'/profile/updateSchedule',
						        data: {
						          subject 	: subject,
								  status	: status,
								  lessonId 	: lessonId,
								  topicId 	: topicId,
								  date 		: openDate,
								  scheduleId : scheduleId
						        },
						        success: function(result)
						        {
						          	var res	= result.split('/');
							          	if(res[0] == 1){
										    $('#schedule{subject}{section2[id]}{i}').val(res[1]);
										    alert('thành công');
										} else alert('thất bại');
						        }
				        	});

									
								});
						</script>
					
					</li>
							<?php 
							}
						} else {
							foreach ($topicChilds as $topic) {
								echo '<li class="'.(@$topic['trial'] ? ' trial-4-level-3': '').'" style="color:#d9534f; padding-left: 40px;"><h5><strong>'.$topic['name'].'</strong></h5>';
								$practices = $data->getPracticesSN($class,$topic['id']);
								for($i = 1; $i <= $practices; $i++){
									$schedule = @$schedules[$subject][$topic['id']][$i];
							    ?>
									<li class="list-group-item" >
						<div class="row">
							<div class='col-md-4 col-sm-4'><?php echo 'Bài '.$i;?>
								<input type="hidden" id="schedule{subject}{topic[id]}{i}" value="{schedule[id]}">
							</div>
							<div class='col-md-4 col-sm-4'>
					            
					            <div class="form-group">
					                <div class='input-group date' id='datetimepicker{topic[id]}{i}'>
					                    <input type='text' class="form-control" value="{schedule[openDate]}" />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
					            </div>
								    <script type="text/javascript">
								    	$(function () {
							                $('#datetimepicker{topic[id]}{i}').datetimepicker({
										        format: "dd/mm/yyyy - HH:ii P",
										        showMeridian: true,
										        autoclose: true,
										        todayBtn: true
										    });
							            });
							            
							        </script>
								
					        </div>
					        <div class='col-md-2 col-sm-2'>  
					            <select name="status{topic[id]}{i}" id="status{topic[id]}{i}" style="height:30px;">
					            	<option value="0">Chưa kích hoạt</option>
					            	<option value="1">Kích hoạt</option>
					            	<script>
					            		$('#status{topic[id]}{i}').val('{schedule[status]}');
					            	</script>
					            </select> 	
					        </div>
					        <div class='col-md-2 col-sm-2'> 
					        	<button type="button" name="submit{topic[id]}{i}" id="submit{topic[id]}{i}" class="btn btn-success">Cập nhật</button>    	
					        </div>
						</div>
						<script>
						$('#submit{topic[id]}{i}').click(function(){
							var status = $('#status{topic[id]}{i}').val();
							var subject = '{subject}';
							var topicId = '{topic[id]}';
							var lessonId = '{i}';
							var scheduleId = $('#schedule{subject}{topic[id]}{i}').val();
							//var formatted = document.getElementById('datetimepicker{value[id]}').value;
							var date = $("#datetimepicker{topic[id]}{i}").datetimepicker("getDate");
							var openDate = date.getFullYear()  + '-'+ (date.getMonth() + 1) + '-' + date.getDate() + ' ' + date.getHours() +':' + date.getMinutes() + ':00' ;
							
							
							$.ajax({
						        url:'/profile/updateSchedule',
						        data: {
						          subject 	: subject,
								  status	: status,
								  lessonId 	: lessonId,
								  topicId 	: topicId,
								  date 		: openDate,
								  scheduleId : scheduleId
						        },
						        success: function(result)
						        {
						          	var res	= result.split('/');
						          	if(res[0] == 1){
									    $('#schedule{subject}{topic[id]}{i}').val(res[1]);
									    alert('thành công');
									} else alert('thất bại');
						        }
				        	});

									
								});
						</script>
					
					</li>
								<?php 
								} 
							}	
						}	
					}	
				}
			}
		}
	}// end else
	?>
	</div>
 </div>
 <div class="panel-footer">Panel footer</div>
</div>
