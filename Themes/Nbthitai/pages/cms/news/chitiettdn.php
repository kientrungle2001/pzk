<Block layout="home/news">
	<Fulllook.Menu cacheable="true" cacheParams="layout" table="tests" layout="detail/topmenu"  position="top-menu" />
	<Cms.News.Breadcrumbs table="news" id="breadcrumbs" categoryTag="span" newsTag="span" delimiter="&gt;" />
	<Cms.News.Detail cacheable="false" cacheParams="layout" table="news" id="detail" layout="cms/news/chitiettdn" />
</Block>