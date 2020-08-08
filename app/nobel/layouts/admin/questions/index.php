<?php 
	$keyword = pzk_session()->getQuestionsKeyword();
	$orderBy = pzk_session()->getQuestionsOrderBy();
	$categoryId = pzk_session()->getQuestionsCategoryId();
    $testId = pzk_session()->getQuestionsTestId();
    $trial = pzk_session()->getQuestionsTrial();
    $questionType = pzk_session()->getQuestionsQuestionType();
	if($categoryId) {
		$data->conditions .= " and categoryIds like '%,$categoryId,%'";
	}

    if($testId) {
        $data->conditions .= " and testId like '%$testId%'";
    }
    if($trial) {
        $data->conditions .= " and trial like '%$trial%'";
    }
    if($questionType) {
    	$data->conditions .= " and questionType like '%$questionType%'";
    }
    
	if($orderBy) {
		$data->orderBy = $orderBy;
	}

	$pageSize = pzk_session()->getQuestionsPageSize();
	if($pageSize) {
		$data->pageSize = $pageSize;
	}
	$data->pageNum = pzk_request()->getPage();

	$items = $data->getItems($keyword, array('name'));
	$countItems = $data->getCountItems($keyword, array('name'));
	$pages = ceil($countItems / $data->pageSize);

	$categories = _db()->select('*')->from('categories')->result();
    $testIds = _db()->select('*')->from('tests')->result();
    $admin = _db()->select('*')->from('admin')->result();
	$cats = array();
	foreach($categories as $cat) {
		$cats[$cat['id']] = $cat;
	}

    $tests = array();
    foreach($testIds as $cat) {
        $tests[$cat['id']] = $cat;
    }

    function get('name'$item, $admin) {
        foreach($admin as $val) {
            if($val['id'] == $item) {
                return $val['name'];
            }
        }
    }

	function getCategoriesName($item, $categories) {
		$rs = array();
		$catIds = explode(',', $item['categoryIds']);

		foreach($catIds as $catId) {
			if($catId) {
                if(isset($categories[$catId]['name'])) {
                    $rs[] = $categories[$catId]['name'];

                }
			}
		}
		return implode(', ', $rs);
	}

    function getTestName($item, $testIds) {
        $rs = array();
        $catIds = explode(',', $item['testId']);

        foreach($catIds as $catId) {
            if($catId) {
                $rs[] = $testIds[$catId]['name'];
            }
        }
        return implode(', ', $rs);
    }


	$categoryTree = buildArr($categories,'parent',0);
	
?>
<script type="text/javascript">
	$(function() {
		$('input[name^=ordering]').keyup(function(evt){
			if(evt.keyCode == 40) {
				var next = $(this).parents('tr').next().find('input[name^=ordering]:first');
				if(next.length) {
					next.focus();
					next.select();
				}
			} else if(evt.keyCode == 38) {
				var prev = $(this).parents('tr').prev().find('input[name^=ordering]:first');
				if(prev.length) {
					prev.focus();
					prev.select();
				}
			}
		});
	});
	function saveOrdering(field) {
		var inputs = $('input[name^='+field+']');
		var orderings = {};
		$.each(inputs, function(index, input) {
			var val = $(input).val();
			var id = $(input).attr('rel');
			orderings[id] = val;
		});
		$.ajax({url: 'saveOrderings', type: 'post', data: {orderings: orderings, field: field}, success: function() { window.location.reload(); }});
	}
</script>
<div class="well">
<form role="search" action="{url /admin_questions/searchPost}">
	<div class="row">
		<div class="form-group col-xs-2">
			<label for="keyword">Tên câu hỏi</label><br>
        	<input class="form-control input-sm" type="text" name="keyword" id="keyword"  placeholder="Câu hỏi" value="{keyword}" />
       	</div>

		
		<div class="form-group col-xs-3">
			<label for="categoryId">Dạng bài tập</label><br>
          	<select id="categoryId" name="categoryId" class="form-control input-sm" placeholder="Danh mục" onchange="window.location='{url /admin_questions/changeCategoryId}?categoryId=' + this.value;">
			<option value="">-- Tất cả --</option>
			{each $categoryTree as $cat}
				<option value="{cat[id]}"><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $cat['level']);?>{cat[name]}</option>
			{/each}
 		 	</select>
  			<script type="text/javascript">
				$('#categoryId').val('{categoryId}');
  			</script>
        </div>

        <div class="form-group col-xs-1">
            <label for="testId">Đề thi</label><br>
            <select id="testId" name="testId" class="form-control input-sm" placeholder="Danh mục" onchange="window.location='{url /admin_questions/changeTestId}?testId=' + this.value;">
                <option value="">-- Tất cả --</option>
                {each $testIds as $cat}
                <option value="{cat[id]}">{cat[name]}</option>
                {/each}
            </select>
            <script type="text/javascript">
                $('#testId').val('{testId}');
            </script>
        </div>
		
		<div class="form-group col-xs-2">
            <label for="questionType">Dạng câu</label><br>
            <select id="questionType" name="questionType" class="form-control input-sm" placeholder="Người dùng" onchange="window.location='{url /admin_questions/changeQuestionType}?questionType=' + this.value;">
            	<option value="">-- Tất cả --</option>
                <option value="<?=QUESTION_TYPE_CHOICE?>">Trắc nghiệm</option>
                <option value="<?=QUESTION_TYPE_FILL?>">Điền đáp án</option>
                <option value="<?=QUESTION_TYPE_FILL_JOIN?>">Tự luận điền từ</option>
            </select>
            <script type="text/javascript">
                $('#questionType').val('{questionType}');
            </script>
        </div>
		
        <div class="form-group col-xs-2">
            <label for="trial">Người dùng</label><br>
            <select id="trial" name="trial" class="form-control input-sm" placeholder="Người dùng" onchange="window.location='{url /admin_questions/changeTrial}?trial=' + this.value;">
                <option value="">-- Tất cả --</option>

                <option value="1">Dùng thử</option>
                <option value="0">Mất phí</option>
            </select>
            <script type="text/javascript">
                $('#trial').val('{trial}');
            </script>
        </div>
        
        <div class="form-group col-xs-1">
        	<label>&nbsp;</label> <br>
        	<button type="submit" name ="submit_action" class="btn btn-primary btn-sm" value="<?=ACTION_SEARCH?>"><span class="glyphicon glyphicon-search"></span> Search</button>
        </div>
        <div class="form-group col-xs-1">
        	<label>&nbsp;</label> <br>
        	<button type="submit" name =submit_action class="btn btn-default btn-sm" value="<?=ACTION_RESET?>"><span class="glyphicon glyphicon-refresh"></span>Reset</button>
        </div>
	</div>
