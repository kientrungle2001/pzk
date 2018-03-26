<Block layout="education/document/home" conditions='["status", "1"]'>
	<Fulllook.Menu table="tests" cacheable="true" cacheParams="layout" layout="detail/topmenu"  position="top-menu" />
	<Fulllook.Document table="categories" id="leftbanner" layout="education/document/leftbanner" position="left-banner"/>
	<Core.Db.List css="news" cacheable="false" cacheParams="id,layout,parentId" table="news" layout="cms/news/list" position="index-content" parentId="198" parentMode="true" parentField="categoryId" parentWhere="equal" listType="row" showThumbnail="true" titleTag="strong" showBrief="true" briefTag="p" briefLength="40" orderBy="ordering desc, created desc"/>
	<Fulllook.Document table="categories" id="rightbanner" layout="education/document/rightbanner" position="right-banner"/>
</Block>