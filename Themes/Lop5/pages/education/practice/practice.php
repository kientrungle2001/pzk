<Block id="practice" layout="education/practice/practice">
	<Fulllook.Menu table="tests" cacheable="true" cacheParams="layout" layout="detail/topmenu"  position="top-menu" />
	<Core.Db.List table="categories" id="subject" cacheable="true" cacheParams="layout" layout="education/practice/showsubject" conditions ='["and", ["status", "1"], ["display","1"], ["parent","47"]]' orderBy="categories.Ordering asc"  position="show-subject"/>
	<Core.Db.List table="tests" id="practicelist" cacheable="true" cacheParams="layout" layout="education/practice/showPracticenumber" conditions ='["and", ["status", "1"], ["practice","1"]]' orderBy="tests.Ordering desc" pageSize="17" position="practice-place"/>
	
	<Core.Db.List table="tests" id="testlist" cacheable="true" cacheParams="layout" layout="education/practice/showTestnumber" conditions ='["and", ["status", "1"], ["practice","0"]]' orderBy="tests.Ordering desc" pageSize="17" position="test-place" />
	
	<Core.Db.List table="tests" cacheable="true" cacheParams="layout" layout="education/practice/slide" orderBy="tests.Ordering desc" position="bottom-slide" pageSize="17" />
</Block>