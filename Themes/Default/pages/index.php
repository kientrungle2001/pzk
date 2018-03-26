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
		<User.Account.Dialog id="userAccountDialog" scriptable="true" />
		<Home.Header id="header" layout="home/header">
			<User.Account.User id="userAccountUser" />
		</Home.Header>
		<Block id="wrapper" layout="empty" />
		<Home.Footer id="footer" layout="home/footer">
			<Education.Achievement.Achievement layout="home/boxachievement" position="box-achievement" />
			<Cms.Banner.Region position="footer" />
		</Home.Footer>
	</Html.Body>
</Page>
