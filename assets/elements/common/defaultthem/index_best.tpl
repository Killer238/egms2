{$_modx->setPlaceholder('product_view', 'grid')}
{$_modx->runSnippet("msProducts", [
    'context' => 'web',
    'limit' => 21,
    'parents' => 52,
    'depth' => 0,
    'tpl' => '@FILE elements/common/chunks/category_product_item.tpl'
])}