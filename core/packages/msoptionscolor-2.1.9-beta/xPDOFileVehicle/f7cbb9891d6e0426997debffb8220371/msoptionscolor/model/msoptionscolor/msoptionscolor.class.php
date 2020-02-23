<?php

//ini_set('display_errors', 1);
//ini_set('error_reporting', -1);

/**
 * The base class for msoptionscolor.
 */
class msoptionscolor
{

    public $version = "2.1.9-beta";

    /** @var modX $modx */
    public $modx;

    /** @var mixed|null $namespace */
    public $namespace = 'msoptionscolor';
    /** @var array $config */
    public $config = array();
    /** @var array $initialized */
    public $initialized = array();

    /** @var miniShop2 $miniShop2 */
    public $miniShop2;

    /**
     * @param       $n
     * @param array $p
     */
    public function __call($n, array $p)
    {
        echo __METHOD__ . ' says: ' . $n;
    }

    /**
     * @param modX $modx
     * @param array $config
     */
    function __construct(modX &$modx, array $config = array())
    {
        $this->modx =& $modx;

        $corePath = $this->getOption('core_path', $config,
            $this->modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/msoptionscolor/');
        $assetsPath = $this->getOption('assets_path', $config,
            $this->modx->getOption('assets_path', null, MODX_ASSETS_PATH) . 'components/msoptionscolor/');
        $assetsUrl = $this->getOption('assets_url', $config,
            $this->modx->getOption('assets_url', null, MODX_ASSETS_URL) . 'components/msoptionscolor/');
        $connectorUrl = $assetsUrl . 'connector.php';

        $this->config = array_merge(array(
            'namespace'       => $this->namespace,
            'connectorUrl'    => $connectorUrl,
            'assetsBasePath'  => MODX_ASSETS_PATH,
            'assetsBaseUrl'   => MODX_ASSETS_URL,
            'assetsPath'      => $assetsPath,
            'assetsUrl'       => $assetsUrl,
            'cssUrl'          => $assetsUrl . 'css/',
            'jsUrl'           => $assetsUrl . 'js/',
            'corePath'        => $corePath,
            'modelPath'       => $corePath . 'model/',
            'handlersPath'    => $corePath . 'handlers/',
            'processorsPath'  => $corePath . 'processors/',
            'templatesPath'   => $corePath . 'elements/templates/mgr/',
            'jsonResponse'    => true,
            'prepareResponse' => true,
            'showLog'         => false,
        ), $config);


        $this->modx->addPackage('msoptionscolor', $this->config['modelPath']);
        $this->modx->lexicon->load('msoptionscolor:default');
        $this->namespace = $this->getOption('namespace', $config, 'msoptionscolor');

        $this->miniShop2 = $modx->getService('miniShop2');
        if (!($this->miniShop2 instanceof miniShop2)) {
            return;
        }

        $this->checkStat();
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

    public function initialize($ctx = 'web', array $scriptProperties = array())
    {
        if (isset($this->initialized[$ctx])) {
            return $this->initialized[$ctx];
        }

        $this->config = array_merge($this->config, $scriptProperties, array('ctx' => $ctx));

        if ($ctx != 'mgr' AND (!defined('MODX_API_MODE') OR !MODX_API_MODE)) {

        }

        $initialize = true;
        $this->initialized[$ctx] = $initialize;

        return $initialize;
    }

    /**
     * @return string
     */
    public function getVersionMiniShop2()
    {
        return isset($this->miniShop2->version) ? $this->miniShop2->version : '2.2.0';
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

        return $this->config['jsonResponse'] ? $this->modx->toJSON($response) : $response;
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

        return $this->config['jsonResponse'] ? $this->modx->toJSON($response) : $response;
    }


    /**
     * @param        $array
     * @param string $delimiter
     *
     * @return array
     */
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

    /**
     * @param array $array
     *
     * @return array
     */
    public function cleanArray(array $array = array())
    {
        $array = array_map('trim', $array);       // Trim array's values
        $array = array_filter($array);            // Remove empty values from array
        $array = array_keys(array_flip($array));  // Remove duplicate fields

        return $array;
    }

    /**
     * @param array $array1
     * @param array $array2
     *
     * @return array
     */
    public function array_merge_recursive_ex(array & $array1 = array(), array & $array2 = array())
    {
        $merged = $array1;

        foreach ($array2 as $key => & $value) {
            if (is_array($value) AND isset($merged[$key]) AND is_array($merged[$key])) {
                $merged[$key] = $this->array_merge_recursive_ex($merged[$key], $value);
            } else {
                if (is_numeric($key)) {
                    if (!in_array($value, $merged)) {
                        $merged[] = $value;
                    }
                } else {
                    $merged[$key] = $value;
                }
            }
        }

        return $merged;
    }

    /**
     * @param array $array
     * @param string $prefix
     *
     * @return array
     */
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

    public function isWorkingClassKey(modResource $resource)
    {
        return in_array($resource->get('class_key'),
            $this->explodeAndClean($this->getOption('working_class_key', null, 'msProduct', true)));
    }

    public function isWorkingTemplates(modResource $resource)
    {
        return in_array($resource->get('template'),
            $this->explodeAndClean($this->getOption('working_templates', null)));
    }

    /**
     * @param string $action
     * @param array $data
     *
     * @return array|modProcessorResponse|string
     */
    public function runProcessor($action = '', $data = array())
    {
        if ($error = $this->modx->getService('error', 'error.modError')) {
            $error->reset();
        }
        $processorsPath = !empty($this->config['processorsPath']) ? $this->config['processorsPath'] : MODX_CORE_PATH;
        /* @var modProcessorResponse $response */
        $response = $this->modx->runProcessor($action, $data, array('processors_path' => $processorsPath));

        return $this->config['prepareResponse'] ? $this->prepareResponse($response) : $response;
    }

    /**
     * This method returns prepared response
     *
     * @param mixed $response
     *
     * @return array|string $response
     */
    public function prepareResponse($response)
    {
        if ($response instanceof modProcessorResponse) {
            $output = $response->getResponse();
        } else {
            $message = $response;
            if (empty($message)) {
                $message = $this->lexicon('err_unknown');
            }
            $output = $this->failure($message);
        }
        if ($this->config['jsonResponse'] AND is_array($output)) {
            $output = $this->modx->toJSON($output);
        } else if (!$this->config['jsonResponse'] AND !is_array($output)) {
            $output = $this->modx->fromJSON($output);
        }

        return $output;
    }

    /** @return array Grid Color Fields */
    public function getGridColorFields()
    {
        $fields = $this->getOption('grid_color_fields', null,
            'rid,key,value', true);
        $fields .= ',rid,key,value,properties,actions';
        $fields = $this->explodeAndClean($fields);

        return $fields;
    }

    /** @return array Window Color Fields */
    public function getWindowColorFields()
    {
        $fields = $this->getOption('window_color_fields', null,
            'rid,name,key,value,color,color2,pattern,pattern2', true);
        $fields .= ',rid,key,value';
        $fields = $this->explodeAndClean($fields);

        return $fields;
    }


    /**
     * @param modManagerController $controller
     * @param array $setting
     */
    public function loadControllerJsCss(modManagerController &$controller, array $setting = array())
    {
        $controller->addLexiconTopic('msoptionscolor:default');

        $config = $this->config;
        if (is_object($controller->resource) AND $controller->resource instanceof xPDOObject) {
            $config['resource'] = $controller->resource->toArray();
        }

        $config['connector_url'] = $this->config['connectorUrl'];
        $config['grid_color_fields'] = $this->getGridColorFields();
        $config['window_color_fields'] = $this->getWindowColorFields();

        if (!empty($setting['css'])) {
            $controller->addCss($this->config['cssUrl'] . 'mgr/main.css');
            $controller->addCss($this->config['cssUrl'] . 'mgr/bootstrap.buttons.css');
        }

        if (!empty($setting['config'])) {
            $controller->addHtml("<script type='text/javascript'>msoptionscolor.config={$this->modx->toJSON($config)}</script>");
        }

        if (!empty($setting['tools'])) {
            $controller->addJavascript($this->config['jsUrl'] . 'mgr/msoptionscolor.js');
            $controller->addJavascript($this->config['jsUrl'] . 'mgr/misc/tools.js');
            $controller->addJavascript($this->config['jsUrl'] . 'mgr/misc/combo.js');
        }

        if (!empty($setting['color'])) {
            $controller->addCss($this->config['cssUrl'] . 'mgr/colorpicker/colorpicker.css');
            $controller->addLastJavascript($this->config['jsUrl'] . 'mgr/colorpicker/colorpicker.js');
            $controller->addLastJavascript($this->config['jsUrl'] . 'mgr/colorpicker/colorpicker.field.js');
            $controller->addLastJavascript($this->config['jsUrl'] . 'mgr/color/color.window.js');
            $controller->addLastJavascript($this->config['jsUrl'] . 'mgr/color/color.grid.js');
        }

        if (!empty($setting['resource/inject'])) {
            $controller->addLastJavascript($this->config['jsUrl'] . 'mgr/resource/inject/inject.tab.js');
            $controller->addLastJavascript($this->config['jsUrl'] . 'mgr/resource/inject/inject.panel.js');
        }

    }

    public function prepareOptionValues($values = null)
    {
        if ($values) {
            if (!is_array($values)) {
                $values = array($values);
            }
            // fix duplicate, empty option values
            $values = array_map('trim', $values);
            $values = array_keys(array_flip($values));
            $values = array_diff($values, array(''));

            if ($this->modx->getOption('msoptionsprice_sort_modification_option_values', null, true, false)) {
                sort($values);
            }

            if (empty($values)) {
                $values = null;
            }
        }

        return $values;
    }

    public function setProductOptions($rid = 0, array $values = array(), $only = null)
    {
        $options = array();
        /** @var $product msProduct */
        if (!$product = $this->modx->getObject('msProduct', array('id' => (int)$rid))) {
            return $options;
        }
        $options = $product->loadData()->get('options');

        foreach ($values as $k => $v) {
            if (!is_array($v)) {
                $v = array($v);
            }
            if (isset($options[$k])) {
                $options[$k] = array_merge($options[$k], $v);
            } else {
                $options[$k] = $v;
            }
        }

        foreach ($options as $k => $v) {
            $options[$k] = $this->prepareOptionValues($options[$k]);
            $product->set($k, $options[$k]);
        }
        $product->set('options', $options);
        $product->save();

        return $options;
    }

    /** TODO remove */
    public function setProductOptions_old($rid = 0, array $values = array(), $only = null)
    {
        $options = array();
        /** @var $product msProduct */
        if (!$product = $this->modx->getObject('msProduct', array('id' => (int)$rid))) {
            return $options;
        }

        $options = $product->loadData()->get('options');
        foreach ($values as $k => $v) {
            if (empty($k)) {
                continue;
            }
            if (isset($product->loadData()->_fields[$k])) {
                $option = $product->get($k);
            } else if (isset($options[$k])) {
                $option = $options[$k];
            } else {
                $option = array();
            }

            if (!is_array($option)) {
                $option = array($v);
            } else if (!in_array($v, $option)) {
                $option[] = $v;
            }

            $option = $this->prepareOptionValues($option);
            $product->set($k, $option);
            $product->set("options-{$k}", $option);
            $options[$k] = $option;
        }
        $product->save();

        return $options;
    }

    public function removeProductOptions($rid = 0, array $values = array(), $only = null)
    {
        $options = array();
        /** @var $product msProduct */
        if (!$product = $this->modx->getObject('msProduct', array('id' => (int)$rid))) {
            return $options;
        }
        $options = $product->loadData()->get('options');

        foreach ($values as $k => $v) {
            if (!isset($options[$k])) {
                continue;
            }
            if (!is_array($v)) {
                $v = array($v);
            }
            $options[$k] = array_diff($options[$k], $v);
        }

        foreach ($options as $k => $v) {
            $options[$k] = $this->prepareOptionValues($options[$k]);
            $product->set($k, $options[$k]);
        }
        $product->set('options', $options);
        $product->save();

        return $options;
    }


    /** TODO remove */
    public function removeProductOptions_old($rid = 0, array $values = array(), $only = null)
    {
        $options = array();
        /** @var $product msProduct */
        if (!$product = $this->modx->getObject('msProduct', array('id' => (int)$rid))) {
            return $options;
        }

        $options = $product->loadData()->get('options');
        foreach ($values as $k => $v) {
            if (empty($k)) {
                continue;
            }
            if (isset($product->loadData()->_fields[$k])) {
                $option = $product->get($k);
            } else if (isset($options[$k])) {
                $option = $options[$k];
            } else {
                $option = array();
            }

            if (empty($option)) {
                continue;
            }
            if (!is_array($v)) {
                $v = array($v);
            }
            $option = array_diff($option, $v);
            $option = $this->prepareOptionValues($option);
            $product->set($k, $option);
            $product->set("options-{$k}", $option);
            $options[$k] = $option;
        }
        $product->save();

        return $options;
    }

    public function getProductOptions(
        $rid = null,
        $key = null,
        $process = false,
        $prefix = ''
    )
    {
        $options = array();
        $classValue = 'msProductOption';

        $q = $this->modx->newQuery($classValue);
        if ($process) {
            $q->select($this->modx->getSelectColumns($classValue, $classValue));
        } else {
            $q->select($this->modx->getSelectColumns($classValue, $classValue, '', array('key', 'value'), false));
        }

        if ($this->modx->getOption('msoptionsprice_sort_modification_option_values', null, true, false)) {
            $q->sortby("{$classValue}.value", "ASC");
        }

        if (!is_null($rid)) {
            $q->where(array(
                "{$classValue}.product_id" => "{$rid}",
            ));
        }

        if ($q->prepare() AND $q->stmt->execute()) {
            while ($row = $q->stmt->fetch(PDO::FETCH_ASSOC)) {
                $k = $prefix . $row['key'];

                if (isset($options[$k])) {
                    if (!is_array($options[$k])) {
                        $options[$k] = array($options[$k]);
                    }
                    $options[$k][] = $row['value'];
                } else {
                    $options[$k][] = $row['value'];
                }

                if ($process) {
                    foreach ($row as $x => $value) {
                        $options[$k . '.' . $x] = $value;
                    }
                }
            }
        }

        if ($key AND !$process) {
            $options = $this->modx->getOption($key, $options, '', true);
        }

        return $options;
    }

    protected function checkStat()
    {
        $key = strtolower(__CLASS__);
        /** @var modDbRegister $registry */
        $registry = $this->modx->getService('registry', 'registry.modRegistry')->getRegister('user', 'registry.modDbRegister');
        $registry->connect();
        $registry->subscribe('/modstore/' . md5($key));
        if ($res = $registry->read(array('poll_limit' => 1, 'remove_read' => false))) {
            return;
        }
        $c = $this->modx->newQuery('transport.modTransportProvider', array('service_url:LIKE' => '%modstore%'));
        $c->select('username,api_key');
        /** @var modRest $rest */
        $rest = $this->modx->getService('modRest', 'rest.modRest', '', array(
            'baseUrl'        => 'https://modstore.pro/extras',
            'suppressSuffix' => true,
            'timeout'        => 1,
            'connectTimeout' => 1,
        ));

        if ($rest) {
            $level = $this->modx->getLogLevel();
            $this->modx->setLogLevel(modX::LOG_LEVEL_FATAL);
            $rest->post('stat', array(
                'package'            => $key,
                'version'            => $this->version,
                'keys'               => ($c->prepare() AND $c->stmt->execute()) ? $c->stmt->fetchAll(PDO::FETCH_ASSOC) : array(),
                'uuid'               => $this->modx->uuid,
                'database'           => $this->modx->config['dbtype'],
                'revolution_version' => $this->modx->version['code_name'] . '-' . $this->modx->version['full_version'],
                'supports'           => $this->modx->version['code_name'] . '-' . $this->modx->version['full_version'],
                'http_host'          => $this->modx->getOption('http_host'),
                'php_version'        => XPDO_PHP_VERSION,
                'language'           => $this->modx->getOption('manager_language'),
            ));
            $this->modx->setLogLevel($level);
        }
        $registry->subscribe('/modstore/');
        $registry->send('/modstore/', array(md5($key) => true), array('ttl' => 3600 * 24));
    }

}