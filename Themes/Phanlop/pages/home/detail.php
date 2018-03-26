<Block id="about" layout="home/detail">
	<Block layout="detail/songnguheader" position="public-header" />
	<Fulllook.Menu table="tests" cacheable="true" cacheParams="layout" layout="detail/topmenu"  position="top-menu" scriptable="false" />
	<Cms.News.Index cacheable="true" cacheParams="layout" layout="home/lastestnews" position="lastestnews">
		<Cms.News.Index cacheable="true" cacheParams="layout" table="news" layout="home/hotnews" position="hotnews" />
	</Cms.News.Index>
</Block>