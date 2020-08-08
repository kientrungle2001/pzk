<?php 
class PzkFavoriteController extends PzkFrontendController 
{
	public $masterPage='index';
	public $masterPosition='left';
	
	public function lessonfavoriteAction()
	{
		$this->layout();		
		//$this->append('user/profilefriend', 'left');
		$this->append('favorite/lessonfavorite', 'left');
		
		$this->page->display();
			
	}

	public function lessonfavoritememberAction()
	{
		$this->layout();
		$this->append('favorite/lessonfavoritemember', 'left');
		
		$this->display();
	}
	public function lessonhistoryAction()
	{
		$this->layout();
		$this->append('favorite/lessonhistory', 'left');
		
		$this->display();
				
	}
	public function delLessionfavoriteAction()
	{
	
		$id = pzk_request()->getSegment(3);
		$lessonfavorite=_db()->getEntity('favorite.lesson_favorite');
		$lessonfavorite->load($id);
		$lessonfavorite->delete();
		$this->redirect('lessonfavorite?member='.pzk_session()->getUserId());
	}
	public function viewlessonAction()
	{
		//$lesson_favoriteId= pzk_request()->getLesson_favoriteId();
		$detailnotepage=$this->parse('favorite/lessonfavoritepage')	;
		$detailnotepage->display();

	}
	public function viewlessonmemberAction()
	{
		//$lesson_favoriteId= pzk_request()->getLesson_favoriteId();
		$detailnotepage=$this->parse('favorite/lessonfavoritememberpage')	;
		$detailnotepage->display();

	}
	public function viewhistoryAction()
	{
		$lesson_favoriteId= pzk_request()->getLesson_historyId();
		$detailnotepage=$this->parse('favorite/lessonhistorypage')	;
		$detailnotepage->display();

	}
    public function detailLessonAction() {
        $this->layout();
        $this->append('favorite/detaillesson', 'left');

        $this->display();
    }
}
 ?>