<?php 

$installer = new Mage_Catalog_Model_Resource_Setup('core_setup');
$installer->startSetup();

$installer->addAttribute('catalog_product', 'status_option', array(
    'group'             => 'product',
    'type'              => 'varchar',
    'backend'           => '',
    'frontend'          => '',
    'label'             => 'Status',
    'note'              => 'Products with recurring profile participate in catalog as nominal items.',
    'input'             => 'select',
    'class'             => '',
    'source'            => 'eav/entity_attribute_source_boolean',
    'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible'           => true,
    'required'          => false,
    'user_defined'      => true,
    'default'           => '',
    'searchable'        => false,
    'filterable'        => false,
    'comparable'        => false,
    'visible_on_front'  => false,
    'unique'            => false,
    'apply_to'          => 'simple,virtual',
    'is_configurable'   => false,
    //'options'           => array(),
    //'note'              => ''
));
