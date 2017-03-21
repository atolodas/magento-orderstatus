<?php 

class Cammino_Orderstatus_Block_Adminhtml_Sales_Order_View_History extends Mage_Adminhtml_Block_Sales_Order_View_History
{
	public function _toHtml(){
		$button = "	<button	type='button' 
							class='scalable'
							onclick='deleteConfirm(\"Você realmente quer voltar o status do pedido?\",\"".$this->getOrderstatusUrl()."\");' 
							style=''><span><span><span>Voltar Pedido ao Status Anterior</span></span></span>
					</button>";

		return parent::_toHtml() . $button;
	}

	public function getOrderstatusUrl(){
		$order = $this->getOrder();
		return $this->getUrl('*/*/returnstatus/order_id/'.$order->getId());
	}
}