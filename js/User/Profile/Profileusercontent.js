PzkUserProfileProfileusercontent = PzkObj.pzkExt({
	
	init: function(){
    
	},
	PostComment: function(avatar1,userCommId,usernamewall,userId, datetime){
		var write_wall= $('#pr_post_wall').val();
         
          $.ajax({
            url:'../note/PostComment',
            data:{
              userId: userId,
              write_wall:write_wall }, 
            success:function(result){
              $('#pr_post_wall').val('');
            	$('#prf_comment_wall div:eq(0)').before('<div><div id="listwrite'+result+'" class="prf_write_wall"><div class="pfr_avatar_wall"><img src="'+avatar1+'" alt="" width="60" height="60"></div><div class="prf_titlenote"><a href="/profile/user?member='+userCommId+'">'+usernamewall+' :</a></div><div class="titel_detail">'+write_wall+' </div><div class="titel_time"> Được viết lúc: '+datetime+' </div><div style="float:right;"><a href="javascript:;" class="black" title="Xoá" onclick="pzk_profile_11.delWrite('+result+');">[Xoá]</a></div> <div class="prf_clear"> </div></div></div>');
           
            }
          });
	},
  PostComment1: function(avatar1,userCommId,usernamewall,userId, datetime){
    var write_wall= $('#pr_post_wall1').val();
         
          $.ajax({
            url:'../note/PostComment',
            data:{
              userId: userId,
              write_wall:write_wall }, 
            success:function(result){
              $('#pr_post_wall1').val('');
              $('#prf_comment_wall div:eq(0)').before('<div><div class="prf_write_wall"><div class="pfr_avatar_wall"><img src="'+avatar1+'" alt="" width="60" height="60"></div><div class="prf_titlenote"><a href="/profile/user?member='+userCommId+'">'+usernamewall+' :</a></div><div class="titel_detail">'+write_wall+' </div><div class="titel_time"> Được viết lúc: '+datetime+' </div><div class="prf_clear"> </div></div></div>');
           
            }
          });
  },
  delWrite: function (id){
    $.ajax({
            url:'/note/delWrite',
            data:{
                  id: id
                 } ,
            success:function(result){
              if(result){
                $('#listwrite'+id).remove();
                //location.reload(true);
              }
            }
    });
  },
  delNote: function(id){
    $.ajax({
            url:'/note/delNote',
            data:{
                  noteId: id
                 } ,
            success:function(result){
              if(result){
                $('#listnote'+id).remove();
                //location.reload(true);
              }
            }
    });
  }
});