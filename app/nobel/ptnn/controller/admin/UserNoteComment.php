<?php
class PzkAdminUserNoteCommentController extends PzkGridAdminController {
	public $title = 'Bình luận các ghi chép';
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
        ),
		array(
			'table' => '`admin` as `modifier`',
			'condition' => 'user_note_comment.modifiedId = modifier.id',
			'type' => 'left'
		),
    );
    public $selectFields = 'user_note_comment.*, user.username as username,user_note.titlenote as titlenote, user_note.contentnote as content, modifier.name as modifiedName';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm'
	);
	public $searchFields = array('userId', 'noteId', 'comment', 'date');
	public $listFieldSettings = array(
		
		
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'User Comment'
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
			'type' => 'datetime',
			'format' => 'd/m/Y H:i',
			'label' => 'Ngày tạo'
		),
		array(
			'index' => 'modifiedName',
			'type' => 'text',
			'label' => 'Người sửa'
		),
		array(
			'index' => 'modified',
			'type' => 'datetime',
			'label' => 'Ngày sửa',
			'format'	=> 'H:i d/m'
		),
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
			'type' => 'date',
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
			'type' => 'date',
			'label' => 'Ngày '
		)
	);
	
 

}