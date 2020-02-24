<?php
$dh = $modx->runSnippet("egDataHost", []);
//$modx->setPlaceholder('region.host', $dh['region']['host']);
//$modx->setPlaceholder('region.mainhost', $dh['region']['mainhost']);
//$modx->setPlaceholder('region.alias', $dh['region']['alias']);
//$modx->setPlaceholder('region.product_category_url', $dh['region']['product_category_url']);

$row['regioncatalog'] = $dh['region']['product_category_url'];//$modx->getPlaceholder('region.product_category_url');
$row['delivery'] = $dh['delivery'];

return json_encode($row);