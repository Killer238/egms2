<?php
$modx->loadClass('egmsSites', MODX_CORE_PATH.'components/egms/model/egms/');
$modx->loadClass('egmsRegions', MODX_CORE_PATH.'components/egms/model/egms/');

if (!$modx->loadClass('pdofetch', MODX_CORE_PATH . 'components/pdotools/model/pdotools/', false, true)) {return false;}
$pdoFetch = new pdoFetch($modx, $scriptProperties);
$host = $_SERVER['HTTP_HOST'];
$main_host = implode(".", array_reverse(array_slice(array_reverse(explode('.', $host)), 0, 2)));
// Set default parameters
$tpl = $modx->getOption('tpl', $scriptProperties);
// Processing data
$pdoFetch->addTime('Parsing data');

$q = $modx->newQuery('egmsSites');
$q->select(array('egmsSites.host', 'egmsRegions.city'));
$q->innerJoin('egmsRegions', 'egmsRegions', 'egmsSites.id_region = egmsRegions.id');
$q->where(
    array(
        'published' => 1,
        'host:LIKE' => '%'.$main_host,
    ));
$q->sortby('egmsRegions.city', 'ASC');
$q->prepare();
$q->stmt->execute();

$citys = $q->stmt->fetchAll(PDO::FETCH_ASSOC);

$ru = $_SERVER['REQUEST_URI'];
if($ru == '/')
    $ru = '';

$output = array();
//print count($citys);
foreach ($citys as $city) {
    $c_name = $city['city'];
    $c_alias = $city['host'];


    $letter = mb_substr($c_name, 0, 1);

    $output[$letter]['letter'] =  $letter;
    $output[$letter]['rows'][] =  array(
        'link' => '//'.$c_alias.$ru,
        'city' => $c_name,
        'active' => $c_alias == $host ? $activeClass : '',
    );

}

$pdoFetch->addTime('Returning parsed data');

// Return output
$log = '';
if ($modx->user->hasSessionContext('mgr') && !empty($showLog)) {
    $log .= '<pre class="egRegions">' . print_r($pdoFetch->getTime(), 1) . '</pre>';
}

$output = $pdoFetch->getChunk($tpl, array('groups' => $output));

$output .= $log;


return $output;