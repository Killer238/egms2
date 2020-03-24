<?php
$xpdo_meta_map['egmsProducts']= array (
  'package' => 'egms',
  'version' => '1.1',
  'table' => 'egms_products',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'context' => NULL,
    'id_resource' => NULL,
    'sdesc' => NULL,
    'desc' => NULL,
  ),
  'fieldMeta' => 
  array (
    'context' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '15',
      'phptype' => 'string',
      'null' => false,
    ),
    'id_resource' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
    'sdesc' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
    ),
    'desc' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
    ),
  ),
);
