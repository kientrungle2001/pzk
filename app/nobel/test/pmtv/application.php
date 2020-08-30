<core.application id="app" name="nobel_test_pmtv" dispatcher="ControllerBased" 
	gsv="DJBoN802jfeoHdZJX1oM0vqdSuVjiqQ_0t4dHq0zEf4">
	<core.database.arrayCondition id="conditionBuilder" />
	<core.database id="db" host="localhost"
		user="root" password="" dbName="dbfull4" />
	<core.database.schema id="db_schema" />
	<core.themes />
	<core.rewrite.table table="categories" routeField="router"  />
	
	<core.rewrite.table table="news" action="news/detail"  />
	
	<core.rewrite.request pattern="^\/game$" route="/Game/ptnn"/>
	
	<core.rewrite.request pattern="^\/rating$" route="/home/rating"/>
	
	<core.rewrite.request pattern="^\/gift$" route="/relax/home"/>
	
	<core.rewrite.request pattern="^\/document\/class-([*class*][\d]+)\/subject-[\w\d\-]+-([*id*][\d]+)$" route="/document/index/$2" queryParams="class,id"/>
	
	<core.rewrite.request pattern="^\/document\/class-([*class*][\d]+)\/subject-[\w\d\-]+\/[\w\d\-]+-([*id*][\d]+)$" route="/document/detail/$2" queryParams="id,class"/>
	
	<core.rewrite.request pattern="^\/practice\/class-([*class*][\d]+)$" route="/practice/home/$1" queryParams="class"/>
	
	<core.rewrite.request pattern="^\/practice\/class-([*class*][\d]+)\/subject-[\w\-]+-([*id*][\d]+)$" route="/practice/detail/$2" queryParams="class,id"/>
	
	<core.rewrite.request pattern="^\/practice\/class-([*class*][\d]+)\/subject-[\w\-]+-([*id*][\d]+)\/examination-([*de*][\w\- \d\%]+)$" route="/practice/doQuestion/$2" queryParams="class,id,de"/>
	<core.rewrite.request pattern="^\/practice\/class-([*class*][\d]+)\/subject-[\w\-]+-([*id*][\d]+)\/topic-[\w\-]+-([*topic*][\d]+)\/examination-([*de*][\w\- \d\%]+)$" route="/practice/doQuestion/$2" queryParams="class,id,de,topic"/>
	
	<core.rewrite.request pattern="^\/practice\/class-([*class*][\d]+)\/subject-[\w\-]+-([*id*][\d]+)\/examination-([*de*][\d]+)$" route="/test/doTest/$2" queryParams="class,id,de" defaultQueryParams='{"practice":"1"}'/>

	<core.rewrite.request pattern="^\/practice-examination\/class-([*class*][\d]+)\/examination-([\d]+)$" route="/test/test/$2" queryParams="class" defaultQueryParams='{"practice":"1"}'/>
	
	<core.rewrite.request pattern="^\/practice-examination\/class-([*class*][\d]+)$" route="/test/test" queryParams="class" defaultQueryParams='{"practice":"1"}'/>
	
	<core.rewrite.request pattern="^\/test\/class-([*class*][\d]+)\/examination-([\d]+)$" route="/test/test/$2" queryParams="class" defaultQueryParams='{"practice":"0"}'/>
	
	<core.rewrite.request pattern="^\/test\/class-([*class*][\d]+)$" route="/test/test" queryParams="class" defaultQueryParams='{"practice":"0"}'/>
	
	<core.rewrite.action />
	<core.rewrite.controller />
	<core.mailer id="mailer" username="kieunghia.luckystar@gmail.com" password="121310121310" host="smtp.gmail.com" secure="tls" port="587" />
	<core.notifier id="notifier" />
	<core.validator id="validator" />
</core.application>