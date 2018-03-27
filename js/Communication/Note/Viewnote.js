PzkCommunicationNoteViewnote = PzkObj.pzkExt({
	
	init: function(){
    var that = this;
    PzkCommunicationNoteViewnote.currentpage=1;
    var userId;
},
	loadpage: function(page, member){
    PzkCommunicationNoteViewnote.currentpage=page;
    var that = this;
    $.ajax({
      type: "Post",
      data:{
        member: member,
        page: page
      },
      url:'/note/viewnotePage',
      success: function(msg){
        $('#prf_viewnotepage').html(msg);        
      }

    });
  },
  loadpage1: function(page, member){
    var that = this;
    $.ajax({
      type: "Post",
      data:{
        member: member,
        page: page
      },
      url:'/note/viewnotePage1',
      success: function(msg){
        $('#prf_viewnotepage1').html(msg);        
      }

    });
  },
  delNote: function(){
    var that = this;
    var check_array=[];
    var checkeds = $('input[name=ckbdel]:checked');
    $.each(checkeds, function( index, checked ) {
        check_array.push(checked.value);
    });
    $.ajax({
        type: "POST",
        data: {del:check_array},
        url:'/note/PostDelUserNote',
        success: function(msg){
          if(msg){
            that.loadpage(PzkCommunicationNoteViewnote.currentpage,msg);
          }  
        }
      });
    },
  delNote1: function(id){
    var that = this;
    $.ajax({
            url:'/note/delNote',
            data:{
                  noteId: id
                 } ,
            success:function(msg){
              if(msg){
                that.loadpage(PzkCommunicationNoteViewnote.currentpage,msg);
              }
              
            }
    });
  }
});
