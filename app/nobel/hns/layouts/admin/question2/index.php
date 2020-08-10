<?php
	$controller = pzk_controller();
	$sortFields = $controller->getSortFields();
	$keyword = pzk_session()->getQuestionsKeyword();
	$orderBy = pzk_session()->getQuestionsOrderBy();
	$categoryId = pzk_session()->getQuestionsCategoryId();
    $testId = pzk_session()->getQuestionsTestId();
    $trial = pzk_session()->getQuestionsTrial();
	$creatorId = pzk_session()->getQuestionsselectcreatorId();
    $questionType = pzk_session()->getQuestionsQuestionType();
    $classes = pzk_session()->getClasses();
    $check = pzk_session()->getQuestionsCheck();
    $status = pzk_session()->getQuestionsStatus();
    $deleted = pzk_session()->getQuestionsDeleted();
	if($categoryId) {
		$data->conditions .= " and categoryIds like '%,$categoryId,%'";
	}
	if($classes) {
		$data->conditions .= " and classes like '%,$classes,%'";
	}
	
    if($testId) {
        $data->conditions .= " and testId like '%,$testId,%'";
    }
    if($trial) {
        $data->conditions .= " and trial like '%$trial%'";
    }
    if($questionType) {
    	$data->conditions .= " and questionType like '%$questionType%'";
    }
	if($creatorId) {
		$data->conditions .= " and createdId = '$creatorId'";
	}
    
	if($orderBy) {
		$data->orderBy = $orderBy;
	}
	
	if($check !==false && $check !==NULL && $check !==''){
		$data->conditions .= " and `check` = '$check'";
	}
	
	if($status !==false && $status !== NULL && $status !==''){
		$data->conditions .= " and status = '$status'";
	}
	
	if(pzk_session()->getAdminLevel() == 'Administrator'){
		if($deleted == DELETED){
			$data->conditions .= " and deleted ='$deleted'";
		}
	}else{
		$data->conditions .= " and deleted ='0'";
	}
	
	$pageSize = pzk_session()->getQuestionsPageSize();
	if($pageSize) {
		$data->pageSize = $pageSize;
	}
    $requestpage = pzk_request()->getPage();
	$data->pageNum = $requestpage;
	
	$items = $data->getItems($keyword, array('name','id'));
	
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
                $rs[] = @$testIds[$catId]['name'];
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
<form role="search" action="<?php echo BASE_REQUEST . '/admin_questions/searchPost' ?>">
	<div class="row">
		<div class="form-group col-xs-2">
			<label for="keyword">Tên câu hỏi or id</label><br>
        	<input class="form-control input-sm" type="text" name="keyword" id="keyword"  placeholder="Câu hỏi" value="<?php echo $keyword ?>" />
       	</div>

		
		<div class="form-group col-xs-3">
			<label for="categoryId">Dạng bài tập</label><br>
          	<select id="categoryId" name="categoryId" class="form-control input-sm" placeholder="Danh mục" onchange="window.location='<?php echo BASE_REQUEST . '/admin_questions/changeCategoryId' ?>?categoryId=' + this.value;">
			<option value="">-- Tất cả --</option>
			<?php foreach($categoryTree as $cat): ?>
				<option value="<?php echo @$cat['id']?>"><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $cat['level']);?><?php echo @$cat['name']?></option>
			<?php endforeach; ?>
 		 	</select>
  			<script type="text/javascript">
				$('#categoryId').val('<?php echo $categoryId ?>');
  			</script>
        </div>

        <div class="form-group col-xs-1">
            <label for="testId">Đề thi</label><br>
            <select id="testId" name="testId" class="form-control input-sm" placeholder="Danh mục" onchange="window.location='<?php echo BASE_REQUEST . '/admin_questions/changeTestId' ?>?testId=' + this.value;">
                <option value="">-- Tất cả --</option>
                <?php foreach($testIds as $cat): ?>
                <option value="<?php echo @$cat['id']?>"><?php echo @$cat['name']?></option>
                <?php endforeach; ?>
            </select>
            <script type="text/javascript">
                $('#testId').val('<?php echo $testId ?>');
            </script>
        </div>
		
		<div class="form-group col-xs-2">
            <label for="questionType">Dạng câu</label><br>
            <select id="questionType" name="questionType" class="form-control input-sm" placeholder="Người dùng" onchange="window.location='<?php echo BASE_REQUEST . '/admin_questions/changeQuestionType' ?>?questionType=' + this.value;">
            	<option value="">-- Tất cả --</option>
                <option value="<?=QUESTION_TYPE_CHOICE?>">Trắc nghiệm</option>
                <option value="<?=QUESTION_TYPE_FILL?>">Điền đáp án</option>
                <option value="<?=QUESTION_TYPE_FILL_JOIN?>">Tự luận điền từ</option>
            </select>
            <script type="text/javascript">
                $('#questionType').val('<?php echo $questionType ?>');
            </script>
        </div>
		
        <div class="form-group col-xs-2">
            <label for="trial">Người dùng</label><br>
            <select id="trial" name="trial" class="form-control input-sm" onchange="window.location='<?php echo BASE_REQUEST . '/admin_questions/changeTrial' ?>?trial=' + this.value;">
                <option value="">-- Tất cả --</option>

                <option value="1">Dùng thử</option>
                <option value="0">Mất phí</option>
            </select>
            <script type="text/javascript">
                $('#trial').val('<?php echo $trial ?>');
            </script>
        </div>
		
		<div class="form-group col-xs-2">
            <label for="creatorId">Người tạo</label><br>
            <select id="creatorId" name="creatorId" class="form-control input-sm" onchange="window.location='<?php echo BASE_REQUEST . '/admin_questions/filter' ?>?index=creatorId&type=select&select=' + this.value;">
                <option value="">-- Tất cả --</option>
				<?php $users = _db()->selectAll()->fromAdmin()->result();?>
                <?php foreach($users as $user): ?>
				<option value="<?php echo @$user['id']?>"><?php echo @$user['name']?></option>
				<?php endforeach; ?>
            </select>
            <script type="text/javascript">
                $('#creatorId').val('<?php echo $creatorId ?>');
            </script>
        </div>
        
		<?php if($sortFields) { ?>
              <div class="form-group col-xs-2">
                  <label>Sắp xếp</label><br>
                  <select id="orderBy" name="orderBy" class="form-control" placeholder="Sắp xếp theo" onchange="window.location='<?php echo BASE_REQUEST . '/admin' ?>_<?php echo @$controller->module?>/changeOrderBy?orderBy=' + this.value;">
                      <?php foreach ($sortFields as $value => $label){ ?>
                          <option value="<?php echo $value ?>"><?php echo $label ?></option>
                      <?php } ?>
                  </select>
                  <script type="text/javascript">
                      $('#orderBy').val('<?php echo $orderBy ?>');
                  </script>
              </div>
                <?php } ?>
   		<div class="form-group col-xs-2">
            <label for="check">Check</label><br>
            <select id="check" name="check" class="form-control input-sm" onchange="window.location='<?php echo BASE_REQUEST . '/admin_questions/changeCheck' ?>?check=' + this.value;">
                <option value="">-- Tất cả --</option>
                <option value="<?=QUESTION_CHECKED?>">Đã check</option>
                <option value="<?=QUESTION_UNCHECKED?>">Chưa check</option>
            </select>
            <script type="text/javascript">
                $('#check').val('<?php echo $check ?>');
            </script>
        </div>
   		
   		
   		<div class="form-group col-xs-2">
            <label for="status">Status</label><br>
            <select id="status" name="status" class="form-control input-sm" onchange="window.location='<?php echo BASE_REQUEST . '/admin_questions/changeStatusQuestion' ?>?status=' + this.value;">
                <option value="">-- Tất cả --</option>
                <option value="<?=QUESTION_ENABLE?>">Enable</option>
                <option value="<?=QUESTION_DISABLE?>">Disable</option>
            </select>
            <script type="text/javascript">
                $('#status').val('<?php echo $status ?>');
            </script>
        </div>
        <?php if(pzk_session()->getAdminLevel() === 'Administrator'):?>
        <div class="form-group col-xs-2">
            <label for="status">Deleted</label><br>
            <select id="deleted" name="deleted" class="form-control input-sm" onchange="window.location='<?php echo BASE_REQUEST . '/admin_questions/changeDeleted' ?>?deleted=' + this.value;">
                <option value="">-- Tất cả --</option>
                <option value="<?=DELETED?>">Xóa</option>
            </select>
            <script type="text/javascript">
                $('#deleted').val('<?php echo $deleted ?>');
            </script>
        </div>
		<?php endif;?>
        <div class="form-group col-xs-1">
        	<label>&nbsp;</label> <br>
        	<button type="submit" name ="submit_action" class="btn btn-primary btn-sm" value="<?=ACTION_SEARCH?>"><span class="glyphicon glyphicon-search"></span> Search</button>
        </div>
        <div class="form-group col-xs-1">
        	<label>&nbsp;</label> <br>
        	<button type="submit" name ="submit_action" class="btn btn-default btn-sm" value="<?=ACTION_RESET?>"><span class="glyphicon glyphicon-refresh"></span>Reset</button>
        </div>
        
        <div class="form-group col-xs-2">
        	<label>&nbsp;</label> <br>
        	<button type="button" name ="enable_right" id="enable_right" onclick="return enableRight()" class="btn btn-default btn-sm" value="1"><span class="glyphicon glyphicon-arrow-left"></span>showMenu</button>
        </div>
        
        <div class="form-group col-xs-2">
        	<label>&nbsp;</label> <br>
        	<button type="button" name ="disable_right" id="disable_right" onclick="return disableRight()" class="btn btn-default btn-sm" value="1"><span class="glyphicon glyphicon-arrow-right"></span>HideMenu</button>
        </div>
        
	</div>
