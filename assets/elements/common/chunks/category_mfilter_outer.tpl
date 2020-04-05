<div class="container main__conteiner" id="mse2_mfilter">
    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col-6"><button type="button" class="btn btn-primary d-md-none w-100 m-2" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">{'eg_catalog' | lexicon}</button></div>
                <div class="col-6"><button type="button" class="btn btn-primary d-md-none w-100 m-2" data-toggle="modal" data-target="#filterModal">{'eg_filte' | lexicon}</button></div>
            </div>
            <aside class="d-none d-md-block">
                <div id="category_filter">
                    <h4>{'eg_filte_title' | lexicon}</h4>
                    <form action="{$id | url}" method="post" id="mse2_filters">
                        {$filters}
                    </form>
                </div>

                {*<div class="row">
                    <div class="col">
                        <div class="row">
                        {$_modx->runSnippet("pdoResources", [
                        'parents' => 2720,
                        'depth' => 1,
                        'sortby'=>'{"menuindex":"asc"}',
                        'limit' => 0,
                        'tpl' => '@INLINE <div class="col-4"><a href="{$id|url}" class="" role="button" aria-pressed="true">{$id|resource:\'menutitle\'}</a></div>',
                        "includeTVs" => "access_vendor",
                        "where" => '[[{"access_vendor:IN":'~ $_modx->getPlaceholder('region.vendors_arr') ~'},{"OR:access_vendor:IS":null}]]',
                        ])}
                        </div>
                    </div>
                </div>*}
            </aside>
        </div>
        <div class="col-md-9">
            <section>
                <div class="row">
                    <div class="col">
                        <h1 class="sf_h1">{'!egCeoData' | snippet | ceodata: 'h1'}</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col description">{'!egCeoData' | snippet | ceodata: 'description'}</div>
                </div>
                <div class="row">
                    <div class="col">
                        <span><strong>{'mse2_popular'| lexicon}:</strong></span>
                            <ul class="tag">{var $mytags = $_modx->resource.catalog_tags}
                                {$_modx->runSnippet("pdoResources", [
                                'depth' => 0,
                                'sortby'=>'{"menuindex":"asc"}',
                                'limit' => 0,
                                'tpl' => '@INLINE <li><a href="{$id|url}" class="" role="button" aria-pressed="true">{$id|resource:\'menutitle\'}</a></li>',
                                "includeTVs" => "access_vendor",
                                "where" => '[[{"access_vendor:IN":'~ $_modx->getPlaceholder('region.vendors_arr') ~'},{"OR:access_vendor:IS":null}]]',
                                ])}
                                {if ($mytags!='')}
                                {$_modx->runSnippet("pdoResources", [
                                'parents' => 0,
                                'resources' => $mytags,
                                'sortby'=>'{"menuindex":"asc"}',
                                'limit' => 0,
                                'tpl' => '@INLINE <li><a href="{$id|url}" class="" role="button" aria-pressed="true">{$id|resource:\'menutitle\'}</a></li>',
                                "includeTVs" => "access_vendor",
                                "where" => '[[{"access_vendor:IN":'~ $_modx->getPlaceholder('region.vendors_arr') ~'},{"OR:access_vendor:IS":null}]]',
                                ])}
                                {/if}
                            </ul>
                    </div>
                </div>
                {*<nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <span class="" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav">Популярые категории</span>
                    <!--button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"  aria-expanded="false" aria-label="Toggle navigation">

                    </button-->
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav  display-inline">
                            {foreach $mytags as $mytag}
                            <li style="display: inline-block;">
                                <a href="{$mytag.tag_url}" class="btn btn-secondary btn-sm active" role="button" aria-pressed="true">{$mytag.tag_name}</a>
                            </li>
                            {/foreach}
                        </ul>
                    </div>
                </nav>*}

                {*<div class="ctags">

                    {foreach $mytags as $mytag}
                        <div class="ctag">
                            <a href="{$mytag.tag_url}" class="btn btn-secondary btn-sm active" role="button" aria-pressed="true">{$mytag.tag_name}</a>
                        </div>
                    {/foreach}
                </div>*}


                <div class="row">
                    <div class="col">
                        {'eg_found_goods' | lexicon}: <span id="mse2_total"> {$total ?: 0}</span>
                    </div>
                </div>
                <div class="row">
                    <div id="mse2_sort" class="col-md-6">
                        {'mse2_sort' | lexicon}
                        <a href="#" data-sort="ms|price"
                           data-dir="{if $sort == 'ms|price:desc'}desc{/if}" data-default="asc" class="sort">
                            {'mse2_sort_price' | lexicon} <span></span>
                        </a>|
                        <a href="#" data-sort="fastprice"
                           data-dir="" data-default="" class="sort">
                            {'ms2_sort_fastprice' | lexicon}<span></span>
                        </a>
                    </div>

                    {** if $tpls}
                        <div id="mse2_tpl" class="col-md-6">
                            <a href="#" data-tpl="0" class="{$tpl0}">{'mse2_chunk_default' | lexicon}</a> /
                            <a href="#" data-tpl="1" class="{$tpl1}">{'mse2_chunk_alternate' | lexicon}</a>
                        </div>
                    {/if *}
                </div>

                <div class="row" id="mse2_results">
                    {$results}
                </div>
                <div class="row paging mse2_pagination">
                    {'page.nav' | placeholder}
                </div>
                {*<div class="row mb-4">
                    <button class="btn btn-primary btn_more">Загрузить еще</button>
                </div>*}
            </section>
        </div>
    </div>
</div>
