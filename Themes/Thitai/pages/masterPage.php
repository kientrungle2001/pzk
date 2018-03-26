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
		<User.Account.Dialog id="userAccountDialog" layout="dialog" cacheable="true" cacheParams="id,layout" />
		<Thitai.Header id="header" layout="header">
			<User.Account.User id="userAccountUser" position="user" layout="thitai/user" cacheable="true" />
		</Thitai.Header>
		<Block id="wrapper" layout="empty" />
		<Thitai.Footer id="footer" layout="footer" cacheable="true" cacheParams="id,layout">
		</Thitai.Footer>
	</Html.Body>
</Page>
