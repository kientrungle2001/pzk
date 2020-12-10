<?php

class PzkApiController extends PzkController {
  public $table = 'news';
  public function jsonAction($id = false) {
    $request = pzk_request();
    if($request->isGet()) {
      if($id) {
        return $this->detailAction($id); 
      } else {
        return $this->searchAction();
      }
    } elseif($request->isPost()) {
      return $this->createAction();
    } elseif($request->isPut()) {
      if($id) {
        return $this->updateAction($id);
      } else {
        return $this->updateMultipleAction();
      }
    } elseif($request->isDelete()) {
      if($id) {
        return $this->deleteAction($id);
      } else {
        return $this->deleteMultipleAction();
      }
    }
  }

  public function detailAction($id) {
    $row = _db()->selectAll()->from($this->getTable())->whereId($id)->result_one();
    return $this->renderJson($row);
  }

  public function searchAction() {
    $request = pzk_request();
    $fields = $request->getFields();
    $conds = $request->getConds();
    $pageSize = $request->getPageSize();
    $pageNum = $request->getPageNum();
    $orderBy = $request->getOrderBy();
    $rows = _db()
        ->select($fields)->from($this->getTable())
        ->where($conds)->orderBy($orderBy)
        ->limit($pageSize, $pageNum)->result();
    $rowCount = _db()
    ->select('count(*) as c')->from($this->getTable())
    ->where($conds)->result_one();
    return $this->renderJson([
      'rows' => $rows,
      'total' => $rowCount['c']
    ]);
  }

  public function createAction() {
    $request = pzk_request();
    $entity = _db()->getTableEntity($this->getTable());
    $entity->setData($request->get('data'));
    $entity->save();
    $row = $entity->getData();
    return $this->renderJson($row);
  }

  public function deleteAction($id) {
    _db()->delete()->from($this->getTable())->whereId($id)->result();
    return $this->renderJson($id);
  }

  public function deleteMultipleAction() {
    $request = pzk_request();
    $conds = $request->getConds();
    _db()->delete()->from($this->getTable())->where($conds)->result();
    return $this->renderJson(true);
  }

  public function updateAction($id) {
    $request = pzk_request();
    $data = $request->get('data');
    _db()->update($this->getTable())->set($data)->whereId($id)->result();
    return $this->renderJson($data);
  }

  public function updateMultipleAction() {
    $request = pzk_request();
    $conds = $request->getConds();
    $data = $request->get('data');
    _db()->update($this->getTable())->set($data)->where($conds)->result();
    return $this->renderJson(true);
  }

  public function renderJson($data) {
    echo json_encode($data);
    return $data;
  }
}