<Block layout="cms/document/home" conditions='["status", "1"]'>
	<Fulllook.Menu table="tests" cacheable="true" cacheParams="layout" layout="global/globalmenu"  position="top-menu" />
	<Fulllook.Document table="categories" id="leftbanner" layout="cms/document/leftbanner" position="left-banner"/>
	<Fulllook.Document table="categories" id="documentindex" layout="cms/document/indexcontent" position="index-content"/>
	<Fulllook.Document table="categories" id="rightbanner" layout="cms/document/rightbanner" position="right-banner"/>
</Block>