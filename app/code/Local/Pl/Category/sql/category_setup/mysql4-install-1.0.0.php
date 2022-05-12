<?php
$installer = $this;
$installer->startSetup();
$installer->run("
-- DROP TABLE IF EXISTS {$this->getTable('category')};
CREATE TABLE {$this->getTable('category')} (
  `category_id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `parent_id` int(11) NULL,
  `description` varchar(255) NOT NULL default '',
  `link` varchar(255) NOT NULL default '',
  `status` tinyint(1) NOT NULL default '2',
  `path` varchar(255) NULL,
  `created_at` DATETIME NOT NULL default CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

$installer->endSetup();
