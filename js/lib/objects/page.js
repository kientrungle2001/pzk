PzkPage = PzkObj.pzkExt({
	init: function() {
		$('head title').text(this.title);
		PzkObj.prototype.init.call(this);
	},
	layout: 'page'
});