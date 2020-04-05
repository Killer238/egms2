<?php
$xpdo_meta_map['plPproductConsists']= array (
  'package' => 'ploader',
  'version' => '1.1',
  'table' => 'pl_pproduct_consists',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'id_load' => NULL,
    'resource_id' => NULL,
    'position' => 0,
    'id_consists_item' => NULL,
    'published' => NULL,
  ),
  'fieldMeta' => 
  array (
    'id_load' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
    'resource_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
    'position' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'id_consists_item' => 
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
  'aggregates' => 
  array (
    'res' => 
    array (
      'class' => 'modResource',
      'local' => 'resource_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'cit' => 
    array (
      'class' => 'plPproductConsistsItem',
      'local' => 'id_consists_item',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
