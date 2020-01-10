<?php
include 'simplexlsx.class.php';

class Seodomains
{
    /** @var modX $modx */
    public $modx;
    public $user_id;
    public $token;

    /**
     * @param modX $modx
     * @param array $config
     */
    function __construct(modX &$modx, array $config = array())
    {
        $this->modx =& $modx;
        $corePath = MODX_CORE_PATH . 'components/seodomains/';
        $assetsUrl = MODX_ASSETS_URL . 'components/seodomains/';

        $this->config = array_merge(array(
            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',
            'processorsPath' => $corePath . 'processors/',
            'version' => '1.2.3',
            'connectorUrl' => $assetsUrl . 'connector.php',
            'assetsUrl' => $assetsUrl,
            'cssUrl' => $assetsUrl . 'css/',
            'jsUrl' => $assetsUrl . 'js/',
            'city_fields' => array_merge(['id'], explode(',', $this->modx->getOption('seodomains_city_fields')), ['actions'])
        ), $config);

        $this->modx->addPackage('seodomains', $this->config['modelPath']);
        $this->modx->lexicon->load('seodomains:default');
    }
     
    /**
     * Base fields
     * @return type
     */
    public function fields() {
        return array(
            1 => 'domain',
            2 => 'city',
            3 => 'city_r',
            4 => 'phone',
            5 => 'email',
            6 => 'address',
            7 => 'address_full',
            8 => 'address_coordinats',
        );
    }
    
    /**
     * GET
     * @param type $url
     * @param type $headers
     * @return type
     */
    public function get($url, $headers) {
	$handle=curl_init();
	curl_setopt($handle, CURLOPT_URL, $url);
	curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	$response=curl_exec($handle);
	$code=curl_getinfo($handle, CURLINFO_HTTP_CODE);
	
        return array("code"=>$code,"response"=>$response);
    }
    
    /**
     * POST
     * @param type $url
     * @param type $peremen
     * @param type $headers
     * @return type
     */
    public function post($url, $peremen, $headers) {
        $data=json_encode($peremen);
	
	$handle=curl_init();
	curl_setopt($handle, CURLOPT_URL, $url);
	curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($handle, CURLOPT_POST, true);
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
	$response=curl_exec($handle);
	$code=curl_getinfo($handle, CURLINFO_HTTP_CODE);
        
	return array("code"=>$code,"response"=>$response);
    }
    
    /**
     * Add site
     * @param type $host
     * @return type
     */
    public function addSite($host) {
        $this->token = $this->modx->getOption('seodomains_token');
        if ($this->token) {
            // save Yandex user_id
            if (!$this->modx->getOption('seodomains_user_id')) {
                $get = $this->get('https://api.webmaster.yandex.net/v4/user/', array('Authorization: OAuth '.$this->token));
                $YaResponse = $this->modx->fromJSON($get['response']);
                $this->user_id = $YaResponse['user_id'];

                $Setting = $this->modx->getObject('modSystemSetting', 'seodomains_user_id');
                $Setting->set('value', $this->user_id);
                $Setting->save();
            } else {
                $this->user_id = $this->modx->getOption('seodomains_user_id');
            }
            
            $response = $this->post("https://api.webmaster.yandex.net/v3/user/".$this->user_id."/hosts/", array('host_url'=>$host), array('Authorization: OAuth '.$this->token, 'Content-type: application/json;charset=UTF-8'));

            $json = (array)json_decode($response['response']);

            return $this->verification($json['host_id']);
        }
    }
    
    /**
     * Verification site
     * @param type $host_id
     * @return type
     */
    public function verification($host_id) {
        $response = $this->get("https://api.webmaster.yandex.net/v3/user/".$this->user_id."/hosts/".$host_id."/verification/", array('Authorization: OAuth '.$this->token));
        $json = (array)json_decode($response['response']);
        $uid = $json['verification_uin'];
        
        return $this->createHtml($uid, $host_id);
    }
    
    /**
     * Send verification
     * @param type $host_id
     */
    public function sendVerification($host_id) {
        $response = $this->post("https://api.webmaster.yandex.net/v3/user/".$this->user_id."/hosts/".$host_id."/verification/?verification_type=HTML_FILE", array(), array('Authorization: OAuth '.$this->token, 'Content-type: application/json;charset=UTF-8'));
        $json = (array)json_decode($response['response']);
    }

    /**
     * Create html file as resource
     * @param type $code
     * @param type $host_id
     * @return type
     */
    public function createHtml($code, $host_id) {
        $title = 'yandex_'.$code.'.html';
        $content = '<html> <head> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> </head> <body>Verification: '.$code.'</body> </html>';
        
        $count = $this->modx->getObject('modResource', array('uri' => $title));
        
        if (!(array)$count) {
            $data = array(
                'createdby' => 1,
                'parent' => $this->modx->getOption('seodomains_html_parent'),
                'template' => 0,
                'isfolder' => 0,
                'deleted' => 0,
                'published' => 1,
                'hidemenu' => 1,
                'searchable' => 0,
                'uri' => $title,
                'uri_override'=> 1,
                'pagetitle' => $title,
                'alias' => $title,
                'content' => $content,
                'richtext' => 0,
            );

            $response = $this->modx->runProcessor('resource/create', $data);
        }
        
        // Sleep 3 sec after send verification
        sleep(1);
                
        $this->sendVerification($host_id);
    }
    
