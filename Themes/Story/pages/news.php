<Block id="news" layout="home/news">
	<Cms.News.List layout="news/lastest" parentId="157" orderBy="news.Id desc" position="top-left-left" pageSize="1" />
	<Cms.News.List layout="news/most-views" parentId="157" orderBy="news.Views desc" position="top-right-left" pageSize="6" />
	<Cms.News.List layout="news/company" parentId="156" orderBy="news.Id desc" position="mid" pageSize="3" />
	<Cms.News.List layout="news/educate" parentId="157" orderBy="news.Id desc" position="mid-bottom" pageSize="3" />
</Block>