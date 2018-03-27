<?php

/**
 *
 */
class PzkHomeController extends PzkController{
		
	public $masterPage	=	"index";
	
	public function indexAction(){
		$this->initPage();
		$this->append('<home.content layout="home/content_home"/>','left');
		$this->display();
	}

    public function categoryAction(){
        $this->layout();
        $category = pzk_parse('<home.category table="categories" layout="home/category"/>');
        $left = pzk_element('left');
        $left->append($category);
        $this->page->display();
    }

    public function questionAction(){
        $this->layout();
        $question = pzk_parse('<core.db.list table="questions" layout="home/question" />');
        $left = pzk_element('left');
        $left->append($question);
        $this->page->display();
    }

    public function videoAction(){
    	
        $file = BASE_DIR . '/3rdparty/uploads/videos/test.txt';
        $file2 = BASE_DIR . '/3rdparty/uploads/videos/test_encrypted.txt';
        $handle = fopen($file, "rb");
        $initial_contents = fread($handle, filesize($file));
        fclose($handle);
        if ($initial_contents) {
            $td = mcrypt_module_open('tripledes', '', 'ecb', '');
            $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
            mcrypt_generic_init($td, '123456', $iv);
            $encrypted_data = mcrypt_generic($td, $initial_contents);

            $encrypted_file = @fopen($file2, 'wb');
            $ok_encrypt = @fwrite($encrypted_file, $encrypted_data);
			
            @fclose($encrypted_file);
        }
    }

