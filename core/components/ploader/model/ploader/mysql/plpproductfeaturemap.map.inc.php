<?php
$xpdo_meta_map['plPproductFeatureMap']= array (
  'package' => 'ploader',
  'version' => '1.1',
  'table' => 'pl_pproduct_feature_map',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'provider' => NULL,
    'feature_load_name' => NULL,
    'feature_load_value' => NULL,
    'key' => NULL,
    'feature_value' => NULL,
    'published' => 1,
  ),
  'fieldMeta' => 
  array (
    'provider' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '20',
      'phptype' => 'string',
      'null' => false,
    ),
    'feature_load_name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '150',
      'phptype' => 'string',
      'null' => false,
    ),
    'feature_load_value' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '150',
      'phptype' => 'string',
      'null' => false,
    ),
    'key' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '250',
      'phptype' => 'string',
      'null' => false,
    ),
    'feature_value' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
    ),
    'published' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 1,
    ),
  ),
  'indexes' => 
  array (
    'id_load_feature_map' => 
    array (
      'alias' => 'id_load_feature_map',
      'primary' => false,
      'unique' => true,
      'type' => 'BTREE',
      'columns' => 
      array (
        'id' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
  'aggregates' => 
  array (
    'moptions' => 
    array (
      'class' => 'msOption',
      'local' => 'key',
      'foreign' => 'key',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
