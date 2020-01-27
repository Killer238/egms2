<div class="container main__conteiner" id="mse2_mfilter">
    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col-6"><button type="button" class="btn btn-primary d-md-none w-100 m-2" data-toggle="modal" data-target="#exampleModal">{'eg_catalog' | lexicon}</button></div>
                <div class="col-6"><button type="button" class="btn btn-primary d-md-none w-100 m-2" data-toggle="modal" data-target="#filterModal">{'eg_filte' | lexicon}</button></div>
            </div>
            <aside class="d-none d-md-block">
                <div id="category_filter">
                    <h4>{'eg_filte_title' | lexicon}</h4>
                    <form action="{$id | url}" method="post" id="mse2_filters">
                        {$filters}
                    </form>
                </div>
            </aside>
        </div>
        <div class="col-md-9">
            <section>
                <h1 class="sf_h1">{'egCeoData' | snippet | ceodata: 'meta_h1'}</h1>
                <!-- <h1 class="sf_h1">{$_modx->getPlaceholder('sf.h1')} </h1>-->
                <div class="ctags">
                    {var $mytags = $_modx->resource.catalog_tags | json_decode}
                    {foreach $mytags as $mytag}
                        <div class="ctag">
                            <a href="{$mytag.tag_url}" class="btn btn-secondary btn-sm active" role="button" aria-pressed="true">{$mytag.tag_name}</a>
                        </div>
                    {/foreach}
                </div>
                <div>{'eg_found_goods' | lexicon} - <span id="mse2_total">{$total ?: 0}</span></div>
                <div class="row" id="mse2_results">
                    {$results}
                </div>
                <div class="row paging mse2_pagination">
                    {'page.nav' | placeholder}
                </div>
            </section>
        </div>
    </div>
</div>
