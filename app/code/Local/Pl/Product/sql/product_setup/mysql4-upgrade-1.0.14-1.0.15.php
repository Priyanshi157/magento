<?php

$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();

$arg_attribute = 'color_option';
$key_data = array('red','black','orange');
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$attr_model = Mage::getModel('catalog/resource_eav_attribute');
$attr = $attr_model->loadByCode('catalog_product', $arg_attribute);
foreach($key_data as $key_value)
{   
    $option = array();
    $arg_value = trim($key_value);
    $attr_id = $attr->getAttributeId();
    $option['attribute_id'] = $attr_id;
    $option['value']['any_option_name'][0] = $arg_value;
    $setup->addAttributeOption($option);
}