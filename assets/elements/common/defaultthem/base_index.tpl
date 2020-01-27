{extends 'file:elements/common/defaultthem/base.tpl'}
{block 'content'}
<section class="">
    <div class="container main__conteiner">
        <div class="row">
            {include 'file:elements/common/defaultthem/index_carusel.tpl'}
        </div>
        <div class="row">
            <div class="col-12">
                [[*content]]
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3>Популяные товары</h3>
            </div>
        </div>
        <div class="row">
            {include 'file:elements/common/defaultthem/index_best.tpl'}
        </div>
        <div class="row">
            <a href="" class="btn btn-success btn active w-100">Перейти в каталог матрасов</a>
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

