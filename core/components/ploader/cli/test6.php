<?php
define('MODX_API_MODE', true);
include dirname(dirname(dirname(dirname(__DIR__)))).'/index.php';

//$t = $modx->makeUrl(37, 'web');
//print ($t);
//$t = $modx->makeUrl(37, 'mas');
//$t = $modx->makeUrl(36, 'mas');

//$r = implode(",", array_merge(array(145), array(-145)));

$select = $modx->newQuery('msCategoryOption');
$select->sortby('rank', 'ASC');
$select = array(
    'category_id' => 136,
    'required' => 1
);
$f = $modx->getCollection('msCategoryOption', $select);
$output = array();

foreach ($f as $t)
{
    print_r($t);
}
//print_r($f);