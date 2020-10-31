<?php
class PzkHomeController extends PzkController {
  public $masterPage = 'index';
  public $masterPosition = 'left';
  public const HOME_PAGE = 'home/index';
  public function indexAction() {
    $this->render(self::HOME_PAGE);
  }
}