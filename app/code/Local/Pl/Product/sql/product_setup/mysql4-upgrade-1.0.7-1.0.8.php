<?php   
$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();

$attributeCode = 'color_option';
$attribute = Mage::getModel('eav/entity_attribute')->loadByCode('catalog_product', $attributeCode);

if ($attribute->getId() && $attribute->getFrontendInput()=='select') {
    $option['attribute_id'] = $attribute->getId();
    $option['value']        =  array('Red','Black', 'Yellow');
    $installer->addAttributeOption($option);
}