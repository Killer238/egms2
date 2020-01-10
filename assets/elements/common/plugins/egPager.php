<?php
// Реагируем только на событие OnPageNotFound
if ($modx->event->name == 'OnPageNotFound') {
    // Определяем ключ запроса из настроек
    $req = $modx->getOption('request_param_alias');
    // Ловим нужный ключ страницы
    $pageVarKey = 'page';
    
    // Если в запросе повторяется наш шаблон "pageVarKey-page", то работаем дальше
    if (preg_match("#.*?({$pageVarKey}-(\d+))#", $_REQUEST[$req], $matches)) {
        // Отрезаем ЧПУ строку и получаем точный адрес текущей страницы
        $uri = str_replace($matches[1], '', $matches[0]);

        // Ищем страницу по этому адресу
        $id = 0;
        // Сначала как есть, со слешем на конце
        if (!$id = $modx->findResource($uri)) {
            // Если не находим - то пробуем отрезать слэш и ищем повторно
            $id = $modx->findResource(rtrim($uri, '/'));
        }

        // Если ресурс найден
        if ($id) {
            // Добавляем номер страницы в глобальные массивы, чтобы pdoPage их там увидел
            $_GET[$pageVarKey] = $_REQUEST[$pageVarKey] = $matches[2];
            // И загружаем эту страницу
            $modx->sendForward($id);
        }
        // Если ресурс не был найден - ничего не делаем, возможно запрос поймает другой плагин
    }


}