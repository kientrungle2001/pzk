<?php 
$id=pzk_request()->getId();
$gallerys=$data->getSubgallery($id); 

?>

<style>
footer-logos {text-align:center;}
.footer-logos img {margin-left:20px;margin-right:20px;}
.footer-logos img.first {}
.footer-logos img.last {}
.footer-logos ul {}
.footer-logos ul li {display: inline; list-style:none;}
</style>
<div class="footer-logos">
        <ul>
		<?php foreach($gallerys as $gallery): ?>
            <li><img src="<?php echo @$gallery['url']?>" alt="" style="width:80%; height:50%;"></li>
        <?php endforeach; ?>
        </ul>
</div>
