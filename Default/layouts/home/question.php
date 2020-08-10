<?php
    $keyword = pzk_session('questionsKeyword');
    $orderBy = pzk_session('questionsOrderBy');
    $categoryId = pzk_session('questionsCategoryId');
    if($categoryId) {
        $data->conditions .= " and categoryIds like '%,$categoryId,%'";
    }
    if($orderBy) {
        $data->orderBy = $orderBy;
    }
    $pageSize = pzk_session('questionsPageSize');
    if($pageSize) {
        $data->pageSize = $pageSize;
    }
    $data->pageNum = pzk_request('page');
    $items = $data->getItems($keyword, array('name'));
    $countItems = $data->getCountItems($keyword, array('name'));
    $pages = ceil($countItems / $data->pageSize);
    $categories = _db()->select('*')->from('categories')->result();
    $cats = array();
    foreach($categories as $cat) {
        $cats[$cat['id']] = $cat;
    }
    function getCategoriesName($item, $categories) {
        $rs = array();
        $catIds = explode(',', $item['categoryIds']);

        foreach($catIds as $catId) {
            if($catId) {
                $rs[] = $categories[$catId]['name'];
            }
        }
        return implode(', ', $rs);
    }
    $categoryTree = treefy($categories);
?>

<form action="" method="post">
	<label for="">Chọn dạng</label>
	<select name="" id="">
		<option value="">Chọn dạng ... </option>
	</select>
	<br>
	<label for="">Chủ đề</label>
	<select name="" id="">
		<option value="">Chọn chủ đề ...</option>
	</select>
	<br>
	<table border="1px" cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th>Số câu</th>
				<th>Thời gian</th>
				<th>Mức độ</th>
				<th rowspan="2"><input type="submit" name="submit" value="Hoàn thành"></th>
				<th rowspan="2" id="countdown"></th>
			</tr>
			<tr>
				<th>
					<select name="number" id="">
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
				</th>
				<th>
					<select name="time" id="">
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select> phút
				</th>
				<th>
					<select name="level">
						<option value="1">Dễ</option>
						<option value="2">Bình thường</option>
						<option value="3">Khó</option>
					</select>
				</th>
			</tr>
		</thead>
	</table>

    <table class="table">
        <?php $i = 1; ?>
        <?php foreach($items as $item): ?>
        <?php
            $answers = _db()->useCB()->select('*')->from('answers')->where(array('questionId', $item['id']))->result();
        ?>
        <tr>
            <td><?php echo 'Câu '.$i.':'; ?></td>
            <td><?php echo @$item['name']?></td>
        </tr>
        <?php foreach($answers as $val): ?>
        <tr>
            <td><input name="value_<?php echo $item['id']; ?>" type="radio" /></td>
            <td><?php echo @$val['value']?></td>
        </tr>
        <?php endforeach; ?>
        <?php $i++; ?>
        <?php endforeach; ?>


    </table>

</form>