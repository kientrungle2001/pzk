<Page id="page">
	
	<Html.Head id="head" layout="admin/home/head" charset="utf-8">
		<Plugin.Jquery />
		<Plugin.Validate />
		<Plugin.Bootstrap theme="true" />
		<Plugin.Bootstrap.Select2 />
		<Plugin.Tinymce />

		<Plugin.Jqueryui />
		<Plugin.Jqueryui.Timepicker />
		<Plugin.Jqueryui.Daterangepicker />
		<!--Plugin.Jeasyui /-->
		<Html.Js src="/js/components.js" />
    </Html.Head>
    <Html.Body id="body">
		<Home.Menu layout="admin/home/menu" />
		<Home.Content layout="admin/home/content" scriptable="false">
			<Home.Right id="right" layout="admin/home/right" />
			<Home.Left id="left" layout="admin/home/left" />
		</Home.Content>
		<Home.Footer layout="admin/home/footer" />
	</Html.Body>
</Page>