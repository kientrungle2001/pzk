<Page id="page" title="Học luyện tiếng Việt và Phát triển ngôn ngữ">
	<Html.Head id="head" layout="home/head" charset="utf-8">
		<Plugin.Jquery />
		<Html.Js src="/js/components.js" />
		<Plugin.Bootstrap />
		<Plugin.Bootstrap.Fontawesome />
		<Plugin.Validate />
		<Core.Themes.Themes />
    </Html.Head>
    <Html.Body id="body">
		<User.Account.Dialog id="userAccountDialog" />
		<Home.Header id="header" layout="home/header">
			<User.Account.User id="userAccountUser" />
		</Home.Header>
		<Block id="left" layout="empty" />
		<Home.Footer id="footer" layout="home/footer">
			<!--cms.Stat layout="cms/stat" /-->
		</Home.Footer>
	</Html.Body>
</Page>