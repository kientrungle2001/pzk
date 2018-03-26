$(function(){
	$('#navbar').addClass('navbar navbar-default navbar-fixed-top');
	$('#myNavbar').addClass('collapse navbar-collapse');
	$('#myNavbar > ul').addClass('nav navbar-nav navbar-right');
	$('#navbarButton').append('<span class="icon-bar"></span>\
				<span class="icon-bar"></span>\
				<span class="icon-bar"></span>');
	$('#navbarButton').attr({
		'type': 	'button',
		'class':	'navbar-toggle'
	});
	$('.register_login_required').addClass('login_required');
	$('.register_login_required').prepend('<span class="glyphicon glyphicon-user"></span>');
	$('.login_login_required').addClass('login_required');
	$('.login_login_required').prepend('<span class="glyphicon glyphicon-log-in"></span>');
	$('.login_required_mobile').addClass('login_required visible-xs top10');
	$('.logout_btn_mobile').addClass('visible-xs top10');
	$('.login_required').attr({
		 'href'			:	'javascript:void(0)',
		 'data-toggle'	:	'modal', 
		 'data-target'	:	'.bs-example-modal-lg'
	});
	$('#logo').addClass('img-responsive');
	$('#logo').css({
		'max-width':'70px', 
		'margin-top': '-15px'
	});
	$('.btn-user').addClass('btn btn-info dropdown');
});
