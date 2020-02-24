<div class="card__delivery" data-minprice="5000" data-deliverycost="350" data-deliveryday="Сегодня">
    <div class="card__deliverycost">
        <span>Доставка по {$region.city_d} - </span>
        <span><b><nobr>{if ($product.price>$delivery.d_min)}
                        Бесплатно
                        {else}
                            {$delivery.d_cost} {'ms2_frontend_currency' | lexicon}
                        {/if}</nobr></b></span>
    </div>
    <div class="card__deliverytime"><span>Доставим:</span> <span>20.05.2020</span></div>
</div>