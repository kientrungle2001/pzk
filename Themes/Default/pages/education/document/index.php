<Block layout="education/document/index" conditions='["status", "1"]'>
	<Fulllook.Menu table="tests" cacheable="true" cacheParams="layout" layout="detail/topmenu"  position="top-menu" />
	<Fulllook.Document table="categories" id="leftbanner" layout="education/document/leftbanner" position="left-banner"/>
	<Cms.Document.List id="document" conditions='["and", ["status", 1], ["type", "document"]]' position="mid-content" layout="education/document/list"/>
	<Fulllook.Document table="categories" id="rightbanner" layout="education/document/rightbanner" position="right-banner"/>	
</Block>