<Block layout="home/content" page="lecture-page">
	<Block layout="cms/banner" />
	<Cms.Menu layout="cms/menu" parentMode="true" parentField="parent" parentId="0" />
	<Education.Lecture.Detail hasVideo="true" id="detail" table="categories" layout="lecture/detail" />
	<!--education.Lecture.Detail layout="lecture/detail" />
	<Education.Practice.Start>
		<Education.Practice.Filter.Lecture />
		<Education.Practice.Filter.Lesson />
		<Education.Practice.Timer />
	</Education.Practice.Start-->
</Block>
