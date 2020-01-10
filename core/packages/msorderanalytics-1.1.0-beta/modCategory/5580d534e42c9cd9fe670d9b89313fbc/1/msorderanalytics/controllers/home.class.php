<?php

class msOrderAnalyticsHomeManagerController extends modExtraManagerController
{
    /** @var msOrderAnalytics $msoa */
    public $msoa;

    /**
     *
     */
    public function initialize()
    {
        $path = MODX_CORE_PATH . 'components/msorderanalytics/model/msorderanalytics/';
        $this->msoa = $this->modx->getService('msorderanalytics', 'msOrderAnalytics', $path);

        parent::initialize();
    }

    /**
     * @return array
     */
    public function getLanguageTopics()
    {
        return array('msorderanalytics:default');
    }

    /**
     * @return bool
     */
    public function checkPermissions()
    {
        return true;
    }

    /**
     * @return null|string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('msorderanalytics');
    }

    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        $this->addCss($this->msoa->config['cssUrl'] . 'mgr/main.css');
        $this->addCss($this->msoa->config['cssUrl'] . 'mgr/bootstrap.buttons.css');

        $this->addJavascript($this->msoa->config['jsUrl'] . 'mgr/msorderanalytics.js');

        $this->addJavascript($this->msoa->config['jsUrl'] . 'mgr/misc/ux.js');
        $this->addJavascript($this->msoa->config['jsUrl'] . 'mgr/misc/utils.js');
        $this->addJavascript($this->msoa->config['jsUrl'] . 'mgr/misc/combo.js');

        $this->addJavascript($this->msoa->config['jsUrl'] . 'mgr/misc/default.grid.js');
        $this->addJavascript($this->msoa->config['jsUrl'] . 'mgr/misc/default.window.js');

        $this->addJavascript($this->msoa->config['jsUrl'] . 'mgr/widgets/objects.grid.js');
        $this->addJavascript($this->msoa->config['jsUrl'] . 'mgr/widgets/objects.window.js');

        $this->addJavascript($this->msoa->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addJavascript($this->msoa->config['jsUrl'] . 'mgr/sections/home.js');

        $this->addHtml('
            <script type="text/javascript">
                msOrderAnalytics.config = ' . json_encode($this->msoa->config) . ';
                msOrderAnalytics.config[\'connector_url\'] = "' . $this->msoa->config['connectorUrl'] . '";
                Ext.onReady(function() {
                    MODx.load({
                        xtype: "msorderanalytics-page-home",
                    });
                });
            </script>
        ');
    }

    /**
     * @return string
     */
    public function getTemplateFile()
    {
        return $this->msoa->config['templatesPath'] . 'home.tpl';
    }
}