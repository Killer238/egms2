<?php
$xpdo_meta_map['plCategoryMap']= array (
  'package' => 'ploader',
  'version' => '1.1',
  'table' => 'pl_category_map',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'provider' => NULL,
    'category_bread' => NULL,
    'category_name' => NULL,
    'id_category' => NULL,
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
    'category_bread' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
    ),
    'category_name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
    ),
    'id_category' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
  ),
  'aggregates' => 
  array (
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
