<?php
$xpdo_meta_map['egmsLog']= array (
  'package' => 'egms',
  'version' => '1.1',
  'table' => 'egms_log',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'type' => '0',
    'date_log' => NULL,
    'host' => NULL,
    'log' => NULL,
  ),
  'fieldMeta' => 
  array (
    'type' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '30',
      'phptype' => 'string',
      'null' => false,
      'default' => '0',
    ),
    'date_log' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => false,
    ),
    'host' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '50',
      'phptype' => 'string',
      'null' => false,
    ),
    'log' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
    ),
  ),
);
