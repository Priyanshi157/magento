<?php 
$installer = $this;
$installer->startSetup();

$installer->run("
	-- DROP TABLE IF EXISTS {$this->getTable('process')};
	CREATE TABLE {$this->getTable('process')} (
	`process_id` int(11) NOT NULL auto_increment,
	`group_id` int(11) NOT NULL,
	`name` varchar(64) NOT NULL ,
	`type_id` tinyint NOT NULL ,
	`per_request_count` varchar(64) NOT NULL ,
	`request_interval` varchar(64) NOT NULL ,
	`request_model` varchar(64) NOT NULL ,
	`file_name` varchar(64) NOT NULL ,
	`created_date` datetime  ,
	PRIMARY KEY (`process_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->run("
    ALTER TABLE {$this->getTable('process')}
    ADD CONSTRAINT  FOREIGN KEY (`group_id`)
    REFERENCES `{$this->getTable('process_group')}` (`group_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;
    ");

$installer->endSetup();