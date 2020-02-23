<?php

class msocColorUpdateProcessor extends modObjectUpdateProcessor
{

    /** @var msocColor $object */
    public $object;
    public $objectType = 'msocColor';
    public $classKey = 'msocColor';
    public $languageTopics = array('msoptionscolor');
    public $permission = '';

    /** @var msoptionscolor $msoptionscolor */
    public $msoptionscolor;
    public $options = array();

    public function initialize()
    {
        $query = $this->getQuery();
        $this->object = $this->modx->getObject($this->classKey, $query);
        if (empty($this->object)) {
            return $this->modx->lexicon($this->objectType . '_err_nfs', $query);
        }
        $this->msoptionscolor = $this->modx->getService('msoptionscolor');
        $this->msoptionscolor->initialize($this->getProperty('context', $this->modx->context->key));

        return true;
    }


    public function beforeSet()
    {
        /** @var  $rid */
        /** @var  $key */
        foreach (array('rid', 'key') as $k) {
            ${$k} = trim($this->getProperty($k));
            if (empty(${$k})) {
                $this->addFieldError($k, $this->modx->lexicon('field_required'));
            }
        }
        $value = trim($this->getProperty('value'));

        $options = $this->msoptionscolor->setProductOptions($rid, array($key => $value), $key);
        $this->options[$key] = isset($options[$key]) ? $options[$key] : array();

        if (!in_array($value, $this->options[$key])) {
            $this->modx->error->addField('key', $this->modx->lexicon('field_required'));
            $this->modx->error->addField('value', $this->modx->lexicon('field_required'));
        }

        return !$this->hasErrors();
    }

    public function getQuery()
    {
        $query = array();
        foreach (array('rid', 'key', 'value') as $k) {
            $query[$k] = trim($this->getProperty($k));
        }

        return $query;
    }

    public function cleanup()
    {
        $array = $this->object->toArray();

        return $this->success('', $this->options);
    }

}

return 'msocColorUpdateProcessor';