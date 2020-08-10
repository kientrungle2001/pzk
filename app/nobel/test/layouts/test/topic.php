<?php
$questionTopic = $data->getItem();
$i= $questionTopic->getId();
?>
<div class="step">
 	<span><strong>Q7 Yêu Cầu: </strong> <?php  echo $questionTopic->getRequest(); ?></span>
</div>
<div class="step">
	<span><strong>Đoạn văn:</strong> <?php  echo $questionTopic->getName(); ?></span>
	
</div>
<?php 
$topicQuestion = $questionTopic->getRealEntity();
$topics = $topicQuestion->getTopics();
$j=1;
?>
<?php foreach($topics as $topic): ?>
<?php 
	$content= $topic->getContent();
	$id_topic=$topic->getId();
?>
<div class="step">
	<div class="step">
		<span><strong>Chủ đề <?php 	echo $j; ?>:</strong> <?php echo $content ?></span>
	</div>
	<div class="step" >
  		<div style="clear:both;"><span><strong>Đáp án:</strong></span></div>
  		
  		<div class="col-xs-3 margin-top-10" style="position:relative; margin-top: 20px; " >
			<div class="input-group" >
			    <input type="text" name="answerstopic[<?=$i?>][<?=$id_topic?>][]" class="input_user_test form-control content_value"/>
			</div>
			<div class="remove-input" ><a href="javascript:void(0)" class="color_delete" title="Xóa"><span class="glyphicon glyphicon-remove-circle"></span></a></div>
		</div>
		<div class="add_row_answer">
			<div class="itemAnswertopic_<?php echo $i.'_'.$id_topic;?>"  ></div>
		</div>
		<div class="btt_add_answer"><button type="button" class="btn btn-primary add-sub-input-test" onclick="addAnswerRow(<?=$i?>,<?=$id_topic?>)" style="margin-left: 15px;"><span class="glyphicon glyphicon-plus-sign"></span> Thêm đáp án</button></div>
  		
</div>
	
</div>
<?php $j++; ?>
<?php endforeach; ?>
<script>
	 	function addAnswerRow(id_question,id_topic){
		
		var div = document.createElement('div');

	    div.className = 'col-xs-3  element-input';
		
	    div.innerHTML = '<div class="input-group" style="margin-bottom: 10px;" >\
	    					<input type="text" name="answerstopic['+id_question+']['+id_topic+'][]" class="input_user_test form-control content_value"/>\
	        			</div>\
	        			<div class="remove-input"  style="margin-bottom: 10px;" ><a href="javascript:void(0)" class="color_delete" title="Xóa"><span class="glyphicon glyphicon-remove-circle"></span></a></div>';

	   	$('.itemAnswertopic_'+id_question+'_'+id_topic).append(div);

	}
</script>