<?php

define('MODX_API_MODE', true);
include dirname(dirname(dirname(dirname(__DIR__)))).'/index.php';

$option = array(
    'key' => $key,
    'caption' => $name,
    'type' => 'textfield'
);
/*
$no = $modx->getObject('msOption', array('key' => 'kit'));
$needl = array('combo-multiple', 'combobox');
if(in_array($no->get('type'), $needl)){
    $properties = $no->get('properties');
    $properties['values'][]='yjdsdfsdffdg';
    $properties['values'] = array_unique($properties['values']);
    $no->set('properties', $properties);
    $no->save();
}
*/

for($i=0;$i<1;$i++){
    print $i;
}