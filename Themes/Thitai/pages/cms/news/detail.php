<Block layout="home/news">
	<Fulllook.Menu cacheable="true" cacheParams="layout" table="tests" layout="detail/topmenu"  position="top-menu" />
	<Cms.News.Breadcrumbs table="news" id="breadcrumbs" categoryTag="span" newsTag="span" delimiter="&gt;" cacheable="true" cacheParams="id,layout,itemId" />
	<Cms.News.Detail cacheable="true" cacheParams="id,layout,itemId" table="news" id="detail" layout="cms/news/detail" />
</Block>