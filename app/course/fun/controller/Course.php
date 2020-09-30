<?php
class PzkCourseController extends PzkController {
  public $masterPage = 'sidebar-left';
  public $masterPosition = 'right';
  public function detailAction() {
    $this->render('course/detail');
  }
}