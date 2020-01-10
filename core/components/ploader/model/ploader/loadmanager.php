<?php

//TODO: загрузка множественных картинок
//TODO: загрузка множественных коментариев

//TODO: загрузка артикуля
//TODO: загрузка мета информации из темы

//TODO: vendor через template
//TODO: генерировать арнтикль

class loadmanager
{

    public $modx;
    public $config = array();
    public $result;

    private $current_id_load;
    private $load_data;
    private $exist_flag;


    function __construct(modX &$modx, array $config = array())
    {

        require_once(MODX_CORE_PATH . 'components/ploader/classes/simple_html_dom.php');

        $this->modx =& $modx;
        $this->config = array(
            'param1' => 1,
            'param2' => 2,
        );
        $this->config = array_merge($this->config, $config);
        $this->exist_flag = 0;

    }

    private function productExist($id_pproduct)
    {

    }

    public function productCreate($id_pproduct)
    {
        $pproduct = null;
        $params = null;
        if($id_pproduct>0)
            $pproduct = $this->modx->getObject('plPproduct', $id_pproduct);
        if($pproduct){
            $id_product = $pproduct->get('id_product');
            if($id_product>0)
            {
                $this->result['errors'][] = array(
                    'code' => 202,
                    'id_pproduct' => $id_pproduct,
                    'message' => 'Товар уже создан id ='.$id_product);
                return;
            }
            //получение данных темы
            /*
            $id_theme = $pproduct->get('id_theme');
            $t = $this->modx->getObject("plPproductTheme", $id_theme);
            $p = json_decode($t->get('params'), true);
             */
            //создаем новый товар
            $data = array( 'class_key' => 'msProduct',
                'pagetitle' => $pproduct->get('name'),
                'longtitle' => $pproduct->get('name'),
                'parent' => $pproduct->get('id_category'),
                'template' => 6, //TODO: тему из таблицы
                'vendor' => $pproduct->get('id_manufacturer'),
                );


            $response = $this->modx->runProcessor('resource/create', $data);
            if ($response->isError()) { // Проверка на ошибки
                $this->result['errors'][] = array(
                    'code' => 205,
                    'id_pproduct' => $pproduct->get('id_pproduct'),
                    'message' => 'ошибка при создании товара'); // $modx->error->failure($response->getMessage()) $response->getMessage());
                return;
            }

            //получаем и сохраняем id нового товара
            $id_product = $response->response['object']['id'];
            $pproduct->set('id_product', $id_product);
            $pproduct->save();

            // получаем лоадеры для загрузки прочих данных
            $load_params['load_name'] = $pproduct->get('name');
            $load_params['load_description'] = $pproduct->get('load_description');
            $load_params['load_price'] = $pproduct->get('load_price');
            $load_params['load_images'] = $pproduct->get('load_images');
            $load_params['load_features'] = $pproduct->get('load_features');
            $load_params['load_consistions'] = $pproduct->get('load_consistions');
            $load_params['load_reviews'] = $pproduct->get('load_reviews');

            $this->loadContent($pproduct->get('id_product'), $load_params, $load_params);

        }
        else
            $this->result['errors'][] = array(
                'code' => 201,
                'id_pproduct' => $id_pproduct,
                'message' => 'Товара не существует!');

    }

    private function updateResourseData($resId, $new_date)
    {
        if($doc = $this->modx->getObject('modResource', $resId)){
            $data = $doc->toArray();
            foreach ($new_date as $key => $v)
                $data[$key] = $v;
            $response = $this->modx->runProcessor('resource/update', $data);
            $t = 0;
            //TODO: add error to log
        }
    }

