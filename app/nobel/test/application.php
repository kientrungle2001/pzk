<Core.Application id="app" name="nobel_test" dispatcher="ControllerBased"
	gsv="DJBoN802jfeoHdZJX1oM0vqdSuVjiqQ_0t4dHq0zEf4">
	<Core.Database.ArrayCondition id="conditionBuilder" />
	<Core.Database id="db" host="localhost"
		user="chothon" password="123456" dbName="flsn" />
	<Core.Database.Schema id="db_schema" />
	<Core.Themes />

	<Core.Rewrite.Table table="categories" routeField="router"  />

	<Core.Rewrite.Table table="news" action="News/detail"  />


	<Core.Rewrite.Request pattern="^\/game$" route="/Game/ptnn"/>

	<Core.Rewrite.Request pattern="^\/rating$" route="/Home/rating"/>

	<Core.Rewrite.Request pattern="^\/gift$" route="/Relax/home"/>

	<Core.Rewrite.Request pattern="^\/document\/class-([*class*][\d]+)\/subject-[\w\d-]+-([*id*][\d]+)$" route="/Document/index/$2" queryParams="class,id" />

	<Core.Rewrite.Request pattern="^\/document\/class-([*class*][\d]+)\/subject-[\w\d-]+\/[\w\d-]+-([*id*][\d]+)$" route="/Document/detail/$2" queryParams="id,class"/>

	<Core.Rewrite.Request pattern="^\/practice\/class-([*class*][\d]+)$" route="/Practice/home/$1" queryParams="class"/>

	<Core.Rewrite.Request pattern="^\/practice\/class-([*class*][\d]+)\/subject-[\w-]+-([*id*][\d]+)$" route="/Practice/detail/$2" queryParams="class,id"/>

	<Core.Rewrite.Request pattern="^\/practice\/class-([*class*][\d]+)\/subject-[\w-]+-([*id*][\d]+)\/examination-([*de*][\w- \d\%]+)$" route="/Practice/doQuestion/$2" queryParams="class,id,de"/>
	<Core.Rewrite.Request pattern="^\/practice\/class-([*class*][\d]+)\/subject-[\w-]+-([*id*][\d]+)\/examination-([*de*][\w- \d\%]+)\/trial$" route="/Practice/doQuestion/$2" queryParams="class,id,de"/>
	<Core.Rewrite.Request pattern="^\/practice\/class-([*class*][\d]+)\/subject-[\w-]+-([*id*][\d]+)\/topic-[\w-]+-([*topic*][\d]+)\/examination-([*de*][\w- \d\%]+)$" route="/Practice/doQuestion/$2" queryParams="class,id,de,topic"/>

	<Core.Rewrite.Request pattern="^\/practice\/class-([*class*][\d]+)\/subject-[\w-]+-([*id*][\d]+)\/topic-[\w-]+-([*topic*][\d]+)\/media-([*media*][\d]+)$" route="/Practice/doMediaQuestion/$2" queryParams="class,id,media,topic"/>

	<Core.Rewrite.Request pattern="^\/practice\/class-([*class*][\d]+)\/subject-[\w-]+-([*id*][\d]+)\/topic-[\w-]+-([*topic*][\d]+)\/vocabulary-([*documentId*][\d]+)$" route="/Practice/showVocabulary/$2" queryParams="class,id,documentId,topic"/>

	<Core.Rewrite.Request pattern="^\/practice\/class-([*class*][\d]+)\/subject-[\w-]+-([*id*][\d]+)\/examination-([*de*][\d]+)$" route="/Test/doTest/$2" queryParams="class,id,de" defaultQueryParams='{"practice":"1"}'/>

	<Core.Rewrite.Request pattern="^\/practice-examination\/class-([*class*][\d]+)\/examination-([\d]+)$" route="/Test/test/$2" queryParams="class" defaultQueryParams='{"practice":"1"}'/>

	<Core.Rewrite.Request pattern="^\/practice-examination\/class-([*class*][\d]+)\/week-([*id*][\d]+)\/examination-([*de*][\d]+)$" route="/Test/doTestSN/$2" queryParams="class, id, de " defaultQueryParams='{"practice":"1"}'/>

	<Core.Rewrite.Request pattern="^\/practice-examination\/class-([*class*][\d]+)$" route="/Test/test" queryParams="class" defaultQueryParams='{"practice":"1"}'/>

	<Core.Rewrite.Request pattern="^\/test\/class-([*class*][\d]+)\/examination-([\d]+)$" route="/Test/test/$2" queryParams="class" defaultQueryParams='{"practice":"0"}'/>

	<Core.Rewrite.Request pattern="^\/practice-examination\/class-([*class*][\d]+)\/week-([*id*][\d]+)$" route="/Test/test/$2" queryParams="class,id" defaultQueryParams='{"practice":"1"}'/>
	<Core.Rewrite.Request pattern="^\/test\/class-([*class*][\d]+)\/week-([*id*][\d]+)$" route="/Test/test/$2" queryParams="class, id" defaultQueryParams='{"practice":"0"}'/>

	<Core.Rewrite.Request pattern="^\/test\/class-([*class*][\d]+)\/week-([*id*][\d]+)\/examination-([*de*][\d]+)$" route="/Test/doTestSN/$2" queryParams="class,id,de" defaultQueryParams='{"practice":"0"}'/>

	<Core.Rewrite.Request pattern="^\/test\/class-([*class*][\d]+)$" route="/Test/test" queryParams="class" defaultQueryParams='{"practice":"0"}'/>

	<Core.Rewrite.Action />
	<Core.Rewrite.Controller />
	<Core.Mailer id="mailer" username="kieunghia.luckystar@gmail.com" password="121310121310" host="smtp.gmail.com" secure="tls" port="587" />
	<Core.Notifier id="notifier" />
	<Core.Validator id="validator" />
</Core.Application>
