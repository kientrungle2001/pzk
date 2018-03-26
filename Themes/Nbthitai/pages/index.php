<Page id="page">
	<Html.Head id="head" layout="home/head" charset="utf-8">
		<Plugin.Jquery />
		<Html.Js src="/js/components.js" />
		<Plugin.Bootstrap />
		<Plugin.Bootstrap.Fontawesome />
		<Plugin.Validate />
		<Core.Themes.Themes />
		<Plugin.Tinymce />
		
    </Html.Head>
    <Html.Body id="body">
		<User.Account.Dialog id="userAccountDialog" layout="thitai/dialog" cacheable="true" cacheParams="id,layout" />
		<Thitai.Header id="header" layout="thitai/header">
			<User.Account.User id="userAccountUser" position="user" layout="thitai/user" cacheable="true" />
			<Cms.Menu id="menu" position="menu" />
		</Thitai.Header>
		<Block id="wrapper" layout="empty" />
		<Thitai.Footer id="footer" layout="thitai/footer" cacheable="true" cacheParams="id,layout">
		</Thitai.Footer>
	</Html.Body>
</Page>
