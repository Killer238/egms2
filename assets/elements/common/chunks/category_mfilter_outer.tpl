<div class="container" msearch2 id="mse2_mfilter">
    <div class="row">
        <div class="col-md-3">
            <button type="button" class="btn btn-primary d-block d-md-none w-100 m-2" data-toggle="modal" data-target="#exampleModal">Фильтр</button>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="bodyf">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Send message</button>
                        </div>
                    </div>
                </div>
            </div>

            <aside id="category_filter" class="d-none d-md-block">
                <h3>Подбор по параметрам</h3>
                <form action="{$id | url}" method="post" id="mse2_filters" style="height: 800px;">
                    {$filters}
                </form>
            </aside>
        </div>
        <div class="col-md-9">
            <section>
                <h1>{$_modx->runSnippet("!egCeoData", ['type' => 'keywords',])}</h1>
                <!-- <h1 class="sf_h1">{$_modx->getPlaceholder('sf.h1')} </h1>-->
                <div class="border-bottom mb-4 pb-3">
                    <div class="form-inline">
                        <span class="mr-md-auto">32 Items found </span>
                        <select class="mr-2 form-control">
                            <option>Latest items</option>
                            <option>Trending</option>
                            <option>Most Popular</option>
                            <option>Cheapest</option>
                        </select>
                        <div class="btn-group">
                            <a href="#" class="btn btn-outline-secondary" data-toggle="tooltip" title="" data-original-title="List view">
                                <i class="fa fa-bars"></i></a>
                            <a href="#" class="btn  btn-outline-secondary active" data-toggle="tooltip" title="" data-original-title="Grid view">
                                <i class="fa fa-th"></i></a>
                        </div>
                    </div>
                </div>
                <div class="rows" id="mse2_results">
                    {$results}
                </div>
                <div class="paging mse2_pagination">
                    {'page.nav' | placeholder}
                </div>
            </section>
        </div>
    </div>
</div>

<script>
    $('#exampleModal').on('show.bs.modal', function() {
        $('#bodyf').append($("#mse2_filters").detach());
    });
    $('#exampleModal').on('hide.bs.modal', function() {
        $('#category_filter').append($("#mse2_filters").detach());
    });
</script>
<style>

    .modal-body {
        max-height:calc(100vh - 200px);
        overflow-y:auto
    }

</style>