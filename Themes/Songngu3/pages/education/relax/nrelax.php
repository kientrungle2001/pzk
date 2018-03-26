<Block id="news" layout="education/relax/nrelax">
	<Cms.News.List cacheable="true" cacheParams="layout" layout="education/relax/lastest" parentId="137" orderBy="news.Id desc" conditions='["and", [["column", "news", "status"], "1"], [["column", "news", "featured"], "1"]]' position="top-left-left" pageSize="5" />
	<Cms.News.List cacheable="true" cacheParams="layout" layout="education/relax/most-view" parentId="137" orderBy="news.Id desc" conditions='[["column", "news", "status"], "1"]' position="top-right-left" pageSize="4" />
	<Cms.News.List cacheable="true" cacheParams="layout" layout="education/relax/showsubject" parentId="137" orderBy="news.Id desc" conditions='[["column", "news", "status"], "1"]' position="showdetail" pageSize="30" />
</Block>