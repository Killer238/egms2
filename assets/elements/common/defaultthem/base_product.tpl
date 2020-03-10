{extends 'file:elements/common/defaultthem/base.tpl'}
{block 'content'}
<section>
    {*var $pd = $_modx->runSnippet("egPrepareFilter", ['product' => $_modx->resource.id])*}
    {var $pd = $_modx->runSnippet("egPrepareFilter", ['product' => $_modx->resource.id, 'options' => 'msoption|size'])}
    {var $pc = $pd['product_cache']}
    {var $deliverytherm = $pd['delivery']}
    {'!msOptionsPrice.initialize' | snippet}
    {*<pre>{print_r($pd['options'])}</pre>*}
 <div class="container product__main">
     <div id="msProduct" class="row">
        <div class="col-sm-12 product__h1">
            <h1 class="text-center text-md-left">
                {if ($.get.reviews)}
                    {'eg_product_reviews'| lexicon}
                {/if}
                {$_modx->resource.longtitle}
                {if ($.get.delivery)}
                    {'eg_product_delivery_in'| lexicon}{'region.city_p' | placeholder}
                {/if}
                <span>{'size_sm' | size}</span>
            </h1>
            {if !$.get.reviews}
            <div class="prod-grid-stars">
                <span></span><span></span><span></span><span></span><span></span><div class="reviews">
                    {if ($pc.rating > 0)}
                        <a title="{'eg_product_reviews'| lexicon} {$_modx->resource.longtitle}" href="{'region.product_category_url'|placeholder}/{$_modx->resource.id | resource :'uri'}reviews/">{'eg_reviews_s' | lexicon}({$pc.rating})</a>
                    {/if}
                </div>
            </div>
            {/if}
        </div>
     </div>

     {switch $.get.reviews}
     {case 'reviews'}
     <div class="row">
         <div class="col-12 col-md-6">
             <div class="gallery-wrap product__images">
                 {'!msGallery' | snippet}
             </div>
         </div>
     </div>
     <div class="row">
         <div class="col-sm-12">
        {'egReviews' | snippet :['id_product' =>  $_modx->resource.id, 'tpl' => '@FILE elements/common/chunks/product/product_reviews.tpl']}
         </div>
     </div>
     <div class="row">
         <div class="col-sm-12">
             <a href="{'region.product_category_url'|placeholder}/{$_modx->resource.id | resource :'uri'}" class="btn btn-lg btn-warning m-2 ms2_link">Купить {$_modx->resource.longtitle}</a>
         </div>
     </div>
     {case default}
     <div class="row product__top">
         <div class="col-12 col-md-8">
             <div class="gallery-wrap product__images">
                 {'!msGallery' | snippet}
             </div>
         </div>
         <div class="col-12 col-md-4">
             <div class="ms2_product product__pricebox">

                 <form class="form-horizontal ms2_form  msoptionsprice-product" method="post">
                     <div class="article">{'eg_art' | lexicon} {$pc.article}</div>
                     <div class="col-md-10 form-control-static price mb-2">
                         <span class='msoptionsprice-cost msoptionsprice-{$_modx->resource.id}'>{number_format($pc.price, 0, ',', ' ')} </span> {'ms2_frontend_currency' | lexicon}
                         {if ($pc.old_price > 0)}
                             <span class="old_price"><span class='msoptionsprice-old-cost msoptionsprice-{$_modx->resource.id}'>{number_format($pc.price_old, 0, ',', ' ')} </span> {'ms2_frontend_currency' | lexicon} (Экономия: {(number_format($product.price_diff, 0, ',', ' ')) |number}  {'ms2_frontend_currency' | lexicon})</span>
                         {/if}
                     </div>
                     <div style="border-top: 1px solid #e6e6e6;">
                         <input type="hidden" name="id" value="{$_modx->resource.id}"/>
                         <input type="hidden" name="count" value="1"/>
                         <input type="hidden" name="product_data" id="product_data" data-unit="{'eg_sm'| lexicon}" />
                         <dl class="dlist-block p-2">
                             <dt>{'eg_size' | lexicon} </dt>
                             <dd>
                                 <select class="option-select mt-2" name="options[size]">
                                     {foreach $pc.options as $option}
                                         <option value="{$option.value}" data-productid="{$_modx->resource.id}" data-size="{$option.value}" data-url="{$option.value}/" data-price="{$option.price}" data-old-price="{$option.old_price}"{$option.selected}>{$option.value}</option>
                                     {/foreach}
                                 </select>
                             </dd>
                             <div class="instock">{'eg_instock' | lexicon}</div>
                         </dl>
                         <div class="card__delivery_{$_modx->resource.id}" data-minprice="{$deliverytherm.d_min}" data-deliverycost="{$deliverytherm.d_cost}">
                             <div class="card__deliverycost">
                                 <span>{'eg_delivery_in' | lexicon} {$region.city_d}: </span>
                                 <span class="free__cost">{'eg_free' | lexicon}</span>
                                 <span class="cost">{if ($pc.price>$deliverytherm.d_min)}{'eg_free' | lexicon}
                                     {else}{$deliverytherm.d_cost} {'ms2_frontend_currency' | lexicon}{/if}
                                 </span>
                             </div>
                             <div class="card__deliverytime"><span>{'delivery_to' | lexicon} </span><span>{$deliverytherm | deliverydate}</span></div>
                         </div>
                         <button class="btn btn-primary btn m-2 w-100" type="submit" name="ms2_action" value="cart/add">
                             <i class="fa fa-shopping-cart"></i>
                             <span class="text">{'ms2_frontend_add_to_cart' | lexicon}</span>
                         </button>
                         <button class="btn btn-success btn m-2 active w-100" type="submit" name="ms2_action" value="cart/add">
                             <i class="fa fa-shopping-cart"></i>
                             <span class="text">{'eg_oneclick' | lexicon}</span>
                         </button>
                     </div>
                     <a href="#"><i class="fa fa-heart"></i>{'eg_i' | lexicon}</a>
                 </form>

             </div>
         </div>
     </div>
     <div class="row">
        <div class="col-sm-12">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#desc" role="tab" data-toggle="tab">{'eg_description_features' | lexicon}</a>
                </li>
                {*<li class="nav-item">
                    <a class="nav-link" href="#chars" role="tab" data-toggle="tab">{'eg_features' | lexicon}</a>
                </li>*}
                <li class="nav-item">
                    <a class="nav-link" href="#delivery" role="tab" data-toggle="tab">{'eg_delivery' | lexicon}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#reviews" role="tab" data-toggle="tab">{'eg_reviews' | lexicon}</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="desc">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            {'egConsistens' | snippet :['tpl' => '@FILE elements/common/chunks/product/product_consists.tpl']}
                            <p>
                                {* выводим описание для определенного контекста*}
                            {$_modx->resource.id | resource: 'product_description'| cdesc :$_modx->context.key | htmlspecialchars}
                            </p>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            {'msProductOptions' | snippet : ['hideEmpty'=> 1]}
                        </div>
                    </div>

                </div>
                {*<div role="tabpanel" class="tab-pane fade" id="chars">{'msProductOptions' | snippet : ['hideEmpty'=> 1]}</div>*}
                <div role="tabpanel" class="tab-pane fade" id="delivery">Доставка {'region.city' | placeholder}
                {'egDelivery' | snippet :[]}
                </div>
                <div role="tabpanel" class="tab-pane fade" id="reviews">
                    <h3>{'eg_reviews' | lexicon}:</h3>
                    {'egReviews' | snippet :['id_product' =>  $_modx->resource.id, 'tpl' => '@FILE elements/common/chunks/product/product_reviews.tpl']}</div>
            </div>
            <h3>{'eg_size' | lexicon}:</h3>
            <ul class="atrs">
                {foreach $pc.options as $option}
                    {if (!$option.selected)}
                        <li><a href="{'region.product_category_url'|placeholder}/{$_modx->resource.id | resource :'uri'}{$option.url}">{$option.value}</a></li>
                    {else}
                        <li>{$option.value}</li>
                    {/if}
                {/foreach}
            </ul>

            {*
            смотрите еще
            *}

            {*
            сложно выбрать?
            *}

            {*
            мы гарантируем / почему нам доверяют
            *}

        </div>
    </div>
     <div class="row mb-3">
         <div class="col-12"><h3>С этим товаром покупают</h3></div>
         {*с этим товаром покупают*}
         {$_modx->setPlaceholder('product_view', 'grid')}
         {$_modx->runSnippet("msProducts", [
         'context' => 'web',
         'limit' => 3,
         'parents' => 0,
         'prepareSnippet' => 'egPrepareFilter',
         'resources' => '263,264,265,266',
         'sortby'=>'ids',
         'tpl' => '@FILE elements/common/chunks/category_product_item.tpl',
         'where' => '{"Data.vendor:IN":'~ $_modx->getPlaceholder('region.vendors_arr') ~'}',
         ])}
     </div>
     {/switch}
 </div>
</section>
{/block}

<!--        [[+new:isnot=``:then=`<span class="badge badge-secondary badge-pill col-auto">[[%ms2_frontend_new]]</span>`]]
            [[+popular:isnot=``:then=`<span class="badge badge-secondary badge-pill col-auto">[[%ms2_frontend_popular]]</span>`]]
            [[+favorite:isnot=``:then=`<span class="badge badge-secondary badge-pill col-auto">[[%ms2_frontend_favorite]]</span>`]]
-->