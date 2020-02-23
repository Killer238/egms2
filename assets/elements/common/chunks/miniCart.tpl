<div id="msMiniCart" class="{$total_count > 0 ? 'full' : ''}">
    <div class="empty">
        <a href="{529 | url}">
        <div class="headcart"><div class="">
                    {'ms2_minicart' | lexicon}</div>
            {'ms2_minicart_is_empty' | lexicon}
        </div>
        </a>
    </div>
    <div class="not_empty">
        <a href="{76 | url}">
        <div class="headcart">
            <div>{'ms2_minicart_goods' | lexicon} <strong class="ms2_total_count"> {$total_count}</strong> {'ms2_frontend_count_unit' | lexicon}</div>
            {'ms2_minicart_cost' | lexicon} <strong class="ms2_total_cost">{$total_cost}</strong> {'ms2_frontend_currency' | lexicon}
        </div>
        </a>
    </div>
</div>