<Block layout="empty">
	
	<User.Profile.Detail cacheable="false" cacheParams="layout" id="detail" layout="user/profile/detail">
		<Fulllook.Menu table="tests" cacheable="true" cacheParams="layout" layout="detail/topmenu" position="top-menu" />
		<User.Profile.Edit id="edit" onsuccess="setTimeout(function(){ window.Location.Reload(); }, 1000);" position="profile-edit-area" />
		<User.Profile.ChangePassword id="changePassword" onsuccess="setTimeout(function(){ window.Location.Reload(); }, 1000);" position="profile-edit-area" />
		<User.Profile.ChangeAvatar id="changeAvatar" onsuccess="setTimeout(function(){ window.Location.Reload();  }, 1000);" position="profile-edit-area" />
	</User.Profile.Detail>
	
	<Education.Question.ShowRating id="listTest" layout="history/test" />

</Block>