<?php
$xpdo_meta_map['egmsDeliveryTherm']= array (
  'package' => 'egms',
  'version' => '1.1',
  'table' => 'egms_delivery_therm',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'key_name' => NULL,
    'therm' => NULL,
    'public_name' => NULL,
  ),
  'fieldMeta' => 
  array (
    'key_name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '15',
      'phptype' => 'string',
      'null' => false,
    ),
    'therm' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '50',
      'phptype' => 'string',
      'null' => false,
    ),
    'public_name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '250',
      'phptype' => 'string',
      'null' => false,
    ),
  ),
);
