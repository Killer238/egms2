<?php

/**
 * The home manager controller for msoptionscolor.
 *
 */
class msoptionscolorHomeManagerController extends msoptionscolorMainController
{
    /* @var msoptionscolor $msoptionscolor */
    public $msoptionscolor;


    /**
     * @param array $scriptProperties
     */
    public function process(array $scriptProperties = array())
    {
    }


    /**
     * @return null|string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('msoptionscolor');
    }


    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        $this->addCss($this->msoptionscolor->config['cssUrl'] . 'mgr/main.css');
        $this->addCss($this->msoptionscolor->config['cssUrl'] . 'mgr/bootstrap.buttons.css');
        $this->addJavascript($this->msoptionscolor->config['jsUrl'] . 'mgr/misc/utils.js');
        $this->addJavascript($this->msoptionscolor->config['jsUrl'] . 'mgr/widgets/items.grid.js');
        $this->addJavascript($this->msoptionscolor->config['jsUrl'] . 'mgr/widgets/items.windows.js');
        $this->addJavascript($this->msoptionscolor->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addJavascript($this->msoptionscolor->config['jsUrl'] . 'mgr/sections/home.js');
        $this->addHtml('<script type="text/javascript">
		Ext.onReady(function() {
			MODx.load({ xtype: "msoptionscolor-page-home"});
		});
		</script>');
    }


    /**
     * @return string
     */
    public function getTemplateFile()
    {
        return $this->msoptionscolor->config['templatesPath'] . 'home.tpl';
    }
}