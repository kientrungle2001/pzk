<Block id="aboutbtnthitai" layout="thitai/aboutbtn">
	<Core.Db.List table="tests" id="practicelist" cacheable="true" cacheParams="layout" layout="test/showPracticenumber" conditions ='["and", ["status", "1"], ["practice","1"]]' orderBy="tests.Ordering desc" pageSize="17" position="practice-place"/>
	
</Block>