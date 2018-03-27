PzkCommunicationSocialHome = PzkObj.pzkExt({
  
  init: function(){
    $('#new_alert').on('hidden.bs.dropdown', function(){
        $.ajax({
            data:{},
            url:'/social/delAlert',
            success: function(result){
            }
        });
    });
    $('#new_invi').on('hidden.bs.dropdown', function(){
        $.ajax({
            data:{},
            url:'/social/delInvi',
            success: function(result){
            }
        });
    });
},
SendNote: function(avatar1,userId,userComment,noteId,userNote)
  {
    var comment_note= $('#note_note'+noteId).val();
   var d = new Date();
   var datetime= d.getFullYear()+'-'+ (d.getMonth()+1) +'-'+ d.getDate()+' '+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds() ; 
    $.ajax({
      data:{
        comment_note: comment_note,
        note_id: noteId,
        userNote: userNote
      },
      url:'/note/PostCommentNote1',
      success: function(result){
        if(result){
          $('#note_note'+noteId).val('');
          if(userNote== userId){
            $('#end_notenote'+noteId).append('<div id="commId'+result+'" class="user_note_comment"><div class="pfr_avatar_wall"><img src="'+avatar1+'" alt="" width="60" height="60"></div><div class="prf_titlenote" ><a href="/profile/user?member='+userId+'">'+userComment+': </a></div><div class="titel_detail">'+comment_note+'</div><div style="float:right;"><a href="javascript:;" class="black" title="Xoá" onclick="pzk_socialhome.delComm('+result+');">[Xoá]</a></div><div class="titel_time"> Được viết lúc: '+datetime+'</div></div>');
          }else $('#end_notenote'+noteId).append('<div id="commId'+result+'" class="user_note_comment"><div class="pfr_avatar_wall"><img src="'+avatar1+'" alt="" width="60" height="60"></div><div class="prf_titlenote" ><a href="/profile/user?member='+userId+'">'+userComment+': </a></div><div class="titel_detail">'+comment_note+'</div><div class="titel_time"> Được viết lúc: '+datetime+'</div></div>');
          
        }
      }
    });
  },
  viewMoreContent:function()
    {
      
      var socialId= window.socialId;
      $.ajax({
        url:'/social/viewContent',
        data:{
          socialId:socialId          
        },
        success: function(result)
        {
          //alert(result);
          $('#viewmore_content').before(result);
        }
      });
      
    },
  viewMore:function(noteId)
    {
      //var noteId= '<?php echo $id; ?>';
      //var commentId= window.commentId;
      var commentId= $('#commentId'+noteId);
      var commentId= document.getElementById('commentId'+noteId).value;
      $.ajax({
        url:'/social/viewComment',
        data:{
          commentId:commentId,
          noteId: noteId
        },
        success: function(result)
        {
          //alert(result);
          $('#viewMoreComment'+noteId).after(result);
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
  Send1: function(avatar1,userId,userComment,noteId)
  {
    var comment_note= $('#txt_comment_note1').val();
   var d = new Date();
   var datetime= d.getFullYear()+'-'+ (d.getMonth()+1) +'-'+ d.getDate()+' '+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds() ; 
    $.ajax({
      data:{
        comment_note: comment_note,
        note_id: noteId
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
      
    },
  agree: function(member){
    $.ajax({
        url:'/Invitation/agree1',
        data:{
          member:member
        },
        success: function(result)
        {
          $('#invi_'+member).remove();
        }
    });
  },
  deny: function(member){
    $.ajax({
        url:'/Invitation/deny1',
        data:{
          member:member
        },
        success: function(result)
        {
          $('#invi_'+member).remove();
        }
    });
  }
  
});
