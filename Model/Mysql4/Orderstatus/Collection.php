<?php

class Cammino_Orderstatus_Model_Mysql4_Orderstatus_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('orderstatus/orderstatus');
    }
}