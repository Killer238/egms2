{$_modx->setPlaceholder('product_view', 'grid')}
{var $products = $_modx->resource.index_best | json_decode}
{$_modx->runSnippet("msProducts", [
    'context' => 'web',
    'limit' => 21,
    'parents' => 0,
    'resources' => $products | toflat :'id_product',
    'sortby'=>'ids',
    'tpl' => '@FILE elements/common/chunks/category_product_item.tpl',
    'where' => '{"Data.vendor:IN":'~ $_modx->getPlaceholder('region.vendors_arr') ~'}',
])}