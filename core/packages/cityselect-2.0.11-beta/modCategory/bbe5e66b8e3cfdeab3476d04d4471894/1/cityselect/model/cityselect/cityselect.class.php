<?php

//ini_set('display_errors', 1);
//ini_set('error_reporting', -1);

/**
 * The base class for citySelect.
 */
class citySelect
{
    /* @var modX $modx */
    public $modx;

    /** @var mixed|null $namespace */
    public $namespace = 'cityselect';
    /** @var string $version */
    public $version = '2.0.11-beta';

    /** @var array $config */
    public $config = array();
    /** @var array $initialized */
    public $initialized = array();
    /** @var array $placeholders */
    public $placeholders = array();

    /** @var pdoFetch $pdoTools */
    public $pdoTools;

    /** @var array $settlement */
    private $settlement;

    /** @var array $settlement */
    private $glelement;

    /**
     * @param modX $modx
     * @param array $config
     */
    function __construct(modX &$modx, array $config = array())
    {
        $this->modx =& $modx;

        $corePath = $this->getOption('core_path', $config,
            $this->modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/cityselect/');
        $assetsPath = $this->getOption('assets_path', $config,
            $this->modx->getOption('assets_path', null, MODX_ASSETS_PATH) . 'components/cityselect/');
        $assetsUrl = $this->getOption('assets_url', $config,
            $this->modx->getOption('assets_url', null, MODX_ASSETS_URL) . 'components/cityselect/');
        $connectorUrl = $assetsUrl . 'connector.php';

        $this->config = array_merge(array(
            'namespace'       => $this->namespace,
            'connectorUrl'    => $connectorUrl,
            'assetsBasePath'  => MODX_ASSETS_PATH,
            'assetsBaseUrl'   => MODX_ASSETS_URL,
            'assetsPath'      => $assetsPath,
            'assetsUrl'       => $assetsUrl,
            'actionUrl'       => $assetsUrl . 'action.php',
            'cssUrl'          => $assetsUrl . 'css/',
            'jsUrl'           => $assetsUrl . 'js/',
            'corePath'        => $corePath,
            'modelPath'       => $corePath . 'model/',
            'processorsPath'  => $corePath . 'processors/',
            'jsonResponse'    => true,
            'prepareResponse' => true,
            'showLog'         => false,
        ), $config);

        $this->modx->addPackage('cityselect', $this->getOption('modelPath'));
        $this->modx->lexicon->load('cityselect:default');
        $this->namespace = $this->getOption('namespace', $config, 'cityselect');

        $this->config = array_merge(array(
            'settlement' => & $_SESSION[$this->namespace]['settlement'],
            'glelement'  => & $_SESSION['gl']['opts'],
        ), $this->config);
        $this->settlement = &$this->config['settlement'];
        if (empty($this->settlement) OR !is_array($this->settlement)) {
            $this->settlement = array();
        }

        $this->glelement = &$this->config['glelement'];
        if (empty($this->glelement) OR !is_array($this->glelement)) {
            $this->glelement = array();
        }

        if ($this->pdoTools = $this->modx->getService('pdoFetch')) {
            $this->pdoTools->setConfig($this->config);
        } else {
            return false;
        }
    }


    /**
     * @param       $n
     * @param array $p
     */
    public function __call($n, array $p)
    {
        echo __METHOD__ . ' says: ' . $n;
    }

    /**
     * @param       $key
     * @param array $config
     * @param null $default
     *
     * @return mixed|null
     */
    public function getOption($key, $config = array(), $default = null, $skipEmpty = false)
    {
        $option = $default;
        if (!empty($key) AND is_string($key)) {
            if ($config != null AND array_key_exists($key, $config)) {
                $option = $config[$key];
            } else if (array_key_exists($key, $this->config)) {
                $option = $this->config[$key];
            } else if (array_key_exists("{$this->namespace}_{$key}", $this->modx->config)) {
                $option = $this->modx->getOption("{$this->namespace}_{$key}");
            }
        }
        if ($skipEmpty AND empty($option)) {
            $option = $default;
        }

        return $option;
    }

    /**
     * Initializes component into different contexts.
     *
     * @param string $ctx The context to load. Defaults to web.
     * @param array $scriptProperties
     *
     * @return boolean
     */
    public function initialize($ctx = 'web', $scriptProperties = array())
    {
        if (isset($this->initialized[$ctx])) {
            return $this->initialized[$ctx];
        }

        $this->config = array_merge($this->config, $scriptProperties, array('ctx' => $ctx));

        if ($ctx != 'mgr' AND (!defined('MODX_API_MODE') OR !MODX_API_MODE)) {
            $this->loadResourceJsCss($scriptProperties);
        }

        /*  if (!defined('MODX_API_MODE') OR !MODX_API_MODE) {
              if ($this->modx->context->key != 'mgr') {

              }
          }*/

        $initialize = true;
        $this->initialized[$ctx] = $initialize;

        return $initialize;
    }

    public function loadResourceJsCss(array $scriptProperties = array())
    {
        $pls = $this->placeholders = $this->makePlaceholders($this->config);

        /**************************************************/
        if (!empty($this->config['bootstrapModalJsCss'])) {
            $css = $this->getOption('bootstrapModalCss', $scriptProperties);
            $this->regClientCSS($css);
            $js = $this->getOption('bootstrapModalJs', $scriptProperties);
            $this->regClientScript($js);
        }
        if (!empty($this->config['bootstrapPopoverJsCss'])) {
            $css = $this->getOption('bootstrapPopoverCss', $scriptProperties);
            $this->regClientCSS($css);
            $js = $this->getOption('bootstrapPopoverJs', $scriptProperties);
            $this->regClientScript($js);
        }
        if (!empty($this->config['bootstrapTabJsCss'])) {
            $css = $this->getOption('bootstrapTabCss', $scriptProperties);
            $this->regClientCSS($css);
            $js = $this->getOption('bootstrapTabJs', $scriptProperties);
            $this->regClientScript($js);
        }
        if (!empty($this->config['selectizeJsCss'])) {
            $css = $this->getOption('selectizeCss', $scriptProperties);
            $this->regClientCSS($css);
            $js = $this->getOption('selectizeJs', $scriptProperties);
            $this->regClientScript($js);
        }

        /**************************************************/

        $css = $this->getOption('frontCss', $scriptProperties, $this->modx->getOption('cityselect_front_css', null),
            true);
        $this->regClientCSS($css, $this->version);

        $js = $this->getOption('frontJs', $scriptProperties, $this->modx->getOption('cityselect_front_js', null), true);
        $this->regClientScript($js, $this->version);

        $action = trim($this->getOption('actionUrl', null, '[[+assetsUrl]]action.php'));
        $assetsUrl = trim($this->getOption('assetsUrl', null, '[[+assetsUrl]]'));

        $config = json_encode(array(
            'actionUrl' => str_replace($pls['pl'], $pls['vl'], $action),
            'assetsUrl' => str_replace($pls['pl'], $pls['vl'], $assetsUrl),
            'ctx'       => $this->modx->context->get('key'),
            'version'   => $this->version,
        ), true);

        $this->regClientStartupScript("<script type=\"text/javascript\">citySelectConfig={$config};</script>", true);
    }

    public function regClientStartupScript($src, $plaintext)
    {
        $src = trim($src);
        if (!empty($src)) {
            $this->modx->regClientStartupScript($src, $plaintext);
        }
    }

    public function regClientScript($src, $version = '')
    {
        $src = trim($src);
        if (!empty($src)) {
            if (!empty($version)) {
                $version = '?v=' . dechex(crc32($version));
            } else {
                $version = '';
            }

            // check is load
            if (empty($version)) {
                $tmp = preg_replace('/\[\[.*?\]\]/', '', $src);
                foreach ($this->modx->loadedjscripts as $script => $v) {
                    if (strpos($script, $tmp) != false) {
                        return;
                    }
                }
            }

            $pls = $this->placeholders;
            if (empty($pls)) {
                $pls = $this->placeholders = $this->makePlaceholders($this->config);
            }

            $src = str_replace($pls['pl'], $pls['vl'], $src);
            $this->modx->regClientScript($src . $version, false);
        }
    }

    public function regClientCSS($src, $version = '')
    {
        $src = trim($src);
        if (!empty($src)) {
            if (!empty($version)) {
                $version = '?v=' . dechex(crc32($version));
            } else {
                $version = '';
            }

            // check is load
            if (empty($version)) {
                $tmp = preg_replace('/\[\[.*?\]\]/', '', $src);
                foreach ($this->modx->loadedjscripts as $script => $v) {
                    if (strpos($script, $tmp) != false) {
                        return;
                    }
                }
            }

            $pls = $this->placeholders;
            if (empty($pls)) {
                $pls = $this->placeholders = $this->makePlaceholders($this->config);
            }

            $src = str_replace($pls['pl'], $pls['vl'], $src);
            $this->modx->regClientCSS($src . $version, null);
        }
    }

    /**
     * return lexicon message if possibly
     *
     * @param string $message
     *
     * @return string $message
     */
    public function lexicon($message, $placeholders = array())
    {
        $key = '';
        if ($this->modx->lexicon->exists($message)) {
            $key = $message;
        } else if ($this->modx->lexicon->exists($this->namespace . '_' . $message)) {
            $key = $this->namespace . '_' . $message;
        }
        if ($key !== '') {
            $message = $this->modx->lexicon->process($key, $placeholders);
        }

        return $message;
    }

    public function explodeAndClean($array, $delimiter = ',')
    {
        $array = explode($delimiter, $array);     // Explode fields to array
        $array = array_map('trim', $array);       // Trim array's values
        $array = array_keys(array_flip($array));  // Remove duplicate fields
        $array = array_filter($array);            // Remove empty values from array

        return $array;
    }

    /**
     * @param        $array
     * @param string $delimiter
     *
     * @return array|string
     */
    public function cleanAndImplode($array, $delimiter = ',')
    {
        $array = array_map('trim', $array);       // Trim array's values
        $array = array_keys(array_flip($array));  // Remove duplicate fields
        $array = array_filter($array);            // Remove empty values from array
        $array = implode($delimiter, $array);

        return $array;
    }

    /** @inheritdoc} */
    public function flattenArray(array $array = array(), $prefix = '')
    {
        $outArray = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $outArray = $outArray + $this->flattenArray($value, $prefix . $key . '.');
            } else {
                $outArray[$prefix . $key] = $value;
            }
        }

