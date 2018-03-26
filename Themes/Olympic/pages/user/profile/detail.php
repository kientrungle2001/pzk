<Block layout="empty">
	<User.Profile.Detail id="detail" layout="user/profile/detail">
		<User.Profile.Edit id="edit" onsuccess="setTimeout(function(){ window.Location.Reload(); }, 1000);" />
		<User.Profile.ChangePassword id="changePassword" onsuccess="setTimeout(function(){ window.Location.Reload(); }, 1000);" />
		<User.Profile.ChangeAvatar id="changeAvatar" onsuccess="setTimeout(function(){ window.Location.Reload();  }, 1000);" />
	</User.Profile.Detail>

</Block>