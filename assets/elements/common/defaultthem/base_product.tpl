{extends 'file:elements/common/defaultthem/base.tpl'}
{block 'content'}
<section>
    {*var $pd = $_modx->runSnippet("egPrepareFilter", ['product' => $_modx->resource.id])*}
    {var $pd = $_modx->runSnippet("egPrepareFilter", ['product' => $_modx->resource.id, 'options' => 'msoption|size'])}
    {var $therm = $_modx->runSnippet('pdoField', ['id' => $id, 'field' => 'product_delivery_therm', 'output' => '0'])}
    {var $pc = $pd['product_cache']}
    {var $deliverytherm = $pd['delivery'][$vendor~'-'~$therm]}

    {if $pd['delivery'][$vendor~'-'~$therm] }
        {var $deliverytherm = $pd['delivery'][$vendor~'-'~$therm]}
    {else}
        {if $pd['delivery'][$vendor~'-0'] }
            {var $deliverytherm = $pd['delivery'][$vendor~'-0']}
        {else}
            {var $deliverytherm = $pd['delivery']['0-0']}
        {/if}
    {/if}
    {'!msOptionsPrice.initialize' | snippet}

    {if (!$.get.reviews && !$.get.delivery)}
    <script type="application/ld+json">{
            "@context" : "http://schema.org",
            "@type": "Product",
            "brand": "{$_pls['vendor.name']}",
            "name": "{$_modx->resource.longtitle} {'region.city_in' | placeholder}{'size_sm' | size}",
            "image": "https://{$.server['HTTP_HOST']}{$image}",
            "offers": {
                "@type": "Offer",
                "url": "https://{$.server['HTTP_HOST']}{$.server['REQUEST_URI']}",
                "priceCurrency": "RUB",
                "price": {$pc.price}.00,
                "availability": "http://schema.org/InStock",
                "itemCondition": "http://schema.org/UsedCondition",
                "seller": {
                    "@type": "Organization",
                    "name": "{'region.sitename' | placeholder}"
                }
            },
            "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": {$pc.rating},
                "ratingCount": {$pc.reviews_count},
                "reviewCount": {$pc.reviews_count}
            }
        }
    {/if}
    </script>
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
                <span class="option_zip">{'size_sm' | size}</span>
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
                         {if ($pc.price_old > 0)}
                             <span class="old_price"><span class='msoptionsprice-old-cost msoptionsprice-{$_modx->resource.id}'>{number_format($pc.price_old, 0, ',', ' ')} </span> {'ms2_frontend_currency' | lexicon} (Экономия: <span class="price_diff">{(number_format($pc.price_diff, 0, ',', ' '))}</span>  {'ms2_frontend_currency' | lexicon})</span>
                         {/if}
                     </div>
                     <div class="p-2" style="border-top: 1px solid #e6e6e6;">
                         <input type="hidden" name="id" value="{$_modx->resource.id}"/>
                         <input type="hidden" name="count" value="1"/>
                         <input type="hidden" name="product_data" id="product_data" data-unit="{'eg_sm'| lexicon}" />
                         <div class="dlist-block">
                             <dt>{'eg_size' | lexicon} </dt>
                             <dd>
                                 <select class="option-select mt-2 option_size" name="options[size]">
                                     {foreach $pc.options as $option}
                                         <option value="{$option.value}" data-delivery-price="{($option.price<$deliverytherm.d_min)?$deliverytherm.d_cost:0}" data-productid="{$_modx->resource.id}" data-size="{$option.value}" data-url="{$option.value}/" data-price="{$option.price}" data-old-price="{$option.price_old}" data-diff-price="{$option.price_diff}"{$option.selected}>{$option.value}</option>
                                     {/foreach}
                                 </select>
                             </dd>
                             <div class="instock">{'eg_instock' | lexicon}</div>
                         </div>
                         <div class="card__delivery card__delivery_{$_modx->resource.id}" data-minprice="{$deliverytherm.d_min}" data-deliverycost="{$deliverytherm.d_cost}">
                             <div>{'eg_delivery' | lexicon} <span class="delivery_city">{'region.city_on' | placeholder}</span></div>
                             <div>Стоимость доставки:<span class="delivery_cost">
                            {if ($pc.price>$deliverytherm.d_min)}{'eg_free' | lexicon}
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
                         {*<div class="card__delivery_{$_modx->resource.id}" data-minprice="{$deliverytherm.d_min}" data-deliverycost="{$deliverytherm.d_cost}">
                             <div class="card__deliverycost">
                                 <span>{'eg_delivery' | lexicon} {'region.city_on' | placeholder}: </span>
                                 <span class="free__cost">{'eg_free' | lexicon}</span>
                                 <span class="cost">{if ($pc.price>$deliverytherm.d_min)}{'eg_free' | lexicon}
                                     {else}{$deliverytherm.d_cost} {'ms2_frontend_currency' | lexicon}{/if}
                                 </span>
                             </div>
                             <div class="card__deliverytime"><span>{'delivery_to' | lexicon} </span><span>{$deliverytherm | deliverydate}</span></div>
                         </div>*}
                         <button class="btn btn-primary btn mt-2 w-100" type="submit" name="ms2_action" value="cart/add">
                             <i class="fa fa-shopping-cart"></i>
                             <span class="text">{'ms2_frontend_add_to_cart' | lexicon}</span>
                         </button>
                         <button class="btn btn-success btn mt-2 active w-100" type="submit" name="ms2_action" value="cart/add">
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
                        <div class="col-sm-12 col-md-6">
                            {'!egConsistens' | snippet :['tpl' => '@FILE elements/common/chunks/product/product_consists.tpl']}
                            <p>

                                {* выводим описание для определенного контекста*}
                            {*$_modx->resource.des | resource: 'product_description'| cdesc :$_modx->context.key | htmlspecialchars*}
                                {*$_modx->resource.content*}
                            </p>
                            {*'!egCeoData' | snippet | ceodata: 'description3'*}
                            <p>Магазин {'region.sitename'|placeholder} является официальным дилером фабрики {$_pls['vendor.name']} {'region.city_in'|placeholder}. Мы работаем напрямую от производителя и можем гаранитровать лучшую цену.
                                Только у нас вы можете купить {$_modx->resource.longtitle} с доставкой {'region.city_on'|placeholder} в любом нестандартном размере без дополнительной наценки.</p>
                            {if ($pc.price_old > 0)}
                            <p>Акция действует в период с  {'sw'| daterange} по {'ew'| daterange}. Кол-во товаров ограничено.
                                Цена со скидкой на <strong>{$_modx->resource.longtitle} составит <span class='msoptionsprice-cost msoptionsprice-{$_modx->resource.id}'>{number_format($pc.price, 0, ',', ' ')} </span> {'ms2_frontend_currency' | lexicon}</strong>.
                                Телефон для заказа {'region.city_in'|placeholder}: <a href="tel:{'region.phone' | placeholder}">{'region.phone' | placeholder}</a>
                            </p>
                            {else}
                            <p>Телефон для заказа {'region.city_in'|placeholder}: <a href="tel:{'region.phone' | placeholder}">{'region.phone' | placeholder}</a></p>
                            <p>Цена за размер <span class="option_zip">{'size_sm' | size}</span> — <span class='msoptionsprice-cost msoptionsprice-{$_modx->resource.id}'>{number_format($pc.price, 0, ',', ' ')} </span> {'ms2_frontend_currency' | lexicon}</strong></p>
                            {/if}
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <h2>Характеристики</h2>
                            {'msProductOptions' | snippet : ['hideEmpty'=> 1, 'tpl' => '@FILE elements/common/chunks/product/product_options.tpl']}
                        </div>
                    </div>

                </div>
                {*<div role="tabpanel" class="tab-pane fade" id="chars">{'msProductOptions' | snippet : ['hideEmpty'=> 1]}</div>*}
                <div role="tabpanel" class="tab-pane fade" id="delivery">
                    <h2 class="delivery-{$deliverytherm.id_delivery}">Доставка {$id |resource:'longtitle'} <span class="option_zip">{'size_sm' | size}</span> {'region.city_on' | placeholder}</h2>
                    <p><strong>Сроки и стоимость:</strong></p>
                    <ul>
                        <li>срок доставки: {if (trim($deliverytherm.d_days)=='')}
                                    {if ($deliverytherm.d_dayscount==0)}
                                        1 день
                                    {else}
                                        {$deliverytherm.d_dayscount} дн.
                                    {/if}
                               {else}
                                {$deliverytherm.d_days}
                        {/if}</li>
                        <li>ближайшая дата: <span class="delivery_date">{$deliverytherm | deliverydate:'dateonly'}</span></li>
                        <li><span class="delivery_free_info_{$_modx->resource.id}" {($deliverytherm.d_min < $pc.price)?'style="display:none"':''}>при сумме заказа более {$deliverytherm.d_min} {'ms2_frontend_currency' | lexicon} - </span>доставка <span class="delivery_cost">{'eg_free' | lexicon}</span> {'region.city_on' | placeholder}</li>
                        <li class="delivery_free_info_{$_modx->resource.id}" {($deliverytherm.d_min < $pc.price)?'style="display:none"':''}>при сумме заказа до {$deliverytherm.d_min} {'ms2_frontend_currency' | lexicon} - <span class="delivery_cost">{$deliverytherm.d_cost}{'ms2_frontend_currency' | lexicon}</span></li>

                    </ul>
                    {if (trim($deliverytherm.delivery_options)!='')}
                        <p><strong>Дополнительные опции доставки:</strong></p>
                        {var $options = explode("||", $deliverytherm.delivery_options)}
                        {if (count($options)>0)}
                            <ul>
                                {foreach $options as $option}
                                    <li>{$pd['options'][$option]['option']} - {$pd['options'][$option]['val']}</li>
                                {/foreach}
                            </ul>
                        {/if}
                    {/if}
                    <p>{$deliverytherm.d_content}</p>
                    {if (trim($deliverytherm.s_address)!='')}
                        <p><strong>Адрес самовывоза:</strong></p>
                        <ul>
                            <li>{$deliverytherm.s_address}<div>самовывоз возможен только по предварительному заказу</div></li>
                        </ul>
                    {/if}
                    {if (trim($deliverytherm.d_payments)!='')}
                        {var $payments = explode("||", $deliverytherm.d_payments)}
                        {if (count($payments)>0)}
                            <h2>Способы оплаты:</h2>
                            <ul>
                                {foreach $payments as $payment}
                                    <li>{$pd['payments'][$payment]['name']}</li>
                                {/foreach}
                            </ul>
                        {/if}
                    {/if}
                </div>
                <div role="tabpanel" class="tab-pane fade" id="reviews">
                    <h3>{'eg_reviews' | lexicon}:</h3>
                    {'egReviews' | snippet :['id_product' =>  $_modx->resource.id, 'tpl' => '@FILE elements/common/chunks/product/product_reviews.tpl']}</div>
            </div>
            {if count($pc.options)>0}
            <h3>{'eg_size' | lexicon}:</h3>
            <ul class="atrs">
                {foreach $pc.options as $option}
                    {if (!$option.selected)}
                        <li><a href="{'region.product_category_url'|placeholder}/{$_modx->resource.id | resource :'uri'}{$option.url}">{$option.value}</a></li>
                    {else}
                        <li>{$option.value}</li>
                    {/if}
                {/foreach}
            {/if}
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
     <div class="row pb-3">
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