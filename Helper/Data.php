<?php 
/**
* 
*/
class Cammino_Orderstatus_Helper_Data extends Mage_Core_Helper_Abstract{

	private $_state = array(
		"canceled"					=> array("state" => "canceled", "label" => "Cancelado"),
		"pending" 					=> array("state" => "pending", "label" => "Pendente"),
		"pending_payment" 			=> array("state" => "pending_payment", "label" => "Aguardado Aprovação"),
		"processing" 				=> array("state" => "processing", "label" => "Pagamento Aprovado"),
		"preparing_for_shipment" 	=> array("state" => "processing", "label" => "Preparado para Envio"),
		"complete" 					=> array("state" => "complete", "label" => "Entregue na Transportadora"),
		"order_received" 			=> array("state" => "complete", "label" => "Pedido Entregue")
	);

	public function getStateByStatus($status){
		return array_key_exists($status, $this->_state) ? $this->_state[$status]['state'] : false;
	}

	public function getLabelByStatus($status){
		return array_key_exists($status, $this->_state) ? $this->_state[$status]['label'] : false;
	}
}