</form>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		Danh sách câu hỏi  <a class="btn btn-primary btn-xs pull-right" role="button" href="<?php echo BASE_REQUEST . '/admin_questions/add' ?>"><span class="glyphicon glyphicon-circle-arrow-right"></span> Thêm câu hỏi</a>
	</div>
	<table class="table">
		<tr>
            <th><input type="checkbox" id="selectall"/></th>
			<th>#</th>
			<th>
				Ordering
				<span class="glyphicon glyphicon-floppy-disk" style="cursor: pointer;" onclick="saveOrdering('ordering');"></span>
			</th>
			<th>Tên</th>
			<th>Dạng bài tập</th>
            <th>Đề thi</th>
			<th>
				Mức độ
				<span class="glyphicon glyphicon-floppy-disk" style="cursor: pointer;" onclick="saveOrdering('level');"></span>
			</th>
            <th>Người dùng</th>
            <th>Người tạo</th>
            <th>Ngày tạo</th>
			<th>Check</th>
			<th>Status</th>
			<?php if(pzk_session()->getAdminLevel() === 'Administrator'):?><th>Deleted</th><?php endif;?>
			<th colspan="2">Action</th>
		</tr>
		<?php foreach($items as $item): ?>
		<?php 
		$catNames = getCategoriesName($item, $cats);
        $nametest = getTestName($item, $tests);
		?>
		<tr>
            <td><input class="checkIds" type="checkbox" name="checkIds[]" value="<?php echo @$item['id']?>"></td>
			<td><?php echo @$item['id']?></td>
			<td><input name="ordering[<?php echo @$item['id']?>]" rel="<?php echo @$item['id']?>" value="<?php echo @$item['ordering']?>" style="width: 20px" /></td>
			<td><a href="<?php echo BASE_REQUEST . '/admin_questions/detail' ?>/<?php echo @$item['id']?>"> <?php if($item['name'] !='') echo strip_tags($item['name']);?>...</a></td>
			<td><?php echo $catNames ?></td>
            <td width="10%"><?php echo $nametest ?></td>
			<td width="3%"><input name="level[<?php echo @$item['id']?>]" rel="<?php echo @$item['id']?>" value="<?php echo @$item['level']?>" style="width: 20px" /></td>
            <td width="7%">
                <select id="trial" name="trial" onchange="window.location = 'onchangeTrial?id=<?php echo @$item['id']?>&field=trial&value='+this.value;">
                    <option <?php if($item['trial'] ==0){ echo 'selected="1"';} ?> value="0">Mất phí</option>
                    <option <?php if($item['trial'] ==1){ echo 'selected="1"';} ?> value="1">Dùng thử</option>
                </select>
            </td>
            <td><?php echo get('name'$item['createdId'], $admin); ?></td>
            <td><?php echo date('d/m/y H:i', strtotime($item['created'])); ?></td>
            <td>
            	<span class="glyphicon glyphicon-star" onclick="window.location='onchangeStatus?field=check&id=<?php echo @$item['id']?>&page=<?php echo $requestpage ?>'" <?php if($item['check'] == QUESTION_CHECKED):?>style="color: blue; font-size: 100%; cursor: pointer;" <?php else:?> style="color: black; font-size: 100%; cursor: pointer;" <?php endif;?>></span>
            </td>
            <td>
            	<span class="glyphicon glyphicon-star" onclick="window.location='onchangeStatus?field=status&id=<?php echo @$item['id']?>&page=<?php echo $requestpage ?>'" <?php if($item['status'] == QUESTION_ENABLE):?>style="color: blue; font-size: 100%; cursor: pointer;" <?php else:?> style="color: black; font-size: 100%; cursor: pointer;" <?php endif;?>></span>
            </td>
            <?php if(pzk_session()->getAdminLevel() === 'Administrator'):?>
            <td>
            	<span class="glyphicon glyphicon-star" onclick="window.location='onchangeStatus?field=deleted&id=<?php echo @$item['id']?>&page=<?php echo $requestpage ?>'" <?php if($item['deleted'] == DELETED):?>style="color: red; font-size: 100%; cursor: pointer;" <?php else:?> style="color: blue; font-size: 100%; cursor: pointer;" <?php endif;?>></span>
            </td>
            <?php endif;?>
			<td width="7%">
				<a href="<?php echo BASE_REQUEST . '/admin_questions/edit' ?>/<?php echo @$item['id']?>"  class="text-center" title="Sửa"><span class="glyphicon glyphicon-edit"></span></a>
				<a class="color_delete text-center" onclick="return confirm_delete('Do you want delete this record?')" title="Xóa" href="<?php echo BASE_REQUEST . '/admin_questions/del' ?>/<?php echo @$item['id']?>"><span class="glyphicon glyphicon-remove"></span></a>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>


