<?php
/**
 * Replace nhiều chuỗi con
 * @param Array $replacements Các chuỗi con cần thay thế dạng : search => replace
 * @param String $str Chuỗi lớn
 * @return String Chuỗi sau khi được thay thế
 */
function pzk_replace($replacements, $str) {
	foreach($replacements as $search => $replace) {
		$str = str_replace($search, $replace, $str);
	}
	return $str;
}

/**
 * Remove chuỗi search khỏi chuỗi subject
 * @param String $search chuỗi cần tìm kiếm
 * @param String $subject chuỗi cần remove
 * @return String chuỗi sau khi remove 
 */
function str_remove($search, $subject) {
	return str_replace($search, '', $subject);
}

/**
 * Upper case first letter of a string
 *
 * @param String 	$str input string
 * @return 	String 	uppercased first letter
 */
function str_ucfirst($str) {
	return strtoupper($str[0]) . substr($str, 1);
}

/**
 * Chuyển tiếng việt có dấu thành tiếng việt không dấu
 * @param string 	$str chuỗi tiếng việt có dấu
 * @return string 	chuỗi tiếng việt không dấu
 */
function khongdau($str) {
    return bodau($str);
}

/**
 * Chuyển một chuỗi thành dạng alias
 * @param string $str chuỗi tiếng việt có dấu
 * @return string chuỗi dạng alias
 */
function khongdauAlias($str) {
	$alias = khongdau($str);
	$aliasTemp = '';
	for($i = 0; $i < strlen($alias); $i++) {
		$chrInt = ord(strtolower($alias[$i]));
		if (($chrInt >= ord('a') && $chrInt <= ord('z')) || ($chrInt >= ord('0') && $chrInt <= ord('9')) || $chrInt == ord('-') || $chrInt == ord('/')) {
			$aliasTemp .= $alias[$i];
		}
	}
	return $aliasTemp;
}
 
/**
 * Decode một chuỗi theo định dạng url
 * @param string $raw_url_encoded chuỗi định dạng ban đầu
 * @return string chuỗi kết quả
 */
function utf8_rawurldecode($raw_url_encoded){ 
    $enc = rawurldecode($raw_url_encoded); 
    if(utf8_encode(utf8_decode($enc))==$enc){; 
        return rawurldecode($raw_url_encoded); 
    }else{ 
        return utf8_encode(rawurldecode($raw_url_encoded)); 
    } 
} 

/**
 * Thay thế dấu ngăn cách đường dẫn thành dấu ngăn cách của hệ thống
 * @param string $path đường dẫn
 * @return string đường dẫn đã được thay thế
 */
function replace_path($path) {
	$path = str_replace('/', DIRECTORY_SEPARATOR, $path);
	$path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
	return $path;
}

/**
 * Thoát các ký tự html
 * @param string $str Chuỗi html
 * @return string Chuỗi được xử lý thoát html
 */
function html_escape($str) {
	return htmlspecialchars($str, ENT_COMPAT, 'utf-8');
}

/**
 * Chuyển tiếng việt có dấu thành tiếng việt không dấu
 * @param string 	$str chuỗi tiếng việt có dấu
 * @return string 	chuỗi tiếng việt không dấu
 */
function bodau ($str){ 
	 $marTViet=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ", 
	"è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ", 
	"ì","í","ị","ỉ","ĩ", 
	"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ", 
	"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ", 
	"ỳ","ý","ỵ","ỷ","ỹ", 
	"đ", 
	"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă" 
	,"Ằ","Ắ","Ặ","Ẳ","Ẵ", 
	"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ", 
	"Ì","Í","Ị","Ỉ","Ĩ", 
	"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ" 
	,"Ờ","Ớ","Ợ","Ở","Ỡ", 
	"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ", 
	"Ỳ","Ý","Ỵ","Ỷ","Ỹ", 
	"Đ"," ");  
	$marKoDau=array("a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a", 
	"e","e","e","e","e","e","e","e","e","e","e", 
	"i","i","i","i","i", 
	"o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o", 
	"u","u","u","u","u","u","u","u","u","u","u", 
	"y","y","y","y","y", 
	"d", 
	"A","A","A","A","A","A","A","A","A","A","A","A" 
	,"A","A","A","A","A", 
	"E","E","E","E","E","E","E","E","E","E","E", 
	"I","I","I","I","I", 
	"O","O","O","O","O","O","O","O","O","O","O","O" 
	,"O","O","O","O","O", 
	"U","U","U","U","U","U","U","U","U","U","U", 
	"Y","Y","Y","Y","Y", 
	"D","-"); 
	$str=str_replace($marTViet,$marKoDau,$str); 
	return $str; 
}