    private function loadContent($id_product, $loads, $load_params, $params = null)
    {

        if($load_params['load_name'])
        {
            //$this->getContentLoad($loads['load_name'], $params);

            $data = array(
                'pagetitle' => $load_params['load_name'],
                'longtitle' => $load_params['load_name'],
                //'alias' => '','uri' => '' // uncomment for alias update
            );
           $this->updateResourseData($id_product, $data);

        }

        //load_description
        if($load_params['load_description'])
        {
            $this->getContentLoad($loads['load_description'], $params);
            $data = array(
                'content' => $this->load_data[$loads['load_description']]['description'],
            );
            $this->updateResourseData($id_product, $data);

        }

        //load_images
        if($load_params['load_images'])
        {
            // if (is_array($loads['load_images'])
            $this->getContentLoad($loads['load_images'], $params);

            $images_arr = $this->load_data[$loads['load_images']]['product_images'];
            foreach ($images_arr as $image)
            {
                $i = array(
                    'id' => $id_product,
                    'name' => $this->load_data[$loads['load_name']]['product_name'],
                    'file' => $image,
                );
                $response = $this->modx->runProcessor('gallery/upload',
                    $i,
                    array('processors_path' => MODX_CORE_PATH.'components/minishop2/processors/mgr/')
                );
            }


        }

        //load_price
        if($load_params['load_price'])
        {
            $this->getContentLoad($loads['load_price'], $params);

            // обновляем цену
            $data = array(
                'price' => $this->load_data[$loads['load_price']]['price']['price'],
                'old_price' => $this->load_data[$loads['load_price']]['price']['old_price'],
            );
            $this->updateResourseData($id_product, $data);

            //delete модификации
            $this->modx->call('msopModification', 'removeProductModification', array(&$this->modx, $id_product, array(array())));
            //создаем модификации
            $modification = $this->load_data[$loads['load_price']]['price']['modifications'];
            if($modification)
            {
                $this->modx->call('msopModification',
                    'saveProductModification',
                    array(&$this->modx, $id_product, $modification));
            }
        }

        //load_features
        if($load_params['load_features'])
        {
            $this->getContentLoad($loads['load_features'], $params);
            $load = $this->modx->getObject('plLoads', array('id' => $loads['load_features']));
            $this->featureProductUpdate($id_product, $loads['load_features'], $load->get('provider'));
        }

        //load_consistions

        //load_reviews

        return 'product created or updated';
    }

    private function featureProductUpdate($id_product, $id_load, $provider_name)
    {
        foreach ($this->load_data[$id_load]['features'] as $feature) {

            $select = array(
                'provider' => $provider_name,
                'feature_load_name' => $feature['name'],
                'feature_load_value' => $feature['value'],
//                'feature_value' => $feature['value'],
                'published' => 1,
            );

            $cf = $this->modx->getCollection('plPproductFeatureMap', $select);
            foreach ($cf as $c)
            {
                $k = $c->get('key');
                if(trim($k)=='')
                    continue;
                if(trim($c->get('feature_value'))=='')
                    continue;

                $select_po = array(
                    'key' => $c->get('key'),
                    'product_id' => $id_product,
                );
                if($po = $this->modx->getObject('msProductOption', $select_po)) {
                    //update
                    $nv = $c->get('feature_value');
                    if($nv != $po->get('value'))
                    {
                        $q = $this->modx->newQuery('msProductOption');
                        $q->command('UPDATE');
                        $q->where($select_po);
                        $q->set(array('value' => $nv));
                        $q->prepare();
                        $q->stmt->execute();
                    }

                }else
                {
                    //insert
                    $select_po['value'] = $c->get('feature_value');
                    $po = $this->modx->newObject('msProductOption');
                    $po->fromArray($select_po);
                    $po->save();
                }
            }
        }
    }

    public function getContentLoad($id_load, $params = null)
    {
        $load = $this->modx->getObject('plLoads', $id_load);
        $provider_name = $load->get('provider');

        // если предыдущий провайдер не равен текущему
        if($this->current_id_load != $id_load)
        {
            // получаем данные с провайдера
            require_once(MODX_CORE_PATH . 'components/ploader/classes/providers/' . $provider_name . '.php');
            $provider = new $provider_name($provider_name);

            //получаем контент с учетом кэширования и прокси
            $provider->getContent($load->get('url'), $id_load, "prod", $params['proxy'], $params['cache']);

            $this->current_id_load = $id_load;
            $provider->getAllData();

            // кэшируем изображения
            if($params['image_cache'])
                $provider->saveImagesToCache();

            // доставем картинки из кэша
            // если картинка отсутствует, то тянем из сети
            if($params['cache'])
                $provider->getImagesFromCache();

            $this->load_data[$id_load] = $provider->extractDataResult;

            //category
            $this->categorySave($id_load, $provider_name);
            //сохраняем характеристики
            $this->featuresSave($id_load, $provider_name);

            $this->manufacturerSave($id_load, $provider_name);

            //сохраняем состав
            $this->consistenceSave($id_load, $provider_name);

            //сохраняем отзывы
            $this->reviewsSave($id_load, $provider_name);
        }
        return $this->load_data[$id_load];
    }

