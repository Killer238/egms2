<?php
$xpdo_meta_map['plPproductImages']= array (
  'package' => 'ploader',
  'version' => '1.1',
  'table' => 'pl_pproduct_images',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'provider' => NULL,
    'source' => NULL,
    'url' => NULL,
  ),
  'fieldMeta' => 
  array (
    'provider' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '20',
      'phptype' => 'string',
      'null' => false,
    ),
    'source' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '20',
      'phptype' => 'string',
      'null' => false,
    ),
    'url' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '200',
      'phptype' => 'string',
      'null' => false,
    ),
  ),
);
