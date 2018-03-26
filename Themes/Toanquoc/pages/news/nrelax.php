<Block id="news" layout="news/nrelax">
	<Fulllook.Menu table="tests" cacheable="true" cacheParams="layout" layout="global/globalmenu"  position="top-menu" />
	<Cms.News.List cacheable="true" cacheParams="layout" layout="news/lastest" parentId="137" orderBy="news.Id desc" position="top-left-left" pageSize="5" />
	<Cms.News.List cacheable="true" cacheParams="layout" layout="news/most-view" parentId="137" orderBy="news.Id desc" position="top-right-left" pageSize="4" />
	<Cms.News.List cacheable="true" cacheParams="layout" layout="news/showsubject" parentId="137" orderBy="news.Id desc" position="showdetail" pageSize="5" />
</Block>