<?php
class PzkHomeController extends PzkController {
  public $masterPage = 'index';
  public $masterPosition = 'left';
  public function indexAction() {
    $this->render('home/index');
  }
}