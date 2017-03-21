<?php 
/**
* 
*/
class Cammino_Orderstatus_Adminhtml_Sales_OrderController extends Mage_Adminhtml_Controller_Action{
	
	public function returnstatusAction(){
		$orderId = $this->getRequest()->getParam('order_id');
		
		// Instância dos modelos e helpers 
		$order 	= Mage::getModel('sales/order')->load($orderId);
		$model 	= Mage::getModel('orderstatus/order');
		$helper = Mage::helper("orderstatus");
		
		// Definição dos status e states (últimos e penúltimos)
		$actualStatus 	= $model->getActualStatus($order);
		$actualState 	= $helper->getStateByStatus($actualStatus);

		$previousStatus = $model->getPreviousStatus($order);
		$previousState	= $helper->getStateByStatus($previousStatus);

		switch ($actualStatus) {
			case 'canceled':
				$model->deleteHistory($order, "canceled");
				$model->undocancelAction($order);
				$model->updateOrderStatus($order, $previousStatus, $previousState);
				break;

			case 'processing':
				$model->deleteHistory($order, "processing");
				$model->undoInvoiceAction($order);
				$model->updateOrderStatus($order, $previousStatus, $previousState);
				break;

			case 'preparing_for_shipment':
				$model->deleteHistory($order, "preparing_for_shipment");
				$model->updateOrderStatus($order, $previousStatus);
				break;

			case 'complete':
				$model->deleteHistory($order, "complete");
				$model->undoShipmentAction($order);
				$model->updateOrderStatus($order, $previousStatus, $previousState);
				break;

			case 'order_received':
				$model->deleteHistory($order, "order_received");
				$model->updateOrderStatus($order, $previousStatus);
				break;
		}

		$this->_redirect('*/sales_order/view', array('order_id' => $orderId));
	}
}