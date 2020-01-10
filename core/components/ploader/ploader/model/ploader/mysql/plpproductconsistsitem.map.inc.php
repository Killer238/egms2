<?php
$xpdo_meta_map['plPproductConsistsItem']= array (
  'package' => 'ploader',
  'version' => '1.1',
  'table' => 'pl_pproduct_consists_item',
  'extends' => 'xPDOObject',
  'fields' => 
  array (
    'id_consists_item' => NULL,
    'provider' => NULL,
    'name' => NULL,
    'description' => NULL,
    'image_url' => NULL,
  ),
  'fieldMeta' => 
  array (
    'id_consists_item' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'pk',
      'generated' => 'native',
    ),
    'provider' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '20',
      'phptype' => 'string',
      'null' => false,
    ),
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '200',
      'phptype' => 'string',
      'null' => false,
    ),
    'description' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
    ),
    'image_url' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '200',
      'phptype' => 'string',
      'null' => false,
    ),
  ),
  'indexes' => 
  array (
    'PRIMARY' => 
    array (
      'alias' => 'PRIMARY',
      'primary' => true,
      'unique' => true,
      'type' => 'BTREE',
      'columns' => 
      array (
        'id_consists_item' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
);
