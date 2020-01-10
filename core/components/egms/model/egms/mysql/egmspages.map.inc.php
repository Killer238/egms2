<?php
$xpdo_meta_map['egmsPages']= array (
  'package' => 'egms',
  'version' => '1.1',
  'table' => 'egms_pages',
  'extends' => 'xPDOObject',
  'fields' => 
  array (
    'id_page' => NULL,
    'type' => NULL,
    'id_resource' => NULL,
    'meta_title' => NULL,
    'meta_description' => NULL,
    'meta_keywords' => NULL,
    'h1' => NULL,
  ),
  'fieldMeta' => 
  array (
    'id_page' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
    'type' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
    'id_resource' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
    'meta_title' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
    ),
    'meta_description' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
    ),
    'meta_keywords' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
    ),
    'h1' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
    ),
  ),
);
