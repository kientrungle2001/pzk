<?php
class PzkUserFreeController extends PzkController {
    public $masterPage = 'index';
    public function indexAction() {
        $this->initPage();
        $this->append('<home.content layout="home/content_home"/>','left');
        $this->display();
    }
}
?>