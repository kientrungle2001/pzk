PzkEasyuiDatagridDataGrid = PzkObj.pzkExt({
	init: function() {
	},
	addMode: function() {
		this.url = BASE_URL + '/index.php'+this.controller+'/add?table=' + this.table;
		return this;
	},
	add: function() {
		$('#dlg-' + this.id).dialog('open');
		$('#fm-' + this.id).form('clear');
		this.url = BASE_URL + '/index.php'+this.controller+'/add?table=' + this.table;
		if(this.multiselects) {
			var multiselects = this.multiselects.split(',');
			for(var i = 0; i < multiselects.length; i++) {
				var field = multiselects[i];
				var selecteds = row[field].split(',');
				$('#' + field).find('option').attr('selected', false);
			}
		}
		if(this.fckeditors) {
			var fckeditors = this.fckeditors.split(',');
			for(var i = 0; i < fckeditors.length; i++) {
				var field = fckeditors[i];
				FCKeditorAPI.Instances[field].SetData('<p></p>');
			}
			
		}
	},
	edit: function() {
		var row = $('#' + this.id).datagrid('getSelected');
		if (row){
			$('#dlg-' + this.id).dialog('open');
			$('#fm-' + this.id).form('load',row);
			if(this.fckeditors) {
				var fckeditors = this.fckeditors.split(',');
				for(var i = 0; i < fckeditors.length; i++) {
					var field = fckeditors[i];
					FCKeditorAPI.Instances[field].SetData(row[field]);
				}
				
			}
			if(this.multiselects) {
				var multiselects = this.multiselects.split(',');
				for(var i = 0; i < multiselects.length; i++) {
					var field = multiselects[i];
					var selecteds = row[field].split(',');
					$('#' + field).find('option').attr('selected', false);
					for(var i = 0; i < selecteds.length; i++) {
						if(selecteds[i])
							$('#' + field).find('option[value='+selecteds[i]+']').attr('selected', true);
					}
				}
				
			}
			this.url = BASE_URL + '/index.php'+this.controller+'/edit?table=' + this.table;
		}
	},
	del: function() {
		var that = this;
		if(that.singleSelect == 'false' || that.singleSelect == false) {
			var rows = $('#' + this.id).datagrid('getSelections');
			if(rows.length > 0) {
				$.messager.confirm('Confirm','Có chắc sẽ xóa bản ghi này?',function(r){
					if (r){
						var ids = [];
						for(var i = 0; i < rows.length; i++) {
							ids.push(rows[i]['id']);
						}
						$.post(BASE_URL + '/index.php'+that.controller+'/del?table=' + that.table,{ids:ids},function(result){
							if (result.success){
								$('#' + that.id).datagrid('reload');    // reload the user data
								$.messager.show({    // show error message
									title: 'Success',
									msg: 'Các bản ghi đã được xóa thành công'
								});
							} else {
								$.messager.show({    // show error message
									title: 'Error',
									msg: result.errorMsg
								});
							}
						},'json');
					}
				});
			}
			
			return true;
		}
		var row = $('#' + this.id).datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirm','Có chắc sẽ xóa bản ghi này?',function(r){
				if (r){
					$.post(BASE_URL + '/index.php'+that.controller+'/del?table=' + that.table,{id:row.id},function(result){
						if (result.success){
							$('#' + that.id).datagrid('reload');    // reload the user data
						} else {
							$.messager.show({    // show error message
								title: 'Error',
								msg: result.errorMsg
							});
						}
					},'json');
				}
			});
		}
	},
	save: function(formId) {
		var that = this;
		var dialogMode = true;
		if(typeof formId != 'undefined') {
			dialogMode = false;
		}
		formId = formId || '#fm-' + this.id;
		
		$(formId).form('submit',{
			url: that.url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.errorMsg){
					$.messager.show({
						title: 'Error',
						msg: result.errorMsg
					});
				} else {
					if(dialogMode)
						$('#dlg-' + that.id).dialog('close');        // close the dialog
					$('#' + that.id).datagrid('reload');    // reload the user data
				}
				return false;
			}
		});
	},
	reload: function() {
		$('#' + this.id).datagrid('reload');
	},
	addToTable: function(options) {
		var row = $('#' + this.id).datagrid('getSelected');
		var data = {};
		if (row){
			data[options.gridField] = row.id;
			data[options.tableField] = $(options.tableFieldSource).val();
			if(!!options.tableField2)
				data[options.tableField2] = $(options.tableFieldSource2).val();
			if(!!options.tableField3)
				data[options.tableField3] = $(options.tableFieldSource3).val();
			if(!!options.tableField4)
				data[options.tableField4] = $(options.tableFieldSource4).val();
			if(!!options.tableField5)
				data[options.tableField5] = $(options.tableFieldSource5).val();
			if(!!data[options.tableField]) {
				$.post(options.url,data,function(result){
					if (!result.errorMsg){
						$.messager.show({    // show error message
							title: 'Success',
							msg: 'Cập nhật thành công'
						});
					} else {
						$.messager.show({    // show error message
							title: 'Error',
							msg: result.errorMsg
						});
					}
				},'json');
			}
		}
	},
	defaultBuilder: function(row, options) {
		
		var data = {};
		
		if(typeof options['gridField'] != 'undefined') {
			data[options.gridField] = row.id;
		}
		
		if(typeof options['fields'] != 'undefined') {
			var fields = options.fields;
			for(var field in fields) {
				var fieldOptions = fields[field];
				if(typeof fieldOptions == 'string') {
					data[field] = $(fieldOptions).val();
				} else if(typeof fieldOptions == 'object') {
					if(fieldOptions.source && fieldOptions.source == 'grid') {
						data[field] = row[fieldOptions.field];
					}
				}
			}
		}
		
		return data;
	},
	
	actOnSelected: function(options) {
		var row = $('#' + this.id).datagrid('getSelected');
		var data = {};
		if (row){
			var builder = options.builder || this.defaultBuilder;
			data = builder.call(this, row, options);
			$.post(options.url,data,function(result){
				if (!result.errorMsg){
					$.messager.show({    // show error message
						title: 'Success',
						msg: 'Cập nhật thành công'
					});
				} else {
					$.messager.show({    // show error message
						title: 'Error',
						msg: result.errorMsg
					});
				}
			},'json');
		}
	},
	search: function(options) {
		var builder = options.builder || this.defaultBuilder;
		var data = builder.call(this, null, options);
		$('#' + this.id).datagrid('load', {filters: data});
	},
	filters: function(data) {
		$('#' + this.id).datagrid('load', {filters: data});
	},
	detail: function(options) {
		var row = $('#' + this.id).datagrid('getSelected');
		var data = {};
		if (row){
			if(typeof options == 'function') {
				options(row);
				return true;
			}
			var builder = options.builder || this.defaultBuilder;
			data = builder.call(this, row, options);
			if(options.action && options.action == 'view') {
				window.open(options.url + '?' + $.param(data));
				return ;
			}
			if(options.action && options.action == 'render') {
				$.post(options.url,data,function(result){
					$(options.renderRegion).html(result);
				});
			}
		}
	}
});