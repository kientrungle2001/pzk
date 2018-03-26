<Core.Db.Detail table="news" id="ajaxdetail" layout="education/relax/ajaxdetail">
	<Cms.News.NewComments cacheable="false" cacheParams="layout" layout="education/relax/comment" id="comment" position="comment"/>
	<Cms.News.List cacheable="true" cacheParams="layout" layout="education/relax/catenews" id="catenews" orderBy="news.Id desc" conditions='[["column", "news", "status"], "1"]' position="catenews" pageSize="5" />
</Core.Db.Detail>