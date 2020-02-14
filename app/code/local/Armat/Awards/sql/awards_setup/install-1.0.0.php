<?php
$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('armat_awards/award'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Id')
    ->addColumn('image', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable'  => false,
    ), 'File name')
    ->addColumn('url', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
    ), 'Linked to');
$installer->getConnection()->createTable($table);

$installer = Mage::getResourceModel('catalog/setup', 'catalog_setup');

$installer->addAttribute('catalog_product', 'product_awards', array(
    'label'             => 'Product awards',
    'type'              => 'text',
    'input'             => 'multiselect',
    'backend'           => 'eav/entity_attribute_backend_array',
    'frontend'          => '',
    'source'            => 'armat_awards/source_block',
    'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible'           => true,
    'required'          => false,
    'user_defined'      => true,
    'searchable'        => false,
    'filterable'        => false,
    'comparable'        => false,
    'visible_on_front'  => false,
    'visible_in_advanced_search' => false,
    'unique'            => false,
    'group'             => 'General'
));

$installer->endSetup();

//$armatDir = Mage::getBaseDir('media').DS.'armat';
//$awardDir = $armatDir.DS.'awards';
//$ioFile = new Varien_Io_File();
//$ioFile->checkAndCreateFolder($armatDir);
//$ioFile->checkAndCreateFolder($awardDir);


