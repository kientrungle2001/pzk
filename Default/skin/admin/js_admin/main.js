

/**
 * @author Admin
 * 
 * Jan 17, 2015
 * 
 * Confirm Delete Item
 */
function confirm_delete(message) {
	
	if (confirm(message)) {
		
		return true;
	}
	return false;
}

function setTinymce(checkspelling) {
    var options = {
        selector: "textarea.tinymce",
        forced_root_block : "",
		statusbar: false,
        force_br_newlines : true,
        force_p_newlines : false,
        relative_url: false,
        remove_script_host: false,
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen media",
            "insertdatetime media table contextmenu paste textcolor"
        ],

        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | styleselect formatselect fontselect fontsizeselect | forecolor backcolor latex",
        entity_encoding : "raw",
        relative_urls: false,
        external_filemanager_path: BASE_URL +"/3rdparty/Filemanager/filemanager/",
        filemanager_title:"Quản lý file upload" ,

        external_plugins: { "filemanager" :BASE_URL +"/3rdparty/Filemanager/filemanager/plugin.min.js", "nanospell": BASE_URL+"/3rdparty/nanospell/plugin.js"},
        nanospell_server: "php",
        height: 250,
		setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        }
    };
    if(!checkspelling) {
        delete options.external_plugins.nanospell;
        delete options.nanospell_server;
    }
    tinymce.init(options);
}
function setInputTinymce(checkspelling) {
    var options = {
        selector: "textarea.tinymce_input",
        forced_root_block : "",
        force_br_newlines : false,
        force_p_newlines : false,
        relative_url: false,
        remove_script_host: false,
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "visualblocks code fullscreen media",
            "media table contextmenu textcolor"
        ],
        toolbar: "media image link bold italic underline table | alignleft aligncenter alignjustify forecolor backcolor removeformat fullscreen code",
		statusbar: false,
		menubar: false,
        entity_encoding : "raw",
        relative_urls: false,
        external_filemanager_path: BASE_URL +"/3rdparty/Filemanager/filemanager/",
        filemanager_title:"Quản lý file upload" ,
        external_plugins: { "filemanager" :BASE_URL +"/3rdparty/Filemanager/filemanager/plugin.min.js", "nanospell": BASE_URL+"/3rdparty/nanospell/plugin.js"},
        nanospell_server: "php",
        height: 130
    };
    if(!checkspelling) {
        delete options.external_plugins.nanospell;
        delete options.nanospell_server;
    }
    tinymce.init(options);
}

$.fn.extend({
    treed: function (o) {
      
      var openedClass = 'glyphicon-minus-sign';
      var closedClass = 'glyphicon-plus-sign';
      
      if (typeof o != 'undefined'){
        if (typeof o.openedClass != 'undefined'){
        openedClass = o.openedClass;
        }
        if (typeof o.closedClass != 'undefined'){
        closedClass = o.closedClass;
        }
      };
      
        //initialize each of the top levels
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this); //li with children ul
            branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
            branch.addClass('branch');
            branch.on('click', function (e) {
                if (this == e.target) {
                    var icon = $(this).children('i:first');
                    icon.toggleClass(openedClass + " " + closedClass);
                    $(this).children().children().toggle();
                }
            })
            branch.children().children().toggle();
        });
        //fire event from the dynamically added icon
      tree.find('.branch .indicator').each(function(){
        $(this).on('click', function () {
            $(this).closest('li').click();
        });
      });
        //fire event to open branch if the li contains an anchor instead of text
        tree.find('.branch>a').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
        //fire event to open branch if the li contains a button instead of text
        tree.find('.branch>button').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
    }
});