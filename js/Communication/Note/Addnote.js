PzkCommunicationNoteAddnote = PzkObj.pzkExt({
	
	init: function(){
    var that = this;

},
	send: function(member){
    var notetitle= $('#note_title').val();
    var notecontent= tinyMCE.get('addnote').getContent();
     
    $.ajax({
            url:'../note/PostUserNote',
            data:{
              notetitle: notetitle,
              notecontent:notecontent }, 
            success:function(result){              
              window.location = "/note/viewnote?member="+member;                         
            }
    });
  },
  reset: function(){
    $('#note_title').val('');
      tinyMCE.get('addnote').setContent('');    
  },
  back: function(member){
    window.location="/note/viewnote?member="+member;
  }
});
