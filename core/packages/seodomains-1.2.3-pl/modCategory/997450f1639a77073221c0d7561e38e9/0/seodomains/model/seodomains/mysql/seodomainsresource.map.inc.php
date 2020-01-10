<?php
$xpdo_meta_map['SeodomainsResource']= array (
  'package' => 'seodomains',
  'version' => '1.0',
  'table' => 'seodomains_resource',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'InnoDB',
  ),
  'fields' => 
  array (
    'domain' => 0,
    'resource' => 0,
    'content' => '',
  ),
  'fieldMeta' => 
  array (
    'domain' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'resource' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'content' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
  ),
);
