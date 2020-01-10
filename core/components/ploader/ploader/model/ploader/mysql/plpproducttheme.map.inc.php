<?php
$xpdo_meta_map['plPproductTheme']= array (
  'package' => 'ploader',
  'version' => '1.1',
  'table' => 'pl_pproduct_theme',
  'extends' => 'xPDOObject',
  'fields' => 
  array (
    'id_theme' => NULL,
    'theme_name' => NULL,
    'params' => NULL,
  ),
  'fieldMeta' => 
  array (
    'id_theme' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'pk',
      'generated' => 'native',
    ),
    'theme_name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
    ),
    'params' => 
    array (
      'dbtype' => 'text',
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
        'id_theme' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
);
