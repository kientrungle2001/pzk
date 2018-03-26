<Block id="practice" layout="education/practice/practice">
	<Block layout="detail/songnguheader" position="public-header" cacheable="true" cacheParams="layout,position" />
	<Fulllook.Menu table="tests" cacheable="true" cacheParams="layout,table,position" layout="detail/topmenu"  position="top-menu" scriptable="false" />
	
	<Education.Test.List id="subject" layout="education/practice/showsubject"  position="show-subject"/>
	<Education.Test.List id="practicelist" layout="education/practice/showPracticenumber" position="practice-place"/>
	<Education.Test.List id="testlist" layout="education/practice/showTestnumber" position="test-place" />
	<Block cacheable="true" cacheParams="layout,position" layout="education/practice/slide" position="bottom-slide" />
	<Education.Achievement.Achievement layout="home/boxachievement" position="box-achievement" />
	
</Block>