    private function consistenceSave($id_load, $provider_name)
    {

    }

    private function reviewsSave($id_load, $provider_name)
    {

    }

    private function categorySave($id_load, $provider_name)
    {
        $cd = $this->load_data[$id_load]['catdat'];
        $bc = implode('/', $cd['breadcrumbs']);
        if($cd)
        {
            $c_s = array(
                'provider' => $provider_name,
                'category_bread' => $bc,
                'category_name' =>  $cd['category'],
            );
            if($f = $this->modx->getObject('plCategoryMap', $c_s))
            {
                $c_id = $f->get('id');
                $this->ploaderUpadteField($id_load, $c_id, 'id');
                $this->ploaderUpadteField($id_load, $bc, 'breadcrumbs');
            }else
            {
                $f = $this->modx->newObject('plCategoryMap');
                $c_s['id_category'] = 0;
                $f->fromArray($c_s);
                $f->save();

                $this->ploaderUpadteField($id_load, $f->get('id'), 'id_category_map');
                $this->ploaderUpadteField($id_load, $bc, 'breadcrumbs');
            }
        }else
        {
            $this->result['errors'][] = array(
                'code' => 701,
                'message' => 'Category not found for '.$id_load.'!');
        }
    }

    private function manufacturerSave($id_load, $provider_name)
    {
        $m = $this->load_data[$id_load]['manufacturer'];
        if ($m)
        {
            $f_s = array(
                'name_manufacturer' => $m,
                'provider' => $provider_name,
            );
            if($f = $this->modx->getObject('plManufacturerMap', $f_s))
            {
                $m_id = $f->get('id');
                $this->ploaderUpadteField($id_load, $m_id, 'id_manufacturer_map');
            }else
            {
                $f = $this->modx->newObject('plManufacturerMap');
                $f_s['id_manufacturer'] = 0;
                $f->fromArray($f_s);
                $f->save();
                $this->ploaderUpadteField($id_load, $f->get('id'), 'id_manufacturer_map');
            }
        }else
        {
            $this->result['errors'][] = array(
                'code' => 702,
                'message' => 'Manufacturer not found for '.$id_load.'!');
        }
    }

    private function ploaderUpadteField($id_load, $id_m, $f_name)
    {
        $l = $this->modx->getObject('plLoads', $id_load);
        $l->set($f_name, $id_m);
        $l->save();
    }

    private function featuresSave($id_load, $provider_name)
    {

        foreach ($this->load_data[$id_load]['features'] as $feature) {

            $select = array(
                'provider' => $provider_name,
                'feature_load_name' => $feature['name'],
                'feature_load_value' => $feature['value'],
                'feature_value' => $feature['value'],
            );

            if (!$option = $this->modx->getObject('plPproductFeatureMap', $select)) {
                $option = $this->modx->newObject('plPproductFeatureMap');
                $option->fromArray($select);
                $option->save();
            }
        }

    }

    public function createCache($id_load, $params)
    {
        $load = $this->modx->getObject('plLoads', $id_load);

        $this->getContentLoad($id_load, $params);
        $dt = date('Y-m-d H:i:s');
        $load->set('url_product_name', $this->load_data[$id_load]['product_name']);
        $load->set('page_type', $this->load_data[$id_load]['page_type']);
        $load->set('load_datetime', $dt);
        $load->set('log', 'create cache - '.$dt);
        //TODO: write log
        $load->save();

        $this->result['result'][] = "created cache for id_load = ".$id_load;

    }

    public function loadData($id_load, $params)
    {
        // работаем только с кэшем
        if(!$params['cache'])
            $params['cache'] = true;

        $this->getContentLoad($id_load, $params);
    }


