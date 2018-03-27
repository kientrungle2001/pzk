<Core.Application id="app" name="nobel_olympic" dispatcher="ControllerBased" 
	gsv="DJBoN802jfeoHdZJX1oM0vqdSuVjiqQ_0t4dHq0zEf4">
	<Core.Database.ArrayCondition id="conditionBuilder" />
	<Core.Database id="db" host="192.168.1.12"
		user="root" password="" dbName="dbfull3" />
	<Core.Database.Schema id="db_schema" />
	<Core.Rewrite.Table table="categories" routeField="router"  />
	<Core.Rewrite.Table table="news" action="news/detail"  />
	<Core.Rewrite.Action />
	<Core.Rewrite.Controller />
	<Core.Themes />
	<Core.Mailer id="mailer" username="kieunghia.luckystar@gmail.com" password="121310121310" host="smtp.gmail.com" secure="tls" port="587" />
	<Core.Notifier id="notifier" />
	<Core.Validator id="validator" />
</Core.Application>