{extends 'file:elements/common/defaultthem/base.tpl'}
{block 'content'}
    <section class="">
        <div class="container main__conteiner">
            <div class="row">
                <div class="col-12 mb-3">
                    <h1>{$_modx->resource.longtitle ?: $_modx->resource.pagetitle}</h1>
                    {$_modx->resource.content}

                    {$_modx->runSnippet("!mSearchForm", [
                    'element' => 'msProduct',
                    'tplForm' => '@FILE elements/common/chunks/tpl.search.tpl',
                    'pageId' => 407,
                    ])}

                    {var $res = $_modx->runSnippet("!mSearch2",[
                    'tpl' => '@FILE elements/common/chunks/.tpl',
                    'parent' => 16,
                    'returnIds' => 1,
                    'context' => 'web'

                    ])}

                    {if $res}
                        <div class="products" >
                            <div class="search-result row">
                                {$_modx->setPlaceholder('product_view', 'grid')}
                                {$_modx->runSnippet("!msProducts", [
                                'context' => 'web',
                                'limit' => 21,
                                'parents' => 0,
                                'resources' => $res,
                                'depth' => 0,
                                'tpl' => '@FILE elements/common/chunks/category_product_item.tpl'
                                ])}
                            </div>
                        </div>
                    {/if}
                </div>
            </div>
        </div>
    </section>
{/block}