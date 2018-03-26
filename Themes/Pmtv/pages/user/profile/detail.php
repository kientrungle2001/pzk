<Block layout="home/content">
	<Block layout="cms/banner" />
	<Cms.Menu layout="cms/menu" parentMode="true" parentField="parent" parentId="0" />
	<Div layout="empty">
		<User.Profile.Detail cacheable="false" cacheParams="layout" id="detail" layout="user/profile/detail">
			<User.Profile.Edit id="edit" onsuccess="setTimeout(function(){ window.Location.Reload(); }, 1000);" position="profile-edit-area" />
			<User.Profile.ChangePassword id="changePassword" onsuccess="setTimeout(function(){ window.Location.Reload(); }, 1000);" position="profile-edit-area" />
			<User.Profile.ChangeAvatar id="changeAvatar" onsuccess="setTimeout(function(){ window.Location.Reload();  }, 1000);" position="profile-edit-area" />
		</User.Profile.Detail>
	</Div>
	<!--education.Question.ShowRating id="listTest" layout="history/test" /-->
	<!--education.Lecture.Practice.History id="user_history" cacheable="false" /-->
	<Education.Lecture.Practice.History table="pmtv_user_book" id="user_history" cacheable="false" layout="education/lecture/practice/history" />
</Block>