pzk_controller = {
	index: function() {
		$(function() {
			// $('#page-content').append(home_content);
			//$('#page-content').append(home_menu);
			load_header();
			load_cms_menu();
		});
	},
	about: function() {
		$(function() {
			$('#page-content').append('<h2>Hello</h2>');
		});
		var query = _db();
		query.Select('id,title').From('news').Where(1).Limit(10, 0).OrderBy('id asc');
		var items = query.Result();
		console.log(items);
	}
}