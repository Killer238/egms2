<form action="{$pageId | url}" method="get" class="msearch2 form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="text" name="{$queryVar}" placeholder="Введите поисковую фразу" value="{$.get.query}" aria-label="Search">
    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Найти</button>
</form>