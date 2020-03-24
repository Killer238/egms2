<?php
$xpdo_meta_map['egmsStock']= array (
  'package' => 'egms',
  'version' => '1.1',
  'table' => 'egms_stock',
  'extends' => 'xPDOObject',
  'fields' => 
  array (
    'rid' => NULL,
    'options' => NULL,
    'quantity' => NULL,
    'id_delivery' => NULL,
  ),
  'fieldMeta' => 
  array (
    'rid' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
    'options' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '50',
      'phptype' => 'string',
      'null' => false,
    ),
    'quantity' => 
    array (
      'dbtype' => 'int',
      'precision' => '50',
      'phptype' => 'integer',
      'null' => false,
    ),
    'id_delivery' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
  ),
);
