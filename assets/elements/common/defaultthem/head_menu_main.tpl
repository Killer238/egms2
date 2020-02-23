{var $menus = [
['item' => 136,
'submenu'=>[
        [
        'col' => '3',
        'parents' => '2720'
        ],
        [
        'col' => '3',
        'parents' => '2723, 2722, 2730, 2726'
        ],
        [
        'col' => '2',
        'parents' => '2721, 2724, 2727,'
        ],
        [
        'col' => '2',
        'parents' => '2725, 2728'
        ],
        [
        'col' => '2',
        'parents' => '480'
        ],
    ],
],

['item' => 135,
'submenu'=>[
[
'col' => '3',
'parents' => '2134'
],
[
'col' => '3',
'parents' => '2723, 2722, 2730, 2726'
],
[
'col' => '2',
'parents' => '2721, 2724, 2727,'
],
[
'col' => '2',
'parents' => '2725, 2728'
],
[
'col' => '2',
'parents' => '2121'
],
],
],

['item' => 137],

['item' => 138],

['item' => 139],


]}

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            {foreach $menus as $menu}
                 <li class="nav-item dropdown">
                         <a class="nav-link dropdown-toggle text-uppercase text-white" href="{$menu.item|url}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{$menu.item| resource : 'menutitle'}</a>
                     {if ($menu.submenu)}
                      <div class="dropdown-menu bg-primary" aria-labelledby="navbarDropdown">
                         <div class="container">
                             <div class="row">
                                 {foreach $menu.submenu as $item}
                                     {$_modx->runSnippet("!pdoMenu", [
                                     'parents' => $item.parents,
                                     'context' => $_modx->context.key,
                                      'cache' => 'asdsad',
                                     'level' => 1,
                                     'displayStart' => 1,
                                     'tplOuter' => '@INLINE <div class="col-md-'~ $item.col ~'">[[+wrapper]]</div>',
                                     'tplInner' => '@INLINE <ul class="nav flex-column">[[+wrapper]]</ul>',
                                     'tplStart' => '@INLINE <a href="[[+link]]" class="text-uppercase text-white submenu-header">[[+menutitle]]</a>[[+wrapper]]',
                                     'tpl' => '@INLINE <li class="nav-item"><a href="[[+link]]" class="nav-link text-white" [[+attributes]]>[[+menutitle]]</a>[[+wrapper]]</li>',
                                     "includeTVs" => "access_vendor",
                                     "where" => '[[{"access_vendor:IN":'~ $_modx->getPlaceholder('region.vendors_arr') ~'},{"OR:access_vendor:IS":null}]]',
                                 ])}
                                 {/foreach}

                             </div>
                        </div>
                     </div>
                     {/if}
                  </li>
            {/foreach}
        </ul>
        {$_modx->runSnippet("!mSearchForm", [
            'element' => 'msProduct',
            'tplForm' => '@FILE elements/common/chunks/tpl.search.tpl',
            'pageId' => 407,
        ])}
</div>
</nav>
