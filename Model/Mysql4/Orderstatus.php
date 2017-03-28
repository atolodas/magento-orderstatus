<?php

class Cammino_Orderstatus_Model_Mysql4_Orderstatus extends Mage_Core_Model_Mysql4_Abstract
{
    public function __construct()
    {    
        // Note that the 'id' refers to the key field in your database table.
        $this->_init('orderstatus/orderstatus', 'id');
    }
}