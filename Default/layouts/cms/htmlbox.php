<?php 
$html = $data->getItem();
?>
 <div class="htmlbox" style="width:{html[width]}; height:{html[height]};">
	 
	 <?php if($html['showname']== 1){
		 echo "<h4 class=\"title\">".$html['name']."</h4>";
	 }
	 ?>
	 {html[content]}
 </div>