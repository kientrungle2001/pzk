pzk.locator = {
	data: {
	},
	locate: function(name) {
		if(typeof this.data[name] != 'undefined') {
			return this.data[name];
		}
		return name;
	},
	set: function(name, path = null) {
		if(path) {
			this.data[name] = path;
		} else {
			this.data = $.extend(this.data, name);
		}
	}
};