    public function deVideoAction(){

        $file = BASE_DIR . '/3rdparty/uploads/videos/test_encrypted.txt';
        $file2 = BASE_DIR . '/3rdparty/uploads/videos/test_decrypted.txt';

        $handle = fopen($file, "rb");
        $initial_contents = fread($handle, filesize($file));
        fclose($handle);

        if ($initial_contents) {

            $td = mcrypt_module_open('tripledes', '', 'ecb', '');
            $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);

            mcrypt_generic_init($td, '123456', $iv);

            $encrypted_data = $initial_contents;

            $p_t = mdecrypt_generic($td, $encrypted_data);

            $newfile = @fopen($file2, 'wb');
            $ok_decrypt = @fwrite($newfile, $p_t);

            @fclose($newfile);
            mcrypt_generic_deinit($td);
            mcrypt_module_close($td);

        }
    }
	
	public function testAction() {
		//$item = _db()->from('user')->whereId('97')->result_one();
		//debug($item);
		/*
		$arrObj = pzk_array()->setData(array(
			'string' => 'string-1',
			'number' => 'number-2',
			'array' => array('key' => 'value')
		));
		$xmlStr = $arrObj->toXml();
		// echo $xmlStr;
		$arrObj = pzk_array();
		$arrObj->fromXml($xmlStr);
		// debug($arrObj->getData());
		$test = pzk_parse('<div xml="test" layout="test" />');
		$test->display();
		*/
		var_dump(pzk_session()->getFilterData('username', 'userId'));
	}
	
	public function importAction() {
		// đọc dữ liệu từ thư mục
		// lấy từng dòng
		// tách lấy username theo email
		// insert username và email, lấy name từ username, password: ptnn123456
		set_time_limit(0);
/* 		$folder = BASE_DIR . '/tmp/data';
		$fileNames = $this->getFiles($folder);
		foreach($fileNames as $fileName) {
			echo 'imported: ' . $fileName . '<br />';
			$emails = file($fileName);
			foreach($emails as $email) {
				$email = trim($email); if(!$email) continue;
				$parts = explode('@', $email);
				$username = $parts[0];
				$userData = array(
					'username' => $username,
					'email' => $email,
					'name' => $username,
					'password' => md5('ptnn123456'),
					'status' => 1,
					'registered' => date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME'])
				);
				$user = _db()->getEntity('User.Account.User');
				$user->setData($userData);
				$user->save();	
			}	
		}
 */		

	}
	
	public function friendAction() {
		set_time_limit(0);
		// duyệt qua tất cả các friend
			// add ngẫu nhiên từ 5 -> 22 friends
/* 		$users = _db()->select('username')->from('user')->result();
		$userCount = count($users);
		foreach($users as $user) {
			$friendCount = rand(5, 22);
			$friends = array();
			for($i = 0; $i < $friendCount; $i++) {
				$friend = $users[rand(0, $userCount-1)];
				$friends[] = array('username' => $user['username'], 'userfriend' => $friend['username']);
				$friends[] = array('userfriend' => $user['username'], 'username' => $friend['username']);
			}
			_db()->insert('friend')->fields('username,userfriend')->values($friends)->result();
		} */
	}
	
	public function noteAction() {
		set_time_limit(0);
		// duyệt qua tất cả các friend
			// chọn ra 4/10 số user
			// add ngẫu nhiên từ 1 -> 5 bài viết
				// mỗi bài viết add ngẫu nhiên từ 3 -> 20 bình luận
		$users = _db()->select('id,username')->from('user')->limit(20000)->orderBy('RAND()')->result();
		$globalNotes = array(
				array(
						'contentnote' => 'Qua khóa học này, con đã tiến bộ, không ngồi "cắn bút suy nghĩ" nữa. Những hình ảnh của con đã sinh động, không còn cộc lốc như trước kia. Cô Phương đã biến môn văn của con từ đáng ghét trở thành yêu thích. Cảm ơn cô đã thay đổi cuộc sống của con, cho con biết rằng văn học là một môn học thú vị, bổ ích, cần thiết trong cuộc sống',
						'datenote' => date('Y-m-d H:i:s'),
						'titlenote' => 'Qua khóa học này, con đã tiến bộ',
						'view' => 0,
						'comment' => 0
				),
				array(
						'contentnote' => 'Sau khóa học Viết văn Miêu tả, con thấy con trưởng thành và viết tiến bộ nhiều. Con ấn tượng với em Bách - em út vì em rất nhí nhố ,đôi lúc cũng thấy dễ thương. Anh Kì Nam- Anh cả của lớp ra dáng chững chạc , nhắc nhở các em. Mai sau con sẽ không thể quên được các người bạn nhí nhảnh của lớp.',
						'datenote' => date('Y-m-d H:i:s'),
						'titlenote' => 'Con thấy con trưởng thành và viết tiến bộ nhiều',
						'view' => 0,
						'comment' => 0
				),
				array(
						'contentnote' => 'Qua khóa học viết văn miêu tả, tôi thấy tôi đã viết tốt hơn nhiều. Khi chưa học tôi viết văn kém nhất lớp nhưng qua khóa học tôi đã vượt lên đứng nhất lớp , tự tin hơn rất nhiều. Tôi rất biết ơn cô và các bạn đã giúp tôi. Dù tôi có đi đâu xa tôi vẫn nhớ đến cô và các bạn. Tôi rất mong cô và các bạn một năm mới hạnh phúc và tràn ngập niềm vui.',
						'datenote' => date('Y-m-d H:i:s'),
						'titlenote' => 'Khi chưa học tôi viết văn kém nhất lớp nhưng qua khóa học tôi đã vượt lên đứng nhất lớp',
						'view' => 0,
						'comment' => 0
				),
				array(
						'contentnote' => 'Qua các ngày học này,con đã rất tiến bộ. Văn của con đã trở nên hay và dài hơn, không còn lủng củng nữa. Có một kí ức mà con không thể quên . Hôm đó cô đến hơi muộn một chút, các bạn nam tắt đèn đi chơi trò" Ma",con rất sợ nhưng cũng thấy rất vui. Trong khóa học con chơi thân nhất với bạn Quyên.Bạn Quyên rất hiền lành chả bao giờ nói to với ai, chữ bạn còn rất đẹp nữa. Cám ơn cô và các bạn đã giúp con suốt hành trình học qua.',
						'datenote' => date('Y-m-d H:i:s'),
						'titlenote' => 'Cám ơn cô và các bạn đã giúp con suốt hành trình học qua',
						'view' => 0,
						'comment' => 0
				),
				array(
						'contentnote' => 'Khoá học đã đem lại cho tôi bao nhiêu kỉ niệm đẹp. Nhất là lần em Bách nhí nhố “đau khổ” vì bị trừ nhiều điểm quá, nhưng may cuối cùng cũng gỡ được. Khoá học cũng đã giúp tôi làm văn nhanh hơn, ý tưởng và từ vựng đã được mở rộng.',
						'datenote' => date('Y-m-d H:i:s'),
						'titlenote' => 'Khoá học đã đem lại cho tôi bao nhiêu kỉ niệm đẹp',
						'view' => 0,
						'comment' => 0
				)
		);
		$globalComments = array(
			array('comment' => 'bài viết tương đối hay'),
				array('comment' => 'Bai van ta hoi sến'),
				array('comment' => 'Bài viết hay,sinh động nhưng cần chỉnh sửa 1 số chỗ cho phù hợp.Như thế bài văn sẽ rất hoàn hảo'),
				array('comment' => 'bai van kha hay'),
				array('comment' => 'Mình thấy có đôi chỗ không hay'),
				array('comment' => 'hay'),
				array('comment' => 'cung tam on chac minh chep dua cho co cham thi khoang 8 hoac diem'),
				array('comment' => 'cũng tạm khoảng đựoc 9 điẻm'),
				array('comment' => 'bai van cua ai ma hay qua vay troi ? qua hay luon kham phuc kham phuc'),
				array('comment' => 'wá là hay chuẩn ko cần chỉnh'),
				array('comment' => 'Hay thật đấy'),
				array('comment' => 'Hay thật đấy mình rất ngưỡng mộ'),
				array('comment' => 'hay wa a!!!!!!!!!!!!!! !!!!'),
				array('comment' => 'Cảm ơn bạn ngân đã đăng bào này lên để mình tham khảo chép văn một tí. Mình là học sinh lớp 4 mà. Hi hi'),
				array('comment' => 'bài này mình cần có thêm chút hoạt động bắt chuột'),
				array('comment' => 'vvvvvvvvvvvvvvv vvvveeeeeeeeeee eeeeeeerrrrrrrr rrrrrrrrrrrrrrr rryyyyyyyyyyyyy yyyyyyyyygggggg ggggggggggggggo ooooooooooooooo ooooooooooooooo ooooooddddddddd ddddddddddddddd ddd'),
				array('comment' => 'super hay'),
				array('comment' => 'loi hoi hoi ngan nhung cung hay nen cho super verygood'),
				array('comment' => 'nhung cung rat hay cho verygood . Toi thich nhatdoan\\\\\'\\\\ \' Hoa mi kha nhao nhan va xinh xan . Dien noi bat de nhan thay o hoa mi la bo long mem muot va xop bong.Mau ao cua hoa mi mau hung hung nhu nhanh cay gia chanhoa mi trong co ve manh mai so voi than hinh khuon tron cua chu nhung lai rat khoe,co the giup chu bam chac vao canh cay va nhay nhot khap noi dang chu y o hoa mi la doi mat long lanh den nhay va tron nhu hai giot suong lu nao cung lap lanh trong that sinh dong . cai duoi dai, duyen dang xoe ra nhu chiec quat ti hon .ban nao nhan xet thi hay ho minh ma cai nay nhan xet de ghe ha chang giong may cai phim gi mai deo nhan xet duoc uc che mo bai nhu dien do ec do deo chep vao nua ngu gi'),
				array('comment' => 'Suốt thời thơ ấu, chú họa mi là chiếc đồng hồ báo thức quen thuộc của em. Khi ông mặt trời thức dậy cũng là lúc chú cất tiếng ca lảnh lót trên cây lộc vừng báo hiệu một ngày mới bắt đầu'),
		);
		foreach($users as $user) {
			$numOfNotes = rand(1, 5);
			shuffle($globalNotes);
			for($i = 0; $i < $numOfNotes; $i++) {
				$notes = array();
				$note = $globalNotes[$i];
				$note['username'] = $user['username'];
				$notes[] = $note;
				$insertId = _db()->insert('user_note')->fields('username,contentnote,datenote,titlenote,view,comment')->values($notes)->result();
				$numOfComments = rand(1, 20);
				$comments = array();
				shuffle($globalComments);
				for($j = 0; $j < $numOfComments; $j++) {
					$usercomment = $users[rand(0, 20000)];
					$comment = $globalComments[$j];
					$comment['userId'] = $usercomment['id'];
					$comment['noteId'] = $insertId;
					$comment['date'] = date('Y-m-d H:i:s');
					$comments[] = $comment;
				}
				_db()->insert('user_note_comment')->fields('userId,noteId,comment,date')->values($comments)->result();
			}
		}
	}
	
	public function wallAction() {
		// duyệt qua tất cả các friend
		// chọn ra 7/10 số user
		// add ngẫu nhiên từ 1 -> 15 bài viết
		set_time_limit(0);
		$users = _db()->select('id,username')->from('user')->limit(40000)->orderBy('RAND()')->result();
		$globalComments = array(
				array('content' => 'bài viết tương đối hay'),
				array('content' => 'Bai van ta hoi sến'),
				array('content' => 'Bài viết hay,sinh động nhưng cần chỉnh sửa 1 số chỗ cho phù hợp.Như thế bài văn sẽ rất hoàn hảo'),
				array('content' => 'bai van kha hay'),
				array('content' => 'Mình thấy có đôi chỗ không hay'),
				array('content' => 'hay'),
				array('content' => 'cung tam on chac minh chep dua cho co cham thi khoang 8 hoac diem'),
				array('content' => 'cũng tạm khoảng đựoc 9 điẻm'),
				array('content' => 'bai van cua ai ma hay qua vay troi ? qua hay luon kham phuc kham phuc'),
				array('content' => 'wá là hay chuẩn ko cần chỉnh'),
				array('content' => 'Hay thật đấy'),
				array('content' => 'Hay thật đấy mình rất ngưỡng mộ'),
				array('content' => 'hay wa a!!!!!!!!!!!!!! !!!!'),
				array('content' => 'Cảm ơn bạn ngân đã đăng bào này lên để mình tham khảo chép văn một tí. Mình là học sinh lớp 4 mà. Hi hi'),
				array('content' => 'bài này mình cần có thêm chút hoạt động bắt chuột'),
				array('content' => 'vvvvvvvvvvvvvvv vvvveeeeeeeeeee eeeeeeerrrrrrrr rrrrrrrrrrrrrrr rryyyyyyyyyyyyy yyyyyyyyygggggg ggggggggggggggo ooooooooooooooo ooooooooooooooo ooooooddddddddd ddddddddddddddd ddd'),
				array('content' => 'super hay'),
				array('content' => 'loi hoi hoi ngan nhung cung hay nen cho super verygood'),
				array('content' => 'nhung cung rat hay cho verygood . Toi thich nhatdoan\\\\\'\\\\ \' Hoa mi kha nhao nhan va xinh xan . Dien noi bat de nhan thay o hoa mi la bo long mem muot va xop bong.Mau ao cua hoa mi mau hung hung nhu nhanh cay gia chanhoa mi trong co ve manh mai so voi than hinh khuon tron cua chu nhung lai rat khoe,co the giup chu bam chac vao canh cay va nhay nhot khap noi dang chu y o hoa mi la doi mat long lanh den nhay va tron nhu hai giot suong lu nao cung lap lanh trong that sinh dong . cai duoi dai, duyen dang xoe ra nhu chiec quat ti hon .ban nao nhan xet thi hay ho minh ma cai nay nhan xet de ghe ha chang giong may cai phim gi mai deo nhan xet duoc uc che mo bai nhu dien do ec do deo chep vao nua ngu gi'),
				array('content' => 'Suốt thời thơ ấu, chú họa mi là chiếc đồng hồ báo thức quen thuộc của em. Khi ông mặt trời thức dậy cũng là lúc chú cất tiếng ca lảnh lót trên cây lộc vừng báo hiệu một ngày mới bắt đầu')
		);
		foreach($users as $user) {
			$comments = array();
			$numOfComments = rand(1, 20);
			shuffle($globalComments);
			for ($i = 0; $i < $numOfComments; $i++) {
				$userwriteIndex = rand(0, 40000);
				$userwrite = $users[$userwriteIndex];
				$comment = $globalComments[$i];
				$comment['datewrite'] = date('Y-m-d H:i:s');
				$comment['username'] = $user['username'];
				$comment['userwritewall'] = $userwrite['username'];
				$comments[] = $comment;
			}
			_db()->insert('user_write_wall')->fields('username,userwritewall,content,datewrite')->values($comments)->result();
		}
	}
	
	public function aqsAction() {
		set_time_limit(0);
		$users = _db()->select('id,username')->from('user')->limit(40000)->orderBy('RAND()')->result();
		$globalQuestions = array(
				array('question' => 'Ai là tác giả của truyện cô bé bán diêm', 'answers' => array('an đec xen')),
				array('question' => 'Chương trình đào tạo Anh văn Kỹ thuật kéo dài 4 năm hay 4 năm rưỡi?', 'answers' => array('Chương trình đào tạo Anh văn Kỹ thuật kéo dài 4 năm và một học kỳ hè vào năm thứ 4. Trong học kỳ hè, SV học các môn tốt nghiệp và ôn tập và thi C1.')),
				array('question' => 'Chương trình đào tạo giảm bớt số tín chỉ còn 150 tín chỉ, vậy có ảnh hưởng tới nội dung chương trình học không?', 'answers' => array('Chương trình đào tạo 150 tín chỉ có số tín chỉ ít hơn chương trình cũ nhưng nội dung chương trình vẫn được đảm bảo, điểm khác biệt là chương trình hướng tới tăng lượng thời gian tự học và tự nghiên cứu của SV.')),
				array('question' => 'Các môn Tiếng Anh chuyên ngành kỹ thuật gồm những môn nào? Vì sao lại chọn những môn này?', 'answers' => array('Các môn Tiếng Anh chuyên ngành kỹ thuật gồm Anh văn chuyên ngành Công nghệ thông tin, Anh văn chuyên ngành Công nghệ Môi trường, Anh văn chuyên ngành Điện-Điện tử, Anh văn chuyên ngành Cơ khí, Anh văn chuyên ngành Thương mại (Tự chọn), Anh văn chuyên ngành thiết kế thời trang (Tự chọn), Anh văn chuyên ngành Dinh dưỡng và công nghệ thực phẩm (Tự chọn).
Các môn Anh văn chuyên ngành hướng tới cung cấp cho sinh viên kiến thức cần thiết về mảng tiếng Anh kỹ thuật.Các môn này được lựa chọn vào chương trình học dựa trên yêu cầu thực tế của xã hội, đặc thù đào tạo của trường, và mức độ phổ biến của mảng kiến thức trong các ngành nghề có liên quan.')),
				array('question' => 'Đối với các môn Tiếng Anh chuyên ngành thì có được đăng ký học song song cả tiếng Việt và tiếng Anh không?', 'answers' => array('Theo chương trình đào tạo, các môn chuyên ngành tiếng Việt được học trước hoặc học song song với môn tương ứng bằng tiếng Anh.')),
				array('question' => 'Những môn học thuộc khối kiến thức giáo dục đại cương (Lý luận chính trị + Pháp luật đại cương, Khoa học XH&NV, Tiếng Nhật, Toán và KHTN, Tin học, Nhập môn ngành SPAVKT, và Luyện âm) có bắt buộc đăng ký học không?', 'answers' => array('Các môn học thuộc khối kiến thức giáo dục đại cương là những môn cung cấp kiến thức nền cho SV, là những môn học bắt buộc.')),
				array('question' => 'Những chứng chỉ quốc tế nào được chấp nhận quy đổi điểm quá trình cho một số môn học trong chương trình 150 TC?', 'answers' => array('Chứng chỉ IELTS và TOEFL iBT.')),
				array('question' => 'Những môn học nào được quy đổi điểm quá trình từ điểm thi quốc tế?', 'answers' => array('Những môn học nào được quy đổi điểm quá trình từ điểm thi quốc tế gồm Nghe-Nói, Đọc, Viết, Ngữ pháp và Luyện âm.')),
				array('question' => 'Em hãy nêu cảm nghĩ về câu:"Học vấn có những chùm rễ đắng cay nhưng hoa quả lại ngọt ngào". ', 'answers' => array('Phải chi được làm đất, 
Để biết rễ cây tìm đến những nơi đâu ? 
Lòng đất "tối đen" mà mênh mông vô tận 
Rễ bám sâu, hoa trái ngọt trên cành !" 
Nghĩa đen:"Sự học"--->Lòng đất ở đây tượng trưng cho thế giới vô tận không bờ bến của sự học mà kiến thức của con người thì hữu hạn như những hạt cát trong đó vậy . 
--->Cái cây muốn lớn ,muốn sinh trưởng ,phát triển phải đâm rễ xuống lòng đất hút dinh dưỡng "tinh túy" trong lòng đất mẹ mà vươn vai trổ nụ. ')),
				array('question' => 'Giúp em giải thích ý nghĩa câu tục ngữ \'Thất bại là mẹ thành công\' với ạ?', 'answers' => array('Thất bại là mẹ của thành công, nghĩa là: Thất bại "sinh ra" thành công. Tại sao người ta lại nói như vậy? 
Ta nên đi từ nguyên nhân của thành công. Nguyên nhân của thành công có nhiều yếu tố nhưng chủ yếu nó bao gồm: 
- Có năng lực 
- Chớp được thời cơ 

Vậy thử xem Thất bại có sinh ra việc có năng lực và chớp thời cơ hay không? Khi người ta thất bại người ta thường ngồi suy ngẫm vì sao người ta thất bại hơn là khi người ta thành công thì người ta thường nghĩ vì sao người ta thành công. Thay vào đó, người ta ăn mừng và tự mãn, điều này giết chết thành công. 
- Khi người ta nghĩ vì sao người ta thất bại thì điều đầu tiên nghĩ tới là năng lực của mình đã đủ chưa (khả năng chuyên môn của bản thân, khả năng liên kết và dùng người, nhân lực, vật lực và thời gian). Sau đó người ta nghĩ tới liệu mình thực hiện như vậy đã đúng thời điểm chưa, đã đủ chín để thực hiện chưa (chớp thời cơ). Khi người ta tìm được ra nguyên nhân như vậy, đa phần họ sẽ chuẩn bị tốt hơn cho những lần sau để không bị thất bại. Do đó thất bại sinh ra thành công là vậy. 
- Con người thường có tính kiêu hãnh, họ thường không chịu thất bại, họ luôn muốn chinh phục và luôn muốn thành công. Trong khi đó thất bại làm có tính kiêu hãnh của họ nổi dậy và mạnh lên, đó là vì sao mà thất bại sinh ra thành công vậy. 

Ý NGHĨA của nó như thế nào? như ở trên tôi đã trình bày. 
- Nó khuyên người ta khi thất bại thì đừng nản, phải biết nhìn lại để nhận ra vì sao lại như vậy và điều quan trọng hơn cả là làm sao để lần sau không bị như vậy nữa và lần sau làm như thế nào để đạt được. 
- Nó còn một ý nghĩa nữa, một ý nghĩa hết sức con người, đó là an ủi người ta, đa phần sự an ủi đều tốt, nó làm cho người ta lấy lại được tự tin. Nhưng đôi khi nó làm nhụt chí người ta vì sự bằng lòng của họ lớn hơn ý chí của họ. 

Câu nói trên chỉ có tác dụng đối với người có ý chí và lòng đam mê mà thôi.', 'Trước hết chúng ta cần hiểu rõ ý nghĩa câu tục ngữ. 
Thất bại là không đạt được kết quả, mục đích như dự định, trái với thành công. Vậy mà câu tục ngữ lại khẳng định thất bại là mẹ thành công-một điều hết sức mâu thuẫn.Hẳn ai cũng biết mẹ là người sinh ra, tạo ra. 
Tổng kết lại, ta hiểu rằng có thất bại thì ta mới có kinh nghiệm, từ đó dẫn tới thành công. Vậy đúng là thất bại đã sinh ra thành công, có bại mới có thắng. Câu tục ngữ tưởng chừng như mâu thuẫn nhưng thật ranó lại là 1 kinh nghiệm sống mang ý nghĩa thực tế. Thất bại dạy cho ta những bài học để ta vượt lên và tiến tới thành công. 

Đó, bạn coi cái định nghĩa tui làm có đúng hok.', 'Mình thì không giỏi văn cho lắm, nhưng cũng có một số ý kiến nè: 
Ví dụ như...Trong cuộc sống, có những lúc chúng ta bị mắc nhưng lỗi lầm gì đó rồi dẫn đến sự thất bại, nhưng thất bại đôi khi cũng dẫn đến sự thành công nên có 1 nhà thơ có câu: Thất bại là mẹ thành công. Khi cúng ta thất bại thì không bao giờ được nản chí, phải cố gắng phát huy để cò thẩ đem tới sự thành công. Rùi,ý kiến của mình đó. ', 
				'theo mình thì không ai mới làm điều gì cũng giỏi được ngay!có thất bại thì mới có thành công nhiều danh nhân nổi tiếng trên thế giới đều đã bị thất bại nhiều người đã cháy túi nhưng không có điều gì có thể dập tắt ý chí lòng quyết tâm của họ trong họ vẫn nuôi một tia hi vọng nhỏ nhoi nhưng đầy lòng khát khao.nếu lần này thất bại thì lần sau sẽ thành công đúng với câu tục ngữ "thất bại là mẹ thành công')),
				array('question' => 'Mong các bạn góp ý giúp . Đề cụ thể là: Nhân dân ta thường nói: " Có công mài sắt có ngày nên kim". Hãy chứng minh tính đúng đắn của câu tục ngữ đó', 'answers' => array('Gửi em dàn bài và vài gợi ý, em hoàn chỉnh thành bài văn nhá ! 
DÀN BÀI 
I Nhập đề : 
Giới thiệu đề. 
II Diễn đề : 
1- Giải đề: 
- Giải nghĩa chánh và ẩn ý. 
- Cho thí dụ chứng minh. 
2- Bình đề : 
Cho biết câu này nhằm khuyên ta điều gì? 
( dẫn ca dao, tục ngữ, danh ngôn chứng minh thêm ) 
III Kết luận : 
Xác nhận nhiệm vụ. 
GỢI Ý : 
II Diễn đề : 
- Một cây sắt lớn mà ta kiên nhẫn, bền chí đem ra mài, hết ngày này đến ngày khác, lâu ngày chầy tháng rồi cũng trở thành một cây kim hữu dụng. 
- Có những công việc lớn hoặc khó, ta không thể làm một ngày một buổi mà xong. Nếu ta không bền chí, quyết tâm làm hoài thì phải bỏ dở nửa chừng. Trái lại, nếu ta quyết vượt qua khó khăn trở ngại, kiên nhẫn làm mãi thì thế nào cũng đi đến kết quả tốt đẹp. 
-Xưa ông Châu Trí mồ côi cha mẹ, phải đến chùa mà ở. Nhà chùa thường đi ngủ sớm để tiết kiệm dầu đèn của bá tánh cung cấp cho. Ông ra sân chùa quét lá đa khô đốt lên, lấy ánh lửa để mà học tập. Phải học tập trong hoàn cảnh khó khăn như thế mà ông không nản lòng nên sau này trở thành một bậc tài danh. Nay có thầy Nguyễn Ngọc Ký vốn bị liệt hai tay từ nhỏ, kiên trì luyện tập viết chữ bằng chân để trở thành người có ích. Thầy học xong phổ thông, đại học và trở thành thầy giáo, một nhà giáo ưu tú.Thầy là một tấm gương sáng về ý chí và nghị lực. 
- Khuyên ta bất cứ làm việc gì, ta không nên làm ít bữa , thấy khó rồi bỏ đi, mà phải chịu khó làm mãi, không thối chí ngã lòng thì mới xong việc ... Tục ngữ cũng có những câu có ý nghĩa tương tự : Có chí thì nên, Nước chảy đá mòn ... 
- Trong hoàn cảnh hiện nay, ngoài đức tính kiên trì nhẫn nại, theo em còn cần phải vận dụng óc thông minh, sáng tạo để đạt được hiệu quả cao nhất trong học tập, lao động, góp phần vào sự nghiệp xây dựng đất nước ngày càng giàu mạnh.',
				'de thui. ban zo vanmau.com ma tim hieu bit chua 
hoac cu lam theo nhung j minh nghi rui chep zo',
				'Con người ta ai cũng muốn thành đạt .Nhưng con đường dẫn đến thành công thường quanh co khúc khuỷu và lắm chông gai .Để động viên con người vững chí , bền gan phấn đấu và tin tưởng ở thắng lợi ,cha ông ta dặn dò con cháu qua câu tục ngữ : 
" Có công mài sắt có ngày nên kim " 
Ai cũng biết cây kim bé nhỏ tới mức nào nhưng cũng hoàn hảo tới mức nào . Thân kim bằng sắt tròn ,mảnh ,nhỏ xíu .Đầu kim nhọn sắt .Trôn kim cũng có một lỗ nhỏ xíu để luồn chỉ qua .Có thể kim mới trở thành một vật có ích cho cuộc đời .Còn sắt là vật liệu làm nên kim . Chỉ có điều ,làm từ sắt nên kim là cả một quá trình tôi luyện , mài dũa công phu bền bỉ . Nhưng có đi có lại .Ai có công mài sắt bền bỉ ,kiên trì sẽ có ngày nên kim .Đức kiên trì ,chí bền bỉ chính là một yếu tố quan trọng dẫn đến thành công . 
Thực tế cuộc sống đã cho thấy điều đó là hoàn toàn có cơ sở .Trong lịch sử chống ngoại xâm của dân tộc ta , chúng ta phải thực hiện chiến lược trường kì kháng chiến ,nhất định thắng lợi .Từ cuộc kháng chiến chống quân Minh của vua tôi nhà Lê đén cuộc kháng chiến chông Pháp ,chống Mĩ của nhân dân ta trong những năm vừa qua ,tát cả đều thử thách ý chí kiên trì ,bền gan vững chí của cả dân tộc .Và cuối cùng chúng ta đã giành được thắng lợi ,đã giành được độc lập 
cho dân tộc ,tự do cho nhân dân .Nhờ kiên trì kháng chiến ,nhân dân ta thành công . 
Trong đời sống lao động sản xuất ,nhân dân ta cũng nhiều lần thể hiện đức kiên nhẫn dáng khâm phục .Nhìn những con đê sừng sững đôi bờ sông Cầu , sông Hồng ,sông Đáy ,sông Thương ,chúng ta hiểu được cha ông ta đã kiên trì ,bền bỉ tới mức nào để ngăn dòng nước lũ ,bảo vệ mùa màng trên đồng bằng Bắc Bộ .Chỉ với đôi bàn tay cầm mai , đôi vai vác đất ,hoàn toàn là sức lao động thủ công ,không có máy xúc ,máy ủi ,máy gạt ,máy đầm như ngày nay ,cha ông ta đã kiên trì ,quyết tâm lao động và thành công . 

Trong học tập ,đức kiên trì lại càng cần thiết dể có được thành công .Từ một em bé mẫu giáo vào lớp một ,bắt đầu cầm phấn viết chữ O đầu tiên đến khi biết đọc ,biết viết ,biết làm toán rồi lần lượt mỗi năm một lớp ,phải mất 12 năm mới hoàn thành những kiến thức phổ thông .Trong quá trình lâu dài ấy ,nếu không có lòng kiên trì luyện tập ,cố gắng học hành ,làm sao có ngày cầm được bằng tốt nghiệp .Người bình thường đã vậy ,với những người như Nguyẽn Ngọc Kí ,lòng kiên trì bền bỉ lại càng cần thiết để vượt qua khó khăn .Vốn bị liệt hai tay từ nhỏ ,anh đã kiên trì luyện viết bằng chân để có thể đến lớp cùng bạn bè .Đức kiên trì đã giúp anh chiến thắng số phận .anh đã học xong phổ thông ,học xong đại học và trở thành thầy giáo ,một nhà giáo ưu tú . 
Thế mới biết ý chí ,nghị lực ,lòng kiên nhẫn ,sự bền bỉ đóng vai trò quan trọng tới mức nào trong việc quyết định thành bại của mỗi công việc nói riêng và cả sự nghiệp của mỗi con người nói chung .Có mục đích ban đầu dung đắn - chưa đủ ; phải có lòng kiên trì ,nhẫn nại cọng với một phương pháp làm việc năng động và sáng tạo thì chúng ta mới có thể biến ước mơ thành hiện thực . 
Bàn luận về một vấn đề có tầm cỡ lớn lao là sự nghiệp mà lại lấy hình ảnh của một sự vật thật bé nhỏ là một cây kim để nói ,ông cha ta phải có chủ ý rõ ràng và sâu sắc ,gửi gắm trong lời khuyên giản dị như một triết lí : có công mài sắt có ngày nên kim .caau tục ngữ không chỉ là một bài học về ý chí mà còn là lời động viên chân tình : hãy lạc quan ,tin tưởng . 
Kế thừa và phát huy quan niệm của ông cha ,với những kinh nghiện trong cuộc đời hoạt động cách mạng của mình ,Bác Hồ đã khuyên thanh niên: 
" Không có việc gì khó 
Chỉ sợ lòng không bền 
Đào núi và lấp biển 
Quyet chí ắt làm nên" 
Việc tu dưỡng ,rèn luyện của mỗi con người phải được tiến hành thường xuyên ,liên tuc .Kinh nghiện của thế hệ trước là lời khuyên quí báu ,lời cổ vũ thanh thiếu niên trên con đường phấn đấu xây dựng cuộc sống tốt đẹp',
				'bài nay hay đó bạn ak. nhưng mà mình có góp ý bạn nên cho 1 số từ ngữ chuyển đoạn thì bài văn sẽ hay và mạch lạc hơn. hjhj.',
				'bài này còn là đề thi giữa hk 2 trường mình đóa.',
				'Bài này là để kiểm tra giữa kì II của khối mình nè! haizz! ',
				'các bạn còn bài uống nước nhớ nguồn ăn quả nhớ kẻ trồng cây ko',
				'bài này ở trong quyển những bài làm văn mẫu mà',
				'Trên đời này chẳng có một kết quả lớn nhỏ nào tự nhiên mà có, tất thảy đều được tạo ra từ những sự cố gắng không ngừng. Sức mạnh của sự kiên trì được nhân dân ta đúc kết trong câu tục ngữ thật hay: Có công mài sắt có ngày nên kim.

Bằng việc nêu ra sự đối lập ghê gớm giữa thanh sắt to lớn, xù xì và cây kim bé nhỏ mà tinh xảo, tác giả dân gian xưa đã nêu bật tác dụng to lớn của sự kiên trì cố gắng không mệt mỏi của con người để đạt tới thành công. Điều đó đã được chứng minh qua rất nhiều tấm gương trong cuộc sống.

Nước Việt Nam ta là một nước nhỏ bé, những ngày đầu kháng chiến chống Pháp và chống Mĩ tiềm lực kinh tế, quân sự chưa mạnh, nhưng nhờ tinh thần trường kì kháng chiến, không sợ gian khổ hy sinh, sau ba mươi năm ta đã chiến thắng vẻ vang.

Trong lĩnh vực học tập rèn luyện, cũng có nhiều tấm gương kiên trì phấn đấu. Xưa có bậc danh nho Nguyễn Siêu, văn hay chữ tốt đến mức được người đời tôn làm “Thần Siêu”. Nhưng mấy ai biết rằng thuở đi học, chữ ông viết rất xấu, mấy lần ông đỗ chưa cao chỉ vì chữ xấu, hại đến văn hay. Khi làm qian, điều khiến ông đau đớn nhất là chỉ vì chữ xấu mà khi ông phê án khiến kẻ dưới luận sai, làm một người đàn bà vô tội thua kiện. Từ đó, ông quyết chí rèn chữ. Viết chữ nho phải viết bằng bút lông, tay phải vừa khéo vừa vững gân tay. Ông kiên trì tập vạch từng nét sổ, nét ngang, nét mác, nét uốn câu,… Nét nào ông cũng phải tập viết hàng ngàn lần, kì cho sắc nét mới tập vào chữ, từ những chữ đơn giản đến những chữ phức tạp. Tập không kể ngày đêm, tay có lúc cứng đờ, tê buốt. Sau nhiêu tháng năm, chữ ông viết tuyệt đẹp, còn được giữ lại không ít lưu bút ở đền Ngọc Sơn. Ngày nay, học sinh lớp hai nào mà không biết tấm gương của thầy giáo Nguyễn Ngọc Kí qua bài Tập đọc. Ngay từ khi còn nhỏ, căn bệnh bại liệt đã cướp đi đôi tay của thầy. Nguyễn Ngọc Kí vẫn đến lớp, lặng lẽ ngồi trên chiếc chiếu ở góc lớp, dùng chân kẹp cây bút, tập đưa những nét chữ nguệch ngoạc trên giấy trắng. Nhưng anh không nản chí, cứ tập mãi, tập mãi, gò lưng mà tập, chân đau nhớc, anh vẫn không thôi. Cuối cùng anh không chỉ viết chữ đẹp mà vẽ được rất chính xác các bài toán Hình học phức tạp, các hình vẽ các cơ quan trong cơ thể người của môn Sinh học. Học xong phổ thông, Anh học Khoa Văn Đại học Tổng hợp Hà Nội. Giờ đây anh đã trở thành thầy giáo. Thầy không chỉ truyền cho học trò tri thức mà cả tinh thần cần cù, nhẫn lại tuyệt vời.

Những công trình khoa học ra đời đâu phải chỉ nhờ tài năng, phần lớn còn phải nhờ lòng nhẫn nại. Giáo sư Tiến sĩ Lương Đình Của từ những hạt thóc giống quý báu đem từ Nhật về, mất hàng chục năm, trải qua hàng ngàn thí nghiệm lai tạo, ông đã đem lại những giống lúa phù hợp với thổ nhưỡng Việt Nam và cho năng xuất cao. Hai vợ chồng nhà bác học Pi-e Quy-ri và Ma-ri Quy-ri đã miệt mài nghiên cứu, kì công lọc đi lọc lại tám tấn quặng để tìm ra một phần mười gam chất phóng xạ ra-đi-um, khai phá một nền khoa học có sức mạnh ghê gớm khi đem phục vụ lợi ích hoà bình nhân loại.

Nhận thức sâu sắc giá trị mạnh mẽ của lòng kiên nhẫn, thơ văn của chúng ta cũng đã viết nên những câu chuyện đầy ý nghĩa. Truyện ngụ ngôn Mài sắt nên kim là một trong số đó. Một cậu bé cứ sờ đến sách là ngại vì chữ viết thì khó mà bài thì dài. Cậu đâm lười học, ham chơi. Ngày ngày lang thang ngoài đường, lúc nào cậu cũng gặp bà lão ngồi bên vệ đường kiên trì mài thanh sắt cứng. Cậu bé rất ngạc nhiên khi bà lão nói một câu đầy tự tin: “Ta mài thanh sắt này để có chiếc kim nhỏ bé”. Cậu hiểu ra rằng chỉ có lòng nhẫn nại mới giúp người ta thành công trong cuộc sống, từ đó cậu chăm chỉ học hành. Ngụ ngôn của nhà thơ nổi tiếng la-phông- ten cũng cho chúng ta một bài học thú vị khi chú rùa chậm chạp, nhưng cực kì chăm chỉ, miệt mài tha cái mai nặng trên lưng đi liên tục không nghỉ, cuối cùng đã thắng chú thỏ lười biếng.
Việc bình thường đã vậy, việc lớn lao như sự nghiệp cách mạng gian nan, cuộc đời buôn ba bốn biển năm châu hoạt động cứu nước của Bác Hồ cũng được Bác viết lên trong bài thơ Đi đường:

Đi đường mới biết gian lao,
Núi cao rồi lại núi cao trập trùng.
Núi cao lên đến tận cùng,
Thu vào tầm mắt muôn trùng nước non.

Đó quả là bài học thấm thía về lòng kiên trì sắt đá của người chiến sĩ cách mạng.

Thế mới biết ở trên đời phàm việc lớn, việc nhỏ, muốn thành công không thể thiếu tinh thần cần cù, chịu khó, kiên trì, nhẫn nại. Một nhà bác học cũng đã từng nói: “Thiên tài chỉ do một phần trăm là bẩm sinh còn chín mươi chín phần trăm là sự cần cù”. Càng ngẫm về câu tục ngữ, nhớ lại những tấm gương trên, em càng thấy lòng kiên trì, nhẫn nại của mình thật còn quá mỏng, làm sao mà em có thể học tốt được. Các nhà bác học, các vị lãnh tụ, sự nghiệp của họ cao như quả núi ngất trời nhưng họ vẫn không bao giờ buông lơi sự nỗ lực, miệt mài trong cả cuộc đời đất thôi. Em không thể buông xuôi được.',
				'Bài viết này rất hay và mạch lạc.',
				'Đề này khó tìm dẫn chứng quá àh')),
				array('question' => 'Làm giùm mình với "Phong cách chính là người" anh chị hiểu ý kiến như thế nào?', 'answers' => array('he, cái đề này lớp tớ vừa bị làm 2 tuần trc\'. Đề này là đề tớ ghét nhất, đã chuẩn bị j` đâu, đến lớp làm cũng đc 3.5 trang. Ngày mai thầy tớ trả bài. Thui để tớ gợi ý sơ wa nhá: 

- Định nghĩa Fong cak là j`? 

+ fong cak (fc) đv chta là khái niệm ko hề xa lạ. Chúng ta từng biết tới fc ăn mặc, fc nói chuyện, fc ca sĩ,... fc trong văn học là...(trg sgk í)..... 

+ fc chính là thể hiện cá tính, cái tôi bản ngã của mỗi nhà văn, quyết định tới yếu tố sống còn của 1 tp. 


- Fong cak văn học gồm 2 fần, ko thể tách rời với nhau, bổ sung cho nhau: 

+ fong cak nội dung: so sánh 1 số tp cùng chủ đề nhg cak thể hiện chủ đề ấy khác nhau. Vd: nét trữ tình của dòng Đà giang trg NLĐSĐ với nét thơ mộng của sông Hương trg AĐĐTCDS, 2 bài Đất nước của NKĐ và NĐT, Vội vàng vs Sóng, ... 

+ fong cak nghệ thuật: fân tích cak viết, cak thể hiện ngth của nhà thơ nhà văn trg 1 số bài thơ. Vd: cak viết của Bác trg Tuyên ngôn độc lập, Bản án chế độ thực dân vs trg Lời kêu gọi toàn quốc k/c, cak viết của Bác trg các bthơ ngth vs các bài thơ Bác viết cho nd lao động bình dân. Hay fc cak thấm đượm các yếu tố văn hoá dân jan của Tố Hữu trg bài Việt Bắc, ........ 


- Khẳng định lại lời nói của Buy-phông',
				'Trong cuộc sống, người ta thường nói phong cách theo hai nghĩa : 
Một là, phong cách nghệ thuật. Đó là phong cách của một nhà văn, nhà thơ, nhà kiến trúc ... hoặc phong cách của một thời đại nào đó. 
Hai là, tác phong, tính cách của một người hay một lớp người nào đó trong xã hội được hình thành một cách tương đối ổn định, làm nên phong cách riêng của một người hay một lớp người đó. 
Phong cách mang đậm dấu ấn cá nhân, nhưng chịu tác động mạnh mẽ sâu sắc của môi trường sống. Đó là những tác động của truyền thống văn hoá, đạo đức, tâm lí nghề nghiệp ... Mỗi người do khí chất, do năng lực và kinh nghiệm có thể tiếp thu những cái tốt đẹp và loại trừ những cái xấu để hình thành phong cách. Vì vậy, cùng một hoàn cảnh nhưng phong cách của mỗi người không hoàn toàn giống nhau, mà nó chính là bản thân người mang phong cách đó.',
				'Giúp mình làm bài này với coi!! [:-P] :D khó quá ah 
Mình cám ơn các ban nhiều lém',
				'trong cuoc song nguoi ta thuong noi phong cach theo hai nghia:mot la,phong cach nghe thuat do la phong cach cua mot nha van, nha tho, nha kien chuc...hoac phong cach cua mot thoi dai nao do.hai la,tac phong,tinh cach cua mot nguoi hay mot lop nguoi nao do trong xa hoi dc hinh thanh 1 cach tuong doi on dinh lam nen phong cach rieng cua mot nguoi hay mot lop nguoi nao do.phong cach mang dam dau an ca nahn,nhung chiu tac dung manh me sau sac cua moi truong song.do la nhung tac dong cua truyen thong van hoa,dao duc tam li nghe nghiep...moi nguoi do khi chat,do nang luc va kinh nghiem co the tip thu nhung cai tot dep va loai tru nhung cai xau de hinh thanh phong cach.vivay,cung môt hoan canh phong cach cau moi nguoi ko hoan toan giong nhau,ma nochinh la ban than nguoi mang phong cach do vay phong cach la cach song da tro thanh ne nep riêng cua moi nguoi,moi gia dinh... 
+phong cach?diem rieng ,net dac sac trong sang tac,ca tinhnghe thuat cua nha van,giup phan biet nha van nay voi nha vna khac. 
+nguoi?dac diem ca tinh con nguoi ca nhan nha van. 
+phong cach chinh la nguoi?vai tro cua ca tinh su hinh thanh phong cach.ca tinh ban than lam nen ca tinh nghe thuat nha van.doc mot tac pham ta thay dc con nguoi,catunh nha van trong do. 



cac ban nen tim them dan chung de chung minh phong cach chinh la nguoi nhu (NAM CAO hay dat con nguoi trong wa trinh an nan,dan vat sam hoi do ngoai doi ong la mot con nguoi ngoan dao ,rat hay tu dan vat minh........ui dai wa hok vit dc nua moi tay wa '))
		);
		
		foreach($users as $user) {
			// insert questions
				// insert answers
			shuffle($globalQuestions);
			$question = $globalQuestions[0];
			$aqsQuestion = array(
					'question' => $question['question'], 
					'userId' => $user['id'], 
					'answer' => count($question['answers'])
			);
			$questionId = _db()->insert('aqs_question')->fields('question,answer,userId')->values(array($aqsQuestion))->result();
			shuffle($question['answers']);
			$answers = array();
			foreach ($question['answers'] as $answer) {
				$answerUser = $users[rand(0, 40000)];
				$answerUserId = $answerUser['id'];
				$aqsAnswer = array(
						'questionId' => $questionId,
						'answer' => $answer,
						'userId' => $answerUserId
				);
				$answers[] = $aqsAnswer;
			}
			_db()->insert('aqs_answer')->fields('questionId,answer,userId')->values($answers)->result();
		}
	}
	
	public function getFiles ($folder) {
		$rs = array();
		$files = glob($folder . '/*.txt');
		foreach($files as $file) {
			$rs[] = $file;
		}
		
		$files = glob($folder . '/*/*.txt');
		foreach($files as $file) {
			$rs[] = $file;
		}
		
		$files = glob($folder . '/*/*/*.txt');
		foreach($files as $file) {
			$rs[] = $file;
		}
		
		$files = glob($folder . '/*/*/*/*.txt');
		foreach($files as $file) {
			$rs[] = $file;
		}
		
		$files = glob($folder . '/*/*/*/*/*.txt');
		foreach($files as $file) {
			$rs[] = $file;
		}
		
		$files = glob($folder . '/*/*/*/*/*/*.txt');
		foreach($files as $file) {
			$rs[] = $file;
		}
		return $rs;
	}

}
