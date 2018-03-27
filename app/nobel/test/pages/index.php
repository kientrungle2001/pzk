<Page id="page" title="Phần mềm khảo sát năng lực toàn diện">
	<Home.Head cacheable="true" cacheParams="id,layout" id="head" layout="home/head" charset="utf-8">
		<Html.Css src="/Default/skin/nobel/test/css/style.css" />
		<Html.Css src="/Default/skin/nobel/test/css/user.css" />
		<Html.Css src="/3rdparty/bootstrap3/css/bootstrap.min.css" />
		<Html.Js src="/3rdparty/jquery/jquery-1.11.1.min.js" />
		<Html.Js src="/js/components.js" />
		<Html.Js src="/3rdparty/bootstrap3/js/bootstrap.min.js" />
		<Html.Js src="/3rdparty/Validate/dist/jquery.Validate.js" />
		<Html.Js src="/js/loadding.js" />
    </Home.Head>
	<Html.Body id="body">
	<Home.Top cacheable="true" cacheParams="id,layout" id="top" layout="home/top"/>
	<Home.Search id="search" layout="home/search">
		<User.Account.User id="userAccountUser" layout="user/account/user" />
		<User.Account.Dialog id="userAccountDialog" cacheable="true" cacheParams="id,layout" />
	</Home.Search>
	<Cms.Menu layout="home/menu" cacheable="true" cacheParams="id,parentId"/>
	<Home.Left id="left" layout="home/left"/>
	<Home.Right id="right" layout="home/right">
		<Cms.Support id="userProfileSidebar" layout="cms/esupport" cacheable="true" cacheParams="id,layout" />
		<Cms.Support layout="cms/vnsupport" cacheable="true" cacheParams="id,layout" />
		<Cms.Course  layout="cms/course" cacheable="true"  cacheParams="id,layout" />
		<Cms.Image  layout="cms/image" cacheable="true"  cacheParams="id,layout"/>
		<Cms.Image  layout="cms/libraryimg" cacheable="true"  cacheParams="id,layout" />
		<Cms.Stat layout="cms/stat" cacheable="true" cacheParams="id,layout"/>
	</Home.Right>
	<Home.Advertisement id="advertisement" layout="home/advertisement" cacheable="true" cacheParams="layout"/>
	<Home.Footer layout="home/footer"/>
	</Html.Body>
</Page>
