pzk_controller = {
	index: function() {
		pzk.lib('html');
		
		pzk.load('/3rdparty/bootstrap3/css/bootstrap.min.css');
		pzk.load('/3rdparty/bootstrap3/js/bootstrap.min.js');
		pzk.load('http://test1sn.vn/3rdparty/font-awesome-4.6.3/css/font-awesome.min.css');
		pzk.load('/3rdparty/jquery/jquery.validate.min.js');
		pzk.load('/3rdparty/jquery/additional-methods.min.js');
		pzk.load('/themes/songngu3/skin/css/style.css');
		pzk.load('/themes/songngu3/layouts/home/header.js');
		pzk.load('/themes/songngu3/layouts/home/menu.js');
		pzk.load('/themes/songngu3/layouts/home.js');
		$(function() {
			$('#page-content').append(home_content);
			//$('#page-content').append(home_menu);
		});
	}
}