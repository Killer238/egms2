<section class="section-footer bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-12">
            <label for="s_mail" class="d-flex align-items-center">
                Подписывайтесь!<input type="text" name="s_mail" id="s_mail" value="70" data-current-value="0" class="form-control ml-1" data-original-value="70">
            </label>
            <button type="button" class="btn btn-warning">Подписаться</button>
            </div>
        </div>
    </div>
</section>
<section class="section-footer bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                {$_modx->runSnippet("pdoMenu", [
                    'context' => $modx->context->key,
                    'parents' => 412,
                    'hereClass' => 'active',
                ])}
            </div>
            <div class="col-md-3">
                {$_modx->runSnippet("pdoMenu", [
                    'context' => $modx->context->key,
                    'parents' => 136,
                    'hereClass' => 'active',
                    'tplStart' => '@INLINE <h2 [[+classes]]><a href="[[+link]]" [[+attributes]]>[[+menutitle]]</a></h2>[[+wrapper]]',
                    'displayStart' =>2,
                    'resources' => '136,460,147,453,141,463,454,455,456,457,458',
                ])}
            </div>
            <div class="col-md-3">
                {$_modx->runSnippet("pdoMenu", [
                    'context' => $modx->context->key,
                    'parents' => 135,
                    'hereClass' => 'active',
                    'tplStart' => '@INLINE <h2 [[+classes]]><a href="[[+link]]" [[+attributes]]>[[+menutitle]]</a></h2>[[+wrapper]]',
                    'displayStart' =>2,
                    'resources' => '',
                ])}
            </div>
            <div class="col-md-3">
                {$_modx->runSnippet("pdoMenu", [
                    'context' => $modx->context->key,
                    'parents' => 137,
                    'hereClass' => 'active',
                    'tplStart' => '@INLINE <h2 [[+classes]]><a href="[[+link]]" [[+attributes]]>[[+menutitle]]</a></h2>[[+wrapper]]',
                    'displayStart' =>2,
                    'resources' => '',
                ])}
                {$_modx->runSnippet("pdoMenu", [
                    'context' => $modx->context->key,
                    'parents' => 138,
                    'hereClass' => 'active',
                    'tplStart' => '@INLINE <h2 [[+classes]]><a href="[[+link]]" [[+attributes]]>[[+menutitle]]</a></h2>[[+wrapper]]',
                    'displayStart' =>2,
                    'resources' => '',
                ])}
            </div>
        </div>
    </div>
</section>
<section class="section-copy">
    <div class="container">
        <div class="row">
            <div class="col-sd-12">
                <div class="">Принимаем к оплате:</div>
                <div class="">
                    <img src="/assets/img/payments/payment1.png" >
                    <img src="/assets/img/payments/payment2.png" >
                    <img src="/assets/img/payments/payment3.png" >
                    <img src="/assets/img/payments/payment4.png" >
                    <img src="/assets/img/payments/payment5.png" >
                    <img src="/assets/img/payments/payment6.png" >
                    <img src="/assets/img/payments/payment7.png" >
                    <img src="/assets/img/payments/payment8.png" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                {'region.region_address' | placeholder}
            </div>

        </div>
    </div>
</section>