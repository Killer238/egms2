<?php
$xpdo_meta_map['egmsDelivery']= array (
  'package' => 'egms',
  'version' => '1.1',
  'table' => 'egms_delivery',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'id_region' => NULL,
    'id_vendor' => NULL,
    'id_category' => NULL,
    'd_cost' => NULL,
    'd_min' => NULL,
    'd_time' => NULL,
    'd_instock' => NULL,
    's_address' => NULL,
    'delivery_options' => NULL,
    'published' => NULL,
  ),
  'fieldMeta' => 
  array (
    'id_region' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'index',
    ),
    'id_vendor' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => true,
    ),
    'id_category' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => true,
    ),
    'd_cost' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
    'd_min' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
    'd_time' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '20',
      'phptype' => 'string',
      'null' => false,
    ),
    'd_instock' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
    's_address' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '250',
      'phptype' => 'string',
      'null' => false,
    ),
    'delivery_options' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
    ),
    'published' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
  ),
  'indexes' => 
  array (
    'd' => 
    array (
      'alias' => 'd',
      'primary' => false,
      'unique' => true,
      'type' => 'BTREE',
      'columns' => 
      array (
        'id_region' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
        'id_category' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => true,
        ),
      ),
    ),
  ),
  'aggregates' => 
  array (
    'dregions' => 
    array (
      'class' => 'egmsRegions',
      'local' => 'id_region',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'vendors' => 
    array (
      'class' => 'msVendor',
      'local' => 'id_vendor',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'categorys' => 
    array (
      'class' => 'msCategory',
      'local' => 'id_category',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
