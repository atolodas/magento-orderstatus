<?php
class Cammino_Orderstatus_Block_Adminhtml_Config extends Mage_Adminhtml_Block_Template implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
	public function __construct(){
		parent::__construct();
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
}