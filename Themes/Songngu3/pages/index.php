<Page id="page">
	<Html.Head id="head" layout="home/head" charset="utf-8">
		<!--
		<Block id="head-scripts" layout="empty" cacheable="true" cacheParams="id">
		<Plugin.Jquery />
		<Html.Js src="/js/components.js" />
		<Plugin.Bootstrap />
		<Plugin.Bootstrap.Fontawesome />
		<Plugin.Validate />
		</Block>
		<Core.Themes.Themes />
		-->
    </Html.Head>
    <Html.Body id="body">    	

		<User.Account.Registersn id="userAccountRegistersn" scriptable="true" />
		<User.Account.Loginsn id="userAccountLoginsn" scriptable="true" />
		
		<Home.Header id="header" layout="home/header2">
			<User.Account.User id="userAccountUser" />
			<Fulllook.Menu id="menu" table="tests" cacheable="true" cacheParams="layout,table,position" layout="detail/topmenu"  position="top-menu" scriptable="false" />
			
		</Home.Header>
		<Container id="wrapper" layout="empty" />
		<Block layout="notifier/messages" cacheable="false" />
		<Home.Footer id="footer" layout="home/footer">
			<Cms.Banner.Region position="footer" />
		</Home.Footer>
	</Html.Body>
</Page>
