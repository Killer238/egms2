{extends 'file:elements/common/defaultthem/base.tpl'}
{block 'content'}
    <div class="container cart">
    {if ($.get.msorder)}
    <div class="row">
        <div class="col md2"><h1 class="text-center md-2">{2758 | resource :'longtitle'}</h1></div>
    </div>
    <div class="row">
        <div class="col">

            {"!msGetOrder" | snippet :['tpl' => '@FILE elements/common/chunks/cart/ordernum.tpl']}
            {2758 | resource :'content'}
        </div>
    </div>
    {else}
        {$_modx->runSnippet("!msCart", [
        'tpl' => '@FILE elements/common/chunks/cart/msCart.tpl',
        'toPlaceholder' => 'cart'
        ])}
        {var $cart = $_modx->getPlaceholder('cart')}
        {if ($cart!='')}
            <div class="row">
                <div class="col md2"><h1 class="text-center md-2">{$id | resource :'longtitle'}</h1></div>
            </div>
            <div class="row">
                <div class="col">
                    {$cart}
                    {$_modx->runSnippet("!msOrder", [
                    'tpl' => '@FILE elements/common/chunks/cart/msOrder.tpl'
                    ])}
                </div>
            </div>
            {else}
            <div class="row">
                <div class="col md2"><h1 class="text-center md-2">{529 | resource :'longtitle'}</h1></div>
            </div>
            <div class="row">
                <div class="col">
                    {529 | resource :'content'}
                </div>
            </div>
        {/if}
    {/if}
    </div>
{/block}