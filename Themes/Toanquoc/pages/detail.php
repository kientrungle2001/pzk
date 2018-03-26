<Block  layout="home/detail">
	<Fulllook.Menu cacheable="false" cacheParams="layout" table="tests" layout="global/globalmenu"  position="top-menu" />
	<Education.Question.Ngonngu cacheable="false" id="ngonngu" position="mid-content" layout="detail/midcontent">
		<Core.Db.List table="document" id="vocabularyList" layout="detail/vocabulary" conditions ='["and", ["status", "1"], ["type","vocabulary"]]' parentField="categoryId" parentMode="true" position="choice"/>
	</Education.Question.Ngonngu>
</Block>