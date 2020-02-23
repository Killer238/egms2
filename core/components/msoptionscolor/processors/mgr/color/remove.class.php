<?php

/**
 * Remove a msocColor
 */
class msocColorRemoveProcessor extends modObjectRemoveProcessor
{
    public $classKey = 'msocColor';
    public $languageTopics = array('msoptionscolor');
    public $permission = '';

    public function initialize()
    {
        return parent::initialize();
    }

    /** {@inheritDoc} */
    public function beforeRemove()
    {
        return parent::beforeRemove();
    }

    /** {@inheritDoc} */
    public function afterRemove()
    {
        return true;
    }

}

return 'msocColorRemoveProcessor';