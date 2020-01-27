{extends 'file:elements/common/defaultthem/base.tpl'}
{block 'content'}
<section>
    [[!msOptionsPrice.initialize?]]
 <div class="container product__main">
    <div id="msProduct" class="row">
        <div class="col-sm-12 product__h1">
            <h1 class="text-center text-md-left">[[*pagetitle]]{'size' | size: $_modx->lexicon->load('eg_sm')}</h1>
            [[+new:isnot=``:then=`<span class="badge badge-secondary badge-pill col-auto">[[%ms2_frontend_new]]</span>`]]
            [[+popular:isnot=``:then=`<span class="badge badge-secondary badge-pill col-auto">[[%ms2_frontend_popular]]</span>`]]
            [[+favorite:isnot=``:then=`<span class="badge badge-secondary badge-pill col-auto">[[%ms2_frontend_favorite]]</span>`]]
        </div>
    </div>
     <div id="msProduct" class="row product__top">
         <div class="col-12 col-md-8">
             <div class="gallery-wrap product__images">
                 [[!msGallery]]
             </div>
         </div>
         <div class="col-12 col-md-4 product__pricebox">
             <div>
                 {'!egOptionPrice' | snippet : [
                 'tpl' => '@FILE elements/common/chunks/product_modification.tpl',
                 'product' => $_modx->resource.id,
                 'options' => 'msoption|size'
                 ]}
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
                        <div class="col-4">
                            {'egConsistens' | snippet :['tpl' => '@FILE elements/common/chunks/product_consists.tpl']}
                            <p>
                                {* выводим описание для определенного контекста*}
                            {$_modx->resource.id | resource: 'product_description'| cdesc :$_modx->context.key | htmlspecialchars}
                            </p>
                        </div>
                        <div class="col-8">
                            {'msProductOptions' | snippet : ['hideEmpty'=> 1]}
                        </div>
                    </div>

                </div>
                {*<div role="tabpanel" class="tab-pane fade" id="chars">{'msProductOptions' | snippet : ['hideEmpty'=> 1]}</div>*}
                <div role="tabpanel" class="tab-pane fade" id="delivery">Доставка {'region.city' | placeholder}
                {'egDelivery' | snippet :[]}
                </div>
                <div role="tabpanel" class="tab-pane fade" id="reviews"> {'egReviews' | snippet :['id_product' =>  $_modx->resource.id, 'tpl' => '@FILE elements/common/chunks/product_reviews.tpl']}</div>
            </div>
            {'!egOptionPrice' | snippet : [
            'tpl' => '@FILE elements/common/chunks/tpl.productModificationList.tpl',
            'product' => $_modx->resource.id,
            'options' => 'msoption|size'
            ]}

            {*
            с этим товаром покупают
            *}
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
 </div>
</section>
{/block}