        return $outArray;
    }

    public function runProcessor($action = '', $data = array())
    {
        if (empty($action)) {
            return false;
        }
        if ($this->modx->context->get('key') !== 'mgr') {
            $action = 'web/' . $action;
        }
        if ($error = $this->modx->getService('error', 'error.modError')) {
            $error->reset();
        }
        $processorsPath = !empty($this->config['processorsPath']) ? $this->config['processorsPath'] : MODX_CORE_PATH;
        /* @var modProcessorResponse $response */
        $response = $this->modx->runProcessor($action, $data, array('processors_path' => $processorsPath));

        return $this->prepareResponse($response);
    }

    public function prepareResponse($response)
    {
        if ($response instanceof modProcessorResponse) {
            $output = $response->getResponse();
            if ($response->isError()) {
                header('HTTP/1.1 400 Bad Request');
            }
        } else {
            header('HTTP/1.1 400 Bad Request');
            $output = $this->failure($response);
        }

        return $output;
    }


    /**
     * @param string $message
     * @param array $data
     * @param array $placeholders
     *
     * @return array|string
     */
    public function failure($message = '', $data = array(), $placeholders = array())
    {
        $response = array(
            'success' => false,
            'message' => $this->lexicon($message, $placeholders),
            'data'    => $data,
        );

        return $response;
    }

    /**
     * @param string $message
     * @param array $data
     * @param array $placeholders
     *
     * @return array|string
     */
    public function success($message = '', $data = array(), $placeholders = array())
    {
        $response = array(
            'success' => true,
            'message' => $this->lexicon($message, $placeholders),
            'data'    => $data,
        );

        return $response;
    }

    /** {@inheritDoc} */
    public function getSettlement()
    {
        return $this->settlement;
    }

    /** {@inheritDoc} */
    public function setSettlement(array $data = array())
    {
        $this->settlement = $data;

        if ($this->getOption('emulation_geolocation', null, true)) {
            $this->glelement = array(
                'selected' => array(
                    'city' => array(
                        'name_ru' => @$data['name'],
                    ),
                ),
            );
        }

        return $this->settlement;
    }

    /** {@inheritDoc} */
    public function cleanSettlement()
    {
        if ($this->getOption('emulation_geolocation', null, true)) {
            $this->glelement = array();
        }

        return $this->setSettlement(array());
    }

    public function getUserBotByUserAgent()
    {
        $pattern = $this->getOption('bot_pattern', null, "~(Google|Yahoo|Rambler|Bot|Yandex|Spider|Snoopy|Crawler|Finder|Mail|curl)~i", true);

        return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
    }

    public function getDefaultSettlement()
    {
        $data = $this->getOption('default_settlement', null, '{"id":"7700000000000","country":"Россия","region_kladr_id":"7700000000000","region_with_type":"г Москва","region_type":"г","region_type_full":"город","region":"Москва","city_kladr_id":"7700000000000","city_with_type":"г Москва","city_type":"г","city_type_full":"город","city":"Москва","kladr_id":"7700000000000","okato":"45000000000","ip":"62.105.128.0"}', true);

        return json_decode($data, true);
    }

    public function getUserAddressByIp($ip = '')
    {
        $method = 'detectAddressByIp';

        /* check bot */
        if (empty($ip)) {
            $ip = $this->getClientIp();
        }
        if (empty($ip) OR $this->getUserBotByUserAgent()) {
            $data = $this->getDefaultSettlement();
            $ip = $this->getOption('ip', $data, '62.105.128.0', true);
        }

        $tmp = array(
            'cache_key' => $this->namespace . '/address/' . strtolower($ip),
            'cacheTime' => 3600,
        );

        if (!$data = $this->getCache($tmp)) {
            try {
                $client = new csDadataApi($this);
                $data = $client->$method($ip);
            } catch (csDadataApiException $exception) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, $exception->getMessage());
            }

            $data = $this->prepareResponseData($data, $method);
            if (!empty($data)) {
                $this->setCache($data, $tmp);
            }
        }

        return $data;

    }

    public function getAddressByKladr($kladr = '')
    {
        $method = 'findByIdAddress';

        $tmp = array(
            'cache_key' => $this->namespace . '/address/' . strtolower($kladr),
            'cacheTime' => 3600,
        );

        if (!$data = $this->getCache($tmp)) {
            try {
                $client = new csDadataApi($this);
                $data = $client->$method($kladr);
            } catch (csDadataApiException $exception) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, $exception->getMessage());
            }

            $data = $this->prepareResponseData($data, $method);
            if (!empty($data)) {
                $this->setCache($data, $tmp);
            }
        }

        return $data;

    }

    public function getSuggestSettlement(array $params = array())
    {
        $method = 'suggestSettlement';

        $params = array_merge(array(
            'contentType' => 'city',
            'WithParent'  => 1,
            'typeCode'    => 1,
            'oneString'   => 1,
            'limit'       => 50,
        ), $params);
        $tmp = array(
            'cache_key' => $this->namespace . '/address/' . sha1(json_encode($params)),
            'cacheTime' => 3600,
        );

        if (!$data = $this->getCache($tmp)) {
            try {
                $client = new csKladrApi($this);
                $data = $client->$method($params);
            } catch (csKladrApiException $exception) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, $exception->getMessage());
            }

            $data = $this->prepareResponseData($data, $method);
            if (!empty($data)) {
                $this->setCache($data, $tmp);
            }
        }

        return $data;

    }

    protected function prepareResponseData($data = array(), $method = '')
    {
        switch ($method) {
            case 'detectAddressByIp':
                if (isset($data['location'])) {
                    $data = $data['location'];
                }
                if (!empty($data['data'])) {
                    $ip = $data['value'];
                    $data = $data['data'];
                    $data['ip'] = $ip;
                } else {
                    $data = array();
                }

                if (empty($data)) {
                    $data = $this->getDefaultSettlement();
                }

                $data['id'] = @$data['city_kladr_id'];
                $data['name'] = @$data['city'];
                $data['type'] = @$data['city_type_full'];
                $data['typeShort'] = @$data['city_type'];

                break;

            case 'findByIdAddress':
                if (isset($data['suggestions'])) {
                    $data = $data['suggestions'];
                }
                if (!empty($data)) {
                    $data = reset($data);
                    $data = isset($data['data']) ? $data['data'] : array();
                } else {
                    $data = array();
                }
                break;

            case 'suggestSettlement':
                if (empty($data)) {
                    $data = array(array(
                        'id'          => '7700000000000',
                        'name'        => 'Москва',
                        'zip'         => 123182,
                        'type'        => 'Город',
                        'typeShort'   => 'г',
                        'okato'       => '45000000000',
                        'contentType' => 'city',
                    ));
                }

                foreach ($data as &$row) {
                    $row['type'] = mb_strtolower($row['type'], 'UTF-8');

                    $row['country'] = 'Россия';
                    $row['city'] = $row['name'];
                    $row['kladr_id'] = $row['id'];
                    $row['city_kladr_id'] = $row['id'];
                    $row['city_with_type'] = $row['typeShort'] . ' ' . $row['name'];
                    $row['city_type'] = $row['typeShort'];
                    $row['city_type_full'] = $row['type'];

                    if (isset($row['fullName'])) {
                        $tmp = explode(',', $row['fullName']);
                        $row['region_with_type'] = reset($tmp);
                    }
                }
                break;
            default:
                break;
        }

        return $data;
    }

    /** {@inheritDoc} */
    public function getClientIp($key = 'ip')
    {
        $this->modx->getRequest();
        $data = $this->modx->request->getClientIp();

        return !empty($key) ? $data[$key] : $data;
    }

    /** {@inheritDoc} */
    public function setCache($data = array(), $options = array())
    {
        return $this->pdoTools->setCache($data, $options);
    }

    /** {@inheritDoc} */
    public function getCache($options = array())
    {
        return $this->pdoTools->getCache($options);
    }

    /** {@inheritDoc} */
    public function clearCache($options = array())
    {
        return $this->pdoTools->clearCache($options);
    }

    /** @inheritdoc} */
    public function makePlaceholders(
        array $array = array(),
        $plPrefix = '',
        $prefix = '[[+',
        $suffix = ']]',
        $uncacheable = true
    )
    {
        return $this->pdoTools->makePlaceholders($array, $plPrefix, $prefix, $suffix, $uncacheable);
    }

}