<div class="clearfix pull-right">
	<div class="delAll">
		<a href="javascript:void(0)" onclick = "return delAll()">Xóa</a>
	</div>
	<form class="form-inline" role="form">
		<strong>Số mục: </strong>
		<select id="pageSize" name="pageSize" class="form-control" placeholder="Số mục / trang" onchange="window.location='<?php echo BASE_REQUEST . '/admin_questions/changePageSize' ?>?pageSize=' + this.value;">
			<option value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option value="50">50</option>
			<option value="100">100</option>
			<option value="200">200</option>
		  </select>
		  <script type="text/javascript">
			$('#pageSize').val('<?php echo $pageSize ?>');
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
		<a class="btn <?php echo $btn ?>" href="<?php echo BASE_REQUEST . '/admin_questions/index' ?>?page=<?php echo $page ?>"><?php  echo ($page + 1)?></a>
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
                        url: "<?php echo BASE_REQUEST ?>/admin_questions/updateCategory",
                        data:{ids:JSON.stringify(allVals), categories:JSON.stringify(categories)},
                        success: function(data) {
                            if(data ==1) {
                                window.location.href = '<?php echo BASE_REQUEST ?>/admin_questions/index';
                            }

                        }
                    });
                }
            }else {
                alert('Vui lòng chọn bảng ghi muốn cập nhật!');
            }

            return false;
        });

        $('#updatetets').click(function(){
            var allVals = [];
            $('.checkIds:checked').each(function() {
                allVals.push($(this).val());
            });

            if(allVals.length > 0){
                var r = confirm("Bạn có muốn cập nhật không?");
                if (r == true) {
                    var testIds = $('#testIds').val();
                    $.ajax({
                        type: "POST",
                        url: "<?php echo BASE_REQUEST ?>/admin_questions/updateTests",
                        data:{ids:JSON.stringify(allVals), testIds:JSON.stringify(testIds)},
                        success: function(data) {
                            if(data ==1) {
                                window.location.href = '<?php echo BASE_REQUEST ?>/admin_questions/index';
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

    function delAll(){

	    var allVals = [];
		$('.checkIds:checked').each(function() {
			allVals.push($(this).val());
		});

        if(allVals.length > 0){
        	var r = confirm("Are you sure delete all");
           	if (r == true) {
            	$.ajax({
                    type: "POST",
                    url: "/admin_questions/delAll",
                    data:{ids:JSON.stringify(allVals)},
                    success: function(data) {
                    	if(data ==1) {
                        	window.location.href = '/admin_questions/index';
                        }
                	}
              	});
        	}
       	}else {
         	alert('Choice select a record want to delete !');
      	}

    }
	
	function enableRight(){
		$('#right').show();
		$('#left').css('width', '80%');
	}
	
	function disableRight(){
		$('#right').hide();
		$('#left').css('width', '100%');
	}
</script>