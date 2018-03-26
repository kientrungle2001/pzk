<Page id="page">
	<Html.Head id="head" layout="home/head" charset="utf-8">
		<Block id="head-scripts" layout="empty" cacheable="true" cacheParams="id">
		<Plugin.Jquery />
		<Html.Js src="/js/components.js" />
		<Plugin.Bootstrap />
		<Plugin.Bootstrap.Fontawesome />
		
		</Block>
		<Core.Themes.Themes />
		
    </Html.Head>
    <Html.Body id="body">    	
		
		<Home.Header id="header" layout="home/header">
			
		</Home.Header>
		<Block id="wrapper" layout="empty" />
		<Block layout="notifier/messages" cacheable="false" />
		<Home.Footer id="footer" layout="home/footer">
			<Cms.Banner.Region position="footer" />
		</Home.Footer>
	</Html.Body>
</Page>
