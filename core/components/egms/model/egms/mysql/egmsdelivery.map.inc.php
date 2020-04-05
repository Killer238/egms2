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
    'id_therm' => NULL,
    'context' => NULL,
    'delivery_name' => NULL,
    'd_payments' => NULL,
    'd_cost' => NULL,
    'd_min' => NULL,
    'd_dayscount' => NULL,
    'd_time' => NULL,
    'd_days' => NULL,
    'd_datehide' => NULL,
    'd_weekdays' => NULL,
    'priority' => NULL,
    'd_instock' => NULL,
    'content' => NULL,
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
    'id_therm' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => true,
    ),
    'context' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '15',
      'phptype' => 'string',
      'null' => false,
    ),
    'delivery_name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
    ),
    'd_payments' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '50',
      'phptype' => 'string',
      'null' => false,
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
    'd_dayscount' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
    'd_time' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
    'd_days' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '15',
      'phptype' => 'string',
      'null' => false,
    ),
    'd_datehide' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
    'd_weekdays' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '7',
      'phptype' => 'string',
      'null' => false,
    ),
    'priority' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
    'd_instock' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
    'content' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
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
        'id_vendor' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => true,
        ),
        'id_therm' => 
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
    'therm' => 
    array (
      'class' => 'egmsDeliveryTherm',
      'local' => 'id_therm',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
