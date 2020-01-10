<?php
class SeodomainsMorefieldsCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'SeodomainsMorefields';
    
    /**
     * var modX
     */
    public function beforeSet() {
        $domain = trim($this->getProperty('domain'));
        $key = trim($this->getProperty('key'));
        
        if (array_search($key, $this->modx->Seodomains->fields())) {
            $this->modx->error->addField('key', $this->modx->lexicon('seodomains_err_key_ae'));
        }
        
        if ($this->modx->getCount($this->classKey, array('domain' => $domain, 'key' => $key))) {
            $this->modx->error->addField('key', $this->modx->lexicon('seodomains_err_key_ae'));
        }
        
        return parent::beforeSet();
    }
}

return "SeodomainsMorefieldsCreateProcessor";