<?php
class SeodomainsResourceCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'SeodomainsResource';
    
    /**
     * var modX
     */
    public function beforeSet() {
        $domain = trim($this->getProperty('domain'));
        $resource = trim($this->getProperty('resource'));

        if ($this->modx->getCount($this->classKey, ['domain' => $domain, 'resource' => $resource])) {
            $this->modx->error->addField('domain', $this->modx->lexicon('seodomains_resource_domain_ae'));
        }
        
        return parent::beforeSet();
    }
}

return "SeodomainsResourceCreateProcessor";