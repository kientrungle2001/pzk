function mapCss(selectors) {
	for(var selector in selectors) {
		var addClasses = selectors[selector];
		$(selector).addClass(addClasses);
	}
}

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
$(function() {
	mapCss({
		'#mainMenu': 'nav navbar-nav',
		'#mainMenu li a': 'auto-font color1-bold',
		'.category-section': 'container bottom-25',
		'.category-section .header': 'bottom-15',
		'.category-section .header .title': 'text-left margin-0 padding-10 font-large border-bottom',
		'.category-section .header .title a': 'font-large text-bold color7',
		'.carousel-item .carousel-thumbnail' : 'img-4-columns bgcolor8-bold',
		'.carousel-item .carousel-thumbnail img': 'img-responsive img-circle',
		'.carousel-item .title' : 'bgcolor8-bold text-center margin-0 padding-10 font-large',
		'.carousel-item .title a' : 'color-white font-large text-bold',
		'.section-index': 'absolute absolute-left--15 absolute-bottom--15 text-center padding-5 font-large radius-10'
	});	
});
