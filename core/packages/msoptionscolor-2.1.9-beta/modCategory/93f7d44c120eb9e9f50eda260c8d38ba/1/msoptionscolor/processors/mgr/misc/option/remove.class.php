<?php

class msocColorOptionRemoveProcessor extends modProcessor
{
    public $classKey = 'msocColor';
    public $classField = 'msocColor';
    public $permission = '';

    /** @var msoptionscolor $msoptionscolor */
    public $msoptionscolor;

    public function initialize()
    {
        $this->msoptionscolor = $this->modx->getService('msoptionscolor');
        $this->msoptionscolor->initialize($this->getProperty('context', $this->modx->context->key));

        return parent::initialize();
    }

    public function process()
    {
        $ids = json_decode($this->getProperty('ids'), true);
        @list($rid, $key, $value) = $this->getProperty('id', $ids[0]);

        $query = array(
            'rid'   => $rid,
            'key'   => $key,
            'value' => $value,
        );
        $object = $this->modx->getObject($this->classKey, $query);
        if ($object AND $object->remove()) {
            $options = $this->msoptionscolor->removeProductOptions($rid, array($key => $value), $key);
            $options = isset($options[$key]) ? $options[$key] : array();

            return $this->success('', array($key => $options));
        }

        return $this->success('');
    }

}

return 'msocColorOptionRemoveProcessor';
