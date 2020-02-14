<?php
class Armat_Awards_Model_Resource_Award_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('armat_awards/award');
    }

    
}
