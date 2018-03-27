<Page id="page">
	<Home.Head id="head" layout="home/head" charset="utf-8">
		<Html.Css src="/default/skin/nobel/ptnn/css/style.css" />
		<Html.Css src="/default/skin/nobel/ptnn/css/user.css" />
		<themes.Themes />
		<Html.Css src="/3rdparty/bootstrap3/css/bootstrap.min.css" />
		<Html.Js src="/3rdparty/jquery/jquery-1.11.1.min.js" />
		<Html.Js src="/js/components.js" />
		<Html.Js src="/3rdparty/bootstrap3/js/bootstrap.min.js" />
		<Html.Js src="/3rdparty/Validate/dist/jquery.validate.js" />
		<Html.Js src="/js/loadding.js" />
    </Home.Head>
	<Home.Top id="top" layout="home/top"/>
	<Home.Search id="search" layout="home/search">
		<User.Account.User id="userAccountUser" layout="user/account/user" />
		<user.Account.Dialog id="userAccountDialog" cacheable="false" cacheParams="id,layout" />
	</Home.Search>
	
	<Core.Db.List table="categories" layout="home/menu" cacheable="false" cacheParams="id,parentId"/>
	<Home.Left id="left" layout="home/left"/>
	<Home.Right id="right" layout="home/right">
		<!--user.Profile.Profileuser id="userProfileSidebar" layout="user/profile/profileuser" cacheable="false" /-->
		
		<Cms.Newsletter.Newsletter  layout="cms/newsletter/newsletter"  />
		
		<!--cms.Stat layout="cms/stat" /-->
		
		<!--cms.Htmlbox layout="cms/htmlbox" /-->
		
		<!--cms.Featured  layout="cms/featured"  /-->

		<Cms.AQs.AQshome  layout="cms/AQs/AQshome" />
		
	</Home.Right>
	<Home.Footer layout="home/footer"/>
	<!--div id="qunit"></div-->
  	<!--div id="qunit-fixture"></div-->
	<!--html.Js  src="/3rdparty/qunit/qunit-1.18.0.js" /-->
	<!--html.Js  src="/testcases/js/test.js" /-->
</Page>