function bodau_giucach($str) {
	 $marTViet=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ", 
	"è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ", 
	"ì","í","ị","ỉ","ĩ", 
	"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ", 
	"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ", 
	"ỳ","ý","ỵ","ỷ","ỹ", 
	"đ", 
	"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă" 
	,"Ằ","Ắ","Ặ","Ẳ","Ẵ", 
	"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ", 
	"Ì","Í","Ị","Ỉ","Ĩ", 
	"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ" 
	,"Ờ","Ớ","Ợ","Ở","Ỡ", 
	"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ", 
	"Ỳ","Ý","Ỵ","Ỷ","Ỹ", 
	"Đ"," ");  
	$marKoDau=array("a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a", 
	"e","e","e","e","e","e","e","e","e","e","e", 
	"i","i","i","i","i", 
	"o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o", 
	"u","u","u","u","u","u","u","u","u","u","u", 
	"y","y","y","y","y", 
	"d", 
	"A","A","A","A","A","A","A","A","A","A","A","A" 
	,"A","A","A","A","A", 
	"E","E","E","E","E","E","E","E","E","E","E", 
	"I","I","I","I","I", 
	"O","O","O","O","O","O","O","O","O","O","O","O" 
	,"O","O","O","O","O", 
	"U","U","U","U","U","U","U","U","U","U","U", 
	"Y","Y","Y","Y","Y", 
	"D"," "); 
	$str=str_replace($marTViet,$marKoDau,$str); 
	return $str;
}

/**
 * Cắt chuỗi theo số từ xác định
 * @param string $str chuỗi cần cắt
 * @param number $count số từ cần cắt
 * @return string chuỗi đã được cắt
 */
function cut_words($str, $count = 150) {
	$words = explode(' ', $str);
	if($count < count($words)) {
		$result = '';
		for($i = 0; $i < $count; $i++) {
			$result .= $words[$i] . ' ';
		}
		$result.= '...';
		return $result;
	} else {
		return $str;
	}
}

/**
 * Cắt chuỗi theo số ký tự xác định
 * @param string $str chuỗi cần cắt
 * @param number $count số ký tự cần cắt
 * @return string chuỗi đã được cắt
 */
function cut_chars($str, $count = 400) {
	if(strlen($str) <= $count) {
		return $str;
	} else {
		return substr($str, 0, $count) . ' ...';
	}
}

/**
 * Chuyển các biểu thức latex trong văn bản thành dạng ảnh
 * @param string $content văn bản có chứa biểu thức latex
 * @return string
 */
function getLatex($content) {
	//http://latex.codecogs.com/
	//$content = preg_replace('/\&nbsp;/', ' ', $content);
	//$partern = '/[;\s+](\d)\s*\/\s*(\d)/';
	//$content = preg_replace($partern, '[/\frac{$1}{$2}/]', $content);
	/*
	$content = str_replace("[/", "<img class='latex' style='display:inline-block; margin: 6px 0px;' src='http://latex.codecogs.com/gif.latex?", $content);
	$content = str_replace("/]", "'  />", $content);
	*/
	/*$content = str_replace("[/", "<img class='latex' style='display:inline-block; margin: 6px 0px;' src='http://".$_SERVER['HTTP_HOST']."/image.php?latex=", $content);
	$content = str_replace("/]", "'  />", $content);
	*/
	$content = str_replace("[/", "\\[", $content);
	$content = str_replace("/]", "\\]", $content);
	return $content;
}

function wordval($str) {
	preg_match('/^[\w\d_]*/', $str, $match);
	return $match[0];
}

/**
 * Clean key
 */
function clean_key($key) {
	if ($key=="0") return $key;
	if ($key == "")
	{
		return "";
	}
	$key = preg_replace( "/\.\./"           , ""  , $key );
	$key = preg_replace( "/\_\_(.+?)\_\_/"  , ""  , $key );
	$key = preg_replace( "/^([\w\.\-\_]+)$/", "$1", $key );
	return $key;
}

/**
 * Clean value
 */
function clean_value($val) {

	if ($val == "")
	{
		return "";
	}
	
	$val = str_replace( "&#032;", " ", $val );
	
	$val = str_replace( chr(0xCA), "", $val );  //Remove sneaky spaces
	
	$val = str_replace( "&"            , "&amp;"         , $val );
	$val = str_replace( "<!--"         , "&#60;&#33;--"  , $val );
	$val = str_replace( "-->"          , "--&#62;"       , $val );
	$val = preg_replace( "/<script/i"  , "&#60;script"   , $val );
	$val = str_replace( ">"            , "&gt;"          , $val );
	$val = str_replace( "<"            , "&lt;"          , $val );
	$val = str_replace( "\""           , "&quot;"        , $val );
	$val = preg_replace( "/\n/"        , "<br>"          , $val ); // Convert literal newlines
	$val = preg_replace( "/\\\$/"      , "&#036;"        , $val );
	$val = preg_replace( "/\r/"        , ""              , $val ); // Remove literal carriage returns
	$val = str_replace( "!"            , "&#33;"         , $val );
	$val = str_replace( "'"            , "&#39;"         , $val ); // IMPORTANT: It helps to increase sql query safety.
	
	// Ensure unicode chars are OK
	
	if ( true )
	{
		$val = preg_replace("/&amp;#([0-9]+);/s", "&#\\1;", $val );
	}
	
	// Strip slashes if not already done so.
	
	if ( get_magic_quotes_gpc() )
	{
		$val = stripslashes($val);
	}
	
	// Swop user inputted backslashes
	
	$val = preg_replace( "/\\\(?!&amp;#|\?#)/", "&#092;", $val ); 
	
	return $val;
}