/***************************************************************/

class csDadataApiException extends Exception
{
}

class csDadataApi
{
    /**
     * https://dadata.ru/api/detect_address_by_ip/
     */

    private $token;
    private $secret;
    private $apiUrl;
    private $apiSuggestionsUrl;
    private $partner = 'MODX.VGRISH';

    /* @var modX $modx */
    public $modx;
    /* @var citySelect $citySelect */
    public $citySelect;

    public function __construct(citySelect $citySelect)
    {
        $this->citySelect = $citySelect;
        $this->modx = $citySelect->modx;

        $this->apiUrl = $this->citySelect->getOption('dadata_api_url', null, 'https://dadata.ru/api/v2');
        $this->apiSuggestionsUrl = $this->citySelect->getOption('dadata_api_suggestions_url', null, 'https://suggestions.dadata.ru/suggestions/api/4_1/rs');
        $this->token = $this->citySelect->getOption('dadata_api_token', null);
        $this->secret = $this->citySelect->getOption('dadata_api_secret', null);
    }

    public function detectAddressByIp($ip = '', array $params = array())
    {
        $url = trim($this->apiSuggestionsUrl, '/') . '/detectAddressByIp?ip=' . $ip;
        $data = $this->request($url, $params, false);

        return isset($data['location']) ? $data : array();
    }

