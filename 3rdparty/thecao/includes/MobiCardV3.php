<?php 
  class Config
  {
	  public static $_URL_WS = "https://www.nganluong.vn/mobile_card_api_v30.php?wsdl";	  
	  public static $_VERSION = "3.0";
	  //Thay d?i 3 thông tin ? phía du?i
	  public static $_MERCHANT_ID = "24338";
	  public static $_MERCHANT_PASSWORD = "12345612";
	  public static $_EMAIL_ACCOUNT_NL = "hoannet@gmail.com";
  }
 
  
  class MobiCardV3
  {
	          function GetErrorMessage($error_code) {
				$arrCode = array(
				   '00'=>  'Giao dịch thành công',
				   '99'=>  'Lỗi, tuy nhiên lỗi chưa được định nghĩa hoặc chưa xác định được nguyên nhân',
				   '01'=>  'Lỗi, địa chỉ IP truy cập API của NgânLượng.vn bị từ chối',
				   '02'=>  'Lỗi, tham số gửi từ merchant tới NgânLượng.vn chưa chính xác (thường sai tên tham số hoặc thiếu tham số)',
				   '03'=>  'Lỗi, Mã merchant không tồn tại hoặc merchant đang bị khóa kết nối tới NgânLượng.vn',
				   '04'=>  'Lỗi, Mã checksum không chính xác (lỗi này thường xảy ra khi mật khẩu giao tiếp giữa merchant và NgânLượng.vn không chính xác, hoặc cách sắp xếp các tham số trong biến params không đúng)',
				   '05'=>  'Tài khoản nhận tiền nạp của merchant không tồn tại',
				   '06'=>  'Tài khoản nhận tiền nạp của merchant đang bị khóa hoặc bị phong tỏa, không thể thực hiện được giao dịch nạp tiền',
				   '07'=>  'Thẻ đã được sử dụng ',
				   '08'=>  'Thẻ bị khóa',
				   '09'=>  'Thẻ hết hạn sử dụng',
				   '10'=>  'Thẻ chưa được kích hoạt hoặc không tồn tại',
				   '11'=>  'Mã thẻ sai định dạng',
				   '12'=>  'Sai số serial của thẻ',
				   '13'=>  'Mã thẻ và số serial không khớp',
				   '14'=>  'Thẻ không tồn tại',
				   '15'=>  'Thẻ không sử dụng được',
				   '16'=>  'Số lần thử (nhập sai liên tiếp) của thẻ vượt quá giới hạn cho phép',
				   '17'=>  'Hệ thống Telco bị lỗi hoặc quá tải, thẻ chưa bị trừ',
				   '18'=>  'Hệ thống Telco bị lỗi hoặc quá tải, thẻ có thể bị trừ, cần phối hợp với NgânLượng.vn để tra soát',
				   '19'=>  'Kết nối từ NgânLượng.vn tới hệ thống Telco bị lỗi, thẻ chưa bị trừ (thường do lỗi kết nối giữa NgânLượng.vn với Telco, ví dụ sai tham số kết nối, mà không liên quan đến merchant)',
				   '20'=>  'Kết nối tới telco thành công, thẻ bị trừ nhưng chưa cộng tiền trên NgânLượng.vn');
				   
				   return $arrCode[$error_code];
			}
			
		 
  

		function CardCharge($params)
		{
			$soap_client = new nusoap_client(Config::$_URL_WS,'wsdl');
			if (!$soap_client->getError()) {
				$params = json_encode($params);
				$paramsEncode = $this->_encrypt($params, Config::$_MERCHANT_PASSWORD);
				$inputs = array(
					'merchant_id'			=> Config::$_MERCHANT_ID,
					'version'				=> Config::$_VERSION,
					'params'				=> $paramsEncode,
				);				
				$result = $soap_client->call(__FUNCTION__,$inputs);
				//echo '<h2>Request</h2><pre>' . htmlspecialchars($soap_client->request, ENT_QUOTES) . '</pre>';
				//echo '<h2>Response</h2><pre>' . htmlspecialchars($soap_client->response, ENT_QUOTES) . '</pre>';
				//echo '<h2>Debug</h2><pre>' . htmlspecialchars($soap_client->debug_str, ENT_QUOTES) . '</pre>';
			
				$result = json_decode($result, true);
				$result['error_message'] = $this->GetErrorMessage($result['error_code']);
				return $result;
			}
			return false;
		}
	
		function GetTransactionDetail($params)
		{
			$soap_client = new nusoap_client(Config::$_URL_WS,'wsdl');
			if (!$soap_client->getError()) {
				$params = json_encode($params);
				$paramsEncode = $this->_encrypt($params, Config::$_MERCHANT_PASSWORD);
				$inputs = array(
					'merchant_id'			=> Config::$_MERCHANT_ID,
					'version'				=> Config::$_VERSION,
					'params'				=> $paramsEncode,
				);
				print_r($inputs);
				$result = $soap_client->call(__FUNCTION__,$inputs);
				$result = json_decode($result, true);
				$result['error_message'] = $this->GetErrorMessage($result['error_code']);
				return $result;
			}
			return false;
		}	
	
		function _encrypt($input, $key_seed)
		{
			$input = trim($input);
			$block = mcrypt_get_block_size('tripledes', 'ecb');
			$len = strlen($input);
			$padding = $block - ($len % $block);
			$input .= str_repeat(chr($padding),$padding);
			// generate a 24 byte key from the md5 of the seed
			$key = substr(md5($key_seed),0,24);
			$iv_size = mcrypt_get_iv_size(MCRYPT_TRIPLEDES, MCRYPT_MODE_ECB);
			$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
			// encrypt
			$encrypted_data = mcrypt_encrypt(MCRYPT_TRIPLEDES, $key, $input, MCRYPT_MODE_ECB, $iv);
			// clean up output and return base64 encoded
			return base64_encode($encrypted_data);
		}
		
		function _decrypt($input, $key_seed)
		{
			$input = base64_decode($input);
			$key = substr(md5($key_seed),0,24);
			$text=mcrypt_decrypt(MCRYPT_TRIPLEDES, $key, $input, MCRYPT_MODE_ECB,'12345678');
			$block = mcrypt_get_block_size('tripledes', 'ecb');
			$packing = ord($text{strlen($text) - 1});
			if ($packing && ($packing < $block)) {
				for($P = strlen($text) - 1; $P >= strlen($text) - $packing; $P--) {
					if(ord($text{$P}) != $packing){
						$packing = 0;
					}
				}
			}
			$text = substr($text,0,strlen($text) - $packing);
			return $text;
		}
	
			
			
			
  }
?>