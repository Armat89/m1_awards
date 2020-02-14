<?php
class Armat_Awards_Block_Adminhtml_Awards extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected function _construct()
    {
        $this->_addButtonLabel = Mage::helper('armat_awards')->__('Add New Award');
 
        $this->_blockGroup = 'armat_awards';
        $this->_controller = 'adminhtml_awards';
        $this->_headerText = Mage::helper('armat_awards')->__('Awards');
    }
}
