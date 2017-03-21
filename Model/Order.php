<?php
class Cammino_Orderstatus_Model_Order extends Mage_Core_Model_Abstract{

	public function getActualStatus($order){
        return $order->getStatus();
    }

    public function getPreviousStatus($order){
        $actualStatus = $this->getActualStatus($order);

        $history = Mage::getModel('sales/order_status_history')
            ->getCollection()
            ->addFieldToFilter('parent_id', $order->getId())
            ->addAttributeToFilter('status', array('neq' => $actualStatus))
            ->setOrder('entity_id','DESC')
            ->getFirstItem();
        
        return $history->getStatus();
    }

    public function undocancelAction($order){
        try {
            foreach($order->getItemsCollection() as $item) {
                if ($item->getQtyCanceled() > 0) $item->setQtyCanceled(0)->save();
            }
        
            $order->setBaseDiscountCanceled(0)
                ->setBaseShippingCanceled(0)
                ->setBaseSubtotalCanceled(0)
                ->setBaseTaxCanceled(0)
                ->setBaseTotalCanceled(0)
                ->setDiscountCanceled(0)
                ->setShippingCanceled(0)
                ->setSubtotalCanceled(0)
                ->setTaxCanceled(0)
                ->setTotalCanceled(0)
                ->save();

            Mage::getSingleton('core/session')->addSuccess('O pedido foi descancelado');
        }
        catch (Mage_Core_Exception $e) {
            Mage::getSingleton('core/session')->addError('O pedido não foi descancelado: ' . $e->getMessage());
        }
        catch (Exception $e) {
            Mage::getSingleton('core/session')->addError('O pedido não foi descancelado: ' . $e->getMessage());
        }
    }

    public function undoInvoiceAction($order){
        try{

            foreach($order->getItemsCollection() as $item) {
                if ($item->getQtyInvoiced() > 0) $item->setQtyInvoiced(0)->save();
            }

            $invoices = $order->getInvoiceCollection();
            foreach ($invoices as $invoice){
                $invoice->delete();
            }

            $order->setBaseDiscountInvoiced(0)
                ->setBaseShippingInvoiced(0)
                ->setBaseSubtotalInvoiced(0)
                ->setBaseTaxInvoiced(0)
                ->setBaseTotalInvoiced(0)
                ->setDiscountInvoiced(0)
                ->setShippingInvoiced(0)
                ->setSubtotalInvoiced(0)
                ->setTaxInvoiced(0)
                ->setTotalInvoiced(0)
                ->save();

            Mage::getSingleton('core/session')->addSuccess('O pedido foi desfaturado');
        }catch (Mage_Core_Exception $e) {
            Mage::getSingleton('core/session')->addError('O pedido não foi desfaturado: ' . $e->getMessage());
        }
        catch (Exception $e) {
            Mage::getSingleton('core/session')->addError('O pedido não foi desfaturado: ' . $e->getMessage());
        }        
    }

    public function undoShipmentAction($order){
        try{
            foreach($order->getItemsCollection() as $item) {
                if ($item->getQtyShipped() > 0) $item->setQtyShipped(0)->save();
            }

            $shipments = $order->getShipmentsCollection();
            foreach ($shipments as $shipment){
                $shipment->delete();
            }
            
            Mage::getSingleton('core/session')->addSuccess('O pedido foi desentregado');
        }catch (Mage_Core_Exception $e) {
            Mage::getSingleton('core/session')->addError('O pedido não foi desentregado: ' . $e->getMessage());
        }
        catch (Exception $e) {
            Mage::getSingleton('core/session')->addError('O pedido não foi desentregado: ' . $e->getMessage());
        }
    }

    public function updateOrderStatus($order, $status, $state = null){
        if($state != null){ $order->setState($state); }
        $order->setStatus($status)->save();
    }

    public function deleteHistory($order, $status){
        try{
            $history = Mage::getModel('sales/order_status_history')
                ->getCollection()
                ->addAttributeToFilter('parent_id', array('eq' => $order->getId()))
                ->addAttributeToFilter('status', array('eq' => $status))
                ->setOrder('entity_id','DESC')
                ->getFirstItem()
                ->delete();

        }catch (Mage_Core_Exception $e) {
            Mage::getSingleton('core/session')->addError("O histórico do status pedido não pode ser apagado: " . $e->getMessage());
        }
        catch (Exception $e) {
            Mage::getSingleton('core/session')->addError("O histórico do status pedido não pode ser apagado: " . $e->getMessage());
        }
    }
}
