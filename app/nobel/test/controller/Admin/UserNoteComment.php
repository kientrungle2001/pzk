<?php
class PzkAdminUserNoteCommentController extends PzkGridAdminController {
	public $addFields = 'userId, noteId, comment, date';
	public $editFields ='userId, noteId, comment, date';
	public $table='user_note_comment';
	public $joins = array(
        array(
            'table' => 'user',
            'condition' => 'user.id = user_note_comment.userId',
            'type' =>''
        ),
        array(
            'table' => 'user_note',
            'condition' => 'user_note.id = user_note_comment.noteId',
            'type' =>''
        )
    );
    public $selectFields = 'user_note_comment.*, user.username as username,user_note.titlenote as titlenote, user_note.contentnote as content';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm'
	);
	public $searchFields = array('userId', 'noteId', 'comment', 'date');
	public $listFieldSettings = array(
		
		array(
			'index' => 'userId',
			'type' => 'text',
			'label' => 'userId '
		),
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'User Comment'
		),
		array(
			'index' => 'noteId',
			'type' => 'text',
			'label' => 'NoteId '
		),
		array(
			'index' => 'titlenote',
			'type' => 'text',
			'label' => 'Tiêu đề Note'
		),
		array(
			'index' => 'content',
			'type' => 'text',
			'label' => 'Nội dung Note'
		),
		array(
			'index' => 'comment',
			'type' => 'text',
			'label' => 'Comment '
		),
		array(
			'index' => 'date',
			'type' => 'text',
			'label' => 'Ngày '
		)
	);
	public $addLabel = 'Thêm mới';
	public $addFieldSettings = array(
		array(
			'index' => 'userId',
			'type' => 'text',
			'label' => 'userId '
		),
		
		array(
			'index' => 'noteId',
			'type' => 'text',
			'label' => 'NoteId '
		),
	
		array(
			'index' => 'comment',
			'type' => 'text',
			'label' => 'Comment '
		),
		array(
			'index' => 'date',
			'type' => 'text',
			'label' => 'Ngày '
		)
	);
	public $editFieldSettings = array(
		array(
			'index' => 'userId',
			'type' => 'text',
			'label' => 'userId '
		),
		
		array(
			'index' => 'noteId',
			'type' => 'text',
			'label' => 'NoteId '
		),
	
		array(
			'index' => 'comment',
			'type' => 'text',
			'label' => 'Comment '
		),
		array(
			'index' => 'date',
			'type' => 'text',
			'label' => 'Ngày '
		)
	);
	public $addValidator = array(
		'rules' => array(
			'userId' => array(
				'required' => true
			),
			'noteId' => array(
				'required' => true
				
			),
			'comment' => array(
				'required' => true
				
			)

		),
		'messages' => array(
			'userId' => array(
				'required' => 'Mã user không được để trống'
				
			),
			'noteId' => array(
				'required' => 'Mã ghi chú không được để trống'
				
			),
			'comment' => array(
				'required' => 'Nội dung comment không được để trống'
				
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'userId' => array(
				'required' => true
			),
			'noteId' => array(
				'required' => true
				
			),
			'comment' => array(
				'required' => true
				
			)

		),
		'messages' => array(
			'userId' => array(
				'required' => 'Mã user không được để trống'
				
			),
			'noteId' => array(
				'required' => 'Mã ghi chú không được để trống'
				
			),
			'comment' => array(
				'required' => 'Nội dung comment không được để trống'
				
			)
		)
	);
 

}