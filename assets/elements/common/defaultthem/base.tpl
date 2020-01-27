<!DOCTYPE html>
<html lang="{$_modx->config.cultureKey}">
<head>
{include 'file:elements/common/defaultthem/head_meta.tpl'}
{include 'file:elements/common/defaultthem/head_scripts.tpl'}
</head>
<body>
<main>
    <header>
        <section>
            {include 'file:elements/common/defaultthem/head_menu_top.tpl'}
        </section>
        <section>
            {include 'file:elements/common/defaultthem/head_header.tpl'}
        </section>
        <section class="navbar-dark bg-primary">
            <div class="container">
                {include 'file:elements/common/defaultthem/head_menu_main.tpl'}
            </div>
        </section>
        <section>
            <div class="container main__conteiner">
                <div class="row">
                    <div class="col-sm">
                        <nav aria-label="breadcrumbs">
                           {$_modx->runSnippet("pdoCrumbs", [
                            'showHome' => 0,
                            'showAtHome' => 0,
                            'tpl' => '@INLINE <li class="breadcrumb-item"><a href="{$link}" itemprop="item">{$menutitle}</a></li>',
                            'tplCurrent' => '@FILE elements/common/chunks/breabcrumbs_current.tpl',
                            'tplWrapper' => '@INLINE <ol class="breadcrumb">{$output}</ol>'
                            ])}
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </header>
    <article>
       {block 'content'}
       {/block}
    </article>
    <footer>
        {include 'file:elements/common/defaultthem/futer_futer.tpl'}
    </footer>
</main>
<noindex>
    {include 'file:elements/common/defaultthem/futer_scripts.tpl'}
</noindex>
SQL: [^qt^] ([^q^]), PHP: [^p^], MEM: [^m^], ALL: [^t^] ([^s^])
</body>
</html>
