{var $vw = $_modx->runSnippet('egVendorsHost',['where' => 'access_vendor:IN'])}
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
<div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
                 <li class="nav-item dropdown">
                         <a class="nav-link dropdown-toggle" href="{136|url}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{136 | resource : 'menutitle'}</a>
                     <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                         <div class="container">
                             <div class="row">
                                 {$_modx->runSnippet("!pdoMenu", [
                                    'parents' => '2121, 2134',
                                    'context' => $_modx->context.key,
                                    'level' => 2,
                                     'displayStart' => 1,
                                    'tplOuter' => '@INLINE <div class="col-md-4">[[+wrapper]]</div>',
                                    'tplInner' => '@INLINE <ul class="nav flex-column">[[+wrapper]]</ul>',
                                    'tplStart' => '@INLINE <a href="[[+link]]" class="text-uppercase text-white">[[+menutitle]]</a>[[+wrapper]]',
                                    'tpl' => '@INLINE <li class="nav-item"><a href="[[+link]]" class="nav-link" [[+attributes]]>[[+menutitle]]</a>[[+wrapper]]</li>',
                                    "includeTVs" => "access_vendor",
                                    "where" => '[['~ $vw ~',{"OR:access_vendor:IS":null}]]',])}matras
                                 {$_modx->runSnippet("!pdoMenu", [
                                 'context' => $_modx->context.key,
                                 'parents' => '2121, 2134',
                                 'level' => 2,
                                 'displayStart' => 1,
                                 'tplOuter' => '@INLINE <div class="col-md-4">[[+wrapper]]</div>',
                                 'tplInner' => '@INLINE <ul class="nav flex-column">[[+wrapper]]</ul>',
                                 'tplStart' => '@INLINE <a href="[[+link]]" class="text-uppercase text-white">[[+menutitle]]</a>[[+wrapper]]',
                                 'tpl' => '@INLINE <li class="nav-item"><a href="[[+link]]" class="nav-link" [[+attributes]]>[[+menutitle]]</a>[[+wrapper]]</li>',
                                 "includeTVs" => "access_vendor",
                                 "where" => '[['~ $vw ~',{"OR:access_vendor:IS":null}]]',])}
                             </div>
                        </div>
                     </div>
                  </li>
                <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{135|url}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{135 | resource : 'menutitle'}</a>
                </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{137|url}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{137 | resource : 'menutitle'}</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{138|url}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{138 | resource : 'menutitle'}</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{139|url}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{139 | resource : 'menutitle'}</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{140|url}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{140 | resource : 'menutitle'}</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
                 <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                 <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
        </form>
</div>
</nav>

{*$_modx->runSnippet("!pdoMenu", [
'context' => $modx->context->key,
'parents' => 136,
'tplOuter' => '@INLINE <div class="dropdown-menu" aria-labelledby="navbarDropdown"><div class="container"><div class="row"><div class="col-md-4"><ul class="nav flex-column">[[+wrapper]]</ul></div></div></div></div>',
    'tpl' => '@INLINE <li class="nav-item"><a href="[[+link]]" class="nav-link" [[+attributes]]>[[+menutitle]]</a>[[+wrapper]]</li>',
'tplParentRow' => '@INLINE <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="[[+link]]" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            [[+menutitle]]
        </a>[[+wrapper]]</li>',

"includeTVs" => "access_vendor",
"where" => '[['~ $vw ~',{"OR:access_vendor:IS":null}]]',
])*}