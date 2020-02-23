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
            <div class="prod-grid-stars">
                <span></span><span></span><span></span><span></span><span></span><div class="reviews">отзывы(5)</div>
            </div>
        </div>
    </div>

     <div class="row product__top">
         <div class="col-12 col-md-8">
             <div class="gallery-wrap product__images">
                 [[!msGallery]]
             </div>
         </div>
         <div class="col-12 col-md-4">
             <div class="ms2_product product__pricebox">
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
                        <div class="col-sm-12 col-md-4">
                            {'egConsistens' | snippet :['tpl' => '@FILE elements/common/chunks/product_consists.tpl']}
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
                <div role="tabpanel" class="tab-pane fade" id="reviews"> {'egReviews' | snippet :['id_product' =>  $_modx->resource.id, 'tpl' => '@FILE elements/common/chunks/product_reviews.tpl']}</div>
            </div>
            {'!egOptionPrice' | snippet : [
            'tpl' => '@FILE elements/common/chunks/tpl.productModificationList.tpl',
            'product' => $_modx->resource.id,
            'options' => 'msoption|size'
            ]}



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
         'resources' => '263,264,265,266',
         'sortby'=>'ids',
         'tpl' => '@FILE elements/common/chunks/category_product_item.tpl',
         'where' => '{"Data.vendor:IN":'~ $_modx->getPlaceholder('region.vendors_arr') ~'}',
         ])}
     </div>
 </div>
</section>
{/block}