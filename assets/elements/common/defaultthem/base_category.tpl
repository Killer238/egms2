{extends 'file:elements/common/defaultthem/base.tpl'}
{block 'content'}
    {var $filter = $_modx->runSnippet("!egCategoryFilter", ['filter' => [
    'tplOuter' => '@FILE elements/common/chunks/category_mfilter_outer.tpl',
    'tpls' => '@FILE elements/common/chunks/category_product_item.tpl',

    'tplFilter.outer.msoption|size' => '@FILE elements/common/chunks/category/tpl.mFilter2.filter.select.tpl',
    'tplFilter.row.msoption|size' => '@FILE elements/common/chunks/category/tpl.mFilter2.filter.option.tpl',

    'tplFilter.outer.msoption|ves' => 'tpl.mFilter2.filter.slider',
    'tplFilter.row.msoption|ves' => 'tpl.mFilter2.filter.number',

    'tplFilter.outer.msoption|visota_matrasa' => 'tpl.mFilter2.filter.slider',
    'tplFilter.row.msoption|visota_matrasa' => 'tpl.mFilter2.filter.number',

    'tplFilter.outer.price' => '@FILE elements/common/chunks/category/tpl.mFilter2.filter.slider.tpl',
    'tplFilter.row.price' => 'tpl.mFilter2.filter.number',

    'ajaxMode' => 'default',
    'paginator' => 'pdoPage',
    'showLog' => '0',

    ]
    ])}

    {$_modx->runSnippet("!mFilter2", $filter)}
{/block}
