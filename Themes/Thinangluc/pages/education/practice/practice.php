<Block id="practice" layout="education/practice/practice">
	<Education.Practice.Slider layout="detail/songnguheader" position="public-header" cacheable="true" cacheParams="layout,position" />
	<Education.Practice.SubjectList id="subject" layout="education/practice/showsubject"  position="show-subject"/>

	<Education.Test.Compability id="showCompability" layout="education/practice/showCompability" position="showCompability" />
	
	<Education.Test.List id="testcompability" cacheable="false" action="test" layout="education/practice/thithu" position="thithu" />
	
	<Block cacheable="true" cacheParams="layout,position" layout="education/practice/slide" position="bottom-slide" />
	<Education.Achievement.Achievement layout="home/boxachievement" position="box-achievement" />
	
</Block>