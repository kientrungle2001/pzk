<Page id="page" title="Phần mềm khảo sát năng lực toàn diện">
	<Home.Head id="head" layout="home/head" charset="utf-8" cacheable="true" cacheParams="id,layout">
		<!--[if lte IE 8]> <Style>  #menu{background: green!important} </Style><![endif]-->
		<Html.Css src="/default/skin/nobel/css/style.css" />
		<Html.Css src="/default/skin/nobel/css/user.css" />
		<Html.Css src="/3rdparty/bootstrap3/css/bootstrap.min.css" />
		<Html.Js src="/3rdparty/jquery/jquery-1.11.1.min.js" />
		<Html.Js src="/js/components.js" />
		<Html.Js src="/3rdparty/bootstrap3/js/bootstrap.min.js" />
		<Html.Js src="/3rdparty/Validate/dist/jquery.Validate.js" />
		<Html.Js src="/js/loadding.js" />
		
    </Home.Head>
	<Html.Body id="body">
	<Home.Top id="top" layout="home/top" cacheable="true" cacheParams="id,layout"/>
	<Home.Search id="search" layout="home/search">
		<User.Account.User id="userAccountUser" layout="user/account/user" />
		<User.Account.Dialog id="userAccountDialog" cacheable="true" cacheParams="id,layout" />
	</Home.Search>
	<Cms.Menu layout="home/menu" />
	<Home.Left id="left_profile" layout="home/left" />
	<Home.Right id="right" layout="home/right">
		<Cms.Support id="userProfileSidebar" layout="cms/esupport" cacheable="true" />
		<Cms.Support layout="cms/vnsupport" cacheable="true" cacheParams="id,layout" />
		<Cms.Course  layout="cms/course" cacheable="true"  cacheParams="id,layout" />
		<Cms.Image  layout="cms/image" cacheable="true"  cacheParams="id,layout"/>
		<Cms.Image  layout="cms/libraryimg" cacheable="true"  cacheParams="id,layout" />
		<Cms.Stat layout="cms/stat" cacheable="true" cacheParams="id,layout"/>
	</Home.Right>
	<Home.Advertisement id="advertisement" layout="home/advertisement" cacheable="true" cacheParams="id,layout"/>
	<Home.Footer layout="home/footer"/>
	</Html.Body>
	<!--<Div id="qunit"></Div>
  	<Div id="qunit-fixture"></Div>
	<Html.Js  src="/3rdparty/qunit/qunit-1.18.0.js" />
	<Html.Js  src="/testcases/js/test.js" /-->
</Page>