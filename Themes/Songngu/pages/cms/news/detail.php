<Block layout="home/news">
	<Block layout="detail/songnguheader" position="public-header" />
	<Fulllook.Menu table="tests" cacheable="true" cacheParams="layout" layout="detail/topmenu"  position="top-menu" scriptable="false" />
	<Cms.News.Breadcrumbs table="news" id="breadcrumbs" categoryTag="span" newsTag="span" delimiter="&gt;" cacheable="true" cacheParams="id,layout,itemId" />
	<Cms.News.Detail cacheable="true" cacheParams="id,layout,itemId" table="news" id="detail" layout="cms/news/detail" />
</Block>