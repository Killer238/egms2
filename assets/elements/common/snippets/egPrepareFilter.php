<?php
$modx->loadClass('plPproductReviews', MODX_CORE_PATH.'components/ploader/model/ploader/');
$tpl = $modx->getOption('tplprod', $scriptProperties, '');
$product = $modx->getOption('product', $scriptProperties);
$options = $modx->getOption('options', $scriptProperties);

$classModification = 'msopModification';
$classOption = 'msopModificationOption';

if (!function_exists('egGetModificationOptions')) {
    function egGetModificationOptions(modX & $modx, $product = null, $showZeroCount = true)
    {
        //$product = $modx->getObject("msProduct", array('id'=> (int)$product_id));
        //die(".".$product_id);
        $rid = $product['id'];//$product->get('id');
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
            'resource_id' => $product['id'],
            'context' => $modx->context->key,
            'published' => 1,
        );
        $reviews = $modx->getCollection('plPproductReviews', $rcq);
        $rc = count($reviews);
        $product_cache['therm'] = $product['product_delivery_therm']; //$product->getTVValue('product_delivery_therm');
        $product_cache['vendor_id'] = $product['vendor.id'];
        $product_cache['article'] = ($product['article']=='')?$product['vendor.id'].$product['id']:$product['article'];
        $product_cache['product_id'] = $product['id'];
        $product_cache['product_vendor_id'] = $product['vendor.id'];
        $product_cache['product_vendor_name'] = $product['vendor.name'];
        $product_cache['product_name'] = $product['pagetitle'];
        $product_cache['product_fullname'] = $product['longtitle'];
        $product_cache['price'] = str_replace(' ', '',  $product['price']);
        $product_cache['price_old'] = str_replace(' ', '', $product['old_price']);//$product['old_price'];
        $product_cache['price_diff'] = ($product_cache['price_old']>0)?$product_cache['price']-$product_cache['price_old']:0;
        $product_cache['price_pr'] = ($product_cache['price_old']>0)?round (100*($product_cache['price'] - $product_cache['price_old'])/$product_cache['price_old']):0;
        $product_cache['url'] = $product['uri'];
        //$product_cache['reviews'] = $reviews;
        $product_cache['reviews_count'] = $rc;
        $product_cache['rating'] = $rc;

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
                    'price_pr' => ($row['old_price']>0)?round (100*($row['price'] - $row['old_price'])/$row['old_price']):0,
                    'url' =>  $product_cache['default']['url'].$row['value'].'/',
                    //'reviews' => $rc,

                );

                $product_cache['options'][$row['value']] = $tmp;
            }
        }

        //die(print_r($product_cache));
        return $product_cache;
    }
}

//die(print_r($row));
if (!is_array($row)){
    if($product){
        $res = $modx->getObject("msProduct", $product);
        $row = $res->toArray();
    }
}
$cacheManager = $modx->getCacheManager();
$hash = "product-".$modx->context->key."-".$row['id'];

if ($row['class_key']=='msProduct')
    if(!$product_cache = $cacheManager->get($hash))
    {
        $product_cache = egGetModificationOptions($modx, $row);
        $cacheManager->add($hash, $product_cache);
    }
//die(print_r($product_cache));
// устанавливаем атрибут по умолчанию!
$get_val = 'msoption|size';
if(isset($product_cache['options'][$_GET[$get_val]]))
{
    $product_cache['options'][$_GET[$get_val]]['selected'] = ' selected';
    //$product_default = $product_cache['options'][$_GET[$get_val]];
    $product_cache['price'] = $product_cache['options'][$_GET[$get_val]]['price'];
    $product_cache['price_old'] = $product_cache['options'][$_GET[$get_val]]['price_old'];
    $product_cache['price_diff'] = $product_cache['options'][$_GET[$get_val]]['price_diff'];
    $product_cache['price_pr'] = $product_cache['options'][$_GET[$get_val]]['price_pr'];
}else{
    $product_default = $product_cache['default'];
    $catalog_defatr = $row['catalog_defatr'];
    if($catalog_defatr!='')
    {
        $r=explode("=", $catalog_defatr);
        if (!isset($_GET[$r[0]]))
        {
            $product_cache['options'][$r[1]]['selected'] = ' selected';
        }
    }
}

$row['product_cache'] = $product_cache;
$dh = $modx->runSnippet("egDataHost", []);
$row['regioncatalog'] = $dh['region']['product_category_url'];
$row['delivery'] = $dh['delivery'];
$row['payments'] = $dh['payments'];
$row['options'] = $dh['options'];
$row['region'] = $dh['region']['city'];
$row['product_prefix'] = $modx->runSnippet("egCeoData", ['field' => 'product_prefix']);

//echo '<pre>';print_r($row);die;

if ($tpl=='')
    return $row;
    //return $product_cache;

//die(print_r($product_cache['options']));

$pdoTools = $modx->getService('pdoTools');
$output = $pdoTools->getChunk($tpl, [
    'product'     => $product_cache,
    'options'     => $product_cache['options'],
    'delivery'    => $delivery,

    'row'         => $row,
]);

return $output;