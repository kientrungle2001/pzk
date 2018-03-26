<?php
/**
 * Hiển thị giá tiền 200000 thành 200.000đ
 * @param float $priceFloat số tiền
 * @return string giá tiền
 */
function product_price($priceFloat) {
	$symbol = 'đ';
	$symbol_thousand = '.';
	$decimal_place = 0;
	$price = number_format($priceFloat, $decimal_place, '', $symbol_thousand);
	return $price.$symbol;
}

/**
 * Hiển thị ngày giờ từ dạng mysql datetime hoặc dạng số nguyên
 * @param mixed $date ngày giờ dạng mysql hoặc dạng số nguyên
 * @return string Chuỗi hiển thị ngày giờ
 */
function format_date($date) {
	if(!is_numeric($date)) {
		$date = strtotime($date);
	}
	return date('d/m/y H:i', $date);
}

/**
 * Hiển thị dung lượng file dễ nhìn
 * @param int $size dung lượng dạng số nguyên
 * @param string $unit Đơn vị cần chuyển
 * @return string Kết quả dạng KBs, GBs, MBs
 */
function humanFileSize($size,$unit="") {
  if( (!$unit && $size >= 1<<30) || $unit == "GB")
    return number_format($size/(1<<30),2)."GB";
  if( (!$unit && $size >= 1<<20) || $unit == "MB")
    return number_format($size/(1<<20),2)."MB";
  if( (!$unit && $size >= 1<<10) || $unit == "KB")
    return number_format($size/(1<<10),2)."KB";
  return number_format($size)." bytes";
}

// seconds time to hours minutes seconds
/**
 * Chuyển đổi thời gian dạng giây thành cấu trúc giờ phút giây
 * @param int $seconds số giây
 * @return multitype:number
 */
function secondsToTime($seconds)
{
	// extract hours
	$hours = floor($seconds / (60 * 60));

	// extract minutes
	$divisor_for_minutes = $seconds % (60 * 60);
	$minutes = floor($divisor_for_minutes / 60);

	// extract the remaining seconds
	$divisor_for_seconds = $divisor_for_minutes % 60;
	$seconds = ceil($divisor_for_seconds);

	// return the final array
	$obj = array(
			"h" => (int) $hours,
			"m" => (int) $minutes,
			"s" => (int) $seconds,
	);
	return $obj;
}

function time_duration($seconds) {
	$time = secondsToTime($seconds);
	$hour = $time['h'];
	$min = $time['m'];
	$sec = $time['s'];

	$resultStrTime = '';

	if($hour) {
		$resultStrTime .= $hour.' giờ ';
	}

	if($min) {
		$resultStrTime .= $min.' phút ';
	}

	if($sec) {
		$resultStrTime .= $sec.' giây ';
	}
	return $resultStrTime;
}

