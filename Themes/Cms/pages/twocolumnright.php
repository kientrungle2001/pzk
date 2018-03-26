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
		<Block layout="empty">
			<Div class="container" style="padding-top: 90px;">
				<Div class="row">
					<Div id="left" class="col-xs-9"></Div>
					<Div id="right" class="col-xs-3"></Div>
				</Div>
			</Div>
		</Block>
		<Home.Footer id="footer" layout="home/footer"/> 
	</Html.Body>
</Page>
