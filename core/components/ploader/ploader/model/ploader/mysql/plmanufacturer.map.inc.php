<?php
$xpdo_meta_map['plManufacturer']= array (
  'package' => 'ploader',
  'version' => '1.1',
  'table' => 'pl_manufacturer',
  'extends' => 'xPDOObject',
  'fields' => 
  array (
    'id_manufacturer' => NULL,
    'name' => NULL,
  ),
  'fieldMeta' => 
  array (
    'id_manufacturer' => 
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
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
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
        'id_manufacturer' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
);
