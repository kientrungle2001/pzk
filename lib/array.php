<?php
/**
 * Explode và trim các kết quả sau khi explode: vd chuỗi 'first, second, last' trả về mảng array('first', 'second', 'last');
 * @param String $delim Dấu phân cách để explode
 * @param String $str Chuỗi cần explode
 * @return Array
 */
function explodetrim($delim, $str) {
	$arr = explode($delim, $str);
	foreach($arr as $i => $e) {
		$arr[$i] = trim($e);
	}
	return $arr;
}

/**
 * Lấy Giá trị nhỏ nhất của một cột trong mảng
 * @param Array $array mảng các dòng
 * @param String $field cột cần lấy min
 * @return mixed kết quả
 */
function min_array($array, $field) {
	$arr = array();
	foreach($array as $row) {
		$arr[] = $row[$field];
	}
	return min($arr);
}

/**
 * Lấy Giá trị lớn nhất của một cột trong mảng
 * @param Array $array mảng các dòng
 * @param String $field cột cần lấy max
 * @return mixed kết quả
 */
function max_array($array, $field) {
	$arr = array();
	foreach($array as $row) {
		$arr[] = $row[$field];
	}
	return max($arr);
}

/**
 * Đếm số lần xuất hiện của một giá trị trong mảng
 * @param Array $arr mảng các giá trị
 * @param mixed $value giá trị trong mảng
 * @return number số lần xuất hiện
 */
function count_array($arr, $value) {
	$total = 0;
	foreach($arr as $v) {
		if($v == $value) {
			$total++;
		}
	}
	return $total;
}
/**
 * Trộn các mảng vào thành một mảng
 * @return array mảng sau khi được trộn
 */
function merge_array() {
	$result = array();
	$arrays = func_get_args();
	foreach($arrays as $array) {
		if(is_array($array)) {
			foreach($array as $key => $value) {
				$result[$key] = $value;
			}
		}
	}
	return $result;
}

/**
 * Phân tích selector thành dạng mảng
 * @param string $selector dữ liệu dạng input[name=abc][type!=text]
 * @return array mảng các dữ liệu đã được phân tích
 */
function pzk_parse_selector($selector) {
	$pattern = '/^([\w\.\d]+)?((\[[^\]]+\])*)?$/';
	$subPattern = '/\[([^=\^\$\*\!\<]+)(=|\^=|\$=|\*=|\!=|\<\>)([^\]]+)\]/';
	if (preg_match($pattern, $selector, $match)) {
		preg_match_all($subPattern, $match[2], $matches);
		$attrs = array();

		$tagName = $match[1];
		if ($tagName) {
			$attrs['tagName'] = $tagName;
		}
		$attrs['attrs'] = array();
		for($i = 0; $i < count($matches[1]); $i++) {
			$attrs['attrs'][] = array('comparator' => $matches[2][$i], 'name' => $matches[1][$i], 'value' => $matches[3][$i]);
		}
			
		return $attrs;
	}
}

function table_append($elems, $elem, $row, $col) {
	$elems[] = array('elem' => $elem, 'row' => $row, 'col' => $col);
}

function table_display($elems) {
	$maxCol = 0;
	$maxRow = 0;
	foreach($elems as $cell) {
		if($cell['row'] > $maxRow) {
			$maxRow = $cell['row'];
		}
		if($cell['col'] > $maxCol) {
			$maxCol = $cell['col'];
		}
	}
	$rs = '<table class="table table-bordered">';
	for($i = 0; $i < $maxRow; $i++) {
		$rs .= '<tr>';
		for($j = 0; $j < $maxCol; $j++) {
			$rs .= '<td>';
			foreach($elems as $cell) {
				if($cell['row'] == $i && $cell['col'] == $j)  {
					$rs.= $cell['elem'];
				} else {
					$rs .= '&nbsp;';
				}
			}
			$rs .= '</td>';
		}
		$rs .= '</tr>';
	}
	$rs.= '</table>';
	return $rs;
}