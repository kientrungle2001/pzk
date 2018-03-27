<core.application id="app" name="nobel">
	<core.database.arrayCondition id="conditionBuilder" />
	<core.database id="db" host="192.168.0.102"
	user="root" password="" dbName="dbfull3" />

	<core.database.schema id="db_schema" />
	<core.rewrite.table table="categories" routeField="router"  />
	<core.rewrite.table table="news" action="news/detail"  />
	<core.rewrite.action />
	<core.rewrite.controller />
	<core.themes />
	<core.mailer id="mailer" username="kieunghia.luckystar@gmail.com" password="121310121310" host="smtp.gmail.com" secure="tls" port="587" />
	<core.notifier id="notifier" />
	<core.validator id="validator" />
</core.application>