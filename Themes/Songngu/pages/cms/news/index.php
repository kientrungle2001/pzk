<Block layout="home/news">
	<Block layout="detail/songnguheader" position="public-header" />
	<Fulllook.Menu table="tests" cacheable="true" cacheParams="layout" layout="detail/topmenu"  position="top-menu" scriptable="false" />
	<Cms.Category.Breadcrumbs id="categoryBreadcrumbs" categoryTag="span" delimiter="&gt;" />
	<Cms.News.Index css="news" cacheable="true" cacheParams="layout" table="news" layout="cms/news/index" />
</Block>