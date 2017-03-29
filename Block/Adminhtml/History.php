<?php
class Cammino_Orderstatus_Block_Adminhtml_History extends Mage_Adminhtml_Block_Template implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
	public function _construct(){
		parent::_construct();
		$this->setTemplate('orderstatus/content.phtml');
	}

	public function getTabLabel(){
		return 'Histórico do Status';
	}

	public function getTabTitle(){
		return 'Orderstatus tab';
	}

	public function canShowTab(){
		return true;
	}

	public function isHidden(){
		return false;
	}

	public function getHistoryData($orderId) {
		return Mage::getModel('orderstatus/history')->getCollection()
			->addFilter('order_id', $orderId)
			->setOrder('id', 'DESC');
	}
}