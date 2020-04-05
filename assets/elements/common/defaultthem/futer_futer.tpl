<section class="section-footer bg-primary">
    <div class="container">
        <div class="row p-4">
            <div class="col-md-4 p-2">
                    <div class="text-white h2 inline-block">Подписывайтесь!</div>
                    <div class="text-white">Узнавайте свежую информацию о скидках и акциях первыми.</div>
            </div>
            <div class="col-md-8 p-2">
                <form action="/" method="get" class="form-inline my-2 my-lg-0">
                    <input type="text" name="s_mail" id="s_mail" class="form-control mr-sm-2 m-2 w-50"  placeholder="Ваш email">
                    <button type="button" class="btn btn-warning m-2 w-30">Подписаться</button>
                    <div class="text-white font-italic">* Нажимая на кнопку "Подписаться", я даю согласие на <a href="{2739|url}"  class="text-white font-italic">обработку персональных данных</a></div>
                </form>
            </div>
        </div>
    </div>
</section>
<section class="section-footer bg-light">
    <div class="container">
        <div class="row pt-4">
            <div class="col-md-3">
                <h4>ИНФОРМАЦИЯ</h4>
                {$_modx->runSnippet("pdoMenu", [
                    'context' => $modx->context->key,
                    'parents' => 412,
                    'hereClass' => 'active',
                ])}
            </div>
            <div class="col-md-3">
                <h4>МАТРАСЫ</h4>
                {$_modx->runSnippet("pdoMenu", [
                    'context' => $modx->context->key,
                    'parents' => 136,
                    'hereClass' => 'active',
                    'resources' => '136,454,455,456,457,458',
                ])}
            </div>
            <div class="col-md-3">
                <h4>ДЕТСКИЕ МАТРАСЫ</h4>
                {$_modx->runSnippet("pdoMenu", [
                    'context' => $modx->context->key,
                    'parents' => 135,
                    'resources'=>'135,420,421,422,423',
                    'hereClass' => 'active',
                ])}
            </div>
            <div class="col-md-3">
                <h4>НАМАТРАСНИКИ</h4>
                <div><a href="tel:{'region.phone' | placeholder}">{'region.phone' | placeholder}</a></div>
                <div style="font-size: 0.8rem">ежедневно с 8:00 до 22:00</div>
                <div><strong>Адрес офиса:</strong> <span style="display: block">{'region.region_address' | placeholder}</span></div>
                <div>Не является магазином.</div>
               {* <h4>НАМАТРАСНИКИ</h4>
                {$_modx->runSnippet("pdoMenu", [
                    'context' => $modx->context->key,
                    'parents' => 137,
                    'level' => 1,
                    'hereClass' => 'active',
                ])}
                *}
               {* <h4>ОСНОВАНИЯ</h4>
                {$_modx->runSnippet("pdoMenu", [
                    'context' => $modx->context->key,
                    'parents' => 138,
                    'level' => 1,
                    'hereClass' => 'active',
                ])}*}
            </div>
        </div>
    </div>
</section>
<section class="section-copy">
    <div class="container">
        <div class="row">
            <div class="col-12">Принимаем к оплате:</div>
            <div class="col"><img src="/assets/img/payments/payment1.png" /></div>
            <div class="col"><img src="/assets/img/payments/payment2.png" /></div>
            <div class="col"><img src="/assets/img/payments/payment3.png" /></div>
            <div class="col"><img src="/assets/img/payments/payment4.png" /></div>
            <div class="col"><img src="/assets/img/payments/payment5.png" /></div>
            <div class="col"><img src="/assets/img/payments/payment6.png" /></div>
            <div class="col"><img src="/assets/img/payments/payment7.png" /></div>
            <div class="col"><img src="/assets/img/payments/payment8.png" /></div>
{*
                    <img src="/assets/img/payments/payment1.png" >
                    <img src="/assets/img/payments/payment2.png" >
                    <img src="/assets/img/payments/payment3.png" >
                    <img src="/assets/img/payments/payment4.png" >
                    <img src="/assets/img/payments/payment5.png" >
                    <img src="/assets/img/payments/payment6.png" >
                    <img src="/assets/img/payments/payment7.png" >
                    <img src="/assets/img/payments/payment8.png" >*}
        </div>
    </div>
</section>