<?php


abstract class citySelectResponseProcessor extends modProcessor
{
    /** @var  citySelect $citySelect */
    public $citySelect;
    public $languageTopics = array('cityselect');
    public $permission = '';

    function __construct(modX &$modx, array $properties = array())
    {
        parent::__construct($modx, $properties);

        if (!$namespace = $modx->getObject('modNamespace', 'cityselect')) {
            $error = "[citySelect] Not found modNamespace: cityselect ";
            $this->modx->log(modX::LOG_LEVEL_ERROR, $error);

            return $this->failure($error);
        }
    }

    public function initialize()
    {
        $corePath = $this->modx->getOption('cityselect_core_path', null,
            $this->modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/cityselect/');
        /** @var citySelect $citySelect */
        $this->citySelect = $this->modx->getService('cityselect', 'citySelect', $corePath . 'model/cityselect/',
            array('core_path' => $corePath));

        $ctx = (string)$this->getProperty('ctx', $this->modx->context->key);
        $this->citySelect->initialize($ctx);

        return true;
    }

}

return 'citySelectResponseProcessor';