function lessonToComment($numberQuestion) {
	if($numberQuestion <= 50){
		return "<li class='list-group-item list-group-item-danger'>Bạn đã làm $numberQuestion câu / 1 tuần. Bạn cần chăm chỉ hơn nữa! </li>"; 
	}else if($numberQuestion >= 70 ) {
		if($numberQuestion <= 80){
			$reward = "| Bạn được thưởng 3 cây <img src='/default/skin/nobel/test/themes/default/media/tree.png' />";
		}else{
			$add = floor(($numberQuestion - 70)/10);
			$numberRewark = 3 + $add;
			$reward = "| Bạn được thưởng $numberRewark cây <img src='/default/skin/nobel/test/themes/default/media/tree.png' />";
		}
		
		return "<li class='list-group-item list-group-item-success'>Bạn đã làm $numberQuestion câu / 1 tuần. Chúc mừng bạn, bạn là học sinh chăm chỉ! $reward</li>";
	}else{
		if($numberQuestion >= 50 && $numberQuestion <= 60){
			$reward = "| Bạn được thưởng 1 cây <img src='/default/skin/nobel/test/themes/default/media/tree.png' />";
		}else{
			$reward = "| Bạn được thưởng 2 cây <img src='/default/skin/nobel/test/themes/default/media/tree.png' />";
		}
		return "<li class='list-group-item list-group-item-info'>Bạn đã làm $numberQuestion Câu / 1 tuần. Bạn hoàn thành nhiệm vụ của tuần. Chúc mừng bạn! $reward</li>"; 
	}
}
function trueQuestionToComment($trueQuestionCent) {
	
	if($trueQuestionCent < 50){
		return "<li class='list-group-item list-group-item-danger'>Bạn đã làm đúng {$trueQuestionCent}% số câu hỏi. Kết quả học tập của bạn chưa tốt, bạn cần ôn tập lại những kiến thức đã học. </li>"; 
	}else if($trueQuestionCent >= 50 && $trueQuestionCent < 60 ) {
		$reward = "| Bạn được thưởng 1 bông hoa <img src='/default/skin/nobel/test/themes/default/media/flower.png' />";
		return "<li class='list-group-item list-group-item-info'>Bạn đã làm đúng {$trueQuestionCent}% số câu hỏi. Kết quả học tập của bạn ở mức trung bình. Bạn nên ôn lại những gì đã học để có được kết quả tốt hơn! $reward</li>";
	}else if($trueQuestionCent >= 60 && $trueQuestionCent < 70){
		$reward = "| Bạn được thưởng 1 bông hoa <img src='/default/skin/nobel/test/themes/default/media/flower.png' />";
		return "<li class='list-group-item list-group-item-info'>Bạn đã làm đúng {$trueQuestionCent}% số câu hỏi. Kết quả học tập của bạn đạt mức Khá! Bạn cần cố gắng hơn! $reward</li>"; 
	}else if($trueQuestionCent >= 70 && $trueQuestionCent < 80){
		$reward = "| Bạn được thưởng 2 bông hoa <img src='/default/skin/nobel/test/themes/default/media/flower.png' />";
		return "<li class='list-group-item list-group-item-success'>Bạn đã làm đúng {$trueQuestionCent}% số câu hỏi. Kết quả học tập của bạn ở mức giỏi! Bạn sẽ đạt mức xuất sắc nếu nỗ lực hơn nữa! $reward</li>"; 
	}else {
		$reward = "| Bạn được thưởng 3 bông hoa <img src='/default/skin/nobel/test/themes/default/media/flower.png' />";
		return "<li class='list-group-item list-group-item-success'>Bạn đã làm đúng {$trueQuestionCent}% số câu hỏi. Bạn rất xuất sắc! Chúc mừng bạn! $reward</li>";
	}
}
function cateToComment($cate, $allCate){
	$name = 'name';
	if(pzk_session('language') == 'vn'){
		$name = 'name_vn';
	}
	$html = '';
	foreach($allCate as $val){
		if(isset($cate[$val['id']])){
			if($cate[$val['id']] >= 50){
				$html .= "<li class='list-group-item list-group-item-warning'>Bạn có vẻ yêu thích môn học ".$val[$name]." .Tuy nhiên, bạn cần dành thêm thời gian cho các môn khác để có thể phát triển toàn diện!</li>";
			}else if($cate[$val['id']] <= 10) {
				$html .= "<li class='list-group-item list-group-item-warning'>Bạn có vẻ chưa quan tâm tới phần ".$val[$name]." .Bạn cần dành nhiều thời gian hơn cho môn học này để có thể phát triển toàn diện!</li>";
			}
		}else{
			$html .= "<li class='list-group-item list-group-item-danger'>Bạn chưa làm bài cho phần ".$val[$name]." .Bạn cần dành nhiều thời gian hơn cho môn học này để có thể phát triển toàn diện!</li>";
		}
	}
	return $html;
}
function trueTestToComment($cenTest, $numberTest){
	$cac = '';
	if($numberTest > 1) {
		$cac = "các";
	}
	if($cenTest < 50){
	return "<li class='list-group-item list-group-item-danger'>Bạn đã làm đúng {$cenTest}% số câu hỏi trong {$cac} đề đã làm. Kết quả học tập của bạn chưa tốt, bạn cần ôn tập lại những kiến thức đã học. </li>"; 
	}else if($cenTest >= 50 && $cenTest < 70 ) {
		$reward = "| Bạn được thưởng 1 quả táo <img src='/default/skin/nobel/test/themes/default/media/apple.png' />";
		return "<li class='list-group-item list-group-item-info'>Bạn đã làm đúng {$cenTest}% số câu hỏi trong {$cac} đề đã làm. Kết quả học tập của bạn ở mức trung bình - khá. Bạn cần cố gắng hơn! $reward</li>";
	}else if($cenTest >= 70 && $cenTest < 80){
		$reward = "| Bạn được thưởng 2 quả táo <img src='/default/skin/nobel/test/themes/default/media/apple.png' />";
		return "<li class='list-group-item list-group-item-info'>Bạn đã làm đúng {$cenTest}% số câu hỏi trong {$cac} đề đã làm. Bạn đạt kết quả khá! Bạn nên làm lại một lần nữa để đạt kết quả tốt nhất! $reward</li>"; 
	}else {
		$reward = "| Bạn được thưởng 3 quả táo <img src='/default/skin/nobel/test/themes/default/media/apple.png' />";
		return "<li class='list-group-item list-group-item-info'>Bạn đã làm đúng {$cenTest}% số câu hỏi trong {$cac} đề đã làm. Bạn rất xuất sắc! Chúc mừng bạn! $reward</li>"; 
	}
}
function reviewforTest($mark) {
	$markCent = ceil($mark*100/30);
	if($markCent < 50) {
		return "Kết quả bài làm của bạn chưa tốt! Bạn cần ôn lại toàn bộ kiến thức các môn học trong phần luyện tập. Bạn cần làm lại một lần nữa. ";
	}else if($markCent <= 50 && $markCent < 70){
		return "Bạn làm đúng $markCent % số câu hỏi. Bạn đạt kết quả trung bình! Bạn cần ôn lại toàn bộ kiến thức các môn học trong phần luyện tập. Bạn nên làm lại một lần nữa để đạt kết quả tốt hơn!";
	}else if( $markCent <= 70 && $markCent < 80){
		return "Bạn làm đúng $markCent % số câu hỏi. Bạn đạt kết quả khá! Bạn nên làm lại một lần nữa để đạt kết quả tốt nhất.";
	}else{
		return "Bạn làm đúng $markCent % số câu hỏi. Bạn rất xuất sắc! Chúc mừng bạn!";
	}
}

