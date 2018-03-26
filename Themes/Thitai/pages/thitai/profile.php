<Block layout="empty">
	<User.Profile.Detail cacheable="false" cacheParams="layout" id="detail" layout="thitai/profile-detail">
		<User.Profile.Edit id="edit" onsuccess="setTimeout(function(){ window.Location.Reload(); }, 1000);" position="profile-edit-area" />
		<User.Profile.ChangePassword id="changePassword" onsuccess="setTimeout(function(){ window.Location.Reload(); }, 1000);" position="profile-edit-area" />
		<User.Profile.ChangeAvatar id="changeAvatar" onsuccess="setTimeout(function(){ window.Location.Reload();  }, 1000);" position="profile-edit-area" />
	</User.Profile.Detail>
</Block>