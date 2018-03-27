PzkRoomJoin = PzkObj.pzkExt({
	init: function() {
		var that = this;
		setInterval(function(){
			that.reloadMembers();
		}, 1000);
	},
	reloadMembers: function() {
		$.ajax({url: '/room/members/'+this.roomId, success: function(resp) {
			$('#room_members').html(resp);
		}});
	}
});