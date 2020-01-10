<?php

class msoaObjectGetProcessor extends modObjectGetProcessor
{
    public $objectType = 'msoaObject';
    public $classKey = 'msoaObject';
    public $languageTopics = array('msorderanalytics:default');
    public $permission = 'view';

    /**
     * @return mixed
     */
    public function process()
    {
        if (!$this->checkPermissions()) {
            return $this->failure($this->modx->lexicon('access_denied'));
        }

        return parent::process();
    }
}

return 'msoaObjectGetProcessor';