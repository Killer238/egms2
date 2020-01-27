<?php
$tpl = $modx->getOption('tpl', $scriptProperties);
$product = $modx->getOption('product', $scriptProperties);
$options = $modx->getOption('options', $scriptProperties);

$classModification = 'msopModification';
$classOption = 'msopModificationOption';

if (!function_exists('egGetModificationOptions')) {
    function egGetModificationOptions(modX & $modx, $product = null, $showZeroCount = true)
    {
        $rid = $product->get('id');
        $product_cache = [];
        $get_val = 'msoption|size';

        $classModification = 'msopModification';
        $classOption = 'msopModificationOption';
        $classMsOption = 'msOption';

        $q = $modx->newQuery($classOption);
        $q->innerJoin($classModification, $classModification, "{$classModification}.id = {$classOption}.mid");
        $q->leftJoin($classMsOption, $classMsOption, "{$classOption}.key = {$classMsOption}.key");

        $q->select($modx->getSelectColumns($classOption, $classOption));
        $q->select($modx->getSelectColumns($classModification, $classModification));
        $q->select($modx->getSelectColumns($classMsOption, $classMsOption, '', ['caption'], false));

        $q->where([
            "{$classOption}.rid"          => "{$rid}",
            "{$classModification}.active" => true,
        ]);
        if (!$showZeroCount) {
            $q->andCondition([
                "{$classModification}.count:>" => 0,
            ]);
        }
        //die($uri);
        $q->sortby("rank");

        $rcq = array(
            'id_product' => $product->get('id'),
            'context' => $modx->context->key,
            'published' => 1,
        );
        $reviews = $modx->getCollection('plPproductReviews', $rcq);
        $rc = count($reviews);
        $product_cache['therm'] = $product->getTVValue('product_delivery_therm');
        $product_cache['vendor_id'] = $product->get('vendor.id');
        $product_cache['default'] = array(
            'product_id' => $product->get('id'),
            'product_vendor_id' => $product->get('vendor.id'),
            'product_name' => $product->get('longtitle'),
            'price' => $product->get('price'),
            'price_old' => $product->get('old_price'),
            'price_diff' => ($product_cache['default']['price_old']>0)?$product_cache['default']['price']-$product_cache['default']['price_old']:0,
            'price_pr' => ($product_cache['default']['price_old']>0)?round (100*($product_cache['default']['price'] - $product_cache['default']['price_old'])/$product_cache['default']['price_old']):0,
            'url' => $product->get('uri'),
            'reviews' => $rc,
        );
       
        if ($q->prepare() AND $q->stmt->execute()) {
            while ($row = $q->stmt->fetch(PDO::FETCH_ASSOC)) {
                //die(print_r($row));
                $tmp = array(
                    'mid' => $row['mid'],
                    'key' => $get_val, //$row['key'],
                    'value' => $row['value'],
                    'selected' => '',
                    'product_id' => $product_cache['default']['product_id'],
                    'product_vendor_id' => $product_cache['default']['product_vendor_id'],
                    'product_name' => $product_cache['default']['product_name']." (".$row['value'].")",
                    'price' => $row['price'],
                    'price_old' => $row['old_price'],
                    'price_diff' => $row['old_price'] - $row['price'],
                    'price_diff' => $row['old_price'] - $row['price'],
                    'price_pr' => ($row['old_price']>0)?round (100*($row['price'] - $row['old_price'])/$row['old_price']):0,
                    'price_pr' => ($row['old_price']>0)?round (100*($row['price'] - $row['old_price'])/$row['old_price']):0,
                    'url' =>  $product_cache['default']['url'].$row['value'].'/',
                    'reviews' => $rc,

                );

                $product_cache['options'][$row['value']] = $tmp;
            }
        }

        //die(print_r($product_cache));
        return $product_cache;
    }
}

$cacheManager = $modx->getCacheManager();
$hash = "product-".$product;

if(!$product_cache = $cacheManager->get($hash))
{
    $c_product = $modx->getObject("msProduct", $product);
    $product_cache = egGetModificationOptions($modx, $c_product);
    $cacheManager->add($hash, $product_cache);
}

// устанавливаем атрибут по умолчанию!
$get_val = 'msoption|size';
if(isset($_REQUEST[$get_val]))
{
    $product_cache['options'][$_GET[$get_val]]['selected'] = ' selected';
    $product_default = $product_cache['options'][$_GET[$get_val]];
}else{
    $product_default = $product_cache['default'];
    $catalog_defatr = $modx->resource->getTVValue('catalog_defatr');
    if($catalog_defatr!='')
    {
        $r=explode("=", $catalog_defatr);
        if (!isset($_GET[$r[0]]))
        {
            $product_cache['options'][$r[1]]['selected'] = ' selected';
            //$price = $product_cache['options'][$r[1]]['price'];
            //$old_price = $product_cache['options'][$r[1]]['price_old'];
        }
    }
}
$dh = $modx->runSnippet('egDataHost');

$delivery_conditions = $dh['delivery'];
$base_category = $dh['region']['product_category_url'];
$region = $dh['region']['city'];

$delivery = $delivery_conditions[$product_cache['vendor_id'].'-0'];
if($delivery_conditions[$product_cache['vendor_id'].'-'.$product_cache['therm']])
    $delivery = $delivery_conditions[$product_cache['vendor_id'].'-'.$product_cache['therm']];

/** @var pdoTools $pdoTools */
$pdoTools = $modx->getService('pdoTools');
$output = $pdoTools->getChunk($tpl, [
    'id'          => $product,
    'region'      => $region,
    'base_category' => $base_category,
    'product'     => $product_default,
    'options'     => $product_cache['options'],
    'delivery'    => $delivery,
]);

return $output;