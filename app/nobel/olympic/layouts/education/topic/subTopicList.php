 <?php 
	$dataTopics = $data->getDataTopics();
	$topicId = $data->getTopicId();
	$topicName = $dataTopics['name'];
	$subTopics = $dataTopics['child'];
	
	
 ?>
<div class='bg-white'>
 <div class='container'>
 <div class="page-header">
  <h1> <small><?php echo $topicName; ?> </small></h1>
</div>

<?php if(is_array($subTopics)) { ?>
 <div class="row">
 <?php foreach($subTopics as $val) { ?>

  <div style="min-height: 380px;" class="col-sm-6 col-md-4">
    <div class="thumbnail">
	<a href="<?php echo BASE_REQUEST.'/'.$val['router']."/".$val['id']; ?>">
      <img src="/default/skin/nobel/ptnn/themes/vnwomen/media/category/idea.jpg" alt="...">
	  </a>
      <div class="caption">
        <h3><?php echo $val['name']; ?></h3>
        <p>...</p>
        <p>
		<a href="<?php echo BASE_REQUEST.'/'.$val['router']."/".$val['id']; ?>" class="btn btn-primary" role="button">Chi tiết</a> 
		</p>
      </div>
    </div>
  </div>

 <?php } ?>
 </div>
<?php } ?>
</div>
</div>