<div id="msMiniCart" class="{$total_count > 0 ? 'full' : ''}">
    <div class="empty">
        <a href="{529 | url}">
        <div class="headcart">
        </div>
            <div class="d-none d-md-block my-3">
                <div>{'ms2_minicart' | lexicon}</div>
                <div>{'ms2_minicart_is_empty' | lexicon}</div>
            </div>
        </a>
    </div>
    <div class="not_empty">
        <a href="{76 | url}">
        <div class="headcart">
            <div class="d-block d-md-none">
                <strong class="ms2_total_count">{$total_count}</strong>
            </div>
            <div class="d-none d-md-block">
                {'ms2_minicart_goods' | lexicon}<strong class="ms2_total_count"> {$total_count}</strong>{'ms2_frontend_count_unit' | lexicon}
            </div>
            <span class="d-none d-md-block">{'ms2_minicart_cost' | lexicon} <strong class="ms2_total_cost">{$total_cost}</strong> {'ms2_frontend_currency' | lexicon}</span>
        </div>
        </a>
    </div>
</div>