{$_modx->lexicon->load('minishop2:cart')}
{$_modx->lexicon->load('minishop2:default')}
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="header__menumobileb">
                <button
            </div>
            <div class="header__logo">
            <a href="{98 | url}">
                <img style="margin:20px;" src="/assets/matras-stock/img/logo.jpg" width="250px" class="d-none d-lg-block" >
                <span class="header__logomobile d-lg-none">МАТРАС-СТОК.РУ</span>
            </a>
            </div>
            <div class="hearer__city">
            <a href="#Cities" class="" data-toggle="modal"><span class="headmap d-none d-lg-block">
                    </span>{'region.city' | placeholder}</a>
            </div>
        </div>
        <div class="col-6">
        </div>
        <!--
        <div class="col-xs-1 col-lg-3">
            <a href="{98 | url}"><img style="margin:20px;" src="/assets/matras-stock/img/logo.jpg" width="250px" class="" ></a>
        </div>
        <div class="col-xs-1 col-lg-2 my-auto head_city">
            <a href="#Cities" class="" data-toggle="modal"><div class="headmap">
                   {'region.city' | placeholder}</div></a>
        </div>
        <div class="col-xs-1 col-lg-3 my-auto head__phone">
            <a href="#"><div class="headphone ">
                    <span class="d-none d-none d-lg-block">{'region.phone' | placeholder}</span>
                </div></a>
        </div>
        <div class="col-xs-1 col-lg-2 my-auto d-none d-lg-block text-center head_clock">
            <div class="time__text"><div class="headclock">
                    <span style="display: block;">Пн.–вс. </span><span>с 9:00 до 21:00</span>
                </div></div>
        </div>
        <div class="col-xs-1 col-lg-2 my-auto text-center head_cart">
            {'!msMiniCart' | snippet : ['tpl' => '@FILE elements/common/chunks/miniCart.tpl']}
        </div>
        -->
</div>