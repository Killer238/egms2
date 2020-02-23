<?php
require_once dirname(__FILE__) . '/update.class.php';

/**
 * SetProperty a msocColor
 */
class msocColorSetPropertyProcessor extends msocColorUpdateProcessor
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

    public function initialize() {
        $primaryKey = $this->getProperty($this->primaryKeyField,false);
        if (empty($primaryKey)) return $this->modx->lexicon($this->objectType.'_err_ns');
        $this->object = $this->modx->getObject($this->classKey,$primaryKey);
        if (empty($this->object)) return $this->modx->lexicon($this->objectType.'_err_nfs',array($this->primaryKeyField => $primaryKey));

        if ($this->checkSavePermission && $this->object instanceof modAccessibleObject && !$this->object->checkPolicy('save')) {
            return $this->modx->lexicon('access_denied');
        }

        $this->msoptionscolor = $this->modx->getService('msoptionscolor');
        $this->msoptionscolor->initialize($this->getProperty('context', $this->modx->context->key));

        return true;
    }

    /** {@inheritDoc} */
    public function beforeSet()
    {
        $fieldName = $this->getProperty('field_name', null);
        $fieldValue = $this->getProperty('field_value', null);

        $this->properties = $this->object->toArray();
        if (!is_null($fieldName) AND !is_null($fieldValue)) {
            $this->setProperty($fieldName, $fieldValue);
        }

        return parent::beforeSet();
    }

}

return 'msocColorSetPropertyProcessor';