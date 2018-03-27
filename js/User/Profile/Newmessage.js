PzkUserProfileNewmessage = PzkObj.pzkExt({
	
	init: function(){
		
  },
delAll: function(userId){
  
    $.ajax({
      type: "Post",
      data:{
          userId: userId
      },
      url:'/profile/delMessage',
      success: function(msg){
        if(msg==1){
          $('#loadMess').remove();
        }
      }

    }); 
    
   
},
delOne: function(userId,messageType){
  
    $.ajax({
      type: "Post",
      data:{
          userId: userId,
          messageType: messageType
      },
      url:'/profile/delOneMessage',
      success: function(msg){
        if(msg==1){
          $('#mess'+messageType).remove();
        }
      }

    }); 
    
   
}	
});