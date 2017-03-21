<?php 
/**
* 
*/
class Cammino_Orderstatus_Helper_Data extends Mage_Core_Helper_Abstract{

	private $_state = array(
		canceled				=> "canceled",
		pending 				=> "pending",
		pending_payment 		=> "pending_payment",
		processing 				=> "processing",
		preparing_for_shipment 	=> "processing",
		complete 				=> "complete",
		order_received 			=> "complete"
	);

	public function getStateByStatus($status){
		return array_key_exists($status, $this->_state) ? $this->_state[$status] : false;
	}
}