<nav class="navbar navbar-expand p-0 bg-secondary d-none d-md-block" style="width:100%;padding:10px 0px 10px 0px;background:#49505f;">
    <div class="container">
            {$_modx->runSnippet("pdoMenu", [
            'context' => $modx->context->key,
            'parents' => 412,
            'hereClass' => 'active',
            'tplOuter' => '@INLINE <ul class="navbar-nav">[[+wrapper]]</ul>',
            'tpl' => '@INLINE <li class="nav-item"><a href="[[+link]]" class="nav-link" [[+attributes]]>[[+menutitle]]</a>[[+wrapper]]</li>',
            ])}
            <!--<li class="nav-item dropdown"><a href="#" class="nav-link">Гарантия{* и сертификаты*}</a></li>-->
    </div>
</nav>