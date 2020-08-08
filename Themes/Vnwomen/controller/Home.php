<?php

/**
 *
 */
class PzkHomeController extends PzkController{
		
	public $masterPage	=	"index";
	
	public function indexAction(){
		$this->initPage();
		
		$themes = pzk_themes('vnwomen');
		
		if(!$themes){
			
			$this->append('<home.content layout="home/content_home"/>','left');
		}
		
		if($themes){
			
			$this->append('<home.content layout="home/content_left"/>','left');
			$this->append('<home.content layout="home/content_mem"/>','left');
			$this->append('<home.content layout="home/content_right"/>','right');
		}
		$this->display();
	}
	
	

    public function categoryAction(){
        $this->layout();
        $category = pzk_parse('<home.category table="categories" layout="home/category"/>');
        $left = pzk_element()->getLeft();
        $left->append($category);
        $this->page->display();
    }

    public function questionAction(){
        $this->layout();
        $question = pzk_parse('<core.db.list table="questions" layout="home/question" />');
        $left = pzk_element()->getLeft();
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
	
	
	
	

}
