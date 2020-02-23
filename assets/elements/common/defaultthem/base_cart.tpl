{extends 'file:elements/common/defaultthem/base.tpl'}
{block 'content'}
    <div class="container">
    <div class="row">
        <div class="col">
    {$_modx->runSnippet("!msCart", [
        'tpl' => '@FILE elements/common/chunks/msCart.tpl'
    ])}

        {$_modx->runSnippet("!msOrder", [
        'tpl' => '@FILE elements/common/chunks/msOrder.tpl'
        ])}

        {'!msGetOrder' | snippet : [
        'tpl' => '']}
        </div>
    </div>
    </div>
{/block}