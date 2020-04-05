{extends 'file:elements/common/defaultthem/base.tpl'}
{block 'content'}
    <div class="container">
    <div class="row">
        <div class="text-center md-2 col-12">
        <h1>{$_modx->resource.longtitle}</h1>
        </div>
        <div class="col-12">
            {$_modx->resource.content}
        </div>
    </div>
    </div>
{/block}