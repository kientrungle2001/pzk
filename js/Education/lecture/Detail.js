PzkEducationLectureDetail = PzkObj.pzkExt({
	saveChoiceUrl	: '/lecture/saveChoice',
	url				: false,
	init: function(){
		var that = this;
		pzk.load('/3rdparty/jquery/jquery.rwdImageMaps.js', function(){
			$('img[usemap]').rwdImageMaps();
		});
		$('#lecture-select').change(function() {
			var url = $(this).val();
			if(!!url) {
				window.location = url;
			}
		});
		$('#btn-start').click(function(){
			var exerciseNum = null;
			if(exerciseNum = $('#lecture-detail-select').val()) {
				window.location = that.url+'?exerciseNum=' + exerciseNum + '#practice-section';
			} else {
				that.alert('Bạn phải chọn bài tập để bắt đầu làm');
			}
			return false;
		});
		
		$('#lecture-detail-select').change(function(){
			$('#startForm').removeClass('hidden');
			$('#doForm').addClass('hidden');
			$(window).trigger('resize');
		});
		$('#questionForm').submit(function(){
			$('#timer').countdown('pause');
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
	alert: function(message) {
		var modal = this.getModal();
		modal.find('.modal-body').html('<img style="width: 100px; height: auto;" src="http://kingofwallpapers.com/alert/alert-005.jpg" /><h3 class="text-center">'+message+'</h3>');
		modal.modal('show');
	},
	modal: false,
	getModal: function() {
		if(!this.modal) {
			this.modal = $('<div class="modal fade" tabindex="-1" role="dialog">\
  <div class="modal-dialog" role="document">\
    <div class="modal-content">\
      <div class="modal-header hidden">\
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
        <h4 class="modal-title">Thông báo</h4>\
      </div>\
      <div class="modal-body text-center color1-bold">\
        <p>One fine body&hellip;</p>\
      </div>\
      <div class="modal-footer">\
        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>\
      </div>\
    </div>\
  </div>\
</div>');
			$('body').append(this.modal);
		}
		return this.modal;
	},
	selectExerciseNum: function(exerciseNum) {
		$('#lecture-detail-select').val(exerciseNum);
	},
	setUrl: function(url) {
		this.url = url;
		$('#lecture-select').val(url);
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
		$('input[type=radio]:checked').parents('.answer-item').addClass('bg-danger');
		for(questionId in resp.answers) {
			var userAnswerInput = $('input[name="answers['+questionId+']"]:checked');
			var userAnswerId = userAnswerInput.val();
			var answerId = resp.answers[questionId];
			if(userAnswerId == answerId) {
				$('#answers_' + questionId + '_' + answerId).parents('.answer-item').find('label').append('<span class="text-success"> - Đúng</span>');
			} else {
				userAnswerInput.parents('.answer-item').find('label').append('<span class="text-danger"> - Chưa chính xác</span>');
			}
			$('#answers_' + questionId + '_' + answerId).parents('.answer-item').removeClass('bg-danger').addClass('bg-success');
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