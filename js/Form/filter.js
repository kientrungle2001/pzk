PzkFormFilter = PzkObj.pzkExt({
	value: false,
	init: function() {
		var that = this;
	},
	select: function(value, label) {
		if(this.value == value) return false;
		this.value = value;
		var clear = 'Xóa';
		if(value == '') {
			label = 'Tất cả';
			clear = '';
			this.$().find('.filter_list').show();
		} else {
			this.$().find('.filter_list').hide();
		}
		if(!label) {
			label = this.$().find('.filter_list a[rel='+value+']').text();
		}
		
		this.$().find('.selected_value').text(label);
		this.$().find('.selected_clear').text(clear);
		
	},
	clear: function() {
		return this.select('');
	}
});