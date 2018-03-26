<Block layout="education/document/home" conditions='["status", "1"]'>
	<Fulllook.Menu table="tests" cacheable="true" cacheParams="layout" layout="detail/topmenu"  position="top-menu" />
	<Fulllook.Document table="categories" id="leftbanner" layout="education/document/leftbanner" position="left-banner"/>
	<Cms.News.Detail css="news" cacheable="true" id="detail" cacheParams="id,layout,itemId" table="news" layout="cms/news/chitiettdn" position="index-content" />
	<Fulllook.Document table="categories" id="rightbanner" layout="education/document/rightbanner" position="right-banner"/>
</Block>