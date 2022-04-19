<?php
$installer = $this;
$installer->startSetup();
$installer->run("
-- DROP TABLE IF EXISTS {$this->getTable('salesman')};
CREATE TABLE {$this->getTable('salesman')} (
  `salesman_id` int(11) unsigned NOT NULL auto_increment,
  `firstName` varchar(255) NOT NULL default '',
  `lastName` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `mobile` bigint(11) NOT NULL default '0',
  PRIMARY KEY (`salesman_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

$installer->endSetup();


