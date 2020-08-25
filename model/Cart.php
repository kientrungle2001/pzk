<?php
class PzkCartModel {
	/**
	Thêm vào giỏ
	*/
	public function addItem($item) {
		$items = $this->getItems();
		$items[] = $item;
		$this->setItems($items);
	}
	/**
	Xóa khỏi giỏ
	*/
	public function removeItem($index) {
		$items = $this->getItems();
		array_slice($items, $index, 1);
		$this->setItems($items);
	}
	
	/**
	Lấy ra các sản phẩm
	*/
	public function getItems() {
		return pzk_or(pzk_session()->getCartItems(), array());
	}
	private function setItems($items) {
		pzk_session()->setCartItems($items);
		$this->calculateTotal();
	}
	/**
	Đếm số sản phẩm
	*/
	public function countItems() {
		return count($this->getItems());
	}
	
	public function emptyItems() {
		$this->setItems(array());
	}
	
	/**
	Tổng hợp
	*/
	public function getSummary() {
		return pzk_session()->getCartSummary();
	}
	
	/**
	Lưu tổng hợp
	*/
	private function setSummary($summary) {
		return pzk_session()->setCartSummary($summary);
	}
	
	/**
	Tính tổng
	*/
	private function calculateTotal() {
		$total = 0;
		$items = $this->getItems();
		foreach($items as $item) {
			$total += $item['price'] * $item['quantity'];
			if(isset($item['options'])) {
				$options = $item['options'];
				foreach($options as $option) {
					$total += $option['price'] * $item['quantity'];
				}
			}
		}
		$summary = array(
			'total'		=> $total;
		);
		$this->setSummary($summary);
	}
	
	/////////////// OPTIONS //////////////////
	public function addOption($index, $option) {
		$items = $this->getItems();
		if(!isset($items[$index]['options'])) {
			$items[$index]['options'] = array();
		}
		$items[$index]['options'][] = $option;
		$this->setItems($items);
	}
	
	public function removeOption($index, $optionIndex) {
		$items = $this->getItems();
		if(!isset($items[$index]['options'])) {
			$items[$index]['options'] = array();
		}
		array_slice($items[$index]['options'], $optionIndex, 1);
		$this->setItems($items);
	}
}