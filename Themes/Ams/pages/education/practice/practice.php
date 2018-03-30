<Block id="practice" layout="education/practice/practice">
	<Education.Practice.Slider layout="detail/songnguheader" position="public-header" cacheable="true" cacheParams="layout,position" />

	<Education.Test.List id="testlist" layout="education/practice/showTestnumber" position="test-place" />
	<!--Education.Test.List id="testcompability" cacheable="false" action="test" layout="education/practice/testcompability" position="test-compability" /-->
	
	<Education.Test.List id="extracompability" cacheable="false" action="extraTest" layout="education/practice/extracompability" position="extra-compability" />
	
	
	<Block cacheable="true" cacheParams="layout,position" layout="education/practice/slide" position="bottom-slide" />
	<Education.Achievement.Achievement layout="home/boxachievement" position="box-achievement" />
</Block>