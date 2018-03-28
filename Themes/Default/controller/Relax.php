<?php

/**
 *
 */
class PzkRelaxController extends PzkController{

	public $masterPage	=	"index";
	public $masterPosition = 'wrapper';
	
	public function HomeAction(){
	// require_once BASE_DIR . '/lib/string.php';
	$this->initPage();
	pzk_page()->set('title', 'Quà tặng');
	pzk_page()->set('keywords', 'Giáo dục, quà tặng');
	pzk_page()->set('description', 'Các bài viết hay, những kinh nghiệm cuộc sống');
	pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
	pzk_page()->set('brief', 'Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
	$this->append('education/relax/nrelax', 'wrapper')
	->display();
	}
	public function ajaxdetailAction(){
			$this->parse('education/relax/ajaxdetail');
			$id = intval(pzk_request('id'));
			//$parentid = pzk_request('parentid');
			$detail = pzk_element('ajaxdetail');
			$detail->set('itemId', $id);
			
			$detail2 = pzk_element('comment');
			$detail2->set('newId', $id);
			pzk_stat()->log('news', $id);
			//$detail = pzk_element('catenews');
			//$detail->setParentId($parentid);
			$detail->display();
	}
	public function showsubjectAction(){
			$this->parse('education/relax/showsubject');
			$id = intval(pzk_request('id'));
			$detail = pzk_element('parent');
			$detail->set('parentId', $id);
			$detail->display();
	}
	public function newCommentAction() {
		$newId = intval(pzk_request('newsid'));
		$userId = intval(pzk_request('userid'));
		$comment = clean_value(pzk_request('comment'));
		if($newId !='' and $comment !='') {
			$frontend = pzk_model('Frontend');
			$data = array(
				'newsId' => $newId,
				'content' => $comment,
				'userId' => $userId,
				'created' => date(DATEFORMAT, time()),
				'ip' => $_SERVER['REMOTE_ADDR'],
			);
			$frontend->save($data, 'news_comment');
			echo 1;
		}
	}

}