function startEndDateOfWeek($week, $year, $frontend=false)  
{  
	if($frontend){
		$format = 'd-m-Y';
	}else{
		$format = 'Y-m-d';
	}
	$time = strtotime("1 January $year", time());  
    $day = date('w', $time);  
    $time += ((7*$week)+1-$day)*24*3600;  
    $dates['startdate'] = date($format, $time);  
    $time += 6*24*3600;  
    $dates['enddate'] = date($format, $time);  
    return $dates;  
} 

function centTrueWordToComment($cent) {
	
	if($cent < 50){
		return "<li class='list-group-item list-group-item-danger'>Tuần này bạn đã làm đúng {$cent}% từ vựng. Bạn cần học lại các từ vựng. </li>"; 
	}else if($cent >= 50 && $cent < 70 ) {
		$reward = "| Bạn được thưởng 1 cây <img src='/default/skin/nobel/test/themes/default/media/tree.png' />";
		return "<li class='list-group-item list-group-item-info'>Tuần này bạn đã làm đúng {$cent}% từ vựng. Bạn nên học lại một lần nữa các từ vựng này. $reward</li>";
	}else if($cent >= 70 && $cent < 90){
		$reward = "| Bạn được thưởng 2 cây <img src='/default/skin/nobel/test/themes/default/media/tree.png' />";
		return "<li class='list-group-item list-group-item-success'>Tuần này bạn đã làm đúng {$cent}% từ vựng. Bạn đã học rất chăm chỉ! Bạn nên học lại 1 lần nữa để có thể  nhớ được nhiều nhất số từ mới. $reward</li>"; 
	}else {
		$reward = "| Bạn được thưởng 3 cây <img src='/default/skin/nobel/test/themes/default/media/tree.png' />";
		return "<li class='list-group-item list-group-item-success'>Tuần này bạn đã làm đúng {$cent}% từ vựng.  Bạn đã học tập rất nghiêm túc và bạn có trí nhớ rất tốt. Chúc mừng bạn! $reward</li>";
	}
}
function reviewGameByCate($numberCate, $allCate, $name){
	if($numberCate > 0){
		$html = '';
		$cent = floor(($numberCate * 100) / $allCate); 
		if($cent >= 50){
			$html .= "<li class='list-group-item list-group-item-warning'>Bạn có vẻ yêu thích môn học ".$name." .Tuy nhiên, bạn cần dành thêm thời gian cho các môn khác để có thể phát triển toàn diện!</li>";
		}else if($cent <= 10) {
			$html .= "<li class='list-group-item list-group-item-warning'>Bạn có vẻ chưa quan tâm tới môn học ".$name." .Bạn cần dành nhiều thời gian hơn cho môn học này để có thể phát triển toàn diện!</li>";
		}
	}else{
		 $html = "<li class='list-group-item list-group-item-danger'>Bạn chưa làm bài cho môn học ".$name.". Bạn cần dành nhiều thời gian hơn cho môn học này để có thể phát triển toàn diện!</li>";
	}
	
	echo $html;
}

function filename_replace($key) {
	return preg_replace('/[^\w\d]/', '_', $key);
}