    /**
     * Import
     * @param type $file
     * @param type $step
     * @return type
     */
    public function import($file, $step) {
        $xlsx = new SimpleXLSX(MODX_BASE_PATH . $file);
        $item = $xlsx->rows();
        
        $exel = array();
        
        if (!$item[$step][0]) {
            return $item[$step][0]; exit();
        }
        
        $data = array(
            'domain' => $item[$step][0],
            'https' => $item[$step][1],
            'city' => $item[$step][2],
            'city_r' => $item[$step][3],
            'phone' => $item[$step][4],
            'email' => $item[$step][5],
            'address' => $item[$step][6],
            'address_full' => $item[$step][7],
        );
        
        $response = $this->runProcessor('mgr/city/create', $data);
        
        if ($item[$step][8]) {
            foreach (json_decode($item[$step][8]) as $field) {
                if ($field->key && $field->value) {
                    $Morefields = $this->modx->newObject('SeodomainsMorefields');

                    $Morefields->set('domain', $response['object']['id']);
                    $Morefields->set('name', $field->name ?: $field->key);
                    $Morefields->set('key', $field->key);
                    $Morefields->set('value', $field->value);

                    $Morefields->save();
                }
            }
        }
        
        return $step+1;
    }
    
    /**
     * Run processor
     * @param type $name
     * @param type $params
     * @return type
     */
    public function runProcessor($name = '', $params = array()) {
        return $this->modx->runProcessor($name, $params, array('processors_path' => $this->config['processorsPath']))->response;
    }
    
    /**
     * Get coordinats
     * @param type $address
     * @return type
     */
    public function getCoordinats ($address) {
        $yandex = file_get_contents("https://geocode-maps.yandex.ru/1.x/?format=json&geocode=".$address);
        $json = json_decode($yandex, true);
        $output = str_replace(' ',',', $json["response"]["GeoObjectCollection"]["featureMember"][0]["GeoObject"]["Point"]["pos"]);
        $array = explode(",", $output);
        
        return  $array[1].','.$array[0];
    }
    
    /**
     * Get more fields
     * @param type $domain_id
     * @return type
     */
    public function getMorefields($domain_id) {
        /* @var pdoFetch $pdoFetch */
        if (!$pdo = $this->modx->getService('pdoFetch')) {
            return 'Could not load pdoFetch class!';
        }
        
        $response = $pdo->getCollection('SeodomainsMorefields', array('domain' => $domain_id));
        
        $output = [];
        
        if (count($response)) {
            foreach ($response as $item) {
                $output[$item['key']] = $item['value'];
            }
        }
        
        return $output;
    }
    
    /**
     * Duplicate morefields
     * @param type $old_item
     * @param type $new_item
     */
    public function duplicateMorefields($old_item, $new_item) {
        $fields = $this->modx->getCollection('SeodomainsMorefields', array('domain' => $old_item));
        
        if (count((array)$fields)) {
            foreach ($fields as $item) {
                $Morefields = $this->modx->newObject('SeodomainsMorefields');

                $Morefields->set('domain', $new_item);
                $Morefields->set('name', $item->name);
                $Morefields->set('key', $item->key);
                $Morefields->set('value', $item->value);

                $Morefields->save();
            }
        }
    }
    
    /**
     * Load custom js & css
     */
    public function loadCustomJsCss (){
        $this->modx->controller->addCss($this->config['cssUrl'] . 'mgr/seodomains.css?v='.$this->config['version']);
        $this->modx->controller->addJavascript($this->config['jsUrl'] . 'mgr/seodomains.js?v='.$this->config['version']);
        $this->modx->controller->addLastJavascript($this->config['jsUrl'] . 'mgr/utils/utils.js?v='.$this->config['version']);
        $this->modx->controller->addLastJavascript($this->config['jsUrl'] . 'mgr/utils/combo.js?v='.$this->config['version']);
        $this->modx->controller->addLastJavascript($this->config['jsUrl'] . 'mgr/widgets/resource.tab.js?v='.$this->config['version']);
        $this->modx->controller->addLastJavascript($this->config['jsUrl'] . 'mgr/widgets/resource.panel.js?v='.$this->config['version']);
        $this->modx->controller->addLastJavascript($this->config['jsUrl'] . 'mgr/widgets/resource.grid.js?v='.$this->config['version']);
        $this->modx->controller->addLastJavascript($this->config['jsUrl'] . 'mgr/widgets/resource.windows.js?v='.$this->config['version']);

        $this->modx->controller->addHtml('<script>
            Ext.onReady(function() {
                Seodomains.config = ' . json_encode($this->config) . ';
                Seodomains.config.connector_url = "' . $this->config['connectorUrl'] . '";
            });
        </script>');
        
        $this->modx->controller->addLexiconTopic('seodomains:default');
    }
    
    /**
     * Get city name by domain id
     * @param type $domain_id
     * @return type
     */
    public function getCityNameById($domain_id) {
        $response = $this->modx->getObject('SeodomainsCity', ['id' => $domain_id]);
        
        return $response->city;
    }
    
    /**
     * Get domain id by domain
     * @param type $domain
     * @return type
     */
    public function getDomainId($domain) {
        $response = $this->modx->getObject('SeodomainsCity', ['domain' => $domain]);
        
        if (!$response) return ;
        
        return $response->id;
    }

    /**
     * Get resource content 
     * @param type $domain
     * @param type $resource
     * @return type
     */
    public function getContent($domain, $resource) {
        $response = $this->modx->getObject('SeodomainsResource', ['domain' => $this->getDomainId($domain), 'resource' => $resource]);
        
        if (!$response) return ;
        
        return $response->content;
    }
}
