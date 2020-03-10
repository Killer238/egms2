<?php
/* @var modX $modx
 * @var array $scriptProperties
 **/

$event = $modx->event->name;

switch ($event) {

    case 'OnPageNotFound':
        if ($modx->context->key != 'mgr')
        {
            $alias = $modx->getOption('request_param_alias', null, 'alias', true);
            $request = &$_REQUEST[$alias];

            $dh = $modx->runSnippet('egDataHost');
            //TODO: искать товары в страницах перезда??

            //если слэша в конце нет,
            // то не ошибка
            //die($request);
            $get_val = "msoption|size";
            $tmp = explode('/', trim(ltrim($request, $dh['region']['product_category_url']), "/"));
            if (preg_match('/\/$/',$request))
            {
                // если подстрока каталога найдена в начале
                // то значит это товар и нужно попробовать найти
                //die("-".strpos($request, $dh['region']['product_category_url']));
                if(strpos($request, $dh['region']['product_category_url'])===0) {
                    //die($request);
                    //die($dh['region']['product_category_url']);

                    // извлекаем alias
                    $themplate = 0;
                    $product_alias = array_shift($tmp);
                    $thed = array_shift($tmp);

                    if ($product_alias) {
                        $resource = $modx->getObject('modResource', array('alias' => $product_alias, 'published'=>1));
                        if ($resource) {

                            if ($thed) {
                                // ищим в размерах
                                $sizes = $resource->get("size");
                                if (in_array($thed, $sizes))
                                {
                                    $_GET[$get_val] = $_REQUEST[$get_val] = $thed;
                                    $thed="ok";
                                }
                                //TODO: ищим в цветах

                                // страницы отзывов
                                if ($thed == 'reviews') {
                                    $themplate = 1;
                                    $_GET['reviews'] = 'reviews';
                                    $thed="ok";
                                }
                                // страницы доставок
                                if ($thed == 'delivery') {
                                    $_GET['delivery'] = 1;
                                    $themplate = 2;
                                    $thed="ok";
                                }
                                // страница характеристик
                                if ($thed == 'chars') {
                                    $themplate = 3;
                                    $thed="ok";
                                }
                                // если третья часть
                                // ничему не соответствует
                                // то выходим
                                if($thed=="ok")
                                {
                                    if ($content)
                                        $resource->set('content', $content);
                                    $modx->resource = $resource;
                                    $modx->request->prepareResponse();
                                    exit();
                                }
                            }else
                            {
                                if ($content)
                                    $resource->set('content', $content);
                                $modx->resource = $resource;
                                $modx->request->prepareResponse();
                                exit();
                            }
                        }
                    }
                }else{
                    $product_alias = array_shift($tmp);

                    $resource = $modx->getObject('modResource', array('alias' => $product_alias));
                    if($resource){
                        //если вторая секция изделие то 301 редирект
                        $url = '//'.$_SERVER['HTTP_HOST'].'/'.$dh['region']['product_category_url'].'/'.$request;
                        //die($url);
                        $modx->sendRedirect($url, array('responseCode' => 'HTTP/1.1 301 Moved Permanently'));
                    }
                }
            }
            //TODO: проверка на страницы из pages

        }
        break;

    case 'OnHandleRequest':
    case 'OnMODXInit':
    default:
        if ($modx->context->key == 'mgr') return;

    $host = $_SERVER['HTTP_HOST'];

    $modx->loadClass('egmsSites', MODX_CORE_PATH.'components/egms/model/egms/');
    //$modx->loadClass('egmsRegions', MODX_CORE_PATH.'components/egms/model/egms/');
    //$modx->loadClass('egmsDelivery', MODX_CORE_PATH.'components/egms/model/egms/');
    //$modx->setOption("site_url1", "https://".$host."/");
    //$modx->setOption("http_host1", $host);

    //die($modx->config->site_url);
    if($site = $modx->getObject("egmsSites", array('host'=> $host, 'published' => 1)))
    {
        $modx->switchContext($site->get('context'));
    }

    break;


}