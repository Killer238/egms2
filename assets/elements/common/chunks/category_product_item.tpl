{*var $view = ''*}
{var $view = $modx->getPlaceholder('product_view')}

{var $therm = $_modx->runSnippet('pdoField', ['id' => $id, 'field' => 'product_delivery_therm', 'output' => '0'])}
{if $delivery[$vendor~'-'~$therm] }
    {var $deliverytherm = $delivery[$vendor~'-'~$therm]}
{else}
    {if $delivery[$vendor~'-0'] }
        {var $deliverytherm = $delivery[$vendor~'-0']}
    {else}
        {var $deliverytherm = $delivery['0-0']}
    {/if}
{/if}
<pre></pre>
<div class="col-md-{$view=='grid'?'4':'12'}">
<div class="card card-product product-{$id}">
    <div class="card-body">
        <div class="row">
            <div class="col-md-{$view=='grid'?'12':'4'}">
                <div class="prod__grid__stars">
                    <span></span><span></span><span></span><span></span><span></span>
                    {if $product_cache.rating > 0 }<div class="reviews"><a title="{'eg_product_reviews'| lexicon} {$id |resource:'longtitle'}" href="{$regioncatalog}/{$id | resource :'uri'}reviews/">{'eg_reviews_s' | lexicon}({$product_cache.rating})</a></div>{/if}
                </div>
                <div class="art">{'eg_art' | lexicon} {$product_cache.article}</div>
                <div class="img-wrap">
                    <a class="url-{$id}" href="{$regioncatalog}/{$id | resource :'uri'}{'url' | size : 'url'}">
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
                <h4><a class="url-{$id}" href="{$regioncatalog}/{$id | resource :'uri'}{'url' | size : 'url'}">
                        {if $product_prefix!='' && $_modx->resource.class_key=='msCategory'}
                            {if $longtitle == $pagetitle}
                                {$longtitle}
                            {else}
                            <div class="catalog">{$product_prefix}</div>
                                {$_pls['vendor.name']} {$pagetitle}
                            {/if}
                        {else}
                            {$longtitle}
                        {/if}<span> {'size_sm' | size}</span></a></h4>
                {*<p>Недорогой классический пружинный матрас на блоке "Боннель" с ППУ. Бязевый чехол.{$introtext}</p>*}
                {'!egProductOptions' | snippet : [
                'tpl' => '@FILE elements/common/chunks/tpl.categoryFeatures.tpl',
                'product' => $id,
                ]}
                <div class="card__delivery card__delivery_{$id}" data-minprice="{$deliverytherm.d_min}" data-deliverycost="{$deliverytherm.d_cost}">
                    <div>{'eg_delivery' | lexicon} <span class="delivery_city">{$region.city_on}</span></div>
                    <div>Стоимость доставки:<span class="delivery_cost">
                            {if ($product_cache.price>$deliverytherm.d_min)}{'eg_free' | lexicon}
                        {else}{$deliverytherm.d_cost} {'ms2_frontend_currency' | lexicon}{/if}</span>
                        <span class="free__cost">{'eg_free' | lexicon}</span>
                    </div>
                    {if ($deliverytherm.d_datehide==1)}
                        <div class="d-none">Доставим:<span class="delivery_date">{$deliverytherm | deliverydate}</span></div>
                        <div>Срок: <span class="delivery_range">{$deliverytherm.d_days}</span></div>
                        {else}
                        <div>Доставим: <span class="delivery_date">{$deliverytherm | deliverydate}</span></div>
                        <div class="d-none">Срок: <span class="delivery_range">{$deliverytherm.d_days}</span></div>
                    {/if}
                </div>

            </article>

            <div class="col-md-{$view=='grid'?'12':'3'} text-center border-left">

                <div class="action-wrap">
                    <div class="price-wrap-{$id} prod-price">
                        {if $product_cache.price_old != $product_cache.price && $product_cache.price_old > 0}
                            <del class="price-old"><span>{number_format($product_cache.price_old, 0, ',', ' ')}</span> {'ms2_frontend_currency' | lexicon}</del><span class="badge-discount">{$product_cache.price_pr}%</span>
                        {/if}
                        <div class="price h4"><span>{number_format($product_cache.price, 0, ',', ' ')}</span> {'ms2_frontend_currency' | lexicon}</div>
                        {*<span class="m-2 p-2" style="padding: 2px 7px;font-size: 12px;background-color: #ef5f5f;color: #fff;border-radius: 4px;">-40%</span>*}
                    </div>
                    <div>
                        <form class="form-horizontal ms2_form  msoptionsprice-product" method="post">
                            <input type="hidden" name="id" value="{$id}"/>
                            <input type="hidden" name="count" class="form-control col-md-6" value="1"/>
                            {if $product_cache.options}
                            <dl class="dlist-inline">
                                <dt>{'ms2_take_size' | lexicon}: </dt>
                                <dd>
                                    <select class="form-control form-control-sm option-select option_size" name="options[size]"">
                                    {foreach $product_cache.options as $option}
                                        <option  value="{$option.value}" data-size="{$option.value}" data-delivery-price="{($option.price<$deliverytherm.d_min)?$deliverytherm.d_cost:0}" data-delivery-date="{$deliverytherm.d_time}" data-instock="{$deliverytherm.d_instock}" data-product-name="{$option.product_name}" data-productid="{$id}" data-option="{$option.value}" data-url="{$regioncatalog}/{$id | resource :'uri'}{$option.url}" data-price="{$option.price}" data-old-price="{$option.price_old}" {$option.selected}>{$option.value}</option>
                                    {/foreach}
                                    </select>
                                </dd>
                            </dl>
                            {/if}
                            <div class="instock">{'eg_instock' | lexicon}</div>
                            <button class="btn btn-success btn active w-100" type="submit" name="ms2_action" value="cart/add">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="text">{'ms2_frontend_add_to_cart' | lexicon}</span>
                            </button>
                        </form>
                    </div>
                    <div class="p-2">
                        <a href="{'region.product_category_url' | placeholder}/{$id | resource :'uri'}{'url' | size : 'url'}" class="btn btn-secondary url-{$id} btn w-100">{'eg_more' | lexicon}</a>
                    </div>

                    {*<a href="#"><i class="fa fa-heart"></i>{'eg_i' | lexicon}</a>*}

                </div>
            </div>

        </div>
    </div>
</div>
</div>