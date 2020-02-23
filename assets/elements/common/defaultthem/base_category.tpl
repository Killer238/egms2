{extends 'file:elements/common/defaultthem/base.tpl'}
{block 'content'}
    {var $filter = $_modx->runSnippet("!egCategoryFilter", ['filter' => [
    'tplOuter' => '@FILE elements/common/chunks/category_mfilter_outer.tpl',
    'tpls' => '@FILE elements/common/chunks/category_product_item.tpl',

    'tplFilter.outer.msoption|size' => 'tpl.mFilter2.filter.select',
    'tplFilter.row.msoption|size' => 'tpl.mFilter2.filter.option',

    'tplFilter.outer.msoption|ves' => 'tpl.mFilter2.filter.slider',
    'tplFilter.row.msoption|ves' => 'tpl.mFilter2.filter.number',

    'tplFilter.outer.msoption|visota_matrasa' => 'tpl.mFilter2.filter.slider',
    'tplFilter.row.msoption|visota_matrasa' => 'tpl.mFilter2.filter.number',

    'tplFilter.outer.price' => 'tpl.mFilter2.filter.slider',
    'tplFilter.row.price' => 'tpl.mFilter2.filter.number',
    'ajaxMode' => 'default',
    'paginator' => 'pdoPage',
    'showLog' => '0',
    'where' => '{"Data.vendor:IN":'~ $_modx->getPlaceholder('region.vendors_arr') ~',"AND:Data.price:>":"2"}',
    ]
    ])}

    {$_modx->runSnippet("!mFilter2", $filter)}
{/block}
