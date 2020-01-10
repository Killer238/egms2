<?php
define('MODX_API_MODE', true);
include dirname(dirname(dirname(dirname(__DIR__)))).'/index.php';


$q = $modx->newQuery('modResource');
$q->where(
    array(
        'parent' => 43,
        'published' => 1,
        'hidemenu' => 0
    ));
$q->sortby('pagetitle', 'ASC');
$citys = $modx->getCollection('modResource', $q);

$output = array();
print count($citys);
foreach ($citys as $city) {
    $c_name = $city->get('pagetitle');
    $letter = mb_substr($c_name, 0, 1);

    $output[$letter]['letter'] =  $letter;
    $output[$letter]['rows'][] =  array(
            'link' => 'sefesfes',
            'city' => $c_name,
            'active' => 'active',
    );

}

print_r($output);
