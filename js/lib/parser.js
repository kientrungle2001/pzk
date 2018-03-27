maxUniqueId = 1;
PzkParser = {
	parse: function(source) {
		if(is_string(source)) {
			if(source.contains('<')) {
				var parser = new DOMParser();
				var xmlDoc = parser.parseFromString(source, "text/xml");
				return this.parse(xmlDoc);
			} else {
				var path = pzk.locator.locate(source);
				pzk.load(path, function(resp) {
					source = resp;
				});
				return this.parse(source);
			}
		} else if(is_a(source, 'XMLDocument')) {
			return this.parse(source.childNodes[0]);
		} else if(is_a(source, 'Element')) {
			return this.parseNode(source);
		} else {
			return source;
		}
	},
	parseNode: function(node) {
		var nodeObjData = {children: []};
		if(node.nodeName == '#text') {
			nodeObjData.tagName = 'label';
			nodeObjData.content = node.nodeValue;
		} else {
			nodeObjData.tagName = node.nodeName;
			if (this.isHtmlTag(node.nodeName)) {
                nodeObjData.tagName = 'htmltag';
				nodeObjData.tag = node.nodeName;
            }
			if(node.attributes.length) {
				for(var i = 0; i < node.attributes.length; i++) {
					nodeObjData[node.attributes[i].nodeName] = node.attributes[i].nodeValue;
				}
			}
		}
		if(typeof nodeObjData.id == 'undefined') {
			nodeObjData.id = 'uniqueID' + maxUniqueId;
			maxUniqueId++;
		}
		var classPath = nodeObjData.tagName.replace(/\./g, '/');
		var parts = nodeObjData.tagName.split('.');
		parts.forEach(function(part, index) {
			parts[index] = part.ucfirst();
		});
		pzk.lib('objects/' + classPath);
		var className = 'Pzk' + parts.join('');
		var classFunction = window[className];
		var rs = new classFunction(nodeObjData);
		pzk.elements[rs.id] = rs;
		rs.init();
		node.childNodes.forEach(function(childNode) {
			nodeObjData.children.push(PzkParser.parseNode(childNode));
		});
		rs.finish();
		return rs;
	},
	htmlTags: {
		'h1' : true, 'h2' : true, 'h3' : true, 'h4' : true, 'h5' : true, 'h6' : true, 'marquee' : true, 'br' : true,
        'p' : true, 'em' : true, 'strong' : true, 'a' : true, 'style' : true, 'div' : true, 'span' : true, 'label' : true, 'b' : true, 'hr' : true,
        'script' : true, 'link' : true, 'select' : true, 'option' : true, 'ul' : true, 'li' : true,
        'table' : true, 'tr' : true, 'td' : true, 'thead' : true, 'tbody' : true, 'caption' : true,
        'input' : true, 'textarea' : true, 'img' : true, 'pre' : true, 'header' : true
	},
	isHtmlTag: function(nodeName) {
		if(this.htmlTags[nodeName]) {
			return true;
		}
		return false;
	}
};