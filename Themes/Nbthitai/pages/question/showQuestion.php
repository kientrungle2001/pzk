<Block layout="home/question">
	<Education.Question.Ngonngu id="showQuestion" position="mid-content" layout="question/showQuestion">
		<Fulllook.Menu table="tests" cacheable="true" cacheParams="layout" layout="detail/topmenu"  position="top-menu" />
		<Core.Db.List table="document" id="vocabularyList" cacheable="true" cacheParams="layout,parentId" layout="detail/vocabulary" conditions ='["and", ["status", "1"], ["type","vocabulary"]]' parentField="categoryId" parentMode="true" position="choice"/>
	</Education.Question.Ngonngu>
</Block>