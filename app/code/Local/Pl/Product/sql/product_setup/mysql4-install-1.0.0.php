<?php
$installer = $this;
$installer->startSetup();

$installer->run("
-- DROP TABLE IF EXISTS {$this->getTable('product')};
CREATE TABLE {$this->getTable('product')} (
  `product_id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `sku` varchar(255) NOT NULL default '',
  `price` int(8) NOT NULL DEFAULT '0',
  `cost_price` int(8) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL default '2',
  `created_at` DATETIME NOT NULL default CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

$installer->endSetup();
