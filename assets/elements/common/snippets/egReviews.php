<?php
$modx->loadClass('plPproductReviews', MODX_CORE_PATH.'components/ploader/model/ploader/');

$tpl = $modx->getOption('tpl', $scriptProperties, '@FILE elements/common/chunks/product_reviews.tpl');
$id_product = $modx->getOption('id_product', $scriptProperties);

$select = array(
    'id_product' => $id_product,
);
$reviews = $modx->getCollection('plPproductReviews', $select);
$reviews_arr = array();
foreach ($reviews as $r){

    $reviews_arr[] = array(
        'stars' => $r->get('stars'),
        'name' => $r->get('name'),
        'comment' => ($r->get('text_rewrite')=='')?$r->get('text'):$r->get('text_rewrite'),
    );
}
//die();
$pdoTools = $modx->getService('pdoTools');
return $pdoTools->getChunk($tpl, array(
    'reviews' => $reviews_arr,
));