    public function updateProductContent($id_pproduct, $load_params, $params = null)
    {

        $select = array(
                'id' => $id_pproduct,
                'id_product>:' => 0
            );
        $products = $this->modx->getCollection('plPproduct', $select);

        foreach ($products as $product) {

            $id_product = $product->get('id_product');

            if ($id_product == 0)
            {
                $this->result['errors'][] = array(
                    'code' => 501,
                    'message' => 'product is 0!');
                $error_flag = true;
            }

            if ($product->get('id_category')==0)
            {
                $this->result['errors'][] = array(
                    'code' => 502,
                    'message' => 'category not defined!');
                $error_flag = true;
            }

            if ($product->get('id_manufacturer')==0)
            {
                $this->result['errors'][] = array(
                    'code' => 503,
                    'message' => 'Manufacturer not defined!');
                $error_flag = true;
            }
            /*
            if ($product->get('id_theme')==0)
            {
                $this->result['errors'][] = array(
                    'code' => 504,
                    'message' => 'theme not defined!');
                $error_flag = true;
            }

            if (trim($product->get('load_params')) == '')
            {
                $this->result['errors'][] = array(
                    'code' => 505,
                    'message' => 'load params is not defined!');
                $error_flag = true;
            }

            if ($product->get('id_theme') ==0)
            {
                $this->result['errors'][] = array(
                    'code' => 506,
                    'message' => 'not active!');
                $error_flag = true;
            }
*/
            if(!$error_flag)
            {
                $loads['load_name'] = $product->get('name');
                $loads['load_description'] = $product->get('load_description');
                $loads['load_price'] = $product->get('load_price');
                $loads['load_images'] = $product->get('load_images');
                $loads['load_features'] = $product->get('load_features');
                $loads['load_consistions'] = $product->get('load_consistions');
                $loads['load_reviews'] = $product->get('load_reviews');

                //$loads = json_decode($product->get('load_params'), true);
                $this->loadContent($id_product, $loads, $load_params, $params);
            }
        }
    }



    public function pProductCreate($id_load, $params = null)
    {
        $this->result = array();
        //получаем лоадеры
        if($id_load== null && $params == null)
            // выбираем новых активных закэшированныйх
            $params = array('page_type' => 'PRODUCT', 'id_pproduct' => 0, 'id_category:>' => '0', 'id_manufacturer:>' => '0', 'published' => 1);
        $new_id = 0;
        $loads = $this->getLoads($id_load, $params);
        $error_flag = false;
        foreach ($loads as $load)
        {
            if($load['plLoads_page_type']=='NEW')
            {
                $this->result['errors'][] = array(
                    'code' => 401,
                    'message' => 'Cache not created yet!');
                $error_flag = true;
            }
            // если лоадер
            if ($load['plLoads_id_pproduct']>0)
            {
                $this->result['errors'][] = array(
                    'code' => 402,
                    'message' => 'product exist!');
                $error_flag = true;
            }

            $category_map = $this->getCategoryMap($load['plLoads_id_category_map']);
            if ($category_map==0)
            {
                $this->result['errors'][] = array(
                    'code' => 403,
                    'message' => 'category not mapped!');
                $error_flag = true;
            }

            $manufacturer_map = $this->getManufacturerMap($load['plLoads_id_manufacturer_map']);
            if ($manufacturer_map==0)
            {
                $this->result['errors'][] = array(
                    'code' => 404,
                    'message' => 'Manufacturer not mapped!');
                $error_flag = true;
            }

            /*if ($load['plLoads_id_theme']==0)
            {
                $this->result['errors'][] = array(
                    'code' => 405,
                    'message' => 'theme not defined!');
                $error_flag = true;
            }*/

            if ($load['plLoads_published']==0)
            {
                $this->result['errors'][] = array(
                    'code' => 406,
                    'message' => 'not published!');
                $error_flag = true;
            }
            $o = $this->modx->getObject('plLoads', $load['plLoads_id']);
            $log ='';
            if (!$error_flag)
            {
                $new_id = $this->addPproduct(
                    $load['plLoads_id'],
                    $load['plLoads_url_product_name'],
                    $category_map,
                    $manufacturer_map,
                    $load['plLoads_id_theme']
                );

                $o->set('id_pproduct', $new_id);
                $log = 'add prod ';
            }else
            {
                $log = 'errors';
            }
            $o->set('action', 0);
            $dt = date('Y-m-d H:i:s');
            $o->set('load_datetime', $dt);
            $o->set('log', $log);
            //TODO: add to writelog
            $o->save();
        }
        return $new_id;
    }

    private function getCategoryMap($categoryMap)
    {
        $c = $this->modx->getObject("plCategoryMap", $categoryMap);
        return $c->get("id_category");
    }

