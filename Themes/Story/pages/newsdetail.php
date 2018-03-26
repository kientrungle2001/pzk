<Block id="news" layout="home/newsdetail">
	<Cms.News.Breadcrumbs id="breadcrumbs" layout="news/breadcrumb"  position="breadcrumb" />
	<Core.Db.Detail table="news" id="detail" layout="news/newscontent" position="newscontent" />
	<Cms.News.List table="news" layout="news/catenews" id="parent" orderBy="news.Id desc" position="catenews" pageSize="5" />
</Block>