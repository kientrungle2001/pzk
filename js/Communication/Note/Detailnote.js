PzkCommunicationNoteDetailnote = PzkObj.pzkExt({
	
	init: function(){
    
},
Send: function(avatar1,userId,userComment,noteId,member)
  {
    var comment_note= $('#txt_comment_note').val();
   var d = new Date();
   var datetime= d.getFullYear()+'-'+ (d.getMonth()+1) +'-'+ d.getDate()+' '+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds() ; 
    $.ajax({
      data:{
        comment_note: comment_note,
        note_id: noteId,
        member: member
      },
      url:'/note/PostCommentNote',
      success: function(result){
        if(result){
          $('#txt_comment_note').val('');
          $('#end_note_comment').append('<div id="commId'+result+'" class="user_note_comment"><div class="pfr_avatar_wall"><img src="'+avatar1+'" alt="" width="60" height="60"></div><div class="prf_titlenote" ><a href="/profile/user?member='+userId+'">'+userComment+': </a></div><div class="titel_detail">'+comment_note+'</div><div style="float:right;"><a href="javascript:;" class="black" title="Xoá" onclick="pzk_detailnote.delComm('+result+');">[Xoá]</a></div><div class="titel_time"> Được viết lúc: '+datetime+'</div></div>');
        }
      }
    });
  },
  viewMore:function(noteId)
    {
      //var noteId= '<?php echo $id; ?>';
      var commentId= window.commentId;
      $.ajax({
        url:'/note/viewComment',
        data:{
          commentId:commentId,
          id: noteId
        },
        success: function(result)
        {
          $('#view_more_comment').after(result);
        }
      });
      
    },
  delComm: function(commentId){
    
    $.ajax({
        type: "POST",
        data: {commentId:commentId},
        url:'/note/delComm',
        success: function(msg){
          if(msg){
              $('#commId'+commentId).remove();
          }  
        }
    });
  },
  Send1: function(avatar1,userId,userComment,noteId,member)
  {
    var comment_note= $('#txt_comment_note1').val();
   var d = new Date();
   var datetime= d.getFullYear()+'-'+ (d.getMonth()+1) +'-'+ d.getDate()+' '+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds() ; 
    $.ajax({
      data:{
        comment_note: comment_note,
        note_id: noteId,
        member: member
      },
      url:'/note/PostCommentNote',
      success: function(result){
        if(result){
          $('#txt_comment_note1').val('');
          $('#end_note_comment1').append('<div class="user_note_comment"><div class="pfr_avatar_wall"><img src="'+avatar1+'" alt="" width="60" height="60"></div><div class="prf_titlenote" ><a href="/profile/user?member='+userId+'">'+userComment+': </a></div><div class="titel_detail">'+comment_note+'</div><div class="titel_time"> Được viết lúc: '+datetime+'</div></div>');
        }
      }
    });
  },
  viewMore1:function(noteId)
    {
      //var noteId= '<?php echo $id; ?>';
      var commentId= window.commentId;
      $.ajax({
        url:'/note/viewComment1',
        data:{
          commentId:commentId,
          id: noteId
        },
        success: function(result)
        {
          $('#view_more_comment').after(result);
        }
      });
      
    }
  
});
