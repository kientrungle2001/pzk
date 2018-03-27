<Page id="page">
	<Html.Head id="head" layout="home/head" charset="utf-8">
		<Plugin.Jquery />
		<Plugin.Bootstrap />
		<Plugin.Validate />
		<Html.Js src="/js/components.js" />
		<Html.Css src="/default/skin/nobel/ptnn/css/style.css" />
		<Html.Css src="/default/skin/nobel/ptnn/css/user.css" />
		<Core.Themes.Themes />
    </Html.Head>
    <Html.Body id="body">
		<Block id="header" layout="empty" />
		<Home.Search id="search" layout="home/search">
			<User.Account.User id="userAccountUser" layout="user/account/user" />
			<User.Account.Dialog id="userAccountDialog" cacheable="false" cacheParams="id,layout" />
		</Home.Search>
		
		<Cms.Menu layout="home/menu" cacheable="false" cacheParams="id,parentId"/>
		<Home.Left id="left" layout="home/left"/>
		<Home.Right id="right" layout="home/right">
			<!--user.Profile.Profileuser id="userProfileSidebar" layout="user/profile/profileuser" cacheable="false" /-->
			
			<!--cms.Newsletter.Newsletter  layout="cms/newsletter/newsletter"  /-->
			
			<!--user.Stat.Highest layout="user/stat/highest" /-->
			
			<!--user.Stat.LatestPaid layout="user/stat/latestPaid" /-->
			
			<!--user.Stat.LatestRegister layout="user/stat/latestRegister" /-->
			
			<!--user.Stat.LatestTest layout="user/stat/latestTest" /-->
			
			<!--cms.Stat layout="cms/stat" /-->
			
			<!--cms.Featured.Featured  layout="cms/featured/featured"  /-->
			
			<!--test.Latest  layout="test/latest"  /-->
			
			<!--cms.Featured.Latest  layout="cms/featured/latest"  /-->
			
			<!--cms.Banner.Banner  layout="cms/banner/banner"  /-->
	
			<!--cms.AQs.AQshome  layout="cms/AQs/AQshome" /-->
			<Cms.Htmlbox itemId="3" />
		</Home.Right>
		<Home.Footer layout="home/footer"/>
	</Html.Body>
	<!--div id="qunit"></Div-->
  	<!--div id="qunit-fixture"></Div-->
	<!--html.Js  src="/3rdparty/qunit/qunit-1.18.0.js" /-->
	<!--html.Js  src="/testcases/js/test.js" /-->
</Page>
