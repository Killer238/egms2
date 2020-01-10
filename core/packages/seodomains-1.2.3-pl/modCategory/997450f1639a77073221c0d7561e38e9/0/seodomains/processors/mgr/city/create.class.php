<?php
class SeodomainsCityCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'SeodomainsCity';
    
    /**
     * var modX
     */
    public function beforeSet() {
        $domain = trim($this->getProperty('domain'));
        
        if ($this->modx->getOption('seodomains_cyrillic_domain')) {
            $domain = idn_to_utf8($domain);
        }
        
        if ($this->modx->getCount($this->classKey, array('domain' => $domain))) {
            $this->modx->error->addField('domain', $this->modx->lexicon('seodomains_err_name_ae'));
        } else {
        
            // Set coordinats
            if ($this->getProperty('address_full')) {
                $this->setProperty('address_coordinats', $this->modx->Seodomains->getCoordinats($this->getProperty('address_full')));
            } elseif ($this->getProperty('address')) {
                $this->setProperty('address_coordinats', $this->modx->Seodomains->getCoordinats($this->getProperty('address')));
            }

            // Set protocol
            $protocol = "http://";

            if ($this->getProperty('https')) {
                $protocol = "https://";
            }
            
            // For cyrillic domains
            $this->setProperty('domain', $domain);

            // Add site to Yandex webmaster
            $this->modx->Seodomains->addSite($protocol.$domain);
        }
        
        return parent::beforeSet();
    }
}

return "SeodomainsCityCreateProcessor";