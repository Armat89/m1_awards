<?php
class Armat_Awards_Block_Adminhtml_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
    {
        $award = Mage::registry('current_award');
        $form = new Varien_Data_Form(array(
            'id' => 'award_form',
            'enctype' => 'multipart/form-data'
        ));

        $fieldset = $form->addFieldset('edit_award', array(
            'legend' => Mage::helper('armat_awards')->__('Award Details')
        ));

        if ($award->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name'      => 'id',
                'required'  => true
            ));
        }
 
        $fieldset->addField('image', 'image', array(
            'name'      => 'image',
            'title'     => Mage::helper('armat_awards')->__('Image'),
            'label'     => Mage::helper('armat_awards')->__('Image'),
            'note' => '(*.jpg, *.png, *.gif)',
            'required'  => true,
        ));
        
        $fieldset->addField('url', 'text', array(
            'name'      => 'url',
            'title'     => Mage::helper('armat_awards')->__('URL'),
            'label'     => Mage::helper('armat_awards')->__('URL'),
            'maxlength' => '500',
            'required'  => false,
        ));
 
 		$form->setMethod('post');
        $form->setUseContainer(true);
        $form->setId('edit_form');
        $form->setAction($this->getUrl('*/*/save'));
        $form->setValues($award->getData());
 
        $this->setForm($form);
    }
}
