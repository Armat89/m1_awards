<?php
class Armat_Awards_Model_Award extends Mage_Core_Model_Abstract
{
    protected $_options;

    protected function _construct()
    {
        $this->_init('armat_awards/award');
    }

    public function toOptionArray()
    {
        $collection = Mage::getModel('armat_awards/award')->getCollection();
        $allattributes = array();
        foreach ($collection as $data) {
            $allattributes[] = array(
                'value' => $data->getId(),
                'label' => $data->getImage()
            );
        }

        return $allattributes;
    }
}
