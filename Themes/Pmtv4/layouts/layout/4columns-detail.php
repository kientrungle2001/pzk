<?php $items = $data->getItems(); 
$items = buildTree($items);
$root = $items[0]; ?>

<div class="container top-25 bottom-25">
	<div class="row">
		<div class="col-xs-12">			
			<div class="header bgcolor1-bold">
				<h2 class="text-center margin-0 padding-10 font-large">
					<a class="color-white font-large text-bold" href="<?php echo @$root['alias']?>"><?php echo @$root['name']?></a>
				</h2>
			</div>
			<div class="row top-10" id="carousel-<?php echo @$data->id?>">
			<?php  $children = $root['children']; $index = 0; ?>
			<?php foreach($children as $item): ?>
			<div class="col-sm-3">
				<div class="bgcolor1">
				<div class="img-4-columns">
				<img src="<?php echo pzk_or($item['img'],'/Themes/pmtv4/skin/media/4column-detail-image.jpg'); ?>" class="img-responsive" />
				</div>
				
				<h3 class="bgcolor1-bold text-left margin-0 padding-10 font-large">
					<a href="/<?php echo @$item['alias']?>" class="color-white font-large text-bold"><?php echo @$item['name']?></a>
				</h3>
				<div class="hidden-xs">
				<p class="lesson">
					<span class="intro-text"><?php echo @$item['content']?></span>
				</p>
				<div class="separator"></div>
				<?php  	$course 	= 	$item['children'][0]; 
					$practice	=	$item['children'][1];
				?>
				<ul class="lesson-detail">
					<li class="course">
						<a class="color-white" href="/<?php echo @$item['alias']?>"> <span class="glyphicon glyphicon-book"></span> Bài giảng cơ bản & nâng cao</a>
					</li>
					<li class="practice">
						<a class="color-white" href="/<?php echo @$item['alias']?>"> <span class="glyphicon glyphicon-pencil"></span> Luyện tập cơ bản & nâng cao</a>
					</li>
				</ul>
				</div>
				</div>
			</div>
			<?php  $index++; ?>
			<?php endforeach; ?>
			<div class="clear"></div>
			</div>
		</div>
	</div>
	
</div>

<script type="text/javascript">
$.fn.carousel = function(options) {
	
	this.addClass('carousel');
	this.css('position', 'relative');
	var nextBtn = $('<span class="glyphicon glyphicon-chevron-right"></span>');
	var prevBtn	= $('<span class="glyphicon glyphicon-chevron-left"></span>');
	this.append(nextBtn);
	this.append(prevBtn);
	
	var itemIndex = 0;
	var allChildren = 	this.find(options.childSelector);
	var size 		=	options.size;
	var pages 		= 	Math.ceil(allChildren.length / size);
	
	allChildren.css('display', 'none');
	var prevItem 	= null;
	
	currentItem = $(allChildren.filter( function(index) {
		return index >= size * itemIndex && index < size * (itemIndex + 1);
	}));
	if(currentItem) {
		currentItem.show();
	}
	nextBtn.click(function() {
		prevItem = $(allChildren.filter( function(index) {
			return index >= size * itemIndex && index < size * (itemIndex + 1);
		}));
		itemIndex++ ;
		if(itemIndex >= pages) {
			itemIndex = 0;
		}
		currentItem = $(allChildren.filter( function(index) {
			return index >= size * itemIndex && index < size * (itemIndex + 1);
		}));
		if(prevItem) {
			prevItem.hide();
		}
		if(currentItem) {
			currentItem.fadeIn();
		}
	});
	prevBtn.click(function() {
		prevItem = $(allChildren.filter( function(index) {
			return index >= size * itemIndex && index < size * (itemIndex + 1);
		}));
		itemIndex--;
		if(itemIndex < 0) {
			itemIndex = pages-1;
		}
		currentItem = $(allChildren.filter( function(index) {
			return index >= size * itemIndex && index < size * (itemIndex + 1);
		}));
		if(prevItem) {
			prevItem.hide();
		}
		if(currentItem) {
			currentItem.fadeIn();
		}
	});
	$(window).resize(function() {
		if(window.innerWidth >= 768) {
			size	=	(options.desktop && options.desktop.size) || options.size;
			pages 	= 	Math.ceil(allChildren.length / size);
			allChildren.hide();
			if(itemIndex > pages) {
				itemIndex = 0;
			}
			currentItem = $(allChildren.filter( function(index) {
				return index >= size * itemIndex && index < size * (itemIndex + 1);
			}));
			if(currentItem) {
				currentItem.fadeIn();
			}
		} else {
			size	=	(options.mobile && options.mobile.size) || options.size;
			pages 	= 	Math.ceil(allChildren.length / size);
			allChildren.hide();
			if(itemIndex > pages) {
				itemIndex = 0;
			}
			currentItem = $(allChildren.filter( function(index) {
				return index >= size * itemIndex && index < size * (itemIndex + 1);
			}));
			if(currentItem) {
				currentItem.fadeIn();
			}
		}
	});
	if(window.innerWidth >= 768) {
		size	=	(options.desktop && options.desktop.size) || options.size;
		pages 	= 	Math.ceil(allChildren.length / size);
		allChildren.hide();
		if(itemIndex > pages) {
			itemIndex = 0;
		}
		currentItem = $(allChildren.filter( function(index) {
			return index >= size * itemIndex && index < size * (itemIndex + 1);
		}));
		if(currentItem) {
			currentItem.fadeIn();
		}
	} else {
		size	=	(options.mobile && options.mobile.size) || options.size;
		pages 	= 	Math.ceil(allChildren.length / size);
		allChildren.hide();
		if(itemIndex > pages) {
			itemIndex = 0;
		}
		currentItem = $(allChildren.filter( function(index) {
			return index >= size * itemIndex && index < size * (itemIndex + 1);
		}));
		if(currentItem) {
			currentItem.fadeIn();
		}
	}
};

$('#carousel-<?php echo @$data->id?>').carousel({
	size: 1,
	childSelector: 	'.col-sm-3',
	desktop: {size: 4}
});
</script>

<style>

.carousel .glyphicon-chevron-left, .carousel .glyphicon-chevron-right {
	position: absolute;
	top:		45px;
	display: 	none;
	font-size: 	30px;
	color: 		white;
}

.carousel .glyphicon-chevron-left {
	left:		30px;
}

.carousel .glyphicon-chevron-right {
	right:		30px;
}
.carousel .glyphicon-chevron-left, .carousel .glyphicon-chevron-right {
	display: 	inline;
}
</style>