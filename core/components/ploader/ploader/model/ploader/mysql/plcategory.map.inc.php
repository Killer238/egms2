<?php
$xpdo_meta_map['plCategory']= array (
  'package' => 'ploader',
  'version' => '1.1',
  'table' => 'pl_category',
  'extends' => 'xPDOObject',
  'fields' => 
  array (
    'id_category' => NULL,
    'name' => NULL,
  ),
  'fieldMeta' => 
  array (
    'id_category' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'pk',
      'generated' => 'native',
    ),
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
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
        'id_category' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
);
