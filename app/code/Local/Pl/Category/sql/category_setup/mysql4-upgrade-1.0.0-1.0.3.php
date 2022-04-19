<?php

// $installer = $this;
// $installer->startSetup();
// $installer->getConnection()->addColumn(
//     $this->getTable('category'),//table name
//     'path',      //column name
//     'varchar(255) NOT NULL'  //datatype definition
//     );
// // ->addColumn(
// //       $this->getTable('category'),
// //       'parent_id'
// //       'int(8) NULL'
// //     );

// $installer->endSetup();


$installer = $this;
$installer->startSetup();
$installer->run("
    ALTER TABLE {$this->getTable('category')}
    ADD CONSTRAINT `Category_Parent` FOREIGN KEY `Category_Fk` (`parent_id`)
    REFERENCES `{$this->getTable('category')}` (`category_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;
    ");

$installer->endSetup();