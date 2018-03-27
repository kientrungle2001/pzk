PzkCommunicationWallViewwritewall = PzkObj.pzkExt({
	init: function(){
    PzkCommunicationWallViewwritewall.current_page=1;
	},
	loadpage: function(page, member){
      var that = this;
      PzkCommunicationWallViewwritewall.current_page= page;
      $.ajax({
        type:"POST",
        data:{
          page_wall: page,
          member: member
        },
        url:'/wall/viewwritewallPage',
        success: function(msg){
          //alert(msg);
          $('#viewall_write_wall').html(msg);
        }

      });
    },
    loadpage1: function(page, member){
      var that = this;
      PzkCommunicationWallViewwritewall.current_page= page;
      $.ajax({
        type:"POST",
        data:{
          page_wall: page,
          member: member
        },
        url:'/wall/viewwritewallPage1',
        success: function(msg){
          //alert(msg);
          $('#viewall_write_wall1').html(msg);
        }

      });
    },
    viewWall: function(avatar1,usercommId,usercomm,userId,datewrite){
    	var write_wall= $('#viewall_post_wall').val();
    	$.ajax({
            url:'/wall/PostCom',
            data:{
              userId: userId,
              write_wall:write_wall }, 
            success:function(result){
              if(result){
                $('#viewall_post_wall').val('');
                $('#viewall_write_wall div:eq(0)').before('<div><div class="prf_write_wall"><div class="pfr_avatar_wall"><img src="'+avatar1+'" alt="" width="60" height="60"></div><div class="prf_titlenote"><a href="/profile/user?member='+usercommId+'">'+usercomm+' :</a></div><div class="titel_detail" >'+write_wall+'</div><div class="titel_time">'+datewrite+'</div><div style="float:right;"><a href="javascript:;" class="black" title="Xoá" onclick="pzk_write_wall11.delWrite('+result+');">[Xoá]</a></div><div class="prf_clear"> </div></div>');
              }             
              
   
            }
        });

    },
    viewWall1: function(avatar1,usercommId,usercomm,userId,datewrite){
      var write_wall= $('#viewall_post_wall1').val();
      $.ajax({
            url:'/wall/PostCom',
            data:{
              userId: userId,
              write_wall:write_wall }, 
            success:function(result){
              if(result){
                $('#viewall_post_wall1').val('');
                $('#viewall_write_wall1 div:eq(0)').before('<div><div class="prf_write_wall"><div class="pfr_avatar_wall"><img src="'+avatar1+'" alt="" width="60" height="60"></div><div class="prf_titlenote"><a href="/profile/user?member='+usercommId+'">'+usercomm+' :</a></div><div class="titel_detail" >'+write_wall+'</div><div class="titel_time">'+datewrite+'</div><div class="prf_clear"> </div></div>');
              }             
              
   
            }
        });

    },
  delWrite: function (id){
    var that = this;
    //var current_page;
    $.ajax({
            url:'/wall/delWrite',
            data:{
                  id: id
                 } ,
            success:function(result){

              if(result){
                that.loadpage(PzkCommunicationWallViewwritewall.current_page,result);
              }
            }
    });
  }
});
