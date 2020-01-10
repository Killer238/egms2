<?php
$xpdo_meta_map['egmsSites']= array (
  'package' => 'egms',
  'version' => '1.1',
  'table' => 'egms_sites',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'id_region' => NULL,
    'host' => NULL,
    'code_yandex' => NULL,
    'code_google' => NULL,
    'vendors' => NULL,
    'deleted' => NULL,
    'published' => NULL,
  ),
  'fieldMeta' => 
  array (
    'id_region' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'index',
    ),
    'host' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '50',
      'phptype' => 'string',
      'null' => false,
    ),
    'code_yandex' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '50',
      'phptype' => 'string',
      'null' => false,
    ),
    'code_google' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '50',
      'phptype' => 'string',
      'null' => false,
    ),
    'vendors' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
    ),
    'deleted' => 
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
  'indexes' => 
  array (
    'region' => 
    array (
      'alias' => 'region',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'id_region' => 
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
    'regions' => 
    array (
      'class' => 'egmsRegions',
      'local' => 'id_region',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
