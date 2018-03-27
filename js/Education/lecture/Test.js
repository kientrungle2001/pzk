PzkEducationLectureTest = PzkObj.pzkExt({
	saveChoiceUrl: '/lecture/saveTest',
	init: function(){
		var that = this;
		pzk.load('/3rdparty/jquery/jquery.rwdImageMaps.js', function(){
			$('img[usemap]').rwdImageMaps();
		});
		
		$('#btn-start').click(function(){
			var testId = null;
			if(testId = $('#lecture-detail-select').val()) {
				var url = $('#lecture-detail-select').find('option:selected').attr('rel');
				window.location = url + '?step=doing';
			}
			return false;
		});
		
		$('#lecture-detail-select').change(function(){
			$('#startForm').removeClass('hidden');
			$('#doForm').addClass('hidden');
			$(window).trigger('resize');
			$('#timer').countdown('pause');
		});
		if(pzk_request.step && pzk_request.step ==='doing') {
			$('#startForm').addClass('hidden');
			$('#doForm').removeClass('hidden');
		} else {
			$('#startForm').removeClass('hidden');
			$('#doForm').addClass('hidden');
		}
		
		$(window).trigger('resize');
		$('#questionForm').submit(function(){
			var data = $(this).serializeForm();
			that.formData = data;
			that.saveChoice(data);
			return false;
		});
		$('.btn-show-explaination').click(function() {
			$('.btn-show-explaination').attr('disabled', 'disabled');
			$('#resultModal').modal('hide');
			$.ajax({
				url: '/lecture/explain',
				data: {questionIds: that.formData.questionIds, quantity: that.formData.quantity},
				type: 'post',
				success: function(resp) {
					that.onShowExplaination(resp);
				}
			});
		});
		$('.btn-show-result').click(function() {
			$('#resultModal').modal('show');
		});
	},
	selectCatId: function(catId) {
		$('#lecture-detail-select').val(catId);
	},
	setUrl: function(url) {
		this.url = url;
	},
	setSaveChoiceUrl: function(url) {
		this.saveChoiceUrl = url;
	},
	saveChoice: function(data) {
		$.ajax({
			url: this.saveChoiceUrl,
			data: data,
			type: 'post',
			success: this.onSavedChoice
		});
	},
	onSavedChoice: function(resp) {
		eval('resp = ' + resp + ';');
		$('.btn-show-explaination').removeClass('hidden');
		$('.btn-show-result').removeClass('hidden');
		$('#questionQuantity').text(resp.quantity);
		$('#rightQuantity').text(resp.rights);
		$('#wrongQuantity').text(resp.wrongs);
		$('#resultModal').modal('show');
		for(var questionId in resp.answers) {
			$('#answers_' + questionId + '_' + resp.answers[questionId]).parents('.answer-item').addClass('bg-success');
		}
		$('input[type=radio]').attr('disabled', 'disabled');
		$('#saveChoiceBtn').attr('disabled', 'disabled');
	},
	onShowExplaination: function(resp) {
		eval('resp = ' + resp + ';');
		$('.question-explaination').removeClass('hidden');
		for(var questionId in resp) {
			var explaination = resp[questionId];
			$('#explaination_' + questionId).html(explaination);
		}
	}
});