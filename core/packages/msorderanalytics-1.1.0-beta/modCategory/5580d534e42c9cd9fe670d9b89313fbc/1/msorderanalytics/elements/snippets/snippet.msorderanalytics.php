<?php
/** @var modX $modx */
/** @var msOrderAnalytics $msoa */
/** @var array $scriptProperties */

$sp = &$scriptProperties;

$modelPath = MODX_CORE_PATH . 'components/msorderanalytics/model/msorderanalytics/';
if (!$msoa = $modx->getService('msorderanalytics', 'msOrderAnalytics', $modelPath, $sp)) {
    return 'Could not load msOrderAnalytics class!';
}
$msoa->initialize($modx->context->key);

// Do your snippet code here. This demo grabs 5 items from our custom table.
$tpl = $modx->getOption('tpl', $sp, 'Item');
$sortby = $modx->getOption('sortby', $sp, 'name');
$sortdir = $modx->getOption('sortbir', $sp, 'ASC');
$limit = $modx->getOption('limit', $sp, 5);
$outputSeparator = $modx->getOption('outputSeparator', $sp, "\n");
$toPlaceholder = $modx->getOption('toPlaceholder', $sp, false);

// Build query
$c = $modx->newQuery('msoaObject');
$c->sortby($sortby, $sortdir);
$c->limit($limit);
$items = $modx->getIterator('msoaObject', $c);

// Iterate through items
$list = array();
/** @var msoaObject $item */
foreach ($items as $item) {
    $list[] = $msoa->tools->getChunk($tpl, $item->toArray());
}

// Output
$output = implode($outputSeparator, $list);
if (!empty($toPlaceholder)) {
    // If using a placeholder, output nothing and set output to specified placeholder
    $modx->setPlaceholder($toPlaceholder, $output);

    return '';
}
// By default just return output
return $output;