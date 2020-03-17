{extends 'file:elements/common/defaultthem/base.tpl'}
{block 'content'}
<section class="">
    <div class="container main__conteiner">
        <div class="row d-none d-md-block">
            {include 'file:elements/common/defaultthem/index_carusel.tpl'}
        </div>
        <div class="row">
            <div class="col-12">
                <h1>Интеренет Магазин Матрас-сток.ру</h1>
            </div>
            <div class="col-12 d-none d-md-block">
                [[*content]]
            </div>
        </div>

        {var $menus = [136,135,140,137,138,139,2525]}
        <div class="row no-gutters justify-content-center m-2 mainmenu ">
        {foreach $menus as $menu}
            <div class="col-4 col-md-2">
                <a href="{$_modx->makeUrl($menu)}">
                    <img src="/assets/img/def/main-{$menu| resource : 'alias'}.svg" />
                    <span>{$menu| resource : 'menutitle'}</span>
                </a>
            </div>
        {/foreach}
        </div>
{*
            <div class="col-4 col-md-2">
                <a href="#">
                    <img src="/assets/img/def/main-md.svg" />
                    <span>Детские матрасы</span>
                </a>
            </div>
            <div class="col-4 col-md-2">
                <a href="#">
                    <img src="/assets/img/def/main-n.svg" />
                    <span>Наматрасники</span>
                </a>
            </div>
            <div class="col-4 col-md-2">
                <a href="#">
                    <img src="/assets/img/def/main-o.svg" />
                    <span>Основания</span>
                </a>
            </div>
            <div class="col-4 col-md-2">
                <a href="">
                    <img src="/assets/img/def/main-p.svg" />
                    <span>Подушки</span>
                </a>
            </div>
            <div class="col-4 col-md-2">
                <a href="">
                    <img src="/assets/img/def/main-pb.svg" />
                    <span>Постельное белье</span>
                </a>
            </div>
            <div class="col-4 col-md-2">
                <a href="">
                    <img src="/assets/img/def/main-od.svg" />
                    <span>Одеяла</span>
                </a>
            </div>
            <div class="col-4 col-md-2">
                <a href="">
                    <img src="/assets/img/def/main-d.svg" />
                    <span>Диваны</span>
                </a>
            </div>
            <div class="col-4 col-md-2">
                <a href="">
                    <img src="/assets/img/def/main-b.svg" />
                    <span>Кровати</span>
                </a>
            </div>
    *}

        <div class="row">
            <div class="col">
                <h3>Популяные товары</h3>
            </div>
        </div>
        <div class="row">
            {include 'file:elements/common/defaultthem/index_best.tpl'}
        </div>
        <div class="row">
            <div class="col m-4">
                <a href="" class="btn btn-success btn active w-100">Перейти в каталог матрасов</a>
            </div>
        </div>
        <div class="row">
            {include 'file:elements/common/defaultthem/index_categorys.tpl'}
        </div>
        <div class="row">
            {include 'file:elements/common/defaultthem/index_manufacturers.tpl'}
        </div>


    </div>
</section>
{/block}

