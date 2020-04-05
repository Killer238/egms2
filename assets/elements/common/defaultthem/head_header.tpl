{$_modx->lexicon->load('minishop2:cart')}
{$_modx->lexicon->load('minishop2:default')}

{*<div class="col-6">
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
</div>*}
{*
        <div class="col-1 col-lg-3">
            <a href="{98 | url}"><img style="margin:20px;" src="/assets/matras-stock/img/logo.jpg" width="250px" class="" ></a>
        </div>
        <div class="col-3 col-lg-2 my-auto head_city">
            <a href="#Cities" class="" data-toggle="modal"><div class="headmap">
                   {'region.city' | placeholder}</div></a>
        </div>
        <div class="col-1 col-lg-3 my-auto head__phone">
            <a href="#"><div class="headphone ">
                    <span class="d-none d-none d-lg-block">{'region.phone' | placeholder}</span>
                </div></a>
        </div>
        <div class="col-1 col-lg-2 my-auto d-none d-lg-block text-center head_clock">
            <div class="time__text"><div class="headclock">
                    <span style="display: block;">Пн.–вс. </span><span>с 9:00 до 21:00</span>
                </div></div>
        </div>
        <div class="col-1 col-lg-2 my-auto text-center head_cart">
            {'!msMiniCart' | snippet : ['tpl' => '@FILE elements/common/chunks/miniCart.tpl']}
        </div>
*}

<div class="container">
    <div class="row align-item-center" style="height: 75px;">
        <div class="col-1 d-block d-md-none my-auto m-0 p-0">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <div class="burger-menu"></div>
            </button>
        </div>
        <div class="col-8 col-md-5 align-self-center">
            <div class="row">
                <div class="col-12 col-md-6 my-auto">
                    {*<h4>fgfdgdfgdfgdfg</h4>*}
                    <a href="//{'region.host' | placeholder}">
                        <div class="logo_head"></div>
                    </a>
                </div>
                <div class="col-12 col-md-6">
                    <a href="#Cities" class="" data-toggle="modal">
                        <div class="headmap d-none d-md-block"></div>
                        <div class="my-1 my-md-3 pl-3">{'region.city' | placeholder}</div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-1 col-md-3 align-self-center">
            <a href="tel:{'region.phone' | placeholder}">
                <div class="headphone "></div>
                <div class="my-3 d-none d-lg-block">{'region.phone' | placeholder}</div>
            </a>
        </div>
        <div class="col-1 col-md-2 align-self-center d-none d-lg-block">
            <div>
                <div class="headclock"></div><div class="my-3"><div>Пн.–вс. </div><div>с 9:00 до 21:00</div></div>
            </div>
        </div>
        <div class="col-1 col-md-2 align-self-center">
            {'!msMiniCart' | snippet : ['tpl' => '@FILE elements/common/chunks/cart/miniCart.tpl']}
        </div>

    </div>
</div>