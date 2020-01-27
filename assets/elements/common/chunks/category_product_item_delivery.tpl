<div class="card__delivery"><span>Доставка по {$region.city_d} - <b><nobr>
{if ($product.price>$delivery.d_min)}
    Бесплатно
{else}
    {$delivery.d_cost} {'ms2_frontend_currency' | lexicon}
{/if}</nobr></b></span></div>
