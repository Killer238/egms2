{extends 'file:elements/common/defaultthem/base.tpl'}
{block 'content'}
<section class="">
    <div class="container main__conteiner">
        <div class="row d-none d-md-block">
            {include 'file:elements/common/defaultthem/index_carusel.tpl'}
        </div>
        <div class="row">
            <div class="col-12">
                <h1>{'!egCeoData' | snippet | ceodata: 'h1'}</h1>
            </div>
            <div class="col-12 d-none d-md-block">
                {'!egCeoData' | snippet | ceodata: 'description'}
            </div>
        </div>

        {*var $menus = [136,135,137,138,139,140]*}{*,2525*}
        {var $menus = explode(",", $_modx->resource.index_menu) }
        <div class="row no-gutters justify-content-center m-2 mainmenu ">
        {foreach $menus as $menu}
            <div class="col-4 col-md-2">
                <a href="{$_modx->makeUrl($menu)}">
                    <img src="/assets/img/def/main-{$menu| resource : 'alias'}.svg" />
                    <span>{$menu| resource : 'menutitle'}</span>
                </a>
            </div>
        {/foreach}
        </div>

        <div class="row">
            <div class="col">
                <h3>Популяные товары</h3>
            </div>
        </div>
        <div class="row">
            {$_modx->setPlaceholder('product_view', 'grid')}
            {var $products = $_modx->resource.index_best | json_decode}
            {$_modx->runSnippet("msProducts", [
            'context' => 'web',
            'limit' => 21,
            'parents' => 0,
            'resources' => $products | toflat :'id_product',
            'sortby'=>'ids',
            'prepareSnippet' => 'egPrepareFilter',
            'tpl' => '@FILE elements/common/chunks/category_product_item.tpl',
            'where' => '{"Data.vendor:IN":'~ $_modx->getPlaceholder('region.vendors_arr') ~'}',
            ])}
        </div>
        <div class="row">
            <div class="col m-4">
                <a href="{136 | url}" class="btn btn-success btn active w-100">Перейти в каталог матрасов</a>
            </div>
        </div>
        {*
        <div class="row">
            {include 'file:elements/common/defaultthem/index_categorys.tpl'}
        </div>
        <div class="row bg-primary">
            <div
        </div>
        <div class="row">
            {include 'file:elements/common/defaultthem/index_manufacturers.tpl'}
        </div>
*}

    </div>
</section>
{/block}