    public function findByIdAddress($query = '', $params = array())
    {
        $url = trim($this->apiSuggestionsUrl, '/') . '/findById/address';
        $data = $this->request($url, array_merge($params, array('query' => $query)), true);

        return isset($data['suggestions']) ? $data : array();
    }

    private function request($url, array $params = array(), $isPost = true, array $headers = array())
    {
        if (empty($url)) {
            $url = $this->apiUrl;
        }

        $timeout = $this->citySelect->getOption('curl_timeout', null, 15, true);

        if ($isPost) {
            $headers = array_merge($headers, array(
                "Content-Type: application/json",
                "Accept: application/json",
                "Authorization: Token {$this->token}",
                "X-Secret: {$this->secret}",
                "X-Partner: {$this->partner}",
            ));
            $opts = array(
                CURLOPT_RETURNTRANSFER => true,
                CURLINFO_HEADER_OUT    => true,
                CURLOPT_VERBOSE        => true,
                CURLOPT_HEADER         => false,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_CONNECTTIMEOUT => $timeout,
                CURLOPT_TIMEOUT        => $timeout,
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => json_encode($params),
                CURLOPT_URL            => $url,
                CURLOPT_HTTPHEADER     => $headers,
            );
        } else {
            $headers = array_merge($headers, array(
                "Accept: application/json",
                "Authorization: Token {$this->token}",
                "X-Partner: {$this->partner}",
            ));
            $opts = array(
                CURLOPT_RETURNTRANSFER => true,
                CURLINFO_HEADER_OUT    => true,
                CURLOPT_VERBOSE        => true,
                CURLOPT_HEADER         => false,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_CONNECTTIMEOUT => $timeout,
                CURLOPT_TIMEOUT        => $timeout,
                CURLOPT_POST           => false,
                CURLOPT_URL            => $url,
                CURLOPT_HTTPHEADER     => $headers,
            );
        }
        $curl = curl_init();
        curl_setopt_array($curl, $opts);
        $response = curl_exec($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($statusCode >= 400) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, print_r($url, 1));
            $this->modx->log(modX::LOG_LEVEL_ERROR, print_r($params, 1));
            $this->modx->log(modX::LOG_LEVEL_ERROR, $response);
        }
        $result = json_decode($response, true);

