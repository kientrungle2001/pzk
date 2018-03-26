<Block id="news" layout="home/relax">
	<Fulllook.Menu table="tests" cacheable="true" cacheParams="layout" layout="detail/topmenu"  position="top-menu" />
	<Cms.News.List cacheable="true" cacheParams="layout" layout="news/lastest" parentId="137" orderBy="news.Id desc" position="top-left-left" pageSize="1" />
	<Cms.News.List cacheable="true" cacheParams="layout" layout="news/most-view" parentId="137" orderBy="news.Views desc" position="top-right-left" pageSize="5" />
	<Cms.News.List cacheable="true" cacheParams="layout" layout="news/showsubject" parentId="137" orderBy="news.Views desc" position="showdetail" pageSize="3" />
</Block>