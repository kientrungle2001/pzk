<Block layout="education/practice/doquestion">
	<Education.Question.Ngonngu id="showQuestion" position="mid-content" layout="education/practice/showQuestion">
		<Block layout="detail/songnguheader" position="public-header" />
		<Fulllook.Menu table="tests" cacheable="true" cacheParams="layout" layout="detail/topmenu"  position="top-menu" scriptable="false" />
		<!-- <Core.Db.List table="document" id="vocabularyList" cacheable="true" cacheParams="layout,parentId" layout="detail/vocabulary" conditions ='["and", ["status", "1"], ["type","vocabulary"]]' parentField="categoryId" parentMode="true" position="choice"/> -->
		<Education.Vocabulary.List id="vocabularyList" layout="detail/vocabulary" position="choice"/>
	
	</Education.Question.Ngonngu>
</Block>