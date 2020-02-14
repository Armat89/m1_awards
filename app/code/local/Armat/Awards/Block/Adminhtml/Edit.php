<?php
class Armat_Awards_Block_Adminhtml_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'armat_awards';
        $this->_mode = 'edit';
        $this->_controller = 'adminhtml';
        
        $award_id = (int)$this->getRequest()->getParam($this->_objectId);
        if(!$award_id) {
        //    Mage::throwException($this->__('Award with this id does not exists'));
        }
        $award = Mage::getModel('armat_awards/award')->load($award_id);
        Mage::register('current_award', $award);
        $this->_removeButton('reset');
    }
 
    public function getHeaderText()
    {
        $award = Mage::registry('current_award');
        if ($award->getId()) {
            return Mage::helper('armat_awards')->__("Edit award '%s'", $this->escapeHtml($award->getName()));
        } else {
            return Mage::helper('armat_awards')->__("Add new award");
        }
    }
}
