<Page id="page" title="Phần mềm khảo sát năng lực toàn diện">
	<Home.Head id="head" layout="home/head" charset="utf-8">
		<Html.Css src="/Default/skin/nobel/test/css/style.css" />
		<Html.Css src="/Default/skin/nobel/test/css/user.css" />
		<Html.Css src="/3rdparty/bootstrap3/css/bootstrap.min.css" />
		<Html.Js src="/3rdparty/jquery/jquery-1.11.1.min.js" />
		<Html.Js src="/js/components.js" />
		<Html.Js src="/3rdparty/bootstrap3/js/bootstrap.min.js" />
    </Home.Head>
	<Home.Top id="top" layout="home/top"/>
	<Home.Search id="search" layout="home/search">
		<User.Account.User id="userAccountUser" layout="user/account/user" />
		<User.Account.Dialog id="userAccountDialog" />
	</Home.Search>
	<Core.Db.List table="categories" layout="home/menu" cacheable="true" cacheParams="id,parentId"/>
	<Home.Left id="left_profile" layout="home/left"/>
	
	<!--home.Footer layout="home/footer"/>
	<Div id="qunit"></Div>
  	<Div id="qunit-fixture"></Div>
	<Html.Js  src="/3rdparty/qunit/qunit-1.18.0.js" />
	<Html.Js  src="/testcases/js/test.js" /-->
</Page>
