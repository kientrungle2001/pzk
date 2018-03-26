<Page id="page">
	<Html.Head id="head" layout="home/head" charset="utf-8">
		<Plugin.Jquery />
		<Html.Js src="/js/components.js" />
		<Plugin.Bootstrap />
		<Plugin.Bootstrap.Fontawesome />
		<Plugin.Validate />
		<Core.Themes.Themes />
    </Html.Head>
    <Html.Body id="body">
		<Plugin.Facebook />
		<User.Account.Dialog id="userAccountDialog" />
		<Home.Header id="header" layout="home/header">
			<Cms.Menu id="menu">
				<User.Account.User id="userAccountUser" />
			</Cms.Menu>
		</Home.Header>
		<Block id="left" layout="empty" />
		<Home.Footer id="footer" layout="home/footer"/> 
	</Html.Body>
</Page>
