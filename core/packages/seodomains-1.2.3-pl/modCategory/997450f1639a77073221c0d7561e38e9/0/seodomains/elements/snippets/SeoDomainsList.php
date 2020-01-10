<?php
/* @var Seodomains $Seodomains */
if (!$Seodomains = $modx->getService('Seodomains', 'Seodomains', MODX_CORE_PATH . 'components/seodomains/model/')) {
    return 'Could not load Seodomains class!';
}

/* @var pdoFetch $pdoFetch */
if (!$modx->loadClass('pdofetch', MODX_CORE_PATH . 'components/pdotools/model/pdotools/', false, true)) {return false;}
$pdoFetch = new pdoFetch($modx, $scriptProperties);

$config = $Seodomains->config;

// Set default parameters
$tpl = $modx->getOption('tpl', $scriptProperties, 'SeoDomains.City.tpl');
$activeClass = $modx->getOption('activeClass', $scriptProperties, 'active');
$sortby = $modx->getOption('sortby', $scriptProperties, 'city');
$sortdir = $modx->getOption('sortdir', $scriptProperties, 'ASC');
$limit = $modx->getOption('limit', $scriptProperties, '');
$showLog = $modx->getOption('showLog', $scriptProperties, 0);
$js = $modx->getOption('frontend_js', $scriptProperties, $config['jsUrl'] . "web/default.js");

if (!empty($js) && preg_match('/\.js/i', $js)) {
    $modx->regClientScript($js);
}

$default = array(
    'class' => 'SeodomainsCity',
    'sortby' => $sortby,
    'sortdir' => $sortdir,
    'limit' => $limit,
    'fastMode' => false,
    'return' => 'data',
);

$pdoFetch->setConfig(array_merge($default, $scriptProperties));
$rows = $pdoFetch->run();

// Processing data
$pdoFetch->addTime('Parsing data');
$output = array();

foreach ($rows as $row) {
    $output[] = array_merge($row, array(
        'active' => $row['domain'] == $_SERVER['HTTP_HOST'] ? $activeClass : '',
        'link' => "//{$row['domain']}{$_SERVER['REQUEST_URI']}"
    ));
}

$pdoFetch->addTime('Returning parsed data');

// Return output
$log = '';
if ($modx->user->hasSessionContext('mgr') && !empty($showLog)) {
    $log .= '<pre class="SeodomainsLog">' . print_r($pdoFetch->getTime(), 1) . '</pre>';
}

$output = $pdoFetch->getChunk($tpl, array('rows' => $output));

$output .= $log;

return $output;