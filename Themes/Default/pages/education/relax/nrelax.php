<Block id="news" layout="education/relax/nrelax">
	<Fulllook.Menu table="tests" cacheable="true" cacheParams="layout" layout="detail/topmenu"  position="top-menu" />
	<Cms.News.List cacheable="true" cacheParams="layout" layout="education/relax/lastest" parentId="137" orderBy="news.Id desc" position="top-left-left" pageSize="5" />
	<Cms.News.List cacheable="true" cacheParams="layout" layout="education/relax/most-view" parentId="137" orderBy="news.Id desc" position="top-right-left" pageSize="4" />
	<Cms.News.List cacheable="true" cacheParams="layout" layout="education/relax/showsubject" parentId="137" orderBy="news.Id desc" position="showdetail" pageSize="5" />
</Block>