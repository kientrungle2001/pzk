<h2 class="text-center">Lịch sử học tập</h2>
<div class="container">
<div class="row">
<div class="col-xs-12">

    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" id="stars" class="btn btn-primary btn-tab" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                <div class="hidden-xs">Bộ đề trắc nghiệm</div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="favorites" class="btn btn-default btn-tab" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                <div class="hidden-xs">Thi thử trực tuyến</div>
            </button>
        </div>
        <!--
		<div class="btn-group" role="group">
            <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                <div class="hidden-xs">Following</div>
            </button>
        </div>
		-->
    </div>
	
	<script>
	$('.btn-tab').click(function() {
		var $tab = $(this);
		$('.btn-tab').removeClass('btn-primary').addClass('btn-default');
		$tab.removeClass('btn-default').addClass('btn-primary');
	});
	</script>

        <div class="well">
      <div class="tab-content">
        <div class="tab-pane fade in active" id="tab1">
          <?php 
		  $tests = _db()->select('user_book.id, user_book.testId, user_book.mark, user_book.quantity_question, user_book.duringTime, user_book.startTime, tests.name')->fromUser_book()->joinTests('user_book.testId=tests.id')->whereUserId(pzk_session('userId'))->where('user_book.categoryId=1409')->orderBy('user_book.id desc')->result();
		  ?>
		  <table class="table table-bordered">
			<thead class="bg-success">
				<th>STT</th>
				<th>Tên đề</th>
				<th>Số câu đúng</th>
				<th>Tổng số câu</th>
				<th>Thời gian làm bài</th>
				<th>Thời điểm nộp bài</th>
			</thead>
			<tbody>
			<?php foreach($tests as $index => $test): ?>
				<tr>
					<td><?php echo ($index + 1)?></td>
					<td><?php echo @$test['name']?></td>
					<td><?php echo @$test['mark']?></td>
					<td><?php echo @$test['quantity_question']?></td>
					<td><?php  echo time_duration($test['duringTime']) ?></td>
					<td><?php echo date('H:i d/m/Y', strtotime($test['startTime']))?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		  </table>
        </div>
        <div class="tab-pane fade in" id="tab2">
          <?php 
		  $contests = _db()->select('user_book.id, user_book.testId, user_book.mark, user_book.quantity_question, user_book.duringTime, user_book.startTime, tests.name')->fromUser_book()->joinTests('user_book.testId=tests.id')->whereUserId(pzk_session('userId'))->where('user_book.compability=1')->orderBy('user_book.id desc')->result();
		  ?>
		  <table class="table table-bordered">
			<thead class="bg-success">
				<th>STT</th>
				<th>Tên đề</th>
				<th>Số câu đúng</th>
				<th>Tổng số câu</th>
				<th>Thời gian làm bài</th>
				<th>Thời điểm nộp bài</th>
			</thead>
			<tbody>
			<?php foreach($contests as $index => $test): ?>
				<tr>
					<td><?php echo ($index + 1)?></td>
					<td><?php echo @$test['name']?></td>
					<td><?php echo @$test['mark']?></td>
					<td><?php echo @$test['quantity_question']?></td>
					<td><?php  echo time_duration($test['duringTime']) ?></td>
					<td><?php echo date('H:i d/m/Y', strtotime($test['startTime']))?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		  </table>
        </div>
        <!--
		<div class="tab-pane fade in" id="tab3">
          <h3>This is tab 3</h3>
        </div>
		-->
      </div>
    </div>

</div>
</div>
</div>