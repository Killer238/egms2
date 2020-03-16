{extends 'file:elements/common/defaultthem/base.tpl'}
{block 'content'}
<section class="">
    <div class="container main__conteiner">
        <div class="row d-none d-md-block">
            {include 'file:elements/common/defaultthem/index_carusel.tpl'}
        </div>
        <div class="row d-none d-md-block">
            <div class="col">
                [[*content]]
            </div>
        </div>
        <div class="row mainmenu">
            <div class="col-4 col-md-1">
                <a href="#">
                <img src="/assets/img/def/main-m.svg" />
                <span">Матрасы</span>
                </a>
            </div>
            <div class="col-4 col-md-1">
                <img src="/assets/img/def/main-n.svg" />
                <span>Наматрасники</span>
            </div>
            <div class="col-4 col-md-1">
                <img src="/assets/img/def/main-o.svg" />
            </div>
            <div class="col-4 col-md-1">
                <img src="/assets/img/def/main-p.svg" />
            </div>
        </div>
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

