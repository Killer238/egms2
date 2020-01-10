<?php
$xpdo_meta_map['plConnectors']= array (
  'package' => 'ploader',
  'version' => '1.1',
  'table' => 'pl_connectors',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'provider' => NULL,
    'connection_type' => NULL,
    'url_sitemap' => NULL,
    'load_datetime' => NULL,
    'published' => NULL,
    'action' => 0,
    'log' => NULL,
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
    'connection_type' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
    'url_sitemap' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'index' => 'unique',
    ),
    'load_datetime' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => false,
    ),
    'published' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
    ),
    'action' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'log' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
    ),
  ),
  'indexes' => 
  array (
    'url_sitemap' => 
    array (
      'alias' => 'url_sitemap',
      'primary' => false,
      'unique' => true,
      'type' => 'BTREE',
      'columns' => 
      array (
        'url_sitemap' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
);
