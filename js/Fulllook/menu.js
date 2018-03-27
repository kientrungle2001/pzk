PzkFulllookMenu = PzkObj.pzkExt({
	init: function() {
		$(".menuquatang").click(function(){
			window.location = BASE_REQUEST+'/gift';
		});
		$(".choiceclass").click(function(){
			numberclass = $(this).data("class");
			window.location = BASE_REQUEST+'/practice/class-'+numberclass;
		});
		$(".choicesubject").click(function(){
			var numbersubject = $(this).data("subject");
			var subclass = $(this).data("class");
			var alias = $(this).data("alias");
			window.location = BASE_REQUEST+'/practice/class-'+subclass+'/subject-'+alias+'-'+numbersubject;
		});
		$(".choicepractice").click(function(){
			var numbertest = $(this).data("number");
			var numclass = $(this).data("class");
			window.location = BASE_REQUEST+'/practice-examination/class-'+numclass+'/examination-'+numbertest;
		});
		$(".choicetest").click(function(){
			var numbertest = $(this).data("number");
			var numclass = $(this).data("class");
			window.location = BASE_REQUEST+'/test/class-'+numclass+'/examination-'+numbertest;
		});
		$(".choicedocument").click(function(){
			var numbersubject = $(this).data("subject");
			var subclass = $(this).data("class");   
			var alias = $(this).data("alias");
			window.location = BASE_REQUEST+'/document/class-'+subclass+'/subject-'+alias+'-'+numbersubject;
		});
		$(".otherpractice").click(function(){
			var subclass = $(this).data("class");
			window.location = BASE_REQUEST+'/practice-examination/class-'+subclass;
		});
		$(".othertest").click(function(){
			var subclass = $(this).data("class");
			window.location = BASE_REQUEST+'/test/class-'+subclass;
		});
	},
  
});