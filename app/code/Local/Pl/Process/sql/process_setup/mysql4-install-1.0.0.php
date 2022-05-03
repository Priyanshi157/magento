<?php 
$installer = $this;
$installer->startSetup();

$installer->run("
	-- DROP TABLE IF EXISTS {$this->getTable('process_group')};
	CREATE TABLE {$this->getTable('process_group')} (
	`group_id` int(11) NOT NULL auto_increment,
	`name` varchar(64) NOT NULL ,
	PRIMARY KEY (`group_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup();