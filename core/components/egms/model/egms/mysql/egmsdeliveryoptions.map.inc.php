<?php
$xpdo_meta_map['egmsDeliveryOptions']= array (
  'package' => 'egms',
  'version' => '1.1',
  'table' => 'egms_delivery_options',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'oname' => NULL,
    'option' => NULL,
    'val' => NULL,
    'params' => NULL,
    'published' => NULL,
  ),
  'fieldMeta' => 
  array (
    'oname' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '15',
      'phptype' => 'string',
      'null' => false,
    ),
    'option' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '250',
      'phptype' => 'string',
      'null' => false,
    ),
    'val' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '250',
      'phptype' => 'string',
      'null' => false,
    ),
    'params' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '20',
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
);
