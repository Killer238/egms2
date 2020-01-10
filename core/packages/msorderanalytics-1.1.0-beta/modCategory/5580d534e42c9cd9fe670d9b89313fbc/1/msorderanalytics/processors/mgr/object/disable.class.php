<?php

class msoaObjectDisableProcessor extends modObjectProcessor
{
    public $objectType = 'msoaObject';
    public $classKey = 'msoaObject';
    public $languageTopics = array('msorderanalytics:default');
    public $permission = 'save';

    /**
     * @return array|string
     */
    public function process()
    {
        if (!$this->checkPermissions()) {
            return $this->failure($this->modx->lexicon('access_denied'));
        }

        $ids = $this->modx->fromJSON($this->getProperty('ids'));
        if (empty($ids)) {
            return $this->failure($this->modx->lexicon('msoa_err_ns'));
        }

        foreach ($ids as $id) {
            /** @var msoaObject $object */
            if (!$object = $this->modx->getObject($this->classKey, $id)) {
                return $this->failure($this->modx->lexicon('msoa_err_nf'));
            }
            $object->set('active', false);
            $object->save();
        }

        return $this->success();
    }
}

return 'msoaObjectDisableProcessor';