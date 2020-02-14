<?php
class Armat_Awards_Model_Source_Block extends Mage_Core_Model_Abstract
{
    static public function getAllOptions()
    {
        $options = Mage::getModel('armat_awards/award')->toOptionArray();
        array_unshift($options, array(
            'label' => Mage::helper('catalog')->__('-- Please Select --'),
            'value' => '',
        ));
        return $options;
    }
}