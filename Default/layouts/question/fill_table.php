<?php $items = $data->getQuestion();$answers = $items->getAnswers();?>
<div class="nobel-list-md choice">
	
	<p><i><?=$items->getRequest()?></i></p>
	<p><span class="ptnn-title"> <?=$items->getName()?></span></p>
	
		
	<table cellspacing="0" cellpadding="0" border="1px" width="67%">
		<thead>
			<tr>
				<?php foreach($answers as $key =>$value):?>
				<th style="text-align:center;"> 
					<input style="text-align:center;" class="input_w" type="text" name="answers[<?=$items->getId()?>][<?=$value->getId()?>][status]" value="<?=$value->getContent();?>"/> 
				</th>
				<?php endforeach;?>
			</tr>
			
			<?php for($i=0;$i<5;$i++):?>
			<tr>
				<?php foreach($answers as $key =>$value):?>
					<th>
					<input style="text-align:center;" class="input_w" type="text" name="answers[<?=$items->getId()?>][<?=$value->getId()?>][<?=$i?>]" placeholder=" . . . . . . . . . . . . . "/>
					</th>
				<?php endforeach;?>
			</tr>
			<?php endfor;?>
		</thead>
	</table>
</div>