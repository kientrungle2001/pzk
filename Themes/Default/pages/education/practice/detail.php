<Block  layout="education/practice/detail" id="detail">
	<Fulllook.Menu table="tests" cacheable="true" cacheParams="layout" layout="detail/topmenu"  position="top-menu" />
	<Education.Practice.Subject cacheable="true" id="subjectPractice" position="mid-content" layout="education/practice/subject" cacheParams="id,categoryId,class,checkPayment">
		<Education.Vocabulary.Default.List id="vocabularyList" layout="detail/vocabulary" position="choice"/>
	</Education.Practice.Subject>
</Block>
