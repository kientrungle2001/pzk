<core.application id="app" name="nobel_ptnn" dispatcher="ControllerBased" 
	gsv="DJBoN802jfeoHdZJX1oM0vqdSuVjiqQ_0t4dHq0zEf4">
	<core.database.arrayCondition id="conditionBuilder" />
	<core.database id="db" host="192.168.1.12"
		user="root" password="" dbName="dbfull2" />
	<core.database.schema id="db_schema" />
	<core.rewrite.table table="categories" routeField="router"  />
	<core.rewrite.table table="news" action="news/detail"  />
	<core.rewrite.action />
	<core.rewrite.controller />
	<core.themes />
	<core.mailer id="mailer" username="kieunghia.luckystar@gmail.com" password="Nghiak4bcntt" host="smtp.gmail.com" secure="tls" port="587" />
	<core.notifier id="notifier" />
	<core.validator id="validator" />
</core.application>