<?php 
$html = $data->getItem();
?>
 <div class="htmlbox" style="width:<?php echo @$html['width']?>; height:<?php echo @$html['height']?>;">
	 
	 <?php if($html['showname']== 1){
		 echo "<h4 class=\"title\">".$html['name']."</h4>";
	 }
	 ?>
	 <?php echo @$html['content']?>
 </div>