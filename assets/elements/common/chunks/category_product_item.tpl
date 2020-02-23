{*var $view = ''*}
{var $view = $modx->getPlaceholder('product_view')}
<div class="col-md-{$view=='grid'?'4':'12'}">
<div class="card card-product product-{$id}">
    <div class="card-body">
        <div class="row">
            <div class="col-md-{$view=='grid'?'12':'4'}">
                <div class="art">Арт: 0003456</div>
                <div class="img-wrap">
                    <a class="url-{$id}" href="{$regioncatalog}/{$id | resource :'uri'}">
                        {if $thumb?}
                            <img src="{$thumb}" class="mw-100" alt="{$pagetitle}" title="{$pagetitle}"/>
                        {else}
                            <img src="{'assets_url' | option}components/minishop2/img/web/ms2_small.png"
                                 srcset="{'assets_url' | option}components/minishop2/img/web/ms2_small@2x.png 2x"
                                 class="mw-100" alt="{$pagetitle}" title="{$pagetitle}"/>
                        {/if}
                    </a>
                </div>
            </div>
            <article class="col-md-{$view=='grid'?'12':'5'}">
                {*if $product.reviews > 0 *}
                <div class="prod__grid__stars">
                    <span></span><span></span><span></span><span></span><span></span><div class="reviews">отзывы(5)</div>
                </div>
                {*/if*}
                <h4><a class="url-{$id}" href="{$regioncatalog}/{$id | resource :'uri'}">
                        {if $_modx->resource.longtitle && $_modx->resource.class_key=='msCategory'}
                            {if $longtitle == $pagetitle}
                                {$longtitle}
                            {else}
                            <div class="catalog">{$_modx->resource.longtitle}</div>
                            {$_pls['vendor.name']} {$pagetitle}
                            {/if}
                        {else}
                            {$longtitle}
                        {/if}</a></h4>
                {*<p>Недорогой классический пружинный матрас на блоке "Боннель" с ППУ. Бязевый чехол.{$introtext}</p>*}
                {'!egProductOptions' | snippet : [
                'onlyOptions' => $modx->runSnippet("egCategoryFeatures"),
                'tpl' => '@FILE elements/common/chunks/tpl.categoryFeatures.tpl',
                'product' => $id,
                ]}
                {'!egOptionPrice' | snippet : ['tpl' => '@FILE elements/common/chunks/category_product_item_delivery.tpl','product' => $id]}
            </article>
            <div class="col-md-{$view=='grid'?'12':'3'} text-center border-left">
                <div class="action-wrap">
                                {'!egOptionPrice' | snippet : [
                                    'tpl' => '@FILE elements/common/chunks/category_modification.tpl',
                                    'product' => $id,
                                    'options' => 'size'
                                ]}
                </div>
            </div>
        </div>
    </div>
</div>
</div>