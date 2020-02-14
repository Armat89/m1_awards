<?php
class Armat_Awards_Block_Adminhtml_Awards_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
 
    protected function _construct()
    {
        $this->setId('awardsGrid');
        $this->_controller = 'adminhtml_awards';
        $this->setUseAjax(true);
        
        $this->setDefaultSort('id');
        $this->setDefaultDir('desc');
    }
 
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('armat_awards/award')->getCollection();
        $this->setCollection($collection);
 
        return parent::_prepareCollection();
    }
 
    protected function _prepareColumns()
    { 
        $this->addColumn('id', array(
            'header'        => Mage::helper('armat_awards')->__('ID'),
            'align'         => 'right',
            'width'         => '20px',
            'filter_index'  => 'id',
            'index'         => 'id'
        ));
 
        $this->addColumn('image', array(
            'header'        => Mage::helper('armat_awards')->__('Image'),
            'align'         => 'left',
            'filter_index'  => 'image',
            'index'         => 'image',
            'type'          => 'text',
            'truncate'      => 50,
            'escape'        => true,
        ));
        
        $this->addColumn('action', array(
            'header'    => Mage::helper('armat_awards')->__('Action'),
            'width'     => '50px',
            'type'      => 'action',
            'getter'     => 'getId',
            'actions'   => array(
                array(
                    'caption' => Mage::helper('armat_awards')->__('Edit'),
                    'url'     => array(
                        'base'=>'*/*/edit',
                    ),
                    'field'   => 'id'
                )
            ),
            'filter'    => false,
            'sortable'  => false,
            'index'     => 'id',
        ));
 
        return parent::_prepareColumns();
    }
 
    public function getRowUrl($awards)
    {
        return $this->getUrl('*/*/edit', array(
            'id' => $awards->getId(),
        ));
    }
    
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }
}
