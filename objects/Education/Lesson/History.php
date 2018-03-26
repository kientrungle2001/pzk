<?php 
/**
* 
*/
class PzkEducationLessonHistory extends PzkObject
{
	public $num_record= 5;
	
	public function loadUserName($member)
	{
		$user=_db()->useCB()->select('user.name as name, user.username as username,user.id as userid, user.avatar as avatar')->from('user')->where(array('id',$member))->result_one();
		return $user;
	}
	public function loadUserId($username)
	{
		$user=_db()->useCB()->select('user.name as name, user.username as username,user.id as userid, user.avatar as avatar')->from('user')->where(array('username',$username))->result_one();
		return $user;
	}
	public function countLession($member)
	{
			
			$count=_db()->useCB()->select('count(*) as count')->from('lession_favorite')->where(array('userId',$member))->result_one();
			return $count; 
	}
	public function numberPage($member)
	{
		$countrow=$this->countFriend($member);
		$num_row= $countrow['count'];
		$num_record= $this->num_record;
        $num_page=ceil($num_row/$num_record);
        return $num_page;
	}
	public function viewListLesson($userId,$id)
	{
			//$listLesson=_db()->useCB()->select('lesson_history.id as id, lessons.lesson_name as lessonName,categories.name as categoriesName, lesson_history.date as date')->from('lesson_history')->join('categories','categories.id=lesson_history.categoriesId')->join('lessons','lessons.id=lesson_history.lessonId')->where(array(array('column','lesson_history','userId'),$member))->result();
		
			//return $listLesson; 
		$listLesson=_db()->useCB()
            ->select('user_book.id, user_book.startTime, categories.name')
            ->from('user_book')
            ->leftjoin('categories','categories.id=user_book.categoryId')
            ->where(array('equal',array('column','user_book','userId'), $userId));

			if($id)
			{

				$listLesson->where(array('lt',array('column','user_book','id'), $id));
			}

			$listLesson->orderBy('user_book.id desc')->limit(6);

			return $listLesson->result();
	}

	public function countLesson($userId, $id)
	{
		$countLesson=_db()->useCB()
            ->select('count(*) as count')
            ->from('user_book')
            ->where(array('userId',$userId));

		if($id)
			{
				$countLesson->where(array('lt','id', $id));
			}
		$countLesson->orderBy('id desc');
		$count= $countLesson->result_one();
		return $count['count'];
	}

    public function detailLesson($lesson_id) {
        $data =_db()->useCB()
            ->select('*')
            ->from('user_answers')
            ->where(array('user_book_id', $lesson_id))
            ->result();

        return $data;
    }
	public function  getQuestionById($id) {
        $data =_db()->useCB()
            ->select('*')
            ->from('questions')
            ->where(array('id', $id))
            ->result_one();
        return $data;
    }
}
 ?>