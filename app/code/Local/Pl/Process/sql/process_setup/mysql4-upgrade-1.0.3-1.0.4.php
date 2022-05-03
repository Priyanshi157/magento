<?php 
$installer = $this;
$installer->startSetup();
$installer->getConnection()->addColumn($installer->getTable('process_column'), 'sample_data', "varchar(255) default NULL AFTER `name`");
$installer->endSetup();
