<?php 
class PzkFillController extends PzkFrontendController 
{
	public $masterPage='index';
	public $masterPosition='left';
	public function layout()
	{
		$this->page = pzk_parse($this->getApp()->getPageUri('index'));
	}

	public function fillAction()
	{
		$this->initPage();	
		$this->append('question/fill', 'left');
		$key_book= uniqid();
		pzk_session('keyBook',$key_book);
		$this->display();
	}

public function fillPostAction(){

	$request = pzk_request();
	$data_answers=$request->get('answers');
	
	$question_id=$data_answers['question_id'];
	$answers=$data_answers['answers'];
	$question_type= $data_answers['question_type'];
	$category_id= $data_answers['category_id'];
	$quantity_question= $data_answers['quantity_question'];
	$userBook= _db()->getEntity('userbook.userbook');
	$userAnswer= _db()->getEntity('userbook.useranswer');
	$userId=pzk_session('userId');


	$time= $data_answers['time'];
	$stop_timer=$data_answers['stop_timer'];

	$time_real = $time*60 -$stop_timer;
	$date= date("Y-m-d H:i:s");

	//insert database
	$row= array('userId'=>$userId,'categoryId'=>$category_id,'time'=>$time,'quantity_question'=>$quantity_question,'mark_status'=>0,'date'=>$date,'time_real'=>$time_real);
	$userBook->setData($row);
	$userBook->save();
	$userbookId=$userBook->get('id');
	for($i=0; $i< $quantity_question; $i++){
		$count=count($answers[$i]);
		$answer[$i]='';
		if($count>0){
			for($j=0; $j< $count; $j++){
			
				$answer[$i]=$answer[$i].$answers[$i][$j].'|';
			}
		}
		$questionId=$question_id[$i];
		$questionType=$question_type[$i];
		$rowAnswer=array('user_book_id'=>$userbookId,'questionId'=>$questionId,'question_type'=>$questionType,'content'=>$answer[$i]);
		$userAnswer->setData($rowAnswer);
		$userAnswer->save();
	} 
	echo base64_encode(encrypt($userbookId, SECRETKEY));
	
}

    public function lessonAction()
    {
        $parent_id = pzk_request()->getSegment(3);

        $this->initPage();
        $this->append('question/lesson', 'left');
        $category = pzk_element('parent_category');
        $category->setParentCategoryId($parent_id);

        $this->display();
    }

    public function questionAction(){

        $this->initPage();
        $id_category=pzk_request()->get('id_category');
        $this->append('question/question', 'left');
        $this->display();
    }

public function fillPostMarkAction(){
	$user_book_id=pzk_request()->get('user_book_id');
	$user_book_id = decrypt(base64_decode($user_book_id),SECRETKEY);
	$userBook= _db()->getEntity('userbook.userbook');
	$userBook->loadWhere(array('id',$user_book_id));
	$userBook->update(array('mark_status'=>'1'));
	echo "1";
}
public function nextPageAction(){
	$request = pzk_request();
	$page=$request->get('page');

	if(isset($page)){
		echo "1";
	}else{
		echo "0";
	}
	
}
public function showAnswerAction() {
    $request = pzk_request();
    $data_answers=$request->get('answers');
	$tam=$data_answers['question_id'];
    
    $frontendmodel = pzk_model('Frontend');
    foreach($tam as $item) {
	    $type = $frontendmodel->getTypeByQuestionId($item);
        $result = '';
        if($type == 'Q2' or $type == 'Q3' or $type == 'Q5' or $type == 'Q6'){
            $answers = $frontendmodel->getAnswerByQuestionId($item);
                foreach($answers as $val) {
                    $result .= ', '.$val['content'];
                }
                if(!empty($result)) {
                    $result = substr($result,2);
                }
                $arResult[] = array(
                    'type' => $type,
                    'questionId' => $item,
                    'value' =>  $result
                );
        }elseif($type == 'Q0' or $type == 'Q4') {
                $answersTrue = $frontendmodel->getAnswerTrue($item);
                $arResult[] = array(
                    'type' => $type,
                    'questionId' => $item,
                    'value' =>  $answersTrue
                );
            }

        }
        echo json_encode($arResult) ;
   
}
}
 ?>