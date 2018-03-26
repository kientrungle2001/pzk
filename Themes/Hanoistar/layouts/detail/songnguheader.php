<?php 
$signActive = pzk_session('checkPayment');
$language = pzk_global()->get('language');
$languagevn = pzk_global()->get('languagevn');
$memberlang = pzk_session('paymentLanguages');
$lang = pzk_session('language');
$login = pzk_session('userId');

$imageSlides = $data->getSlider('Home slider');

?>
<?php if($imageSlides){ ?>

<div id="carousel-example-generic" class="carousel item slide" data-ride="carousel">


<style style="text/css">
/*
.example1 {
 height: 50px;	
 overflow: hidden;
 width: 100%; float: left;
}
.example1 h4 {
 color: white;
 position: absolute;
 width: 100%;
 height: 100%;
 margin: 0;
 line-height: 50px;
 text-align: center;
 /* Starting position */
 -moz-transform:translateX(100%);
 -webkit-transform:translateX(100%);	
 transform:translateX(100%);
 /* Apply animation to this element */	
 -moz-animation: example1 20s linear infinite;
 -webkit-animation: example1 20s linear infinite;
 animation: example1 20s linear infinite;
}
/* Move it (define the animation) */
@-moz-keyframes example1 {
 0%   { -moz-transform: translateX(100%); }
 100% { -moz-transform: translateX(-100%); }
}
@-webkit-keyframes example1 {
 0%   { -webkit-transform: translateX(100%); }
 100% { -webkit-transform: translateX(-100%); }
}
@keyframes example1 {
 0%   { 
 -moz-transform: translateX(100%); /* Firefox bug fix */
 -webkit-transform: translateX(100%); /* Firefox bug fix */
 transform: translateX(100%); 		
 }
 100% { 
 -moz-transform: translateX(-100%); /* Firefox bug fix */
 -webkit-transform: translateX(-100%); /* Firefox bug fix */
 transform: translateX(-100%); 
 }
}
*/
</style>



  
<ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>
  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    
	<?php $i = 1; foreach($imageSlides as $img){ ?>
    <div class="item <?php if($i ==1){ echo 'active';} ?>">
			<?php if(!$lang || $lang == 'vn' ){ ?>
				 <img class="item" src="<?=BASE_URL.$img['image_vn']?>" />
			<?php }else{ ?>
				<img class="item" src="<?=BASE_URL.$img['image']?>" />
			<?php } ?>
     
    </div>
	<?php $i++; } ?>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<?php } ?>


