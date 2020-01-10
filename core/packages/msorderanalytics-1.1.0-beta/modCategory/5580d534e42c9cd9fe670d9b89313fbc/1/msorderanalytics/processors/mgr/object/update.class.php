<?php

class msoaObjectUpdateProcessor extends modObjectUpdateProcessor
{
    public $objectType = 'msoaObject';
    public $classKey = 'msoaObject';
    public $languageTopics = array('msorderanalytics:default');
    public $permission = 'save';
    /** @var msOrderAnalytics $msoa */
    protected $msoa;

    /**
     * @return bool
     */
    public function initialize()
    {
        $path = MODX_CORE_PATH . 'components/msorderanalytics/model/msorderanalytics/';
        if (!$this->msoa = $this->modx->getService('msorderanalytics', 'msOrderAnalytics', $path)) {
            return false;
        }
        $this->msoa->initialize($this->modx->context->key);

        return parent::initialize();
    }

    /**
     * @return bool|string
     */
    public function beforeSave()
    {
        if (!$this->checkPermissions()) {
            return $this->modx->lexicon('access_denied');
        }

        return parent::beforeSave();
    }

    /**
     * @return bool
     */
    public function beforeSet()
    {
        if (!$id = (int)$this->getProperty('id')) {
            return $this->modx->lexicon('msoa_err_ns');
        }

        // Проверяем на заполненность
        $required = array(
            'group',
            'parent',
            'name:msoa_err_required_name',
        );
        $this->msoa->tools->checkProcessorRequired($this, $required, 'msoa_err_required');

        // Проверяем на уникальность
        $unique = array(
            'name:msoa_err_unique_name',
        );
        $this->msoa->tools->checkProcessorUnique('', 0, $this, $unique, 'msoa_err_unique');

        return parent::beforeSet();
    }
}

return 'msoaObjectUpdateProcessor';