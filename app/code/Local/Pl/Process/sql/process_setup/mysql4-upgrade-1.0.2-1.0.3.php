<?php 
$installer = $this;
$installer->startSetup();

$installer->run("
	-- DROP TABLE IF EXISTS {$this->getTable('process_entry')};
	CREATE TABLE {$this->getTable('process_entry')} (
	`entry_id` int(11) NOT NULL auto_increment,
	`process_id` int(11) NOT NULL,
	`identifier` varchar(64) NOT NULL ,
	`data` text NOT NULL ,
	`start_time` datetime NULL,
	`end_time` datetime NULL,
	`created_date` datetime  ,
	PRIMARY KEY (`entry_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->run("
    ALTER TABLE {$this->getTable('process_entry')}
    ADD CONSTRAINT  FOREIGN KEY (`process_id`)
    REFERENCES `{$this->getTable('process')}` (`process_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;
    ");

$installer->endSetup();