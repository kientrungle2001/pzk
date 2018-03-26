<Page id="page">
	<Html.Head id="head" charset="utf-8">
		<Plugin.Jquery />
		<Plugin.Bootstrap />
		<Plugin.Validate />
		<Html.Js src="/js/components.js" />
		<Html.Js src="/Default/skin/nobel/ptnn/Themes/vnwomen/js/main.js" />
		<Core.Themes.Themes />
    </Html.Head>
	<Html.Body id="body">
		<Home.Header id="header" layout="template/main/header" />
		
		<Home.Content id="content" layout="template/main/content">
			<Home.Left id="left" layout="template/main/left" />
			<Home.Right id="right" layout="template/main/right" />
		</Home.Content>
		
		<Home.Register id="register" layout="template/main/register" />
		<Home.Footer id="footer" layout="template/main/footer"/> 
		
	</Html.Body>
</Page>
