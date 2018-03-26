<Cms.Document.Detail id="detail" cacheable="false">
	<Block layout="detail/songnguheader" position="public-header" />
	<Fulllook.Menu table="tests" cacheable="true" cacheParams="layout" layout="detail/topmenu"  position="top-menu" scriptable="false" />
	<Fulllook.Document table="categories" cacheable="true" cacheParams="layout"  id="leftbanner" layout="education/document/leftbanner" position="left-banner"/>
	<Fulllook.Document  layout="education/document/otherdocument" position="other-document"/>
	<Fulllook.Document table="categories" id="rightbanner" layout="education/document/rightbanner" position="right-banner"/>
</Cms.Document.Detail>