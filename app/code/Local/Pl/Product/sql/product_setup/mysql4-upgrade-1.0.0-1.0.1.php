<?php 

$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();
$installer->addAttributeSet(Mage_Catalog_Model_Product::ENTITY,'Custom');
$installer->endSetup();
