<?php
class PzkAdminLessonFavoriteController extends PzkGridAdminController {
    public $addFields = 'userId, lessonId, categoriesId,date';
    public $editFields = 'userId, lessonId, categoriesId,date';
    public $table='lesson_favorite';
    public $joins = array(
        array(
            'table' => 'user',
            'condition' => 'user.id = lesson_favorite.userId',
            'type' =>''
        ),
        array(
            'table' => 'lessons',
            'condition' => 'lessons.id = lesson_favorite.lessonId',
            'type' =>''
        ),
        array(
            'table' => 'categories',
            'condition' => 'categories.id = lesson_favorite.categoriesId',
            'type' =>''
        )
    );
    public $selectFields = 'lesson_favorite.*, user.username,lessons.lesson_name, categories.name';
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm',
        'userId asc' => 'userId tăng',
        'userId desc' => 'userId giảm',
        'categoriesId asc' => 'categoriesId tăng',
        'categoriesId desc' => 'categoriesId giảm'
    );
    public $searchFields = array('id, userId, categoriesId, lessonId, date');
    public $listFieldSettings = array(
        array(
            'index' => 'userId',
            'type' => 'text',
            'label' => 'Mã người dùng'
        ),
         array(
            'index' => 'username',
            'type' => 'text',
            'label' => 'Tên người dùng'
        ),

        array(
            'index' => 'lessonId',
            'type' => 'text',
            'label' => 'Mã bài học '
        ),
        array(
            'index' => 'lesson_name',
            'type' => 'text',
            'label' => 'Tên bài học'
        ),
        array(
            'index' => 'categoriesId',
            'type' => 'text',
            'label' => 'Danh mục '
        ),
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên mục'
        ),
        array(
            'index' => 'date',
            'type' => 'text',
            'label' => 'Ngày'
        )

    );
	public $logable = true;
	public $logFields = 'userId, lessonId, categoriesId, name, date';
    public $addLabel = 'Thêm mới';
    public $addFieldSettings = array(
        array(
            'index' => 'userId',
            'type' => 'text',
            'label' => 'Mã người dùng'
        ),
        array(
            'index' => 'lessonId',
            'type' => 'text',
            'label' => 'Mã bài học '
        ),
        array(
            'index' => 'categoriesId',
            'type' => 'text',
            'label' => 'Mã danh mục '
        ),
        array(
            'index' => 'date',
            'type' => 'text',
            'label' => 'Ngày'
        )
    );
    public $editFieldSettings = array(
       array(
            'index' => 'userId',
            'type' => 'text',
            'label' => 'Mã người dùng'
        ),
        array(
            'index' => 'lessonId',
            'type' => 'text',
            'label' => 'Mã bài học '
        ),
        array(
            'index' => 'categoriesId',
            'type' => 'text',
            'label' => 'Mã danh mục '
        ),
        array(
            'index' => 'date',
            'type' => 'text',
            'label' => 'Ngày'
        )
    );
    public $addValidator = array(
        'rules' => array(
            'userId' => array(
                'required' => true
            ),
            'lessonId' => array(
                'required' => true
               
            ),
             'categoriesId' => array(
                'required' => true
               
            )

        ),
        'messages' => array(
            'userId' => array(
                'required' => 'Mã người dùng không được để trống'
                
            ),
            'lessonId' => array(
                'required' => 'Mã bài học không được để trống'
                
            ),
            'categoriesId' => array(
                'required' => 'Mã danh mục không được để trống'
                
            )
        )
    );
    public $editValidator = array(
        'rules' => array(
            'userId' => array(
                'required' => true
            ),
            'lessonId' => array(
                'required' => true
               
            ),
             'categoriesId' => array(
                'required' => true
               
            )

        ),
        'messages' => array(
            'userId' => array(
                'required' => 'Mã người dùng không được để trống'
                
            ),
            'lessonId' => array(
                'required' => 'Mã bài học không được để trống'
                
            ),
            'categoriesId' => array(
                'required' => 'Mã danh mục không được để trống'
                
            )
        )
    );


}