        return $result;
    }

}

/***************************************************************/

class csKladrApiException extends Exception
{
}

class csKladrApi
{
    /**
     * http://kladr-api.ru/integration/
     */

    private $token;
    private $apiUrl;

    /* @var modX $modx */
    public $modx;
    /* @var citySelect $citySelect */
    public $citySelect;

    public function __construct(citySelect $citySelect)
    {
        $this->citySelect = $citySelect;
        $this->modx = $citySelect->modx;

        $this->apiUrl = $this->citySelect->getOption('kladr_api_url', null, 'http://kladr-api.ru/api.php');
        $this->token = $this->citySelect->getOption('kladr_api_token', null);
    }

    public function suggestSettlement(array $params = array())
    {
        $url = trim($this->apiUrl, '/');
        $data = $this->request($url, $params, false);

        return isset($data['result']) ? $data['result'] : array();
    }

    private function request($url, array $params = array(), $isPost = true, array $headers = array())
    {
        if (empty($url)) {
            $url = $this->apiUrl;
        }

        $timeout = $this->citySelect->getOption('curl_timeout', null, 15, true);

        if ($isPost) {
            $headers = array_merge($headers, array(
                //"Content-Type: application/json",
                // "Accept: application/json",
                //"Authorization: Token {$this->token}",
                //"X-Partner: {$this->partner}",
            ));
            $opts = array(
                CURLOPT_RETURNTRANSFER => true,
                CURLINFO_HEADER_OUT    => true,
                CURLOPT_VERBOSE        => true,
                CURLOPT_HEADER         => false,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_CONNECTTIMEOUT => $timeout,
                CURLOPT_TIMEOUT        => $timeout,
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => json_encode($params),
                CURLOPT_URL            => $url,
                CURLOPT_HTTPHEADER     => $headers,
            );
        } else {

            if (!empty($this->token)) {
                $params['token'] = $this->token;
            }
            $url .= '?' . http_build_query($params);

            $headers = array_merge($headers, array(
                //"Accept: application/json",
                "Connection: close\r\n",
                // "X-Partner: {$this->partner}",
            ));
            $opts = array(
                CURLOPT_RETURNTRANSFER => true,
                CURLINFO_HEADER_OUT    => true,
                CURLOPT_VERBOSE        => true,
                CURLOPT_HEADER         => false,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_CONNECTTIMEOUT => $timeout,
                CURLOPT_TIMEOUT        => $timeout,
                CURLOPT_POST           => false,
                CURLOPT_URL            => $url,
                CURLOPT_HTTPHEADER     => $headers,
            );
        }
        $curl = curl_init();
        curl_setopt_array($curl, $opts);
        $response = curl_exec($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($statusCode >= 400) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, print_r($url, 1));
            $this->modx->log(modX::LOG_LEVEL_ERROR, print_r($params, 1));
            $this->modx->log(modX::LOG_LEVEL_ERROR, $response);
        }
        $result = json_decode($response, true);

        return $result;
    }

}

