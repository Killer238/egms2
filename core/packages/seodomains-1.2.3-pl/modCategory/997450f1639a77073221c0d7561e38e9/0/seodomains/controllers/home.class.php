<?php
/**
 * Home 
 */
class SeodomainsHomeManagerController extends modExtraManagerController {
    /** @var modExtra $Seodomains */
    public $Seodomains;
    
    /**
     *
     */
    public function initialize()
    {
        $this->Seodomains = $this->modx->getService('Seodomains', 'Seodomains', MODX_CORE_PATH . 'components/seodomains/model/');
        parent::initialize();
    }
    
    /**
     * 
     * @return string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('seodomains');
    }
    
    public function loadCustomCssJs() {
        $this->addCss($this->Seodomains->config['cssUrl'] . 'mgr/seodomains.css?v='.$this->Seodomains->config['version']);
        $this->addJavascript($this->Seodomains->config['jsUrl'] . 'mgr/seodomains.js?v='.$this->Seodomains->config['version']);
        $this->addJavascript($this->Seodomains->config['jsUrl'] . 'mgr/utils/utils.js?v='.$this->Seodomains->config['version']);
        $this->addJavascript($this->Seodomains->config['jsUrl'] . 'mgr/utils/combo.js?v='.$this->Seodomains->config['version']);
        $this->addJavascript($this->Seodomains->config['jsUrl'] . 'mgr/sections/home.js?v='.$this->Seodomains->config['version']);
        $this->addJavascript($this->Seodomains->config['jsUrl'] . 'mgr/widgets/city.grid.js?v='.$this->Seodomains->config['version']);
        $this->addJavascript($this->Seodomains->config['jsUrl'] . 'mgr/widgets/morefields.grid.js?v='.$this->Seodomains->config['version']);
        $this->addJavascript($this->Seodomains->config['jsUrl'] . 'mgr/widgets/city.windows.js?v='.$this->Seodomains->config['version']);
        $this->addJavascript($this->Seodomains->config['jsUrl'] . 'mgr/widgets/morefields.windows.js?v='.$this->Seodomains->config['version']);
        
        
        $this->addJavascript($this->Seodomains->config['jsUrl'] . 'mgr/widgets/import.form.js?v='.$this->Seodomains->config['version']);
        
        $this->addHtml('<script>
            Ext.onReady(function() {
                Seodomains.config = ' . json_encode($this->Seodomains->config) . ';
                Seodomains.config.connector_url = "' . $this->Seodomains->config['connectorUrl'] . '";

                MODx.add({
                    xtype: "seodomains-panel-home"
                });
            });
        </script>');
    }
    
    public function getLanguageTopics()
    {
        return array('Seodomains:default');
    }
    
    public function getTemplateFile()
    {
        return '';
    }
}