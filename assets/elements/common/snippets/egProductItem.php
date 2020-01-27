<?php
$tpl = $modx->getOption('tpl', $scriptProperties);
$product = $modx->getOption('product', $scriptProperties);
$options = $modx->getOption('options', $scriptProperties);

$classModification = 'msopModification';
$classOption = 'msopModificationOption';

if (!function_exists('egGetModificationOptions')) {
    function egGetModificationOptions(modX & $modx, $product = null, $uri, $showZeroCount = true)
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
        $product_cache['product_id'] = $product->get('id');
        $product_cache['product_name'] = $product->get('longtitle');
        $product_cache['product_vendor_id'] = $product->get('vendor.id');
        $product_cache['product_uri'] = $uri;
        $product_cache['price'] = $product->get('price');
        $product_cache['price_old'] = $product->get('old_price');

        $rc = 0;

        $price_diff = ($product_cache['price_old']>0)?$product_cache['price_old']-$product_cache['price']:0;
        $product_cache['default'] = array(
            'product_vendor_id' => $product_cache['product_vendor_id'],
            'product_name' => $product_cache['product_name'],
            'price' => $product_cache['price'],
            'price_old' => $product_cache['price_old'],
            'price_diff' => $price_diff,
            'price_pr' => ($product_cache['price_old']>0)?round (100*($product_cache['price'] - $product_cache['price_old'])/$product_cache['price_old']):0,
            'reviews' => $rc,
            'url' => $product_cache['product_uri'],
        );
        //die($product_cache['default']['price_pr']);

        if ($q->prepare() AND $q->stmt->execute()) {
            while ($row = $q->stmt->fetch(PDO::FETCH_ASSOC)) {
                //die(print_r($row));
                $tmp = array(
                    'mid' => $row['mid'],
                    'key' => $get_val, //$row['key'],
                    'product_name' => $product_cache['product_name']." (".$row['value'].")",
                    'product_vendor_id' => $product_cache['product_vendor_id'],
                    'value' => $row['value'],
                    'price' => $row['price'],
                    'price_old' => $row['price_old'],
                    'price_diff' => $row['price_old'] - $row['price'],
                    'price_pr' => ($product_cache['price_old']>0)?round (100*($row['price'] - $row['price_old'])/$row['price_old']):0,
                    'url' =>  $product_cache['product_uri'].$row['value'].'/',
                    'reviews' => $rc,
                    'selected' => '',
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

$dh = $modx->runSnippet('egDataHost');

if(!$product_cache = $cacheManager->get($hash))
{
    $c_product = $modx->getObject("msProduct", $product);
    $product_cache = egGetModificationOptions($modx, $c_product, $c_product->get('uri'));
    $cacheManager->add($hash, $product_cache);
}

$base_url =$dh['region']['product_category_url']."/".$product_cache['product_uri'];
$product_url = $base_url;

$price = $product_cache['default']['price'];
$old_price = $product_cache['default']['price_old'];
$price_pr = $product_cache['default']['price_pr'];

// устанавливаем атрибут по умолчанию!
$get_val = 'msoption|size';
if(isset($_REQUEST[$get_val]))
{
    $product_cache['options'][$_GET[$get_val]]['selected'] = ' selected';
    $product_cache['product_name'] = $product_cache['product_name']." (".$_GET[$get_val].")";
    $product_url = $product_cache['options'][$_REQUEST[$get_val]]['url'];
    $price = $product_cache['options'][$_GET[$get_val]]['price'];
    $old_price = $product_cache['options'][$_GET[$get_val]]['price_old'];
}else{
    $catalog_defatr = $modx->resource->getTVValue('catalog_defatr');
    if($catalog_defatr!='')
    {
        $r=explode("=", $catalog_defatr);
        if (!isset($_GET[$r[0]]))
        {
            $product_cache['options'][$r[1]]['selected'] = ' selected';
            $price = $product_cache['options'][$r[1]]['price'];
            $old_price = $product_cache['options'][$r[1]]['price_old'];
        }
    }
}

/** @var pdoTools $pdoTools */
$pdoTools = $modx->getService('pdoTools');

$output = $pdoTools->getChunk($tpl, [
    'id'          => $product,
    'option'        => $get_val,
    'product_name' => $product_cache['product_name'],
    'product_vendor_id' => $product_cache['product_vendor_id'],
    'product_url' => $product_url,

    'product_price' => $price,
    'product_old_price' => $old_price,
    'product_price_pr' => $price_pr,
    'product_price_diff' => ($price - $old_price),
    'reviews' => 999,
    'options'     => $product_cache['options'],
]);
//die(print_r($product_cache['options']));
return $output;