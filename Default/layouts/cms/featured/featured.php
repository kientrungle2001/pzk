<style>
.featured-wrapper{
	width:100%;
	min-height: 200px;
}
.featured-container{
	min-height:180px; 
	width: 90%;
	margin-left:10px;
}
.more{
	margin-top:20px;
	
}
</style>
<div id="container featured-wrapper">
     <div class="row featured-container">
	   <h4 class="text-center"><span class="label label-primary">Các bài viết hay</span></h4>  
       <div class="title">
<?php $featured= $data->getItems(); ?>
		<?php foreach($featured as $title): ?>
			<div>
			<span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span>
			<a href="/featured/detail?id=<?php echo @$title['id']?>"><span class="label label-primary"> <?php echo @$title2['title']?>  <?php echo @$title['title']?></span></a>
			</div>
        <?php endforeach; ?>
       </div>
	    <p class="text-center more"><a href="/featured/subfeatured"><span class="label label-primary">Xem thêm</span></a></p>
     </div>
	
 </div>
