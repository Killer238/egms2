<?php
$xpdo_meta_map['plPproductFeature']= array (
  'package' => 'ploader',
  'version' => '1.1',
  'table' => 'pl_pproduct_feature',
  'extends' => 'xPDOObject',
  'fields' => 
  array (
    'id_load_feature' => NULL,
    'id_load' => NULL,
    'id_load_feature_map' => NULL,
    'active' => 1,
    'load_datetime' => NULL,
  ),
  'fieldMeta' => 
  array (
    'id_load_feature' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'pk',
      'generated' => 'native',
    ),
    'id_load' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
    'id_load_feature_map' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
    'active' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 1,
    ),
    'load_datetime' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
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
        'id_load_feature' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
);