    private function getManufacturerMap($manufacturerMap)
    {
        $m = $this->modx->getObject("plManufacturerMap", $manufacturerMap);
        return $m->get("id_manufacturer");
    }

    private function addPproduct($id_load, $name, $id_category, $id_manufacturer, $id_theme = 0)
    {
        $table = $this->modx->getTableName('plPproduct');

        $sql = "INSERT INTO {$table} (
                            `name`, 
                            `id_product`, 
                            `id_category`, 
                            `id_manufacturer`, 
                            `id_theme`, 
                            `load_params`, 
                            `load_description`,
                            `load_price`,
                            `load_images`,
                            `load_features`,
                            `load_consistions`,
                            `load_reviews`,
                            `load_datetime`, 
                            `published`, 
                            `action`,
                            `log`) 
                                    VALUES (
                                    :name, 
                                    :id_product, 
                                    :id_category, 
                                    :id_manufacturer, 
                                    :id_theme, 
                                    :load_params, 
                                    :load_description,
                                    :load_price,
                                    :load_images,
                                    :load_features,
                                    :load_consistions,
                                    :load_reviews,
                                    :load_datetime, 
                                    :published, 
                                    0,
                                    :log);";

        $stmt = $this->modx->prepare($sql);
        $dt = date('Y-m-d H:i:s');
        $load_params = json_encode(array(
                'load_description' => $id_load,
                'load_price' => $id_load,
                'load_images' => $id_load,
                'load_features' => $id_load,
                'load_consistions' => $id_load,
                'load_reviews' => $id_load));

        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':id_product', 0);
        $stmt->bindValue(':id_category', $id_category);
        $stmt->bindValue(':id_manufacturer', $id_manufacturer);
        $stmt->bindValue(':id_theme', 0);
        $stmt->bindValue(':load_params', $load_params);
        $stmt->bindValue(':load_description', $id_load);
        $stmt->bindValue(':load_price', $id_load);
        $stmt->bindValue(':load_images', $id_load);
        $stmt->bindValue(':load_features', $id_load);
        $stmt->bindValue(':load_consistions', $id_load);
        $stmt->bindValue(':load_reviews', $id_load);
        $stmt->bindValue(':load_datetime', $dt);
        $stmt->bindValue(':published', 1);
        $stmt->bindValue(':log', "product created - from id - ".$id_load." at ". $dt);

        $stmt->execute();

        $stmt->closeCursor();

        return $this->modx->lastInsertId();

    }

    public  function printErrors()
    {
        if($this->result['errors'])
            foreach ($this->result['errors'] as $r)
                print '     ERROR: code '.$r['code']. '; message: '. $r['message']. '; url: '. $r['url']."\n";
    }

    public function loadConnectors($provider_name, $id_connector = null, $params = null)
    {
        if($provider_name && $id_connector == null)
            if($params['exist_url'] && $this->exist_flag == 0)
            {
                $s = array(
                    'provider' => $provider_name,
                    'published' => 1
                );
                $q = $this->modx->newQuery('plLoads');
                $q->command('UPDATE');
                $q->where($s);
                $q->set(array('exist_url' => 0));
                $q->prepare();
                $q->stmt->execute();

                $this->exist_flag = 1;
            }

        //$this->result = array('connectors' => 0, 'founded' => 0, 'added' => 0, 'exists' => 0);
        //получаем коннектор или коннекторы по одному провайщдеру
        $connectors = $this->getConnectors($provider_name, $id_connector);

           //$this->result['connectors'] += count($connectors);

            // получить коллекцию для закгрузки
            require_once(MODX_CORE_PATH . 'components/ploader/classes/providers/' . $provider_name . '.php');

            $loads = array();
            $provider = new $provider_name($provider_name);

            // перебираем коннекторы
            foreach ($connectors as $connector) {
                if($connector['plConnectors_published']>0){
                    //получаем контент с учетом кэширования и прокси
                    $provider->getContent($connector['plConnectors_url_sitemap'], $connector['plConnectors_id'], "conn", $params['proxy'], $params['cache']);
                    //если контент ок
                    if(!$provider->errors){

                        $loads[$connector['plConnectors_id']] = $provider->getSitemap();
                        $this->result[$connector['plConnectors_id']]['messages'][] = 'load added';
                        //$loads_tmp = $provider->getSitemap();//$connector['plConnectors_connection_type']);
                        //$loads = array_merge($loads, $loads_tmp);
                    }
                    else
                        foreach ($provider->errors as $err)
                            $this->result[$connector['plConnectors_id']]['errors'][]= $err;
                    //обновляем дату по коннектору и записываем лог
                }else{
                    $this->result[$connector['plConnectors_id']]['errors'][]= 'Connecot unpablished!';
                }
            }

            //$this->result['founded'] += count($loads);
            // перебираем коллекцию
            foreach ($loads as $con => $urls)
            {
                foreach ($urls as $url)
                {
                    //если урла нет, то добавляем его
                    if(!$l = $this->modx->getObject('plLoads', array('url' => $url)))
                    {
                        $this->addLoad($url, $provider_name);
                    }else{
                        $l->set('exist_url',1);
                        $l->save();
                        $this->result['exists'] += 1;
                    }
                }
            }

        $this->WriteLog('plConnectors');
    }

    private function WriteLog($type)
    {
        if($type=='plConnectors')
        {
           foreach ($this->result as $id_c =>$v)
           {
               if($c = $this->modx->getObject($type, $id_c))
               {
                   $log = $c->get('log');

                   $log_arr = explode("\r\n", $log);
                   $dt = date('Y-m-d H:i:s');
                   $row = "load ok - ".$dt;
                   array_unshift($log_arr, $row);
                   $log = implode("\r\n", $log_arr);
                   $c->set('log', $log);
                   $c->set('load_datetime', $dt);
                   $c->set('action', 0);
                   $c->save();

                   //TODO: пишем
                   // actio || дата || кол-во || сообщение
                   // ADD || date || 1 || добавлено
                   // ниже добавленные ИД
                   // ERR
                   //TODO: добавить запись в лог, если ничего не добавлено, то просто поставить дату и написать что ничего не добавлено, что бы лог не рос
               }
           }
        }
    }



    private function addLoad($url, $provider)
    {
        $table = $this->modx->getTableName('plLoads');

        $sql = "INSERT INTO {$table} (`url`, `page_type`, `id_pproduct`, `url_product_name`,
                                    `provider`, `id_category_map`, `id_manufacturer_map`, `exist_url`, `load_datetime`, `published`) 
                                    VALUES (:url, :page_type, :id_pproduct, :url_product_name, :provider, 
                                    :id_category_map, :id_manufacturer_map, :exist_url, :published);";
        $stmt = $this->modx->prepare($sql);

        $stmt->bindValue(':url', $url);
        $stmt->bindValue(':page_type', 'NEW');
        $stmt->bindValue(':id_pproduct', 0);
        $stmt->bindValue(':url_product_name', '-');
        $stmt->bindValue(':provider', $provider);
        $stmt->bindValue(':id_category_map', 0);
        $stmt->bindValue(':id_manufacturer_map', 0);
        $stmt->bindValue(':load_datetime', date('Y-m-d H:i:s'));
        $stmt->bindValue(':exist_url', 1);
        $stmt->bindValue(':published', 1);

        $stmt->execute();

        $stmt->closeCursor();

        $this->result['added'] += 1;
    }

    public function getConnectors($provider, $id_connector=null)
    {
        $restiction = array( 'provider' => $provider);
        if($id_connector!=null)
            $restiction = array_merge($restiction,array('id'=> $id_connector));

        $q = $this->modx->newQuery('plConnectors');
        $q->where($restiction);
        $a = array();
        if ($q->prepare() && $q->stmt->execute()) {
            while ($row = $q->stmt->fetch(PDO::FETCH_ASSOC)) {
                    $a[] = $row;
            }
        }
        return $a;
    }

    private function getLoads($id_load=null, $params=null)
    {
        $restiction = array();

        if($id_load!=null)
            $restiction = array( 'id' => $id_load);

        if($params!=null)
            $restiction = array_merge($restiction, $params);

        $q = $this->modx->newQuery('plLoads');
        $q->where($restiction);
        $a = array();
        if ($q->prepare() && $q->stmt->execute()) {
            while ($row = $q->stmt->fetch(PDO::FETCH_ASSOC)) {
                $a[] = $row;
            }
        }
        return $a;
    }
}