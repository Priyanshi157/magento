<?php   
$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();

$attributeCode = 'addtocart_settings';
$attribute = Mage::getModel('eav/entity_attribute')->loadByCode('catalog_product', $attributeCode);
print_r($attribute);
exit;
if ($attribute->getId()) {
    $option['attribute_id'] = $attribute->getId();
    $option['value']        =  array('Red','Black', 'Yellow');
    $installer->addAttributeOption($option);
}