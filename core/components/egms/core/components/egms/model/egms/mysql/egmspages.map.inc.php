<?php
$xpdo_meta_map['egmsPages']= array (
  'package' => 'egms',
  'version' => '1.1',
  'table' => 'egms_pages',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'context' => NULL,
    'url' => NULL,
    'redirect_url' => NULL,
    'id_resource' => NULL,
    'published' => NULL,
  ),
  'fieldMeta' => 
  array (
    'context' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '20',
      'phptype' => 'string',
      'null' => false,
    ),
    'url' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
    ),
    'redirect_url' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
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
    'published' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
  ),
);
