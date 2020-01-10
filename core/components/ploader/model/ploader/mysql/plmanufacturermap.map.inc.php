<?php
$xpdo_meta_map['plManufacturerMap']= array (
  'package' => 'ploader',
  'version' => '1.1',
  'table' => 'pl_manufacturer_map',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'provider' => NULL,
    'name_manufacturer' => NULL,
    'id_manufacturer' => NULL,
  ),
  'fieldMeta' => 
  array (
    'provider' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
    ),
    'name_manufacturer' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
    ),
    'id_manufacturer' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
  ),
  'aggregates' => 
  array (
    'vendors' => 
    array (
      'class' => 'msVendor',
      'local' => 'id_manufacturer',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
