<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filter_label" aria-hidden="true">
    <div class="modal-dialog full__dialog modal-dialog-centered modal" role="document">
        <div class="modal-content full__dialog">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="filter_label">{'eg_modal_filter_ttitle' | lexicon}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="bodyf">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="filter_reset">{'eg_modal_filter_cancel' | lexicon}</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">{'eg_modal_filter_show' | lexicon}</button>
            </div>
        </div>
    </div>
</div>

{$_modx->runSnippet("!egCitys", [
'tpl' => '@FILE elements/common/chunks/modal_regions.tpl'
])}
{*$_modx->getPlaceholder('MinifyX.js')*}
{*<script src="assets/components/js/build.js?fgdgd6576fg" type="text/javascript"></script>*}


<script src="assets/components/js/jquery-3.4.1.min.js?fg3347523544335335" type="text/javascript"></script>
<script src="assets/components/js/popper.min.js?fg3347523544335335" type="text/javascript"></script>
<script src="assets/components/js/bootstrap.min.js?fg33475233544335335" type="text/javascript"></script>
<script src="assets/components/js/common.js?fg33434344356764552343535653444453358d34435644545454534335335" type="text/javascript"></script>

