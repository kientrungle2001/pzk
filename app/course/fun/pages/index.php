<Page id="page" title="Phần mềm khảo sát năng lực toàn diện">
	<Home.Head id="head" layout="home/head" charset="utf-8" cacheable="true" cacheParams="id,layout">
		<Html.Css src="/3rdparty/bootstrap4/dist/css/bootstrap.min.css" />
		<Html.Css src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
		<Html.Js src="/3rdparty/jquery/jquery-1.11.1.min.js" />
		<Html.Js src="/js/components.js" />
		<Html.Js src="/3rdparty/bootstrap4/dist/js/bootstrap.min.js" />
		<Html.Js src="/3rdparty/Validate/dist/jquery.validate.js" />
		<Html.Js src="/js/loadding.js" />

	</Home.Head>
	<Html.Body id="body">
		<Static conds='["and", ["equal", "status", 1], ["equal", "code", "page_top_box"]]' />
		<Home.Top id="top" layout="home/top" cacheable="true" cacheParams="id,layout" />
		<Home.Search id="search" layout="home/search">
			<User.Account.User id="userAccountUser" layout="user/account/user" />
			<User.Account.Dialog id="userAccountDialog" cacheable="true" cacheParams="id,layout" />
		</Home.Search>
		<Home.Left id="left" layout="home/left">

		</Home.Left>
		<Home.Footer layout="home/footer" />
		<Static conds='["and", ["equal", "status", 1], ["equal", "code", "page_bottom_box"]]' />
	</Html.Body>
</Page>