<?php

/**
 * Get an msopModification
 */
class msocColorGetProcessor extends modObjectGetProcessor
{
    /** @var msocColor $object */
    public $object;
    public $objectType = 'msocColor';
    public $classKey = 'msocColor';
    public $languageTopics = array('msoptionscolor');
    public $permission = '';

    public function initialize()
    {
        $this->setProperties(json_decode($this->getProperty('query'), true));

        $query = $this->getQuery();
        $this->object = $this->modx->getObject($this->classKey, $query);
        if (empty($this->object)) {
            return $this->modx->lexicon($this->objectType . '_err_nfs', $query);
        }

        return true;
    }

    public function cleanup()
    {
        $array = $this->object->toArray();

        return $this->success('', $array);
    }

    public function getQuery()
    {
        $query = array();
        foreach (array('rid', 'key', 'value') as $k) {
            $query[$k] = trim($this->getProperty($k));
        }

        return $query;
    }

}

return 'msocColorGetProcessor';