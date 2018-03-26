<Page id="page">
	<Html.Head id="head" layout="home/head" charset="utf-8">
		<Plugin.Jquery />
		<Plugin.Jqueryui />
		<Html.Js src="/js/components.js" />
		<Plugin.Bootstrap />
		<Plugin.Bootstrap.Fontawesome />
		<Plugin.Validate />
		<Core.Themes.Themes />
		
    </Html.Head>
    <Html.Body id="body">
		<User.Account.Dialog id="userAccountDialog" />
		<Cms.Menu id="header" layout="home/header">
			<User.Account.User id="userAccountUser" />
		</Cms.Menu>
		<Block id="wrapper" layout="empty" />
		<Home.Footer id="footer" layout="home/footer"/> 
	</Html.Body>
	<!--div id="qunit"></Div-->
  	<!--div id="qunit-fixture"></Div-->
	<!--html.Js  src="/3rdparty/qunit/qunit-1.18.0.js" /-->
	<!--html.Js  src="/testcases/js/test.js" /-->
</Page>
