function loadpage(page){
  current_page= page;
  
  $.ajax({
	type:"POST",
	data:{
	  page: current_page
	 
	},
	url:'/friend/searchuser',
	success: function(msg){
	  //alert(msg);
	  $('#view_result_search').html(msg);
	}

  });
}