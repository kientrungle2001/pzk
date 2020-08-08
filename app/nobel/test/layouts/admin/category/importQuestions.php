<?php $categoryId = pzk_request()->getSegment(3); 
$cat = _db()->selectAll()->fromCategories()->whereId($categoryId)->result_one();
$controller = pzk_controller();
$content = file_get_contents(BASE_DIR . '/tmp/cauhoi.txt');
?>
<div class="panel panel-default">
<div class="panel-heading">
    <b>Import câu hỏi - Danh mục: {cat[name]}</b>
</div>
<div class="panel-body borderadmin">

	<div class="row">
		<div class="col-xs-6">
		<form role="form" method="post" enctype="multipart/form-data"  action="{url /admin}_{controller.module}/importQuestionsPost/{categoryId}">
		 <div class="form-group clearfix">
				<label for="content">Nội dung</label>
				<div style="float: left;width: 100%;" class="item">
					<textarea id="content" name="content" onkeyup="previewImportQuestions($(this).val());" onblur="previewImportQuestions($(this).val());" style="width: 100%; height: 400px">{content}</textarea>
				</div>
			</div>
		  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Cập nhật</button>
		  <a class="btn btn-default" href="{url /admin}_{controller.module}/index"><span class="glyphicon glyphicon-refresh"></span> Quay lại</a>
		</form>
		</div>
		<div class="col-xs-6">
			<label for="content">Xem trước</label><br />
			<div id="preview" style="float: left;width: 100%;" class="item">
			
			</div>
		</div>
	</div>

</div>
</div>
<script>
	function previewImportQuestions(content) {
		var result = previewImportQuestionsAction(content);
		$('#preview').width($('#content').width());
		$('#preview').html(result);
		$('#content').height($('#preview').height());
		return true;
		if(1)
		$.ajax({
			url: '/admin_{controller.module}/previewImportQuestions',
			type: 'post',
			data: {content: content, isAjax: true},
			success: function(resp) {
				$('#preview').html(resp);
			}
		});
	}
	
	function previewImportQuestionsAction($content) {
		var result = '';
		var $model = new ImportCategory();
		$model.import($content);
		var $questions = $model.getQuestions();
		var $totalAnswers = 0;
		var $questionIndex = 1;
		var $answerAlphas = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
		for(var i = 0; i < $questions.length; i++) {
			var $question = $questions[i];
			$question.import();
			var $answers = $question.getAnswers();
			if(!$answers.length) continue;
			var $recommend = '';
			result += '<strong><i>'+$questionIndex + '. ' + $question.get('name') +'</i></strong><br />';
			result += '<div>';
			for(var j = 0; j < $answers.length; j++) {
				var $answer = $answers[j];
				if($answer.get('status')) {
					result += '<strong>' + $answerAlphas[j] + '. ' + $answer.getContent() + '</strong><br />';
					$recommend = $answer.getRecommend();
				} else {
					result +=  $answerAlphas[j] + '. ' + $answer.getContent() + '<br />';
				}
				
			}
			result += '</div><br /><br /><br />';
			result += '<div>' + $recommend + '</div><br />';
			$totalAnswers += $answers.length;
			$questionIndex ++;
		}
		return result;
	}
	function ImportCategory() {
		
	}
	ImportCategory.pzkImpl({
		import: function($content) {
			var $questions = [];
			this.setContent($content);
			var $questionContents = $content.split('-----');
			for(var i = 0; i < $questionContents.length; i++) {
				var $questionContent = $questionContents[i];
				if(!!$.trim($questionContent)) {
					var $question = new ImportQuestionSplit();
					$question.setContent($questionContent);
					$question.index = i;
					$questions.push($question);
				}
			}
			this.setQuestions($questions);
		},
		setContent: function($content) {
			this.$content = $content;
		},
		getContent: function() {
			return this.$content;
		},
		setQuestions: function($questions) {
			this.$questions = $questions;
		},
		getQuestions: function() {
			return this.$questions;
		}
	});
	
	function ImportQuestionSplit() {
		
	}
	ImportQuestionSplit.pzkImpl({
		import: function() {
			var $answers = [];
			var $content = this.getContent();
			var $contents = $content.split('===');
			var $nameRegion = $contents[0] || '';
			var $answersRegion = $contents[1] || '';
			var $rightRegion = $contents[2] || '';
			var $levelRegion = $contents[3] || '';
			var $recommend = nl2br($contents[4] || '');
			var $matches = $answersRegion.matchAll(/[\r\n][\s\t]*[ABCDEFGHI][\s\t]*\.[\s\t]*([^\r\n]*)/g);
			var $answerContents = $matches[1];
			var $match = $rightRegion.matchAll(/[\s\t]*:[\s\t]*([ABCDEFGHI])/g);
			var $rightIndex = -1;
			if($match[1]) {
				$rightIndex = $match[1][0].charCodeAt(0) - 'A'.charCodeAt(0);
			}
			var $levelMatch = $levelRegion.matchAll(/[\s\t]*:[\s\t]*([\d]+)/g);
			var $level = ($levelMatch[1] && $levelMatch[1][0]) || 0;
			var $nameRepaired = $nameRegion.replace(/^[^\:\.]*[\:\.]\s*/g, '');
			$nameRepaired = $.trim(nl2br($nameRepaired));
			//$this->setName( trim($name));
			this.setname( $nameRepaired);
			if($answerContents) {
				for(var i = 0; i < $answerContents.length; i++) {
					var $answerContent = $answerContents[i];
					var $answer = new ImportAnswer();
					$answer.setContent($answerContent);
					$answers.push($answer);
				}	
			}
			
			if($rightIndex != -1) {
				$answers[$rightIndex].setRecommend($recommend);
				$answers[$rightIndex].setStatus('1');
			} else {
				if(console)
					console.log('Câu hỏi '+ this.index + ': ' + $nameRepaired + ' chưa có câu trả lời đúng', 'danger');
			}
			if(!$level) {
				if(console)
				console.log('Câu hỏi '+ this.index + ': ' + $nameRepaired + ' chưa có độ khó', 'danger');
			}
			this.setLevel($level);
			this.setAnswers($answers);
			if(!$answers.length) {
				if(console)
				console.log('Câu hỏi '+ this.index + ': ' + $nameRepaired + ' chưa có câu trả lời nào', 'danger');
			}
		},
		setContent: function($content) {
			this.$content = $content;
		},
		getContent: function() {
			return this.$content;
		},
		setName: function($name) {
			this.$name = $name;
		},
		getName: function() {
			return this.$name;
		},
		setLevel: function($level) {
			this.$level = $level;
		},
		getLevel: function() {
			return this.$level;
		},
		setAnswers: function($answers) {
			this.$answers = $answers;
		},
		getAnswers: function() {
			return this.$answers;
		}
	});
	
	function ImportAnswer() {
		
	}
	
	ImportAnswer.pzkImpl({
		setContent: function($content) {
			this.$content = $content;
		},
		getContent: function() {
			return this.$content;
		},
		setRecommend: function($recommend) {
			this.$recommend = $recommend;
		},
		getRecommend: function() {
			return this.$recommend;
		},
		setStatus: function($status) {
			this.$status = $status;
		},
		getStatus: function() {
			return this.$status || 0;
		}
	});
</script>