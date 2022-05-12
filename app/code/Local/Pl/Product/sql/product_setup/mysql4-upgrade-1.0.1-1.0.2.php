<?php 
$installer = new Mage_Catalog_Model_Resource_Setup('core_setup');
$installer->startSetup();

$installer->addAttribute('catalog_product', 'name', array(
    'group'             => 'product',
    'type'              => 'varchar',
    'backend'           => '',
    'frontend'          => '',
    'label'             => 'Product Name',
    'note'              => 'Products with recurring profile participate in catalog as nominal items.',
    'input'             => 'text',
    'class'             => '',
    'source'            => 'eav/entity_attribute_source_boolean',
    'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible'           => true,
    'required'          => false,
    'user_defined'      => false,
    'default'           => '',
    'searchable'        => false,
    'filterable'        => false,
    'comparable'        => false,
    'visible_on_front'  => false,
    'unique'            => false,
    'apply_to'          => 'simple,virtual',
    'is_configurable'   => false
));