</form>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		Danh sách câu hỏi  <a class="btn btn-primary btn-xs pull-right" role="button" href="{url /admin_questions/add}"><span class="glyphicon glyphicon-circle-arrow-right"></span> Thêm câu hỏi</a>
	</div>
	<table class="table">
		<tr>
            <th><input type="checkbox" id="selectall"/></th>
			<th>#</th>
			<th>Tên</th>
			<th>Dạng bài tập</th>
            <th>Đề thi</th>
			<th>Mức độ
			<span class="glyphicon glyphicon-floppy-disk" style="cursor: pointer;" onclick="saveOrdering('level');"></span>
			</th>
            <th>Người dùng</th>
            <th>Người tạo</th>
            <th>Ngày tạo</th>

			<th colspan="2">Action</th>
		</tr>
		{each $items as $item}
		<?php 
		$catNames = getCategoriesName($item, $cats);
        $nametest = getTestName($item, $tests);
		?>
		<tr>
            <td><input class="checkIds" type="checkbox" name="checkIds[]" value="{item[id]}"></td>
			<td>{item[id]}</td>
			<td><a href="{url /admin_questions/detail}/{item[id]}">{item[name]}</a></td>
			<td>{catNames}</td>
            <td width="10%">{nametest}</td>
			<td width="3%"><input name="level[{item[id]}]" rel="{item[id]}" value="{item[level]}" style="width: 20px" /></td>
            <td width="7%">
                <select id="trial" name="trial"onchange="window.location = 'onchangeTrial?id={item[id]}&field=trial&value='+this.value;">
                    <option <?php if($item['trial'] ==0){ echo 'selected="1"';} ?> value="0">Mất phí</option>
                    <option <?php if($item['trial'] ==1){ echo 'selected="1"';} ?> value="1">Dùng thử</option>
                </select>
            </td>
            <td><?php echo get('name'$item['createdId'], $admin); ?></td>
            <td><?php echo date('d/m/y H:i:s', strtotime($item['created'])); ?></td>
			<td width="7%">
				<a href="{url /admin_questions/edit}/{item[id]}"  class="text-center" title="Sửa"><span class="glyphicon glyphicon-edit"></span></a>
				<a class="color_delete text-center" onclick="return confirm_delete('Do you want delete this record?')" title="Xóa" href="{url /admin_questions/del}/{item[id]}"><span class="glyphicon glyphicon-remove"></span></a>
			</td>
		</tr>
		{/each}
	</table>
</div>


<div class="clearfix pull-right">
	<form class="form-inline" role="form">
		<strong>Số mục: </strong>
		<select id="pageSize" name="pageSize" class="form-control" placeholder="Số mục / trang" onchange="window.location='{url /admin_questions/changePageSize}?pageSize=' + this.value;">
			<option value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option value="50">50</option>
			<option value="100">100</option>
			<option value="200">200</option>
		  </select>
		  <script type="text/javascript">
			$('#pageSize').val('{pageSize}');
		  </script>
		<strong>Trang: </strong>
		<?php 
			for ($page = 0; $page < $pages; $page++):?>
				<?php 
				if($page == $data->pageNum) {
					$btn = 'btn-primary';
				} else {
					$btn = 'btn-default';
				}
				?>
		<a class="btn {btn}" href="{url /admin_questions/index}?page={page}">{? echo ($page + 1)?}</a>
		<?php endfor; ?>
	</form>

</div>

<script>
    $(document).ready(function() {
        $('#selectall').click(function(event) {
            if(this.checked) {
                $('.checkIds').each(function() {
                    this.checked = true;
                });
            }else{
                $('.checkIds').each(function() {
                    this.checked = false;
                });
            }
        });

        $('#updatecate').click(function(){
            var allVals = [];
            $('.checkIds:checked').each(function() {
                allVals.push($(this).val());
            });

            if(allVals.length > 0){
                var r = confirm("Bạn có muốn cập nhật không?");
                if (r == true) {
                    var categories = $('#categoryIds').val();
                    $.ajax({
                        type: "POST",
                        url: "{url}/admin_questions/updateCategory",
                        data:{ids:JSON.stringify(allVals), categories:JSON.stringify(categories)},
                        success: function(data) {
                            if(data ==1) {
                                window.location.href = '{url}/admin_questions/index';
                            }

                        }
                    });
                }
            }else {
                alert('Vui lòng chọn bảng ghi muốn cập nhật!');
            }

            return false;
        });
        $(window).scroll(function () {
            if ($(this).scrollTop() > 360) {
                $('#showmenucate').css({ position:'fixed', top:'0px', right: '10px', width: '18%'});
            }else {
                $('#showmenucate').css({position:'', width: ''});
            }
        });
    });
</script>